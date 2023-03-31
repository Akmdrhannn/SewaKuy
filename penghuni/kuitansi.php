<?php
require "../config.php";
session_start();
if (!isset($_SESSION['level'])) {
    if (isset($_GET['level']) && isset($_GET['username']) ) {
    	$level = $_GET['level'];
      	$username = $_GET['username'];
    	$_SESSION['level'] = $level;
      	$_SESSION['username'] = $username;
    }else {
    header("Location: ../login.php");
    }
}else {
    if ($_SESSION['level'] != 'penghuni') {
        header("Location: /".$_SESSION['level']."/home.php");
    }
}



$id_book = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT *,booking.harga AS nominal FROM booking INNER JOIN kamar ON booking.id_kamar=kamar.id_kamar WHERE id_booking='$id_book'");
$trx = mysqli_fetch_assoc($data);

// $detail = mysqli_query($koneksi, "SELECT detail_booking.*, barang.NAMA_BARANG,barang.HARGA_JUAL_BARANG FROM `detail_booking` INNER JOIN barang ON detail_transaksi_penjualan.ID_BARANG=barang.ID_BARANG WHERE detail_transaksi_penjualan.id_booking='$id_book'");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk pembayaran</title>
    <style type="text/css">
		body{
			color: #a7a7a7;
		}
	</style>
</head>
<body  onload="window.print(); ">
	<div align="center">
		<table width="500" border="0" cellpadding="1" cellspacing="0">
			<tr>
				<th>SewaKuy <br>
			</tr>
            <tr>
				<th>------------------------------------------------------------------------------------------------------------------------</th>
			</tr>
			// <tr align="center"><td><hr></td></tr>
			// <tr>
			// <td>#<?=$trx['tanggal_booking']?> - <b>USERNAME :</b> <?php echo $_SESSION["username"]?></td>
			// </tr>
			// <tr>
			// 	<th>------------------------------------------------------------------------------------------------------------------------</th>
			// </tr>
			<tr><td><hr></td></tr>
		</table>
		<table width="500" border="0" cellpadding="3" cellspacing="0">
            <tr>
                <td valign="top">ID Booking</td>
				<td valign="top" align="center">ID Kamar</td>
				<td valign="top" align="center">Nama Kamar</td>
				<td valign="top" align="center" >Harga</td>
				<td valign="top" align="right">Bayar</td>
            </tr>
            <tr>
				<td>-----------------------------</td>
				<td>-----------------------------</td>
				<td>-----------------------------</td>
				<td>-----------------------------</td>
			</tr>
			<tr>
				<td valign="top">
					<?=$trx['id_booking']?>
				</td>
				<td valign="top" align="center"><?=$trx['id_kamar']?></td>
				<td valign="top" align="center"><?=$trx['nama_kamar']?></td>
				<td valign="top" align="center"><?=number_format($trx['nominal'])?></td>
				<td valign="top" align="right"><?= $trx['bayar']?></td>
			</tr>
			// <tr>
			// 	<td colspan="4">-------------------------------------------------------------------------------------------------------------------------</td>
			// </tr>
			// <tr>
			// 	<td colspan="4"><hr></td>
			// </tr>
			// <tr>
			// </tr>
		</table>
		<table width="500" border="0" cellpadding="1" cellspacing="0">
			<tr><td><hr></td></tr>
            <tr>
				<th>--------------------------------------------------------------------------------</th>
			</tr>
			<tr>
				<th>Terimakasih</th>
			</tr>
			<tr>
				<th>Selamat Menikmati</th>
			</tr>
            <tr>
                <th>Sewakuy</th>
            </tr>
		</table>
	</div>
</body>
</html>