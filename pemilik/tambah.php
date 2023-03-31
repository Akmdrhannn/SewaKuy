<?php
 include "header.php";
 function up(){
  $nama = $_FILES['foto']['name'];
  $ext = explode('.',$nama);
  $ext = end($ext);
  $namaFIle = uniqid();
  $namaFIle .= '.';
  $namaFIle .= $ext;
  $tmp = $_FILES['foto']['tmp_name'];
  move_uploaded_file($tmp, "../kamar/".$namaFIle);
  return $namaFIle;
}
 if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $kategori = $_POST['kategori'];
  $username = $_SESSION['username'];
  $harga = $_POST['harga'];
  $alamat = $_POST["alamat"];
  $jarak = $_POST['jarak'];
  $status = $_POST['status'];
  $aturan = $_POST['aturan'];
  $link = $_POST['link'];
 
  if($_FILES['foto']['error']===4){
    $foto = 'default.png';
}else{
    $foto = up();
}


//   if ($pw == $confirm) {
//       $sql = "SELECT * FROM user WHERE username='$username'";
//       $result = mysqli_query($koneksi, $sql);
//       if (!$result->num_rows > 0) {
          $add = "INSERT INTO kamar (id_kamar, username, nama_kamar, harga, jarak_utm, alamat, aturan,gambar_kamar,kategori, status, link) VALUES (NULL,'$username','$nama','$harga','$jarak','$alamat','$aturan','$foto','$kategori','$status','$link')";
          $resultFinal = mysqli_query($koneksi, $add);
          $id_kamar = mysqli_insert_id($koneksi);

            foreach ($_POST['fasilitas'] as $i) {
                $addFasil = "INSERT INTO fasilitas_kamar (id_fasilitas, id_kamar) VALUES ('$i','$id_kamar')";
                $dd = mysqli_query($koneksi, $addFasil);
              }
// }
//       } else {
//           echo "<script>alert('Username already available!')</script>";
//       }
//   } else {
//       echo "<script>alert('Password not matched!')</script>";
//   }
              echo "<script>
                  alert('Data kamar berhasil ditambah!');
                  document.location.href = 'kelola.php';
              </script>";
}
 ?>

    <!-- Section: Design Block -->
<section class="hero-section" id="hero" style='height: 1700px;'>
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
  <div class="px-4 py-5 px-md-5 text-center text-lg-start hero-section" style="margin-top:60px">

        <div class="col-lg-8 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body">
              <form method="post" enctype="multipart/form-data">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <h3>Tambah Kamar</h3>
                <br>
                <!-- Name  -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="nama">Nama Kamar</label>
                  <input required type="text" id="nama" name="nama" class="form-control"/>
                </div>
                <!-- Kategori -->
                <label>Kategori</label>
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
                <!-- gender -->
                <label>Fasilitas</label>
                <br>
                <?php
                $data = mysqli_query($koneksi,"SELECT * FROM fasilitas");
                while ($fasilitas = mysqli_fetch_array($data)) { ?>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="<?= $fasilitas['id_fasilitas']?>" name="fasilitas[]" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        <?= $fasilitas['fasilitas']?>
                    </label>
                    </div>
                <?php } ?>
                <br>
                <!-- Harga -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3">Harga</label>
                  <input required type="number" name="harga" id="form3Example3" class="form-control" />
                </div>
                <!-- Alamat -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="address">Alamat</label>
                  <input required type="text" name="alamat" id="address" class="form-control" />
                </div>
                <!-- Jarak UTM -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="alamat">Jarak Dari UTM</label>
                  <input required type="number" id="alamat" name="jarak" class="form-control" />
                </div>

                <!-- Aturan -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4">Aturan</label>
                  <input required type="text" id="form3Example4" name="aturan" class="form-control" />
                </div>

                <!-- Status -->
                <select class="form-select" name="status" aria-label="Default select example">
                    <option value="tersedia">Tersedia</option>
                    <option value="tidak trsedia">Tidak Tersedia</option>
                </select>
                <!-- gambar -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="foto">Gambar</label>
                  <input type="file" name="foto" id="foto" class="form-control" />
                </div>
                <div class="form-outline mb-4">
                  <button class="btn btn-success" onclick=" window.open('https://imgbb.com/upload')">Link Upload Gambar 360</button>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="link">Gambar 360</label>
                  <input type="text" name="link" id="link" class="form-control" />
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                  Tambah
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
<?php include "footer.php";?>