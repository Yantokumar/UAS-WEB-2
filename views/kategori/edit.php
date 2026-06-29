<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$base_path = dirname(__DIR__, 2);
require_once $base_path . '/views/layout/header.php';
require_once $base_path . '/classes/kategori.php';

$kategoriObj = new Kategori();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);
$detail = $kategoriObj->ambilMasingMasing($id);

if (!$detail) {
    echo "<script>alert('Data kategori tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

if (isset($_POST['ubah'])) {
    $nama_kategori = trim($_POST['nama_kategori']);
    
    if (!empty($nama_kategori)) {
        if ($kategoriObj->ubah($id, $nama_kategori)) {
            echo "<script>alert('Kategori berhasil diperbarui!'); window.location='index.php';</script>";
        } else {
            echo "<div>Gagal memperbarui data!</div>";
        }
    }
}
?>

<h4>Ubah Kategori</h4>
<form action="" method="POST">
    <div>
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" value="<?= htmlspecialchars($detail['nama_kategori']); ?>" required>
    </div>
    <div>
        <a href="index.php" class="button button-kembali">Kembali</a>
        <button type="submit" name="ubah">Perbarui Data</button>
    </div>
</form>

<?php
require_once $base_path . '/views/layout/footer.php';
?>