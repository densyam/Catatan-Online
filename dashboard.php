<?php
include 'config/koneksi.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$nama = $_SESSION['nama'] ?? '';
$id   = $_SESSION['id'] ?? '';
$total_catatan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM catatan where id='$id'"))['total'];
$total_kategori = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kategori"))['total'];

$kategori_query = mysqli_query($koneksi, "SELECT k.jenis, COUNT(c.id) AS jumlah FROM kategori k LEFT JOIN catatan c ON k.id = c.id_kategori AND c.id_user='$id' GROUP BY k.id");
$kategori_nama = [];
$kategori_jumlah = [];
while ($row = mysqli_fetch_assoc($kategori_query)) {
    $kategori_nama[] = $row['jenis'];
    $kategori_jumlah[] = $row['jumlah'];
}
$query = mysqli_query($koneksi,"SELECT c.id, c.judul, c.isi, c.tanggal, u.nama as nama_user, k.jenis FROM catatan c JOIN user u on c.id_user = u.id LEFT JOIN kategori k on c.id_kategori = k.id where c.id_user='$id' order by c.tanggal DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?= $nama; ?></title>
    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/sb-admin-2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body id="page-top">

<div id="wrapper">
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
            <div class="sidebar-brand-text mx-3">Kelola Catatan</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item active">
            <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="user/catatan/catatan.php">Data Catatan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="user/kategori/kategori.php">Data Kategori</a>
        </li>
        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link" href="auth/ganti_password.php">Ganti Password</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="auth/logout.php">Logout</a>
        </li>
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content" class="p-4">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Selamat datang, <?= $nama; ?>.</h1>
                                <a href="user/catatan/tambah.php" class="btn btn-primary mb-3">Tambah Catatan</a>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Catatan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Isi</th>
                                        <th>Kategori</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($data = mysqli_fetch_assoc($query)) {
                                        $kategori = $data['jenis'] ? $data['jenis'] : "-";
                                        echo "
                                        <tr>
                                            <td>".$no++."</td>
                                            <td>".$data['judul']."</td>
                                            <td>".$data['isi']."</td>
                                            <td>".$kategori."</td>
                                            <td>".$data['tanggal']."</td>
                                            <td>
                                                <a href='user/catatan/edit.php?id={$data['id']}' class='btn btn-sm btn-warning'>Edit</a>
                                                <a href='user/catatan/hapus.php?id={$data['id']}' onclick=\"return confirm('Yakin ingin menghapus catatan ini?');\" class='btn btn-sm btn-danger'>Hapus</a>
                                            </td>
                                        </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Statistik Catatan per Kategori</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="grafikKategori" width="400" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="asset/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="asset/js/sb-admin-2.min.js"></script>


<script>
    const ctx = document.getElementById('grafikKategori').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($kategori_nama); ?>,
            datasets: [{
                label: 'Jumlah Catatan',
                data: <?= json_encode($kategori_jumlah); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {y: {beginAtZero: true}}
        }
    });
</script>
</body>
</html>