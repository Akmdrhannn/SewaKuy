<?php
    // error_reporting(0);
    session_start();
    include '../config.php';
    // if (!isset($_SESSION['level'])) {
    //     if (isset($_GET['level']) && isset($_GET['username']) ) {
    //         $level = $_GET['level'];
    //           $username = $_GET['username'];
    //         $_SESSION['level'] = $level;
    //           $_SESSION['username'] = $username;
    //     }else {
    //     header("Location: ../login.php");
    //     }
    // }else {
    //     if ($_SESSION['level'] != 'pemilik') {
    //         header("Location: /".$_SESSION['level']."/home.php");
    //     }
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>WARUNG ADI</title>
    <link rel="stylesheet" id="theme_link" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/materia/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script async="" defer="" src="https://buttons.github.io/buttons.js"></script>

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

</head>

<body style="margin-right: 0px;">

<?php
    if (isset($_POST['submit1'])) {
        $tahun = $_POST['tahun'];

    }else {
        $tahun = '2022';
    }

?>
<script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          const nama_kamar=[];
          <?php
          $listBulan = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
          ];
        //   $sql = "SELECT DATE_FORMAT(booking.tanggal_booking,'%M') AS bulan, SUM(booking.harga) AS pendapatan FROM booking INNER JOIN kamar on booking.id_kamar=kamar.id_kamar WHERE kamar.username = 'irul' AND booking.tanggal_booking LIKE '2022%' GROUP BY MONTH(booking.tanggal_booking)";
        //   $tampil = mysqli_query($koneksi, $sql);
            // while ($data = mysqli_fetch_array($tampil)){
                foreach ($listBulan as $bulan) {
                    $query = "SELECT SUM(booking.harga) AS pendapatan FROM booking INNER JOIN kamar on booking.id_kamar=kamar.id_kamar WHERE kamar.username = '".$_SESSION['username']."' AND booking.tanggal_booking LIKE '$tahun%' AND DATE_FORMAT(booking.tanggal_booking,'%M') = '$bulan' GROUP BY MONTH(booking.tanggal_booking)";
                	$item = mysqli_query($koneksi, $query);
                if ($item->num_rows <=0 ){
                    $hasil['pendapatan'] = 0;
                }else {
                    $hasil=mysqli_fetch_assoc($item);
                }

           ?>
          test = parseInt("<?php echo($hasil['pendapatan']) ?>");
          var randomColor = Math.floor(Math.random()*16777215).toString(16);
          nama_kamar.push(["<?php echo($bulan) ?>",test,randomColor]);
          <?php } ?>
          console.log(nama_kamar);
          data = [
            ["Element", "Penghasilan", { role: "style" } ]
          ];
          nama_kamar.forEach(myFunction);
          function myFunction(value, index, array) {
            data.push(value);
          }
          var data = google.visualization.arrayToDataTable(data);

          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);

          var options = {
            title: "Laporan Penghasilan pada <?= $tahun ?>",
            width: 600,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
          };
          var chart = new google.visualization.ColumnChart(document.getElementById("stat_hasil"));
          chart.draw(view, options);
      }
      </script>
<div class="container">
    <div class="row">
            <div class="col-sm-12">
                <br>
                <!-- <h3>Penjualan</h3> -->
                <form action="stat_hasil.php" method="POST">
                <table>
                    <tr>
                        <td>
                        <select name="tahun" class="form-select">
                            <?php
                                $sql1 = "SELECT YEAR(booking.tanggal_booking) AS tahun FROM booking, kamar WHERE kamar.username = '".$_SESSION['username']."' AND booking.id_kamar = kamar.id_kamar GROUP BY YEAR(booking.tanggal_booking);";
                                $tampil1 = mysqli_query($koneksi, $sql1);
                                while ($fas = mysqli_fetch_array($tampil1)){
                                    echo"<option value='{$fas['tahun']}'>{$fas['tahun']}</option>";
                                    }

                				$total = mysqli_query($koneksi, "SELECT SUM(booking.harga) AS total FROM booking INNER JOIN kamar on booking.id_kamar=kamar.id_kamar WHERE kamar.username = '".$_SESSION['username']."' AND booking.tanggal_booking LIKE '$tahun%'");
								$hasil = mysqli_fetch_array($total);
                            ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <button type="submit1" name="submit1" class="btn btn-primary btn-block mb-4">
                        Submit
                        </button>
                        </td>
                    </tr>
                </table>
                </form>
            </div>

    </div>

    <div class="row">
        <div class="col-sm-12">
            <div id="stat_hasil" style="height: 400px;"></div>
          	

        </div>
        <div class="col-sm-12">
            <div>
                 <h3>Total Penghasilan : <b>Rp <?= number_format($hasil['total'],2,',','.')?></b></h3>
            </div>
        </div>
    </div>

</div>


<!-- SELECT pesanan.tanggal_pesanan, SUM(pembayaran.total_bayar)as hasil FROM `pesanan` INNER JOIN pembayaran ON pesanan.pesanan_id=pembayaran.pesanan_id GROUP BY tanggal_pesanan; -->

</body>
</html>