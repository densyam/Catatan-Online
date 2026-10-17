<?php
include '../../config/koneksi.php';
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM kategori where id='$id'");
header("Location: ../../kategori/kategori.php");
?>