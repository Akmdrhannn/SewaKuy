<?php include "header.php";
function up(){
  $nama = $_FILES['profil']['name'];
  $tmp = $_FILES['profil']['tmp_name'];
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
  move_uploaded_file($tmp, "../profil/".$nama);
  return $nama;
}

$sql = "SELECT * FROM user WHERE username = '".$_SESSION['username']."';";
$data = mysqli_query($koneksi,$sql);
$data_profil = mysqli_fetch_assoc($data);
if (isset($_POST['submit'])) {

  $username = $_SESSION['username'];
  $nama = $_POST['nama'];
  $jk = $_POST['jk'];
  $email = $_POST['email'];
  $no_hp = $_POST["hp"];
  $lama = $_POST['lama'];
  if($_FILES['profil']['error']===4){
    $foto = $lama;
  }else{
    $foto = up();
  }
  if ( $foto ) {
  	$chek = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '$email';");
    if ($chek->num_rows > 0){
    	 echo "<script>
              alert('Email sudah terdaftar!');
              document.location.href = 'profil.php';
          </script>";
    
    } else {
    $update = "UPDATE user
    SET nama = '$nama', jk = '$jk', email = '$email', nomor_hp= '$no_hp', foto_profil= '$foto'
    WHERE username='$username';" ;
    $resultFinal = mysqli_query($koneksi, $update);
    echo "<script>
              alert('Data profil telah diubah!');
              document.location.href = 'profil.php';
          </script>";
  }
  }

}
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
            <form method="post" enctype="multipart/form-data">
            <h3 class="card-title">Your Profile</h3>
            </div>
            <div class="card-body">
            <div class="row row-2">
            <div class="col-md-3">
            <img style="width: 250px; height:250px" src="../profil/<?php echo $data_profil['foto_profil']; ?>">
            <label class="form-label" for="profil">Ubah foto : </label>
            <input type="hidden" name="lama" value="<?php echo $data_profil['foto_profil']; ?>"/>
            <input type="file" name="profil" id="profil" class="form-control"/>
            </div>
            <div class="col-md-9">
            <h4>Your Profile</h4>
            <div class="table-responsive">
            <table class="table table-bordered">
            <tbody><tr>
            <td><strong>Nama</strong></td>
            <td><input value="<?php echo $data_profil['nama']; ?>" type="text" name="nama" required></td>
            </tr>
            <tr>
            <td><strong>Username</strong></td>
            <td><input type="text" readonly value="<?php echo $data_profil['username']; ?>" name="username" ></td>
            </tr>
            <tr>
            <td><strong>Jenis Kelamin</strong></td>
            <td><?php if ($data_profil['jk'] == 'pria') { ?>
                  <input class="form-check-input" type="radio" name="jk" value="pria" id="jk1" checked>
                  <label class="form-check-label" for="jk1">
                    Pria &nbsp;
                  </label>
                  <input class="form-check-input" type="radio" name="jk" value="wanita" id="jk2">
                  <label class="form-check-label" for="jk2">
                    Wanita
                  </label>
                  <?php } else { ?>
                    <input class="form-check-input" type="radio" name="jk" value="pria" id="jk1">
                  <label class="form-check-label" for="jk1">
                    Pria &nbsp;
                  </label>
                  <input class="form-check-input" type="radio" name="jk" value="wanita" id="jk2" checked>
                  <label class="form-check-label" for="jk2">
                    Wanita
                  </label>
                  <?php }?></td>
            </tr>
            <tr>
            <td><strong>Email</strong></td>
            <td><input value="<?php echo $data_profil['email']; ?>" required type="email" name="email"></td>
            </tr>
            <tr>
            <td><strong>Nomor Hp</strong></td>
            <td><input value="<?php echo $data_profil['nomor_hp']; ?>" required type="number" name="hp"></td>
            </tr>
            </tbody></table>
            </div>
            </div>
            </div>
            </div>
            <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-primary">
            Simpan
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

<?php include "footer.php"; ?>