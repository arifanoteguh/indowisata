<?php

include 'koneksi.php';

$cari = $_GET['cari'];

$query = mysqli_query($konek,"SELECT * FROM post JOIN user ON post.id_user=user.iduser where username='$cari' OR caption='$cari' order by id_post desc");

if(!$query){
		die("Gagal : ".mysql_error());
}


?>