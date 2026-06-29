<?php
require_once __DIR__ . '/../config/Database.php';

class Barang extends Database {

    public function __construct() {
        parent::__construct();
    }

    public function tampilSemua($search = "") {
        $query = "SELECT barang.*, kategori.nama_kategori 
                  FROM barang 
                  LEFT JOIN kategori ON barang.id_kategori = kategori.id_kategori";
        
        if (!empty($search)) {
            $query .= " WHERE barang.nama_barang LIKE ?";
            $stmt = $this->conn->prepare($query);
            $searchParam = "%" . $search . "%";
            $stmt->bind_param("s", $searchParam);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $query .= " ORDER BY barang.id_barang DESC";
            $result = $this->conn->query($query);
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function tambah($nama_barang, $harga, $stok, $id_kategori) {
        $stmt = $this->conn->prepare("INSERT INTO barang (nama_barang, harga, stok, id_kategori) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siii", $nama_barang, $harga, $stok, $id_kategori);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function ambilMasingMasing($id_barang) {
        $stmt = $this->conn->prepare("SELECT * FROM barang WHERE id_barang = ?");
        $stmt->bind_param("i", $id_barang);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function ubah($id_barang, $nama_barang, $harga, $stok, $id_kategori) {
        $stmt = $this->conn->prepare("UPDATE barang SET nama_barang = ?, harga = ?, stok = ?, id_kategori = ? WHERE id_barang = ?");
        $stmt->bind_param("siiii", $nama_barang, $harga, $stok, $id_kategori, $id_barang);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function hapus($id_barang) {
        $stmt = $this->conn->prepare("DELETE FROM barang WHERE id_barang = ?");
        $stmt->bind_param("i", $id_barang);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>