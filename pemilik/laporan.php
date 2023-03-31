<?php
    include "header.php";
    $cekpes = mysqli_query($koneksi, "SELECT date_format(`tanggal_booking`,'%Y') AS tgl FROM  kamar,booking WHERE kamar.username='".$_SESSION['username']."' LIMIT 1");
    if ($cekpes -> num_rows > 0){
        $pes = mysqli_fetch_array($cekpes);
        $tahun = $pes['tgl']; ?>

        <section class="hero-section" id="hero" style='padding-top: 90px; height:1700px'>

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
                <div class="row justify-content-right">
                    <div class="col-md-5" data-aos="fade-up">
                        <h2 class="text-white" style="margin-top: 20px; margin-bottom: 0px;">Laporan</h2>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-sm-12">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <iframe src="stat_menu.php" frameborder="0" width="100%" height="600"></iframe>
                            </div>
                        </div>
                        <div class="panel panel-default">
                        <div class="panel-body">
                                <iframe src="stat_hasil.php" frameborder="0" width="100%" height="600"></iframe>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
        </div>
</section>
<?php include "footer.php";
    } else { ?>
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
            <div class="row justify-content-right">
                <div class="col-md-5" data-aos="fade-up">
                    <h2 class="text-white" style="margin-top: 20px; margin-bottom: 0px;">Laporan</h2>
                </div>
            </div>
            <br>
            <div class="row align-items-center">
                <div class="col-12 hero-text-image">
                <div class="row">
                    <div class="col-lg-8 text-center text-lg-start">
                    <h1 data-aos="fade-right">Kamar belum tersewa </h1>
                    </div>
                </div>
                </div>
            </div>
            </div>

            </section><!-- End Hero -->
            <?php include "footer.php";
    }?>