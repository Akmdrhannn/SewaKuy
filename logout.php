<?php
include "header.php";
// session_start();
$uname = $_SESSION['username'];
$add = "INSERT INTO log (username, waktu, aktif) VALUES ('$uname',' ', 'logout' )";
$resultFinal = mysqli_query($koneksi, $add);
session_destroy();

echo "<script>
        alert('Anda berhasil logout!');
        document.location.href = 'index.php';
    </script>";?>