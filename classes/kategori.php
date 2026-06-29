<?php
$base_path = dirname(__DIR__);
require_once $base_path . '/config/Database.php';

class Kategori extends Database {

    public function __construct() {
        parent::__construct();
    }

    public function tampilSemua() {
        $query = "SELECT * FROM kategori ORDER BY id_kategori DESC";
        $result = $this->conn->query($query);
        
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function tambah($nama_kategori) {
        $stmt = $this->conn->prepare("INSERT INTO kategori (nama_kategori) VALUES (?)");
        $stmt->bind_param("s", $nama_kategori);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function ambilMasingMasing($id_kategori) {
        $stmt = $this->conn->prepare("SELECT * FROM kategori WHERE id_kategori = ?");
        $stmt->bind_param("i", $id_kategori);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function ubah($id_kategori, $nama_kategori) {
        $stmt = $this->conn->prepare("UPDATE kategori SET nama_kategori = ? WHERE id_kategori = ?");
        $stmt->bind_param("si", $nama_kategori, $id_kategori);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function hapus($id_kategori) {
        $stmt = $this->conn->prepare("DELETE FROM kategori WHERE id_kategori = ?");
        $stmt->bind_param("i", $id_kategori);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>