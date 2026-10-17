<?php
include '../config/koneksi.php';

if (isset($_POST["simpan"])) {
    $jenis = $_POST["jenis"];
    $keterangan = $_POST["keterangan"];

    $query = mysqli_query($koneksi, "INSERT INTO kategori (jenis, keterangan) VALUES ('$jenis','$keterangan')");
    echo "<script>alert('Kategori berhasil ditambahkan!'); window.location.href='../kategori/kategori.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <link rel="stylesheet" href="../asset/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/sb-admin-2.min.css">
</head>
<body id="page-top">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Kategori</h5>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis Kategori</label>
                    <input type="text" class="form-control" id="jenis" name="jenis" required>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="kategori.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<script src="../asset/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../asset/js/sb-admin-2.min.js"></script>
</body>
</html>