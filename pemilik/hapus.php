<?php
    require "../config.php";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM kamar WHERE id_kamar = '$id'";
        $hapus = mysqli_query($koneksi,$sql);
        echo "<script>
                  alert('Data kamar berhasil dihapus!');
                  document.location.href = 'kelola.php';
              </script>";
    }
    ?>