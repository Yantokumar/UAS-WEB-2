<?php
require_once __DIR__ . '/Database.php';

class Auth extends Database {
    
    public function __construct() {
        parent::__construct();
    }

    public function register($username, $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $cekUser = $this->conn->prepare("SELECT username FROM users WHERE username = ?");
        $cekUser->bind_param("s", $username);
        $cekUser->execute();
        $cekUser->store_result();
        
        if ($cekUser->num_rows > 0) {
            return "Username sudah digunakan!";
        }
        
        $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $passwordHash);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return "Registrasi gagal.";
        }
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT id_user, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['username'] = $username;
                return true;
            }
        }
        return "Username atau password salah!";
    }

    public function cekLogin() {
        if (!isset($_SESSION['login'])) {
            header("Location: http://localhost/uas-inventaris/login.php");
            exit;
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: http://localhost/uas-inventaris/login.php");
        exit;
    }
}
?>