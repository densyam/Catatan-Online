<?php
include 'config/koneksi.php';
session_start();

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        if (password_verify($password, $data['password'])) {
            $_SESSION["id"] = $data['id'];
            $_SESSION["nama"] = $data['nama'];
            $_SESSION["username"] = $data['username'];

            header("Location: dashboard.php");
            exit;
        } else {
            echo "<script>alert('Password salah!'); window.location='index.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/sb-admin-2.min.css">
</head>
<body class="bg-gradient-dark">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h1 class="h4 text-gray-900">Login</h1>
                    </div>
                    <form action="" method="post">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control form-control-user" name="username" placeholder="Masukkan Username" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control form-control-user" name="password" placeholder="Masukkan Password" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                            Login
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="auth/register.php">Buat Akun Baru!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="asset/js/bootstrap.bundle.min.js"></script>
</body>
</html>