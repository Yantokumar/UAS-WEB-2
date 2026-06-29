<?php
// views/layout/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$base_path = dirname(__DIR__, 2);
require_once $base_path . '/config/Auth.php';

$auth = new Auth();
$auth->cekLogin();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris Barang</title>
    <link rel="stylesheet" href="http://localhost/uas-inventaris/assets/css/style.css">
</head>
<body>

<nav>
    <div>
        <a href="http://localhost/uas-inventaris/index.php"> Inventaris Apps</a>
        <div>
            <ul>
                <li><a href="http://localhost/uas-inventaris/index.php">Dashboard</a></li>
                <li><a href="http://localhost/uas-inventaris/views/kategori/index.php">Kategori</a></li>
                <li><a href="http://localhost/uas-inventaris/views/barang/index.php">Data Barang</a></li>
                <li><a href="http://localhost/uas-inventaris/views/transaksi/index.php">Transaksi</a></li>
                <li><a href="http://localhost/uas-inventaris/views/transaksi/laporan.php">Laporan</a></li>
            </ul>
            <div class="user-info">
                <span>Halo, <strong><?= htmlspecialchars($_SESSION['username']); ?></strong></span>
                <a href="http://localhost/uas-inventaris/logout.php" onclick="return confirm('Yakin ingin logout?')">Logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="container">