<?php
require "../config.php";
$aksi = $_GET['aksi'];
$user = $_GET['user'];
if ($aksi == 'sudah'){
  $update = "UPDATE user
      SET verif= 'sudah'
      WHERE username = '$user'";
  mysqli_query($koneksi, $update);
  echo "<script>
          alert('".$user." telah tervalidasi!');
          document.location.href = 'home.php';
        </script>";
}elseif ($aksi == 'tolak'){
  $delete = "DELETE FROM user WHERE username = '$user'";
  mysqli_query($koneksi, $delete);
  echo "<script>
          alert('".$user." telah ditolak!');
          document.location.href = 'home.php';
        </script>";
}

?>