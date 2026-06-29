<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "yusuf12";
    private $db_name = "db_inventaris";
    protected $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        
        if ($this->conn->connect_error) {
            die("Koneksi database gagal: " . $this->conn->connect_error);
        }
    }
}
?>