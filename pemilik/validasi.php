<?php include "header.php";
        $username = $_SESSION['username'];
        $sql = "SELECT k.*, b.*, b.username AS penghuni FROM kamar k inner join booking b on k.id_kamar=b.id_kamar WHERE validasi='belum' AND k.username='$username'";
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
                  <h1 data-aos="fade-right">Belum ada penyewa</h1>
                  </div>
              </div>
              </div>
          </div>
          </div>

          </section><!-- End Hero -->
          <?php
          include "footer.php"; die;
        } else { ?>
        <!-- ======= Hero Section ======= -->
        <section class="hero-section" id="hero" style='padding-top: 90px'>

          <div class="wave">

            <svg width="100%" height="355px" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
                  <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z" id="Path"></path>
                </g>
              </g>
            </svg>

          </div>
            <div class="container" style="margin-top: 70px;">
              <div class="row justify-content-right">
                <div class="col-md-5" data-aos="fade-up">
                  <h2 class="text-white">Validasi</h2>
                </div>
              </div>
              <br>
              <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        while ($tampil = mysqli_fetch_array($data)){
          ?>
          <div class="col">
            <div class="card h-100">
              <img src="../kamar/<?= $tampil['gambar_kamar'] ?>" class="card-img-top" alt="<?= $tampil['gambar_kamar'] ?>">
              <div class="card-body">
                <h5 class="card-title"><?= strtoupper($tampil['nama_kamar']) ?></h5>
                <p class="card-text" style="color: black;">Pemesan : <?= $tampil['penghuni'] ?> </p>
                <p class="card-text" style="color: black;">Tanggal booking : <?= $tampil['tanggal_booking'] ?> </p>
              </div>
              <div class="row" style="text-align: -webkit-center;">
                <div class="col-6">
                <a class="btn btn-primary me-md-2" href="valid.php?aksi=valid&id=<?= $tampil['id_booking'] ?>">VALIDASI</a>
                </div>
                <div class="col-6">
                <a class="btn btn-primary me-md-2" href="valid.php?aksi=tolak&id=<?= $tampil['id_booking'] ?>">TOLAK</a>
                </div>
            </div>
          </div>
                </div>
        <?php } ?>
      
        </div>
      </section>

<?php include "footer.php"; } ?>