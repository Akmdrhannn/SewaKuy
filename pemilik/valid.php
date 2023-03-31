<?php
require "../config.php";
$id = $_GET['id'];
$aksi = $_GET['aksi'];
if ($aksi =='valid') {
  $update = "UPDATE booking
    SET validasi = 'sudah'
    WHERE id_booking = '$id'";
  mysqli_query($koneksi,$update);
  echo "<script>
          alert('Booking telah tervalidasi!');
          document.location.href = 'validasi.php';
        </script>";

}elseif ($aksi =='tolak') {
  $hapus = "DELETE FROM booking
    WHERE id_booking = '$id'";
  mysqli_query($koneksi,$hapus);
  echo "<script>
          alert('Booking telah ditolak!');
          document.location.href = 'validasi.php';
        </script>";
}



?>