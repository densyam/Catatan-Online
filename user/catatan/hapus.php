<?php
include '../config/koneksi.php';
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM catatan where id='$id'");
header("Location: ../dashboard.php");
?>