<!doctype html>
<html lang="en">
<?php
 include "header.php";
 ?>
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
  <div class="px-4 py-5 px-md-5 text-center text-lg-start hero-section">
    <div class="container" >
      <div class="row gx-lg-5 align-items-center" style="margin-top: 40px;">
        <div class="col-lg-6 mb-5 mb-lg-5">
          <h1 class="my-5 display-3 fw-bold ls-tight">
              #SerunyaNgekos
               <br/>
            <span >AlaSewakuy</span>
          </h1>
          <p>
            Yuk daftarkan diri anda!
          </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body">
            
 <?php
 function up(){
  $nama = $_FILES['berkas']['name'];
  $tmp = $_FILES['berkas']['tmp_name'];
  $ekstensiGambarvalid = ['pdf'];
	// erol.screen.jpg
	$esktensiGambar = explode('.', $nama);
	$ekstensiupload = strtolower(end($esktensiGambar));
	if ( !in_array($ekstensiupload, $ekstensiGambarvalid) ) {
		echo "<script>
			alert('Yang Anda Upload Bukan pdf');
		</script>";
		return false;
    }
  move_uploaded_file($tmp, "./berkas/".$nama);
  return $nama;
}


 if (isset($_GET["aktor"])){
  if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $username = $_POST['user'];
    $email = $_POST['email'];
    $pw = $_POST['pw'];
    $confirm = $_POST["confirm"];
    $level = $_POST["level"];
    $no_hp = "";
    $foto = "default.jpg";
    $alamat = $_POST['address'];
    $verif = $_POST['verif'];
  	$eror_nama = 0;
  	if (!preg_match("/^[a-zA-Z ]*$/",$nama)){
		echo "<script>
                          alert('nama bermasalah');
                        </script>";
    $eror_nama = 1;
    }else{
    	$eror_nama = 0;
    }

    if ($level=="pemilik"){
        if($_FILES['berkas']['error']===4){
          $berkas = "-";
        }else{
          $berkas = up();
        }
          if ( $berkas ) {
          if ($pw == $confirm) {
              $sql = "SELECT * FROM user WHERE username='$username' OR email='$email'";
              $result = mysqli_query($koneksi, $sql);
              if (!$result->num_rows > 0) {
              if ($eror_nama == 0){
                  $add = "INSERT INTO user (username, password, nama, jk, alamat_kos, email, nomor_hp, foto_profil, berkas, level, verif) VALUES ('$username',MD5('$pw'),'$nama','$jk','$alamat','$email','$no_hp','$foto','$berkas','$level','$verif')";
                  $resultFinal = mysqli_query($koneksi, $add);
              
              if ($level == 'pemilik') {
                    echo "<script>
                          alert('Anda berhasil register, akun anda segera di verifikasi!');
                          document.location.href = 'login.php';
                        </script>";
                  }else{
                    echo "<script>
                          alert('Anda berhasil register, silahkan login!');
                          document.location.href = 'login.php';
                        </script>";
                  }
              }
                  
              } else {
                  echo "<script>alert('Username atau email telah terdaftar!')</script>";
              }
          } else {
              echo "<script>alert('Confirm password tidak cocok!')</script>";
          }
        }
    }else{
        $berkas = "-";
        if ($pw == $confirm) {
            $sql = "SELECT * FROM user WHERE username='$username' OR email='$email'";
            $result = mysqli_query($koneksi, $sql);
            if (!$result->num_rows > 0) {
            	if ($eror_nama == 0){
                $add = "INSERT INTO user (username, password, nama, jk, alamat_kos, email, nomor_hp, foto_profil, berkas, level, verif) VALUES ('$username',MD5('$pw'),'$nama','$jk','$alamat','$email','$no_hp','$foto','$berkas','$level','$verif')";
                $resultFinal = mysqli_query($koneksi, $add);
           
                  echo "<script>
                        alert('Anda berhasil register, silahkan login!');
                        document.location.href = 'login.php';
                      </script>";
                }
                
            } else {
                echo "<script>alert('Username atau email telah terdaftar!')</script>";
            }
        } else {
            echo "<script>alert('Confirm password tidak cocok!')</script>";
        }
    }

  }
  if ($_GET["aktor"]=="pemilik"){
    ?>
    <!-- Section: Design Block -->
    <!-- <form action="" method="get">
              <label>Aktor</label>
                <div >
                  <br>
                  <input class="form-check-input" type="radio" name="aktor"  value="penghuni" id="aktor1">
                  <label class="form-check-label" for="aktor1">
                    Penghuni &nbsp;
                  </label>
                  <input class="form-check-input" type="radio" name="aktor" checked value="pemilik" id="aktor2">
                  <label class="form-check-label" for="aktor2">
                    Pemilik
                  </label>
                </div>
                <br>
                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                  Submit
                </button>
              </form> -->

    <form method="post" enctype="multipart/form-data">
                <!-- 2 column grid layout with text inputs for the first and last names -->

                <!-- Name input -->
                <h3>Register</h3>
                <br>
                <div class="form-outline mb-4">
                  <label class="form-label" for="nama">Name</label><br>
                  <?php 
                  	if(!preg_match("/^[a-zA-Z ]*$/",$nama)){
                    	echo"<span style='color:red;'>Nama tidak boleh angka...!</span>";
                    }
                  ?>
                  <input type="text" id="nama" name="nama" class="form-control" value='<?=$nama?>' required/>
                </div>
                <!-- Gender -->
                <label>Jenis Kelamin</label>
                <div >
                  <br>
                  <input class="form-check-input" checked type="radio" name="jk" value="pria" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    Pria &nbsp;
                  </label>
                  <input class="form-check-input" type="radio" name="jk" value="wanita" id="flexRadioDefault2">
                  <label class="form-check-label" for="flexRadioDefault2">
                    Wanita
                  </label>
                </div>
                <br>
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3">Email</label><br>
                
                  <input type="email" name="email" id="form3Example3" class="form-control" value='<?=$email?>' required/>
                  <input type="hidden" name="level" value="pemilik"/>
                  <input type="hidden" name="verif" value="belum"/>
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="profil">Berkas : </label><br>
                  <span style="color:orange;">Berkas yang harus di upload : foto KTP & Surat Ket RT/RW (.PDF)</span>
                  <input type="file" name="berkas" id="profil" class="form-control" required/>
                </div>
                <!-- Alamat -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="address">Alamat Kos</label>
                  <input type="text" name="address" id="address" class="form-control" value='<?=$alamat?>' required/>
                </div>
                <!-- Username input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="user">Username</label>
                  <input type="text" id="user" name="user" class="form-control" value='<?=$username?>' required/>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4">Password</label>
                  <input type="password" id="form3Example4" name="pw" class="form-control" required/>
                </div>

                <!-- Confirm Password -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4">Confirm Password</label>
                  <input type="password" id="form3Example4" name="confirm" class="form-control" required/>
                </div>
 
                <div>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Have an account? <a href="login.php"
                      style="color: #393f81;">Login here</a></p>
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                  Register
                </button>

              </form>
    <?php
  }else{
    ?>
    <!-- Section: Design Block -->
    <!-- <form action="" method="get">
              <label>Aktor</label>
                <div >
                  <br>
                  <input class="form-check-input" type="radio" name="aktor" checked value="penghuni" id="aktor1">
                  <label class="form-check-label" for="aktor1">
                    Penghuni &nbsp;
                  </label>
                  <input class="form-check-input" type="radio" name="aktor" value="pemilik" id="aktor2">
                  <label class="form-check-label" for="aktor2">
                    Pemilik
                  </label>
                </div>
                <br>
                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                  Submit
                </button>
              </form> -->

    <form method="post">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <!-- Name input -->
                <h3>Register</h3>
                <br>
                <div class="form-outline mb-4">
                  <label class="form-label" for="nama">Name</label><br>
                  
                  <?php 
                  	if(!preg_match("/^[a-zA-Z ]*$/",$nama)){
                    	echo"<span style='color:red;'>Nama tidak boleh angka...!</span>";
                    }
                  ?>
                  <input type="text" id="nama" name="nama" class="form-control" value='<?=$nama?>' required/>
                </div>
                <!-- Gender -->
                <label>Jenis Kelamin</label>
                <div >
                  <br>
                  <input class="form-check-input" checked type="radio" name="jk" value="pria" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    Pria &nbsp;
                  </label>
                  <input class="form-check-input" type="radio" name="jk" value="wanita" id="flexRadioDefault2">
                  <label class="form-check-label" for="flexRadioDefault2">
                    Wanita
                  </label>
                </div>
                <br>
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3">Email</label><br>
                 
                  <input type="email" name="email" id="form3Example3" class="form-control" value='<?=$email?>' required/>
                  <input type="hidden" name="level" value="penghuni"/>
                  <input type="hidden" name="verif" value="sudah"/>
                </div>

                <!-- Username input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="alamat">Username</label>
                  <input type="text" id="alamat" name="user" class="form-control" value='<?=$username?>' required/>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4">Password</label>
                  <input type="password" id="form3Example4" name="pw" class="form-control" required/>
                </div>

                <!-- Confirm Password -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4">Confirm Password</label>
                  <input type="password" id="form3Example4" name="confirm" class="form-control" required/>
                </div>

                <div>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Have an account? <a href="login.php"
                      style="color: #393f81;">Login here</a></p>
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                  Register
                </button>

              </form>
    <?php } }else {
    ?>
            <form action="" method="get">
                <!-- Aktor -->
                <h3>Pilih Aktor</h3>
                <br>
                <div >
                  <br>
                  <input class="form-check-input" type="radio" name="aktor" checked value="penghuni" id="aktor1">
                  <label class="form-check-label" for="aktor1">
                    Penghuni &nbsp;
                  </label>
                  <input class="form-check-input" type="radio" name="aktor" value="pemilik" id="aktor2">
                  <label class="form-check-label" for="aktor2">
                    Pemilik
                  </label>
                </div>
                <br>
                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                  Submit
                </button>
              </form>
              <?php } ?>

 <?php

 ?>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Jumbotron -->
</section>
<?php include "footer.php";?>