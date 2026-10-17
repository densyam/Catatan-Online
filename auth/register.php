<?php
include '../config/koneksi.php';
session_start();

if (isset($_POST["register"])) {
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $konfirmasi = $_POST["konfirmasi"];

    $cek = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username sudah digunakan!'); window.location='register.php';</script>";
        exit;
    }

    if ($password !== $konfirmasi) {
        echo "<script>alert('Konfirmasi password tidak sesuai!'); window.location='register.php';</script>";
        exit;
    }

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (nama, username, password, role) VALUES ('$nama', '$username', '$password_hashed', 'user')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='../index.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat registrasi.'); window.location='register.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../asset/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/sb-admin-2.min.css">
</head>
<body class="bg-gradient-dark">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h1 class="h4 text-gray-900">Buat Akun Baru</h1>
                    </div>
                    <form action="" method="post">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control form-control-user" name="nama" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control form-control-user" name="username" placeholder="Masukkan Username" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control form-control-user" name="password" placeholder="Masukkan Password" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control form-control-user" name="konfirmasi" placeholder="Konfirmasi Password" required>
                        </div>
                        <button type="submit" name="register" class="btn btn-primary btn-user btn-block">
                            Register
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="../index.php">Sudah punya akun? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../asset/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>