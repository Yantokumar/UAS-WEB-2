<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../../classes/barang.php';

$barangObj = new Barang();

$search = isset($_GET['search']) ? trim($_GET['search']) : "";

if (isset($_GET['action']) && $_GET['action'] == 'hapus') {
    $id = intval($_GET['id']);
    if ($barangObj->hapus($id)) {
        echo "<script>alert('Barang berhasil dihapus!'); window.location='index.php';</script>";
    }
}

$dataBarang = $barangObj->tampilSemua($search);
?>

<div>
    <h3>Daftar Stok Barang</h3>
    <a href="tambah.php" class="button">➕ Tambah Barang</a>
</div>

<div>
    <form action="" method="GET">
        <input type="text" name="search" placeholder="Cari nama barang..." value="<?= htmlspecialchars($search); ?>" style="width: 300px; display: inline-block;">
        <button type="submit">Cari</button>
        <?php if(!empty($search)): ?>
            <a href="index.php" class="button button-kembali">Reset</a>
        <?php endif; ?>
    </form>
</div>

<div>
    <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori (Join)</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($dataBarang)): ?>
                    <tr>
                        <td colspan="6">Data barang tidak ditemukan.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($dataBarang as $brg): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($brg['nama_barang']); ?></td>
                            <td><?= htmlspecialchars($brg['nama_kategori'] ?? 'Tanpa Kategori'); ?></td>
                            <td>Rp <?= number_format($brg['harga'], 0, ',', '.'); ?></td>
                            <td><?= $brg['stok']; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $brg['id_barang']; ?>">Edit</a>
                                <a href="index.php?action=hapus&id=<?= $brg['id_barang']; ?>" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
</div>

<?php
require_once __DIR__ . '/../layout/footer.php';
?>