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
    if ($_SESSION['level'] != 'admin') {
        header("Location: /".$_SESSION['level']."/home.php");
    }
}
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
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
        <h1><a href="index.php">SEWAKUY</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="active" href="home.php">Validasi Pemilik</a></li>
          <li><a href="aktivitasakun.php">Aktivitas Akun</a></li>
          <li><a href="../logout.php">Keluar</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- navbar -->

    </div>
  </header><!-- End Header -->

  <body>
<?php
        $sql = "SELECT * FROM user WHERE level='pemilik' AND verif='belum'";
        $data = mysqli_query($koneksi,$sql);
        if ($data->num_rows == 0) {
          ?>
          <!-- ======= Hero Section ======= -->
          <section class="hero-section" id="hero" style='height: 500px; padding-top: 90px'>

          <div class="wave">

          <svg width="100%" height="355px" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
                  <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z" id="Path"></path>
              </g>
              </g>
          </svg>

          </div>

          <div class="container">
          <div class="row align-items-center">
              <div class="col-12 hero-text-image">
              <div class="row">
                  <div class="col-lg-8 text-center text-lg-start">
                  <h1 data-aos="fade-right">Tidak ada user</h1>
                  </div>
              </div>
              </div>
          </div>
          </div>

          <?php
        } else { ?>
        <!-- ======= Hero Section ======= -->
      <section class="hero-section" id="hero">
        <div class="wave">
          <svg width="100%" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
                  <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z" id="Path"></path>
                </g>
              </g>
          </svg>
        </div>
        <div class="px-4 py-5 px-md-5 text-center text-lg-start" >
          <div class="container">
            <div class="row justify-content-center text-center " style="margin-top: 90px;">
              <div class="col-md-5" data-aos="fade-up">
                <h2 class="text-white">Validasi User Pemilik</h2>
              </div>
            </div>
            <div class="row align-items-center"  style="margin-top: 40px;">
            <div class="col">
              <div class="card">
              <div class="card-header">
              <h2 class="card-title">Daftar User</h2>
              </div>
              <div class="card-body">
              <div class="row">
              <div class="col-md-2">
              </div>
              <div class="table-responsive">
              <table class="table">
              <tbody>
              <tr>
                <th><strong>Username</h3></strong></td>
                <th><strong>Nama</h3></strong></td>
                <th><strong>Alamat Kos</h3></strong></td>
                <th><strong>Email</h3></strong></td>
          		<th><strong>Berkas</h3></strong></td>
                <th><strong>Aksi</h3></strong></td>
              </tr>
            <?php while ($tampil = mysqli_fetch_array($data)){ ?>
            <tr>
                <td><?php echo $tampil['username']; ?></td>
                <td><?php echo $tampil['nama']; ?></td>
                <td><?php echo $tampil['alamat_kos']; ?></td>
                <td><?php echo $tampil['email']; ?></td>
                <td><a href="filedownload.php?username=<?php echo $tampil['username']; ?>"><u>Lihat</u></a></td>
            
                <td>
                  <button><a type="submit" name="valid" href="validasi.php?aksi=sudah&user=<?php echo $tampil['username']; ?>">VALIDASI</a></button>
                  <button><a type="submit" name="tolak" href="validasi.php?aksi=tolak&user=<?php echo $tampil['username']; ?>">TOLAK</a></button>
                </td>
            </tr>
            
            
      
          <?php } } ?>
          <!-- Jumbotron -->
        </table>
          </div>
            </div>
          </div>
        </div>
          </div>
          </div>
</section>


   <!-- ======= Footer ======= -->
   <footer class="footer" role="contentinfo">
    <!-- <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4 mb-md-0">
          <h3>About SoftLand</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius ea delectus pariatur, numquam aperiam
            dolore nam optio dolorem facilis itaque voluptatum recusandae deleniti minus animi.</p>
          <p class="social">
            <a href="#"><span class="bi bi-twitter"></span></a>
            <a href="#"><span class="bi bi-facebook"></span></a>
            <a href="#"><span class="bi bi-instagram"></span></a>
            <a href="#"><span class="bi bi-linkedin"></span></a>
          </p>
        </div>
        <div class="col-md-7 ms-auto">
          <div class="row site-section pt-0">
            <div class="col-md-4 mb-4 mb-md-0">
              <h3>Navigation</h3>
              <ul class="list-unstyled">
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Features</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
              <h3>Services</h3>
              <ul class="list-unstyled">
                <li><a href="#">Team</a></li>
                <li><a href="#">Collaboration</a></li>
                <li><a href="#">Todos</a></li>
                <li><a href="#">Events</a></li>
              </ul>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
              <h3>Downloads</h3>
              <ul class="list-unstyled">
                <li><a href="#">Get from the App Store</a></li>
                <li><a href="#">Get from the Play Store</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div> -->

      <div class="row justify-content-center text-center">
        <div class="col-md-7">
          <p class="copyright">&copy; Copyright SoftLand. All Rights Reserved</p>
          <div class="credits">
            <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=SoftLand
          -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </div>
      </div>

    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>


</html>