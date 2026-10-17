<?php
session_start();
include '../../config/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit;
}

$username = $_SESSION['username'];

if (isset($_POST["ubah"])) {
    $password_lama = $_POST["password_lama"];
    $password_baru = $_POST["password_baru"];
    $konfirmasi = $_POST["konfirmasi"];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    $user = mysqli_fetch_assoc($query);

    if (!password_verify($password_lama, $user['password'])) {
        echo "<script>alert('Password lama salah!'); window.location='ganti_password.php';</script>";
        exit;
    }

    if ($password_baru !== $konfirmasi) {
        echo "<script>alert('Konfirmasi password tidak sesuai!'); window.location='ganti_password.php';</script>";
        exit;
    }

    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

    $update = mysqli_query($koneksi, "UPDATE user SET password='$password_hash' WHERE username='$username'");

    if ($update) {
        echo "<script>alert('Password berhasil diubah, silakan login ulang!'); window.location='logout.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengubah password.'); window.location='ganti_password.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password | SB Admin 2</title>

    <link href="../asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../asset/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-dark">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-7 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">

                        <div class="text-center mb-4">
                            <h1 class="h4 text-gray-900 mb-2">Ganti Password</h1>
                            <p class="mb-4">Silakan isi form di bawah untuk mengganti password Anda.</p>
                        </div>

                        <form class="user" action="" method="post">
                            <div class="form-group">
                                <label for="password_lama">Password Lama</label>
                                <input type="password" class="form-control form-control-user" name="password_lama" id="password_lama" required>
                            </div>
                            <div class="form-group">
                                <label for="password_baru">Password Baru</label>
                                <input type="password" class="form-control form-control-user" name="password_baru" id="password_baru" required>
                            </div>
                            <div class="form-group">
                                <label for="konfirmasi">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control form-control-user" name="konfirmasi" id="konfirmasi" required>
                            </div>

                            <button type="submit" name="ubah" class="btn btn-primary btn-user btn-block">
                                Simpan
                            </button>
                            <a href="../dashboard.php" class="btn btn-secondary btn-user btn-block">
                                Kembali
                            </a>
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </div>

    <script src="../asset/vendor/jquery/jquery.min.js"></script>
    <script src="../asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../asset/js/sb-admin-2.min.js"></script>

</body>
</html>