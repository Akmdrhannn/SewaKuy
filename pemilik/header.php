<!DOCTYPE html>
<html lang="en">
<?php
require "../config.php";
session_start();
if (!isset($_SESSION['level'])) {
    if (isset($_GET['level']) && isset($_GET['username']) ) {
    	$level = $_GET['level'];
      	$username = $_GET['username'];
    	$_SESSION['level'] = $level;
      	$_SESSION['username'] = $username;
    }else {
    header("Location: ../login.php");
    }
}else {
    if ($_SESSION['level'] != 'pemilik') {
        header("Location: /".$_SESSION['level']."/home.php");
    }
}

$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '".$_SESSION['username']."'");
$tampil = mysqli_fetch_array($sql);
?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SewaKuy</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="./assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <!-- jQuery Rating -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

  <!-- =======================================================
  * Template Name: SoftLand - v4.7.0
  * Template URL: https://bootstrapmade.com/softland-bootstrap-app-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1><a href="home.php">SEWAKUY</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="active " href="home.php">Beranda</a></li>
          <li><a href="kos.php">Kamar Kos</a></li>
          <li><a href="kelola.php">Kelola Kamar</a></li>
          <li><a href="validasi.php">Validasi Booking</a></li>
          <li><a href="status.php">Status</a></li>
          <li><a href="laporan.php">Laporan</a></li>
          <li class="dropdown"><a href="profil.php"><img style="width: 30px; height:30px; border-radius: 100%;" src="../profil/<?php echo $tampil['foto_profil']; ?>">&nbsp;<?php echo $tampil['nama']; ?></a>
            <ul>
              <li><a href="profil.php">Lihat Profil</a></li>
              <li><a href="../logout.php">Keluar</a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- navbar -->
    </div>
  </header><!-- End Header -->