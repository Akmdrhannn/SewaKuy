<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Preview</title>
</head>
<body>
  <?php
  include "../config.php";
  
  $username = $_GET['username'];
  
  $sql = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username'");
  $tampil = mysqli_fetch_array($sql);
  
  
  ?>
  <embed src="../berkas/<?php echo $tampil['berkas']; ?>" width='100%' height='700px'>
</body>
</html>