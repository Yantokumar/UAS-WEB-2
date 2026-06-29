<?php
session_start();
require_once 'config/Auth.php';

$auth = new Auth();
$pesan = "";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (!empty($username) && !empty($password)) {
        $hasil = $auth->register($username, $password);
        if ($hasil === true) {
            echo "<script>alert('Registrasi berhasil! Silahkan login.'); window.location='login.php';</script>";
        } else {
            $pesan = $hasil;
        }
    } else {
        $pesan = "Semua field harus diisi!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi - Sistem Inventaris</title>
</head>
<body>
<div>
    <h4>Buat Akun</h4>
    <?php if($pesan): ?>
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;"><?= $pesan; ?></div>
    <?php endif; ?>
    <form action="" method="POST">
        <div>
            <label>Username</label><br>
            <input type="text" name="username" required>
        </div>
        <div style="margin-top: 10px;">
            <label>Password</label><br>
            <input type="password" name="password" required>
        </div>
        <div style="margin-top: 15px;">
            <button type="submit" name="register">Daftar</button>
        </div>
    </form>
    <p>Sudah ada akun? <a href="login.php">Login</a></p>
</div>
</body>
</html>