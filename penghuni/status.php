<?php
  include "header.php";
  $sql = "SELECT * FROM kamar k inner join booking b on k.id_kamar=b.id_kamar WHERE validasi='sudah' AND b.username='{$_SESSION['username']}' AND aktif='true'  GROUP BY k.id_kamar";
  $data = mysqli_query($koneksi,$sql);
    if ($data->num_rows > 0) {
?>

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
                <h2 class="text-white">Status Kamar</h2>
              </div>
            </div>
            <div class="row align-items-center"  style="margin-top: 40px;">
              <div class="col">
            <?php
            while ($tampil = mysqli_fetch_array($data)){
              $id = $tampil['id_kamar'];
              $sql_kamar = "SELECT * FROM kamar k inner join booking b on k.id_kamar=b.id_kamar WHERE validasi='sudah' AND b.username='{$_SESSION['username']}' AND aktif='true' AND k.id_kamar='$id'";
              $data_kamar= mysqli_query($koneksi,$sql_kamar);?>
          <div class="card">
            <div class="card-header">
            <h2 class="card-title"><?= strtoupper($tampil['nama_kamar']) ?></h2>
            </div>
            <div class="card-body">
            <div class="row">
            <div class="col-md-2">
            <h6>Kode Kamar : K<?php echo $tampil['id_kamar']; ?></h6>
            </div>
            <div class="table-responsive">
            <table class="table">
            <tbody><tr>
            <tr>
              <td><strong>Tanggal</h3></strong></td>
              <td><strong>Status</h3></strong></td>
              <td><strong>Harga</h3></strong></td>
              <td><strong>Aksi</h3></strong></td>
            </tr>
            <?php
              $terakhir =  mysqli_query($koneksi,"SELECT * FROM booking WHERE id_kamar='$id' ORDER BY id_booking DESC LIMIT 1");
              $data_booking = mysqli_fetch_array($terakhir);
              $id_booking = $data_booking['id_booking'];
              $today = strftime("%Y-%m-%d");
              $now = date_create($today);
              $tanggal = $data_booking['tanggal_booking'];
              $mulai = date_create($tanggal);
              $diff = date_diff($now,$mulai);
              $user = $data_booking['username'];
              if ((int)$diff->format("%a") > 30) {
                mysqli_query($koneksi,"INSERT INTO booking (id_booking,id_kamar,username, tanggal_booking, validasi,bayar,aktif) VALUES ('','$id','$user','$today','sudah','belum','true')");
              }
              while ($tampil_kamar = mysqli_fetch_array($data_kamar)){
              ?>
            <tr>
                <td><?php echo $tampil_kamar['tanggal_booking']; ?></td>
                <td><?php echo $tampil_kamar['bayar']; ?></td>
                <?php if ($tampil_kamar['bayar'] == 'belum') { ?>
                <td><?php echo "Rp. ".$tampil_kamar['harga']; ?></td>
                <td><button><a type="submit" name="submit" href="bayar.php?id=<?php echo $id_booking; ?>">BAYAR</a></button></td>
              </tr>
                <?php } else { ?>
                  <td></td>
                  <td></td>
                  </tr>
                  <?php } ?>
            <?php } ?>
            </tbody></table>
            </div>
        </div>
    </div>
    </div>
    <br>
<?php } ?>
  <!-- Jumbotron -->
</section>

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
