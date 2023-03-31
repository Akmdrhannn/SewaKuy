<?php
require "../config.php";
$id = $_GET['id'];
$update = "UPDATE booking
    SET bayar = 'lunas'
    WHERE id_booking = '$id'";

mysqli_query($koneksi,$update);
echo "<script>
        alert('Anda berhasil membayar!');
        document.location.href = 'status.php';
      </script>";

?>