<?php
    include "header.php";
    $id_kamar= $_GET['id'];

    if (isset($_POST['kirim'])) {
        $ulasan = $_POST['ulasan'];
        $rating = $_POST['rating'];
        $now = strftime("%Y-%m-%d");
        $user = $_SESSION['username'];

        mysqli_query($koneksi,"INSERT INTO rating VALUES (NULL,'$id_kamar','$user','$now','$rating','$ulasan')");
        echo "<script>
                alert('Terima kasih atas ulasan anda!');
                document.location.href = 'detail.php?id=$id_kamar';
              </script>";
    }

    $data = mysqli_query($koneksi,"SELECT * FROM kamar WHERE id_kamar = '$id_kamar'");
    $tampil = mysqli_fetch_array($data);
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
      <div class="row gx-lg-5 align-items-center"  style="margin-top: 50px;">
        <div class="col-lg-6 text-center text-lg-start">
            <h1 data-aos="fade-right" class="aos-init aos-animate" style="margin-top: 70px;"><?= strtoupper($tampil['nama_kamar']);?></h1>
            <img src="../kamar/<?= $tampil['gambar_kamar'];?>" class="img-thumbnail shadow shadow-offset-left-sm" alt="<?= $tampil['gambar_kamar'];?>" style="border-radius: 5.25rem!important;">
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form method="post">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <h3>Ulas Kamar</h3>
                <br>

                <!-- Email input -->
                <div class="form-floating">
                    <textarea class="form-control" name="ulasan" placeholder="Isi ulasan disini" id="ulasan" style="height: 200px"></textarea>
                    <label for="ulasan">Ulasan</label>
                </div>
                <br>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4">Rate</label>
                        <div class="rateyo" id= "rating"></div>
                        <input type="hidden" name="rating">
                </div>

                <!-- Submit button -->
                <button type="submit" name="kirim" class="btn btn-primary btn-block mb-4">
                  Kirim
                </button>


              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Jumbotron -->
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<!-- Invoke star rating -->
    <script>
        $(function () {
            $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
                var rating = data.rating;
                $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
                // $(this).parent().find('.result').text('rating :'+ rating);
                $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
            });
        });
    </script>


<?php include "footer.php"; ?>
