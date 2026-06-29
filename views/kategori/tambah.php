<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$base_path = dirname(__DIR__, 2);
require_once $base_path . '/views/layout/header.php';
require_once $base_path . '/classes/kategori.php';

if (isset($_POST['simpan'])) {
    $nama_kategori = trim($_POST['nama_kategori']);
    
    if (!empty($nama_kategori)) {
        $kategoriObj = new Kategori();
        if ($kategoriObj->tambah($nama_kategori)) {
            echo "<script>alert('Kategori baru berhasil ditambahkan!'); window.location='index.php';</script>";
        } else {
            echo "<div class='alert alert-danger'>Gagal menambahkan data!</div>";
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-4 fw-bold">Tambah Kategori Baru</h4>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Contoh: Elektronik, Pakaian, dll." required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary btn-sm">Kembali</a>
                        <button type="submit" name="simpan" class="btn btn-primary btn-sm">Simpan Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once $base_path . '/views/layout/footer.php';
?>