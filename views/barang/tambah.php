<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../../classes/barang.php';
require_once __DIR__ . '/../../classes/kategori.php';

$kategoriObj = new Kategori();
$barangObj = new Barang();

$dataKategori = $kategoriObj->tampilSemua();

if (isset($_POST['simpan'])) {
    $nama_barang = trim($_POST['nama_barang']);
    $id_kategori = intval($_POST['id_kategori']);
    $harga = intval($_POST['harga']);
    $stok = intval($_POST['stok']);
    
    if (!empty($nama_barang) && $id_kategori > 0) {
        if ($barangObj->tambah($nama_barang, $harga, $stok, $id_kategori)) {
            echo "<script>alert('Barang berhasil ditambahkan!'); window.location='index.php';</script>";
        } else {
            echo "<div>Gagal menambahkan data barang!</div>";
        }
    } else {
        echo "<div>Semua data wajib diisi dengan benar!</div>";
    }
}
?>

<h4>Tambah Barang Baru</h4>
<form action="" method="POST">
    <div>
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" placeholder="Masukkan nama barang" required>
    </div>
    
    <div>
        <label>Kategori</label>
        <select name="id_kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($dataKategori as $ktg): ?>
                <option value="<?= $ktg['id_kategori']; ?>"><?= htmlspecialchars($ktg['nama_kategori']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Harga (Rp)</label>
        <input type="number" name="harga" placeholder="Contoh: 50000" min="0" required>
    </div>
    <div>
        <label>Stok Awal</label>
        <input type="number" name="stok" placeholder="Contoh: 10" min="0" required>
    </div>

    <div>
        <a href="index.php" class="button button-kembali">Kembali</a>
        <button type="submit" name="simpan">Simpan Barang</button>
    </div>
</form>

<?php
require_once __DIR__ . '/../layout/footer.php';
?>