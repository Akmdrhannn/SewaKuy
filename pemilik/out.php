<?php 
require "../config.php";
$id = $_GET['id'];
mysqli_query($koneksi,"UPDATE booking SET aktif = 'false' WHERE id_kamar ='$id'");
mysqli_query($koneksi,"UPDATE kamar SET status='tersedia' WHERE id_kamar=$id ");
echo "<script>
        alert('Kamar kembali tersedia!');
        document.location.href = 'status.php';
      </script>";