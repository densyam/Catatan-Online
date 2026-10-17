<?php
include '../../config/koneksi.php';
$query = mysqli_query($koneksi, "SELECT c.id, c.judul, c.isi, c.tanggal, u.nama as nama_user, k.jenis FROM catatan c JOIN user u on c.id_user = u.id LEFT JOIN kategori k on c.id_kategori = k.id order by c.tanggal DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Catatan</title>
    <link rel="stylesheet" href="../../asset/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../asset/css/sb-admin-2.min.css">
</head>
<body id="page-top">

<div id="wrapper">
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../dashboard.php">
            <div class="sidebar-brand-text mx-3">Kelola Catatan</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="../../dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../../kategori/kategori.php">Data Kategori</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="../../catatan/catatan.php">Data Catatan</a>
        </li>
        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link" href="../../auth/logout.php">Logout</a>
        </li>
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content" class="p-4">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Data Catatan</h1>


                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Jenis Kategori</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($data = mysqli_fetch_assoc($query)) {
                                echo "<tr>
                                    <td>".$no++."</td>
                                    <td>".$data['judul']."</td>
                                    <td>".$data['isi']."</td>
                                    <td>".$data['jenis']."</td>
                                    <td>".$data['tanggal']."</td>
                                    <td>
                                        <a href='edit.php?id={$data['id']}' class='btn btn-sm btn-warning'>Edit</a>
                                        <a href='hapus.php?id={$data['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus catatan ini?');\">Hapus</a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../asset/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../asset/js/sb-admin-2.min.js"></script>
</body>
</html>