<?php include "header.php" ?>

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
      <div class="container">
        <div class="row justify-content-center text-center ">
          <div class="col-md-5" data-aos="fade-up">
            <h2 class="text-white">Kelola Kamar</h2>
          </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <a class="btn btn-primary me-md-2" type="button" href="tambah.php">Tambah Kamar</a>
        </div>
        <br>
        <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        $username = $_SESSION['username'];
        $data = mysqli_query($koneksi,"SELECT * FROM kamar WHERE username='$username'");
        while ($tampil = mysqli_fetch_array($data)){
          $id = $tampil['id_kamar'];
          $sql = mysqli_query($koneksi, "SELECT AVG(rate) as rate FROM rating WHERE rating.id_kamar=$id");
          $rt = mysqli_fetch_array($sql);
          $rate = $rt['rate'];
          
          ?>

    
          <div class="col">
            <div class="card h-100">
              <img src="../kamar/<?= $tampil['gambar_kamar'] ?>" class="card-img-top" alt="<?= $tampil['gambar_kamar'] ?>">
              <div class="card-body">
                <h5 class="card-title"><?= strtoupper($tampil['nama_kamar']) ?></h5>
                <p class="card-text" style="color: black;"><?= $tampil['alamat'] ?> </p>
                <div class="row" style="text-align: -webkit-center; margin-right: -150px;">
                <div id="rate<?= $id ?>" class="col-sm-6 text-center" style="margin-left: 25px;"></div> 
                <div class="col-sm-6" style="color: black;">Rp.<?= $tampil['harga'] ?>,00</div> 
                </div>
                <div class="row" style="text-align: -webkit-center;">
                <div class="col-6">
                    <a class="btn btn-primary me-md-2" href="edit.php?id=<?= $tampil['id_kamar'] ?>">EDIT</a>
                </div>
                <div class="col-6">
                  <?php
                    $sql = mysqli_query($koneksi, "SELECT * FROM booking WHERE id_kamar=$id");
                    if ($sql -> num_rows > 0){
                  ?>
                    <button disabled class="btn btn-primary me-md-2" href="hapus.php?id=<?= $tampil['id_kamar'] ?>">HAPUS</button>
                    <?php } else { ?>
                      <a class="btn btn-primary me-md-2" href="hapus.php?id=<?= $tampil['id_kamar'] ?>">HAPUS</a>
                    <?php } ?>
                </div>
                </div>
              </div>
              <?php
                    $sql = mysqli_query($koneksi, "SELECT * FROM booking WHERE aktif='true' AND id_kamar=$id");
                    if ($sql -> num_rows > 0){
                  ?>
                    <button disabled class="btn btn-primary me-md-2" href="tersedia.php?id=<?= $tampil['id_kamar'] ?>&status=<?= $tampil['status'] ?>"><?= strtoupper($tampil['status']); ?></button>
                    <?php }else{ ?>
                      <a class="btn btn-primary me-md-2" href="tersedia.php?id=<?= $tampil['id_kamar'] ?>&status=<?= $tampil['status'] ?>"><?= strtoupper($tampil['status']); ?></a>
                    <?php } ?>
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

<?php include "footer.php"; ?>