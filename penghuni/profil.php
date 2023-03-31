<?php
include "header.php";
$sql = "SELECT * FROM user WHERE username = '".$_SESSION['username']."';";
$data = mysqli_query($koneksi,$sql);
$data_profil = mysqli_fetch_assoc($data);
?>
    <!-- Section: Design Block -->
<section class="hero-section" id="hero">
  <div class="wave">

      <svg width="100%" height="355px" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
            <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z" id="Path"></path>
          </g>
        </g>
      </svg>

    </div>
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" >
    <div class="container">
      <div class="row align-items-center"  style="margin-top: 40px;">
        <div class="col">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Your Profile</h3>
            </div>
            <div class="card-body">
            <div class="row row-2">
            <div class="col-md-3">
            <img style="width: 250px; height:250px" src="../profil/<?php echo $data_profil['foto_profil']; ?>">
            </div>
            <div class="col-md-9">
            <h4>Your Profile</h4>
            <div class="table-responsive">
            <table class="table table-bordered">
            <tbody><tr>
            <td><strong>Nama</strong></td>
            <td><?php echo $data_profil['nama']; ?></td>
            </tr>
            <tr>
            <td><strong>Username</strong></td>
            <td><?php echo $data_profil['username']; ?></td>
            </tr>
            <tr>
            <td><strong>Jenis Kelamin</strong></td>
            <td><?php echo $data_profil['jk']; ?></td>
            </tr>
            <tr>
            <td><strong>Email</strong></td>
            <td><?php echo $data_profil['email']; ?></td>
            </tr>
            <tr>
            <td><strong>Nomor Hp</strong></td>
            <td><?php echo $data_profil['nomor_hp']; ?></td>
            </tr>
            </tbody></table>
            </div>
            </div>
            </div>
            </div>
            <div class="card-footer">
            <a href="editprofil.php" class="btn btn-primary">
            Edit Profile
            </a>
            </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Jumbotron -->
</section>

<?php include "footer.php"; ?>