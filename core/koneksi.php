<?php
$server="localhost";
$u="root";
$p="";
$db="indowisata";
//untuk meng-hidden error warning dari MySQL
$konek= mysqli_connect($server, $u, $p) or die("<br><h1>Gagal Terkoneksi Dengan MySQL");
mysqli_select_db($konek,$db);
?>