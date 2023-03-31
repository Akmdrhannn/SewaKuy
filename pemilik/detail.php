<?php
  require "header.php";
  $id = $_GET['id'];
  $sql = mysqli_query($koneksi,"SELECT * FROM kamar WHERE id_kamar=$id");
  $data = mysqli_fetch_array($sql);

?>


<!-- ======= Hero Section ======= -->
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

<div class="container">
  <div class="row align-items-center">
    <div class="col-12 hero-text-image ">
      <div class="row">
        <div class="col-lg-8 text-center text-lg-start">
          <h1 data-aos="fade-right" class="aos-init aos-animate" style="margin-top: 70px;"><?= strtoupper($data['nama_kamar']) ?></h1>
          <iframe width="700" height="500" allowfullscreen style="border-style:none;" src="https://cdn.pannellum.org/2.5/pannellum.htm#panorama=<?= $data['link'] ?>"></iframe>
        </div>
        <div class="col-lg-4" style="margin-top: 150px;">
          <div class=" text-center text-lg-start ">
            <div class="card">
              <img src="../kamar/<?= $data['gambar_kamar'] ?>" class="card-img-top" alt="<?= $data['gambar_kamar'] ?>" style="height: 350px;">
              <div class="card-body" >
                <h5 class="card-title"><?= strtoupper($data['nama_kamar']) ?></h5>
                <p class="card-text" style="color: gray;"><?= $data['alamat'] ?><br>Jarak dari UTM <?= $data['jarak_utm'] ?> meter</p>
 				<p class="card-text" style="color: gray;"><br>Status Kamar : <b><?= strtoupper($data['status']) ?></b> </p>
                <form action="" method="post">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="inputPassword6" class="col-form-label"><h4>Mulai Kos</h4></label>
                        </div>
                        <div class="col-auto">
                            <input readonly type="date" required name="tanggal" id="inputPassword6" class="form-control" placeholder="DD/MM/YYYY">
                        </div>
                    </div>
                    <br>
                    <input disabled type="submit" name="submit" value="booking" class="btn btn-primary">
                </form>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</section><!-- End Hero -->

<!-- ======= Home Section ======= -->
<section class="section">
<div class="container">

  <div class="row justify-content-left mb-3 ">
    <div class="col-md-6" style="box-shadow: 10px 0 5px -2px gray;" data-aos="fade-right">
      <h2 class="section-heading">Fasilitas</h2>
      <div class="card">
      <div class="card-body">
        <ul>
          <?php
            $sql_fas = mysqli_query($koneksi, "SELECT id_fasilitas FROM fasilitas_kamar WHERE id_kamar=$id");
            while ($fas = mysqli_fetch_array($sql_fas)){
              $sql_fasil = mysqli_query($koneksi, "SELECT * FROM fasilitas WHERE id_fasilitas='{$fas['id_fasilitas']}'");
              while ($fas_kamar = mysqli_fetch_array($sql_fasil)){
          ?>
            <li><?= $fas_kamar['fasilitas'] ?></li>
          <?php } } ?>
        </ul>
      </div>
    </div>
    </div>
    <div class="col-md-2"></div>
    

  </div>
  <div class="row justify-content-left mb-3">
    <div class="col-md-6" style="box-shadow: 10px 0 5px -2px gray;" data-aos="fade-right">
      <h2 class="section-heading">Rules</h2>
      <div class="card">
      <div class="card-body">
        <p><?= $data['aturan'] ?></p>
      </div>
    	</div>
    </div>
   	<div class="col-md-2"></div>
        <div class="col-md-4" style="box-shadow: 10px 0 5px -2px gray; padding: 20px"  data-aos="fade-right">
          <h2 class="section-heading text-center">Ulasan</h2>

          <?php
            $sql_rt = mysqli_query($koneksi, "SELECT * FROM rating WHERE id_kamar=$id");
            while ($ulasan = mysqli_fetch_array($sql_rt)){
            $id_rt = $ulasan['id_rating'];
            $rate = $ulasan['rate'];
          ?>
          <div class="card" style="margin: 5px">
          <div class="card-body">

              <div class="row">
                <div class="col-sm-4" ><?= $ulasan['username'] ?></div>
                <div class="col-sm-4"><?= $ulasan['tanggal_rate'] ?></div>
                <div class="col-sm-4" id="rate<?= $id_rt ?>"></div>
              </div>

              <div class="row">
                <div class="col-sm-12 text-left"><br><?= $ulasan['ulasan'] ?></div>
              </div>

          </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
          <!-- Invoke star rating -->
          <script>


          $(function () {

          $("#rate<?= $id_rt ?>").rateYo({
              rating    : <?= $rate ?>,
              starWidth: "20px",
              readOnly: true
          });

          });
          </script>
        </div>
          <?php }
          $cekhistori = mysqli_query($koneksi,"SELECT * FROM booking WHERE booking.id_kamar = '$id' AND booking.username = '{$_SESSION['username']}'");
          if ($cekhistori->num_rows > 0) {
          ?>
          <a class="btn btn-primary me-md-2" href="ulas.php?id=<?= $id ?>">Ulas Kamar</a>
          <?php } else {?>
            <button disabled class="btn btn-primary me-md-2" href="ulas.php?id=<?= $id ?>">Ulas Kamar</button>
            <?php } ?>
        </div>

</div>
</section>

<?php include "footer.php"; ?>