<?php
$host   = getenv('DB_HOST');
$user   = getenv('DB_USER');
$pass   = getenv('DB_PASS');
$dbname = getenv('DB_NAME');
$port   = (int) getenv('DB_PORT');

$koneksi = mysqli_init();

mysqli_ssl_set($koneksi, NULL, NULL, NULL, NULL, NULL);

$connected = mysqli_real_connect(
    $koneksi, 
    $host, 
    $user, 
    $pass, 
    $dbname, 
    $port, 
    NULL, 
    MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT
);

if (!$connected) {
    die("Koneksi ke database Aiven gagal: " . mysqli_connect_error());
}
?>