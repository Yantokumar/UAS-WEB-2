<?php
require_once __DIR__ . '/../../classes/transaksi.php';

$transaksiObj = new Transaksi();
$dataTransaksi = $transaksiObj->tampilSemua();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Inventaris Barang</title>
    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

<div>
    <div>
        <div>
            <h2>LAPORAN MUTASI BARANG INVENTARIS</h2>
            <p>Dicetak pada tanggal: <?= date('d-m-Y H:i'); ?></p>
        </div>
        <div class="no-print">
            <button onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
            <a href="http://localhost/uas-inventaris/index.php">Kembali</a>
        </div>
    </div>

    <hr>

    <table border="1" cellpadding="5" cellspacing="0" style="width:100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Jenis Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($dataTransaksi)): ?>
                <tr>
                    <td colspan="5">Belum ada data sirkulasi barang.</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; foreach ($dataTransaksi as $trx): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= date('d-m-Y', strtotime($trx['tanggal'])); ?></td>
                        <td><?= htmlspecialchars($trx['nama_barang'] ?? 'Barang Terhapus'); ?></td>
                        <td><?= $trx['jumlah']; ?></td>
                        <td>
                            <?= $trx['jenis'] == 'masuk' ? 'Masuk' : 'Keluar'; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>