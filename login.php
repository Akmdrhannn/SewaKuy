<?php
	
    include "header.php";


    if (isset($_POST['submit'])) {
        $uname = $_POST['uname'];
        $pw = $_POST['pw'];

        $sql = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$uname' AND password=MD5('$pw') AND verif='sudah'");
        $hasil = mysqli_fetch_assoc($sql);
        if ($hasil > 0) {
        	$add = "INSERT INTO log (username, waktu, aktif) VALUES ('$uname',' ', 'login' )";
            $resultFinal = mysqli_query($koneksi, $add);
            $_SESSION['username'] = $uname;
            $_SESSION['level'] = $hasil['level'];
            if ($hasil['level'] == 'penghuni') {
                echo "<script>
                    alert('Selamat datang ".$_SESSION['username']." anda berhasil login sebagai penghuni!');
                    document.location.href = 'penghuni/home.php';
                </script>";
            }elseif ($hasil['level'] == 'admin') {
              echo "<script>
                    alert('Selamat datang ".$_SESSION['username']." anda berhasil login sebagai admin!');
                    document.location.href = 'admin/home.php';
                </script>";
            }else {
                echo "<script>
                    alert('Selamat datang ".$_SESSION['username']." anda berhasil login sebagai pemilik!');
                    document.location.href = 'pemilik/home.php';
                </script>";
            }

        } else {
            echo "<script>
                alert('Anda gagal login! ');
            </script>";
        }
    }
	if(isset($_GET['code'])){
    	
        $gClient->authenticate($_GET['code']);
        $_SESSION['token'] = $gClient->getAccessToken();
        $gpUserProfile = $google_oauthV2->userinfo->get();
        $email = $gpUserProfile['email'];
        $sql = mysqli_query($koneksi,"SELECT * FROM user WHERE email='$email' AND verif='sudah'");
        $hasil = mysqli_fetch_assoc($sql);
        if ($hasil > 0) {
            $_SESSION['username'] = $hasil['username'];
            $_SESSION['level'] = $hasil['level'];
        	$uname = $_SESSION['username'];
        	$add = "INSERT INTO log (username, waktu, aktif) VALUES ('$uname',' ', 'login' )";
            $resultFinal = mysqli_query($koneksi, $add);
        	
            if ($hasil['level'] == 'penghuni') {
                echo "<script>
                    alert('Selamat datang ".$_SESSION['username']." anda berhasil login sebagai penghuni!');
                    document.location.href = 'penghuni/home.php';
                </script>";
            }elseif ($hasil['level'] == 'admin') {
              echo "<script>
                    alert('Selamat datang ".$_SESSION['username']." anda berhasil login sebagai admin!');
                    document.location.href = 'admin/home.php';
                </script>";
            }else {
                echo "<script>
                    alert('Selamat datang ".$_SESSION['username']." anda berhasil login sebagai pemilik!');
                    document.location.href = 'pemilik/home.php';
                </script>";
            }

        } else {
            echo "<script>
                alert('EMAIL BELUM TERDAFTAR! ');
            </script>";
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
      <div class="row gx-lg-5 align-items-center"  style="margin-top: 50px;">
      <div class="col-lg-6 mb-5 mb-lg-5">
          <h1 class="my-5 display-3 fw-bold ls-tight">
              #SerunyaNgekos
               <br />
            <span >AlaSewakuy</span>
          </h1>
          <p>
            Yuk segera login!
          </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form method="post">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <h3>Login</h3>
                <br>

                <!-- Email input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3">Username</label>
                  <input type="text" id="form3Example3" name="uname" class="form-control" required/>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4">Password</label>
                  <input type="password" id="form3Example4" name="pw" class="form-control" required/>
                </div>
                <div>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="register.php"
                      style="color: #393f81;">Register here</a></p>
                </div>


                <!-- Submit button -->
                <div class="row text-center">
                  <div class="col">
                    <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                      Login
                    </button>
                  </div>
				</div>
                 
              </form>
			  <div class="row text-center">
               <div class="col">
                    <a href="<?= $gClient->createAuthUrl() ?>" class="btn btn-primary btn-block mb-4">
                      Login with Google
                    </a>
				</div>
				</div>
				</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Jumbotron -->
</section>


<?php include "footer.php"; ?>