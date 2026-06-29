<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$base_path = dirname(__DIR__, 2);
require_once $base_path . '/views/layout/header.php';
require_once $base_path . '/classes/kategori.php';

$kategoriObj = new Kategori();

if (isset($_GET['action']) && $_GET['action'] == 'hapus') {
    $id = intval($_GET['id']);
    if ($kategoriObj->hapus($id)) {
        echo "<script>alert('Kategori berhasil dihapus!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus kategori.'); window.location='index.php';</script>";
    }
}

$dataKategori = $kategoriObj->tampilSemua();
?>

<div>
    <h3>Daftar Kategori Barang</h3>
    <a href="tambah.php" class="button">➕ Tambah Kategori</a>
</div>

<div>
    <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($dataKategori)): ?>
                    <tr>
                        <td colspan="3">Belum ada data kategori.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($dataKategori as $ktg): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($ktg['nama_kategori']); ?></td>
                            <td>
                                <a href="edit.php?id=<?= $ktg['id_kategori']; ?>">Edit</a>
                                <a href="index.php?action=hapus&id=<?= $ktg['id_kategori']; ?>" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
</div>

<?php
require_once $base_path . '/views/layout/footer.php';
?>