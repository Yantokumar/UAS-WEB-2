<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../../classes/barang.php';
require_once __DIR__ . '/../../classes/transaksi.php';

$barangObj = new Barang();
$transaksiObj = new Transaksi();

$dataBarang = $barangObj->tampilSemua();

if (isset($_POST['simpan'])) {
    $id_barang = intval($_POST['id_barang']);
    $tanggal = $_POST['tanggal'];
    $jumlah = intval($_POST['jumlah']);
    $jenis = 'keluar';

    if ($id_barang > 0 && !empty($tanggal) && $jumlah > 0) {
        $hasil = $transaksiObj->tambahTransaksi($id_barang, $tanggal, $jumlah, $jenis);
        if ($hasil === true) {
            echo "<script>alert('Transaksi barang keluar berhasil dicatat!'); window.location='index.php';</script>";
        } else {
            echo "<div class='alert alert-danger'><strong>Gagal mendaftarkan transaksi:</strong> " . $hasil . "</div>";
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h4 class="card-title mb-4 fw-bold text-danger">Input Barang Keluar</h4>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Pilih Barang</label>
                        <select name="id_barang" class="form-select" required>
                            <option value="">-- Pilih Barang --</option>
                            <?php foreach ($dataBarang as $brg): ?>
                                <option value="<?= $brg['id_barang']; ?>"><?= htmlspecialchars($brg['nama_barang']); ?> (Tersedia: <?= $brg['stok']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Keluar</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah Keluar</label>
                        <input type="number" name="jumlah" class="form-control" min="1" placeholder="Masukkan jumlah barang" required>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="index.php" class="btn btn-secondary btn-sm">Kembali</a>
                        <button type="submit" name="simpan" class="btn btn-danger btn-sm">Kurangi Stok</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../layout/footer.php';
?>