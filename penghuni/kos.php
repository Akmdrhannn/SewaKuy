<?php include "header.php"; ?>

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
    <div class="container" style="margin-top: 70px;">
      <div class="container">
      <div class="row justify-content-right">
        <div class="col-md-5" data-aos="fade-up">
          <h2 class="text-white" style="margin-top: 20px; margin-bottom: 0px;">Kamar Kos</h2>
        </div>
      </div>
      <form action="" method="get">
        <div class="row">
          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title">Cari Kamar</h5>
                <input type="text" id="cari" name="cari" class="form-control"/>
                  <div >
                    <br>
                    <input class="form-check-input" type="radio" name="kategori" value="putra" id="kategori1">
                    <label class="form-check-label" for="kategori1">
                      Putra &nbsp;
                    </label>
                    <input class="form-check-input" type="radio" name="kategori" value="putri" id="kategori2">
                    <label class="form-check-label" for="kategori2">
                      Putri
                    </label>
                  </div>
                  <br>
                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Search</button>
              </div>
            </div>
          </div>
          <div class="col"></div>
          <div class="col"></div>
        </div>
      </form>
    <div class="row row-cols-1 row-cols-md-3 g-4"  style="margin-top:10px;">
      <?php
      $sql_kamar = "SELECT * FROM kamar";
      if (isset ($_GET['submit'] )) {
        $sql_kamar = $sql_kamar." WHERE ";
        if (isset ($_GET['cari'] ) && !isset($_GET['kategori'])){
          if ($_GET['cari'] != NULL) {
            $sql_kamar = $sql_kamar."nama_kamar LIKE '%".$_GET['cari']."%'";
          }

        }elseif (isset ($_GET['cari'] ) && isset($_GET['kategori']) ) {
          if ($_GET['cari'] != NULL && $_GET['kategori']!= NULL) {
            $sql_kamar = $sql_kamar."kategori = '".$_GET['kategori']."' AND nama_kamar LIKE '%".$_GET['cari']."%'";
          }
          if ($_GET['cari'] == NULL){
            $sql_kamar = $sql_kamar."kategori = '".$_GET['kategori']."'";
          }

        }
      }

        $data = mysqli_query($koneksi, $sql_kamar);
        if ($data->num_rows > 0) {
          while ($tampil = mysqli_fetch_array($data)){
            $id = $tampil['id_kamar'];
            $sql = mysqli_query($koneksi, "SELECT AVG(rate) as rate FROM rating WHERE rating.id_kamar=$id");
            $rt = mysqli_fetch_array($sql);
            $rate = $rt['rate'];

            ?>


            <div class="col">
              <div class="card h-100">
                <img src="../kamar/<?= $tampil['gambar_kamar'] ?>" class="card-img-top" alt="kos1">
                <div class="card-body">
                  <h5 class="card-title"><?= strtoupper($tampil['nama_kamar']) ?></h5>
                  <p class="card-text text-black" ><?= $tampil['alamat'] ?> </p>
                  <div class="row">
                  <div id="rate<?= $id ?>" class="col-sm-6 text-center"></div>
                  <div style="text-align: right;" class="col-sm-6">Rp.<?= $tampil['harga'] ?>,00</div>
                  </div>
                </div>
                  <a class="btn btn-primary me-md-2" href="detail.php?id=<?= $id ?>">Detail</a>
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
    </section>
    <?php }else { ?>
    <h5 class="text-white">Hasil Pencarian Tidak Ada</h5>
    <?php } ?>


<?php include "footer.php"; ?>