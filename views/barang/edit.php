<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../../classes/barang.php';
require_once __DIR__ . '/../../classes/kategori.php';

$barangObj = new Barang();
$kategoriObj = new Kategori();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);
$detail = $barangObj->ambilMasingMasing($id);
$dataKategori = $kategoriObj->tampilSemua();

if (!$detail) {
    echo "<script>alert('Data barang tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

if (isset($_POST['ubah'])) {
    $nama_barang = trim($_POST['nama_barang']);
    $id_kategori = intval($_POST['id_kategori']);
    $harga = intval($_POST['harga']);
    $stok = intval($_POST['stok']);
    
    if (!empty($nama_barang) && $id_kategori > 0) {
        if ($barangObj->ubah($id, $nama_barang, $harga, $stok, $id_kategori)) {
            echo "<script>alert('Data barang berhasil diperbarui!'); window.location='index.php';</script>";
        } else {
            echo "<div>Gagal memperbarui data!</div>";
        }
    }
}
?>

<div>
    <div>
        <div>
            <div>
                <h4>Ubah Data Barang</h4>
                <form action="" method="POST">
                    <div>
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" value="<?= htmlspecialchars($detail['nama_barang']); ?>" required>
                    </div>
                    
                    <div>
                        <label>Kategori</label>
                        <select name="id_kategori" required>
                            <?php foreach ($dataKategori as $ktg): ?>
                                <option value="<?= $ktg['id_kategori']; ?>" <?= $ktg['id_kategori'] == $detail['id_kategori'] ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($ktg['nama_kategori']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <div>
                            <label>Harga (Rp)</label>
                            <input type="number" name="harga" value="<?= $detail['harga']; ?>" min="0" required>
                        </div>
                        <div>
                            <label>Stok</label>
                            <input type="number" name="stok" value="<?= $detail['stok']; ?>" min="0" required>
                        </div>
                    </div>

                    <div>
                        <a href="index.php">Kembali</a>
                        <button type="submit" name="ubah">Perbarui Barang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../layout/footer.php';
?>