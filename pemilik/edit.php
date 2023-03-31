<?php
 include "header.php";
 $id = $_GET['id'];
 $sql = "SELECT * FROM kamar WHERE id_kamar = '$id'";
 $data = mysqli_query($koneksi,$sql);
 $result = mysqli_fetch_assoc($data);

 function up(){
  $nama = $_FILES['foto']['name'];
  $tmp = $_FILES['foto']['tmp_name'];
  $ekstensiGambarvalid = ['jpg', 'jpeg', 'png'];
	// erol.screen.jpg
	$esktensiGambar = explode('.', $nama);
	$ekstensiupload = strtolower(end($esktensiGambar));
	if ( !in_array($ekstensiupload, $ekstensiGambarvalid) ) {
		echo "<script>
			alert('Yang Anda Upload Bukan Gambar');
		</script>";
		return false;
	}
  move_uploaded_file($tmp, "../kamar/".$nama);
  return $nama;
}

 if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $kategori = $_POST['kategori'];
  $username = $_SESSION['username'];
  $harga = $_POST['harga'];
  $alamat = $_POST["alamat"];
  $jarak = $_POST['jarak'];
  $aturan = $_POST['aturan'];
  $lama = $_POST['lama'];
  $link = $_POST['link'];
  if ($_FILES['foto']['error']===4){
    $foto = $lama;
  }else{
    $foto = up();
  }
  if ( $foto ) {
          $update = "UPDATE kamar
          SET username = '$username', nama_kamar= '$nama', harga= '$harga', jarak_utm= '$jarak', alamat= '$alamat', aturan= '$aturan', gambar_kamar= '$foto', kategori= '$kategori', gambar_kamar= '$foto', link='$link'
          WHERE id_kamar = '$id'";
          $resultFinal = mysqli_query($koneksi, $update);

          $sql = " DELETE FROM fasilitas_kamar WHERE id_kamar = '$id'";
          mysqli_query($koneksi,$sql);

            foreach ($_POST['fasilitas'] as $i) {
                $addFasil = "INSERT INTO fasilitas_kamar (id_fasilitas, id_kamar) VALUES ('$i','$id')";
                $dd = mysqli_query($koneksi, $addFasil);
              }
              echo "<script>
                  alert('Data kamar telah diubah!');
                  document.location.href = 'kelola.php';
              </script>";
            }
 }
 ?>

    <!-- Section: Design Block -->
<section class="hero-section" id="hero" style='height: 1600px; padding-top: 60px'>
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
  <div class="px-4 py-5 px-md-5 text-center text-lg-start hero-section">
      <div class="row">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body">
              <form method="post" enctype="multipart/form-data">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <h3>Edit Kamar</h3>
                <br>

                <!-- Name  -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="nama">Nama Kamar</label>
                  <input required type="text" id="nama" name="nama" class="form-control" value="<?= $result['nama_kamar'];?>"/>
                </div>

                <!-- Kategori -->
                <label>Kategori</label>
                <div >
                  <?php if ($result['kategori'] == 'putra') { ?>
                  <br>
                  <input class="form-check-input" type="radio" name="kategori" value="putra" id="kategori1" checked>
                  <label class="form-check-label" for="kategori1">
                    Putra &nbsp;
                  </label>
                  <input class="form-check-input" type="radio" name="kategori" value="putri" id="kategori2">
                  <label class="form-check-label" for="kategori2">
                    Putri
                  </label>
                  <?php } else { ?>
                    <input class="form-check-input" type="radio" name="kategori" value="putra" id="kategori1">
                  <label class="form-check-label" for="kategori1">
                    Putra &nbsp;
                  </label>
                  <input class="form-check-input" type="radio" name="kategori" value="putri" id="kategori2" checked>
                  <label class="form-check-label" for="kategori2">
                    Putri
                  </label>
                  <?php }?>
                </div>
                <br>
                <!-- Fasilitas -->
                <label>Fasilitas</label>
                <br>
                <?php
                    $sql = "SELECT * FROM fasilitas";
                    $tampil = mysqli_query($koneksi, $sql);
                    while ($fas = mysqli_fetch_array($tampil)){
                      $sql = "SELECT * FROM fasilitas_kamar WHERE id_kamar='$id' AND id_fasilitas='{$fas['id_fasilitas']}'";
                      $go = mysqli_query($koneksi, $sql);
                      if ($go->num_rows > 0) {
                          echo"<input class='form-check-input' type='checkbox' name='fasilitas[]' value='{$fas['id_fasilitas']}' checked>&nbsp;{$fas['fasilitas']}";
                      } else {
                          echo"<input class='form-check-input' type='checkbox' name='fasilitas[]' value='{$fas['id_fasilitas']}'>&nbsp;{$fas['fasilitas']}";
                      } ?>
                      <br>
                      <?php
                    }
                  ?>
                <br>

                <!-- Harga -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3">Harga</label>
                  <input required type="number" name="harga" value="<?= $result['harga'];?>" id="form3Example3" class="form-control" />
                </div>

                <!-- Alamat -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="address">Alamat</label>
                  <input required type="text" name="alamat" value=" <?= $result['alamat'];?>" id="address" class="form-control" />
                </div>

                <!-- Jarak UTM -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="alamat">Jarak Dari UTM</label>
                  <input required type="number" id="alamat" value="<?= $result['jarak_utm'];?>" name="jarak" class="form-control" />
                </div>

                <!-- Aturan -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4">Aturan</label>
                  <input required type="text" id="form3Example4" value="<?= $result['aturan'];?>" name="aturan" class="form-control" />
                </div>

                <div class="form-outline mb-4">
                  <button class="btn btn-success" onclick=" window.open('https://imgbb.com/upload')">Link Upload Gambar 360</button>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="link">Gambar 360</label>
                  <input type="text" name="link" id="link" value="<?= $result['link'];?>" class="form-control" />
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                  Simpan
                </button>


              </div>
            </div>
          </div>
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="card">
            <div class="card-body">
              <img style="width: 500px;" src="../kamar/<?php echo $result['gambar_kamar']; ?>">
              <br>
              <label class="form-label" for="profil">Ubah foto : </label>
              <input type="hidden" name="lama" value="<?php echo $result['gambar_kamar']; ?>"/>
              <input type="file" name="foto" class="form-control"/>
            </div>
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