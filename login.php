<?php
session_start();
require_once 'config/Auth.php';

$auth = new Auth();
$pesan = "";

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    $hasil = $auth->login($username, $password);
    if ($hasil === true) {
        header("Location: index.php");
        exit;
    } else {
        $pesan = $hasil;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Inventaris</title>
</head>
<body>
<div>
    <h4>Login</h4>
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
            <button type="submit" name="login">Masuk</button>
        </div>
    </form>
    <p>Belum punya akun? <a href="register.php">Daftar</a></p>
</div>
</body>
</html>