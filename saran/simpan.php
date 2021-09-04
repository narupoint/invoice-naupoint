<?php
include 'koneksi.php';
// menyimpan data kedalam variabel
$nama      = $_POST['nama'];
$topik     = $_POST['topik'];
$saran     = $_POST['saran'];
// query SQL untuk insert data
$query = "INSERT INTO saran SET nama='$nama',topik='$topik',saran='$saran'";
mysqli_query($conn, $query);
// mengalihkan ke halaman index.php
header("Location:http://0.0.0.0:8080/saran/index.php?pesan=Saran & Masukan mu sudah terkirim.");
?>
