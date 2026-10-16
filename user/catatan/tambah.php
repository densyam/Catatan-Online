<?php
include '../../config/koneksi.php';
session_start();
$id_user = $_SESSION['id'];
if (isset($_POST["simpan"])) {
    $judul = $_POST["judul"];
    $isi = $_POST["isi"];
    $id_kategori = $_POST["id_kategori"];
    $tanggal = $_POST["tanggal"];

    $query = mysqli_query($koneksi, "INSERT INTO catatan (judul, isi, id_user, id_kategori, tanggal) VALUES ('$judul', '$isi', '$id_user', '$id_kategori', '$tanggal')");
    echo "<script>alert('Catatan berhasil ditambahkan!'); window.location.href='../../dashboard.php'</script>";
}
$kategori = mysqli_query($koneksi, "SELECT * FROM kategori order by jenis ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Catatan</title>
    <link rel="stylesheet" href="../../asset/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../asset/css/sb-admin-2.min.css">
</head>
<body id="page-top">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Catatan</h5>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" required>
                </div>
                <div class="mb-3">
                    <label for="isi" class="form-label">Isi</label>
                    <textarea class="form-control" id="isi" name="isi" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="id_kategori" name="id_kategori" required>
                        <option value="" selected disabled>Pilih Kategori</option>
                        <?php while ($row = mysqli_fetch_assoc($kategori)) { ?>
                            <option value="<?= $row['id']; ?>"><?= $row['jenis'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="../../dashboard.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<script src="../../asset/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../asset/js/sb-admin-2.min.js"></script>
</body>
</html>