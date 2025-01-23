<?php
require_once __DIR__ . '../../../init.php';

$obj_buku = $modelBuku->getAllBukuFromDB();
// var_dump($obj_buku);
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-base-200 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php require_once __DIR__ . '../../includes/navbar.php' ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php require_once __DIR__ . '../../includes/sidebar.php' ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="container mx-auto overflow-y-auto h-[calc(100vh-4rem)]">
                <div class="bg-base-100 shadow-xl rounded-box p-6">
                    <h1 class="text-4xl font-bold mb-6 text-primary">Manage Buku</h1>

                    <div class="flex justify-between items-center mb-6">
                        <div class="form-control">
                            <input id="search-input" type="text" name="query" placeholder="Search By Judul or Pengarang"
                                class="input input-bordered w-full max-w-xs" />
                        </div>

                        <button class="btn btn-primary">
                            <i class="fa-solid fa-plus mr-2"></i>
                            <a href=".././views/buku/buku_input.php">Add New Buku</a>
                        </button>
                    </div>

                    <!-- Buku Table -->
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>Buku ID</th>
                                    <th>Judul</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Stok</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($obj_buku as $buku){ ?>
                                <tr>
                                    <td class="text-primary font-medium"><?= $buku->id ?></td>
                                    <td><?= $buku->judul ?></td>
                                    <td><?= $buku->pengarang ?></td>
                                    <td><?= $buku->penerbit ?></td>
                                    <td><?= $buku->tahunTerbit ?></td>
                                    <td><?= $buku->stok ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="../../views/buku/buku_update.php?id=<?= $buku->id ?>"
                                                class="btn btn-sm btn-warning">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <button class="btn btn-sm btn-error"
                                                onclick="return confirmDelete(<?= $buku->id ?>)">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function confirmDelete(bukuId) {
        if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
            window.location.href = "../../response_input.php?modul=buku&fitur=delete&id=" + bukuId;
        } else {
            alert("Gagal menghapus data");
            return false;
        }
    }
    </script>

</body>

</html>