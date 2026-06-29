<?php
require_once __DIR__ . '/../config/Database.php';

class Transaksi extends Database {

    public function __construct() {
        parent::__construct();
    }

    public function tampilSemua() {
        $query = "SELECT transaksi.*, barang.nama_barang 
                  FROM transaksi 
                  LEFT JOIN barang ON transaksi.id_barang = barang.id_barang 
                  ORDER BY transaksi.id_transaksi DESC";
        $result = $this->conn->query($query);
        
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function tambahTransaksi($id_barang, $tanggal, $jumlah, $jenis) {
        $this->conn->begin_transaction();

        try {
            $stmt = $this->conn->prepare("INSERT INTO transaksi (id_barang, tanggal, jumlah, jenis) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isis", $id_barang, $tanggal, $jumlah, $jenis);
            $stmt->execute();

            $stmtBarang = $this->conn->prepare("SELECT stok FROM barang WHERE id_barang = ?");
            $stmtBarang->bind_param("i", $id_barang);
            $stmtBarang->execute();
            $barang = $stmtBarang->get_result()->fetch_assoc();
            $stokSekarang = $barang['stok'];

            if ($jenis == 'masuk') {
                $stokBaru = $stokSekarang + $jumlah;
            } else {
                $stokBaru = $stokSekarang - $jumlah;
                if ($stokBaru < 0) {
                    throw new Exception("Stok tidak mencukupi untuk transaksi keluar!");
                }
            }

            $updateBarang = $this->conn->prepare("UPDATE barang SET stok = ? WHERE id_barang = ?");
            $updateBarang->bind_param("ii", $stokBaru, $id_barang);
            $updateBarang->execute();

            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            $this->conn->rollback();
            return $e->getMessage();
        }
    }
}
?>