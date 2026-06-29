<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../../classes/transaksi.php';

$transaksiObj = new Transaksi();
$dataTransaksi = $transaksiObj->tampilSemua();
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold text-dark">Riwayat Transaksi Barang</h3>
    <div>
        <a href="masuk.php" class="btn btn-success btn-sm me-2">➕ Barang Masuk</a>
        <a href="keluar.php" class="btn btn-danger btn-sm">➖ Barang Keluar</a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">No</th>
                    <th>Tanggal</th>
                    <th>Nama Barang (Join)</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Jenis</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($dataTransaksi)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada riwayat transaksi.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($dataTransaksi as $trx): ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= date('d-m-Y', strtotime($trx['tanggal'])); ?></td>
                            <td class="fw-bold"><?= htmlspecialchars($trx['nama_barang'] ?? 'Barang Dihapus'); ?></td>
                            <td class="text-center font-monospace"><?= $trx['jumlah']; ?></td>
                            <td class="text-center">
                                <?php if($trx['jenis'] == 'masuk'): ?>
                                    <span class="badge bg-success w-75">MASUK</span>
                                <?php else: ?>
                                    <span class="badge bg-danger w-75">KELUAR</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once __DIR__ . '/../layout/footer.php';
?>