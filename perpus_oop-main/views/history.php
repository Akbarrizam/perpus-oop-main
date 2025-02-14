<?php
require_once __DIR__ . '../../init.php';

$user = unserialize($_SESSION['anggota_login']);
$historyPeminjaman = $modelPeminjaman->getPeminjamanByUserId($user->id);

?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>History - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen">
    <!-- Navbar -->
    <div class="navbar bg-white shadow-lg sticky top-0 z-50">
        <div class="flex-1">
            <a href="./index.php" class="btn btn-ghost normal-case text-xl text-modern-primary font-bold">
                <i class="fas fa-book-reader mr-2"></i> Perpustakaan
            </a>
        </div>
        <div class="flex-none">
            <a href="./index.php" class="btn btn-ghost text-modern-secondary hover:text-modern-primary">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>
    </div>

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">
            <i class="fas fa-history text-primary mr-3"></i>
            Riwayat Peminjaman
        </h1>
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-primary text-primary-content">
                                <th class="rounded-tl-lg">Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Jumlah</th>
                                <th class="rounded-tr-lg">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($historyPeminjaman as $peminjaman): ?>
                            <?php foreach ($peminjaman->detailPeminjaman as $detail): ?>
                            <tr class="hover">
                                <td class="font-semibold">
                                    <?php 
                                            $buku = $modelBuku->getBukuById($detail->buku_id);
                                            echo htmlspecialchars($buku->judul);
                                            ?>
                                </td>
                                <td><?= htmlspecialchars($peminjaman->tanggal_pinjam); ?></td>
                                <td><?= htmlspecialchars($peminjaman->tanggal_kembali); ?></td>
                                <td><?= htmlspecialchars($detail->jumlah); ?></td>
                                <td>
                                    <?php 
                                            $status = $modelStatus->getStatusById($peminjaman->status_id);
                                            if ($status->status_nama == 'Dikembalikan'): ?>
                                    <span class="badge badge-success gap-2">
                                        <i class="fas fa-check"></i>
                                        <?= htmlspecialchars($status->status_nama); ?>
                                    </span>
                                    <?php else: ?>
                                    <span class="badge badge-warning gap-2">
                                        <i class="fas fa-clock"></i>
                                        <?= htmlspecialchars($status->status_nama); ?>
                                    </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

