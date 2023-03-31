<?php include "header.php";
        $data = mysqli_query($koneksi,"SELECT * FROM kamar k inner join booking b on k.id_kamar=b.id_kamar WHERE b.username='{$_SESSION['username']}' GROUP BY k.id_kamar");
        if ($data->num_rows > 0) {?>
        <section class="hero-section" id="hero" style='padding-top: 90px'>

      <div class="wave">

        <svg width="100%" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
              <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z" id="Path"></path>
            </g>
          </g>
        </svg>

      </div>

      <div class="container">

          <div class="row justify-content-right">
            <div class="col-md-5" data-aos="fade-up">
              <h2 class="text-white" style="margin-top: 20px; margin-bottom: 0px;">History Booking</h2>
            </div>
          </div>
          <br>
          <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
          while ($tampil = mysqli_fetch_array($data)){
            $id = $tampil['id_kamar'];
          	$id_book = $tampil['id_booking'];
            $sql = mysqli_query($koneksi, "SELECT AVG(rate) as rate FROM rating WHERE rating.id_kamar=$id");
            $rt = mysqli_fetch_array($sql);
          $rate = $rt['rate'];
          ?>

<!-- ======= Hero Section ======= -->


        <div class="col">
          <div class="card h-100">
            <img src="../kamar/<?= $tampil['gambar_kamar'] ?>" class="card-img-top" alt="<?= $tampil['gambar_kamar'] ?>">
              <div class="card-body" >
                <h5 class="card-title"><?= strtoupper($tampil['nama_kamar']) ?></h5>
                <p class="text-black">Tanggal Booking : <?= $tampil['tanggal_booking'] ?></p>
                <div class="row">
                  <div id="rate<?= $id ?>" class="col-sm-6 text-center"></div>
                  <div class="col-sm-6"></div>
              </div>
              <a class="btn btn-primary me-md-2" href="detail.php?id=<?= $id ?>">Detail</a>
              <a class="btn btn-primary me-md-2" href="kuitansi.php?id=<?= $id_book ?>">Kuitansi</a>
            </div>
          </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
        <!-- Invoke star rating -->
        <script>


        $(function () {

        $("#rate<?= $id ?>").rateYo({
            rating    : <?= $rate ?>,
            starWidth: "20px",
            readOnly: true
        });

        });
        </script>
        <?php } ?>
      </div>
      </div>
  </section><!-- End Hero -->

<?php include "footer.php"; } else { ?>
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
              <div class="col-lg-8 text-center  text-lg-start">
              <h3 class="text-white" data-aos="fade-right">Anda belum pernah booking kamar</h3>
              </div>
          </div>
          </div>
      </div>
    </div>

  </section><!-- End Hero -->
<?php include "footer.php"; } ?>