<?php

include_once ('../../core/koneksi.php');
include '../../core/login.php';
session_start();
if(!isset($_SESSION['login_admin'])){ //LOGIN
	?><script>
		window.alert("Admin Harap Login!");
		window.location.href="login.php";
	</script>
	<?php
}  
  $get = "delete from post where id_post='".$_GET['hapus_id']."'";
  $query = mysqli_query($konek,$get) or die($get);
  header("Location: ../post.php");

?>