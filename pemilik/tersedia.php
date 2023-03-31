<?php 
require "../config.php";
$id = $_GET['id'];
$status = $_GET['status'];
if ($status == "tersedia") {
    $update = "UPDATE kamar
        SET status = 'tidak tersedia' 
        WHERE id_kamar = '$id'";
} else {
    $update = "UPDATE kamar
        SET status = 'tersedia'
        WHERE id_kamar = '$id'";
}
mysqli_query($koneksi,$update);
header("Location: kelola.php");

?>