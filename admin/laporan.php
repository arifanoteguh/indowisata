<?php

include '../core/koneksi.php';
include '../core/login.php';
session_start();
if(!isset($_SESSION['login_admin'])){ //LOGIN
	?><script>
		window.alert("Admin Harap Login!");
		window.location.href="login.php";
	</script>
	<?php
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>IndoWisata</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="..\css\bootstrap.min.css">
	<script src="..\js\jquery.min.js"></script>
	<script src="..\js\bootstrap.min.js"></script>
	<style type="text/css">
	body{
		background-color: #f5f5f5;
		color:#fff;
	}
	a{
		text-decoration: none !important;

	}
	a.menu{
		text-align: left;
		color:#fff;
		display:block !important;
		padding:10%;
	}
  	a.menu.active,a:hover.menu{
		color:#fff;
  		background-color: #e32929 !important;
		font-weight: bold;
  	}
  	ul{
  		width: 100%;
  	}

	</style>

	</script>
</head>
<body>
<!--Side navbar-->
	<div class="col-sm-2" style="float:left; background-color: #3a3a3a; text-align:center; padding:0; height:100%; position:fixed; z-index:999;">  
		<div class="container-fluid">
			<h3>Admin Access</h3>
			<hr>
			<ul class="nav navbar-nav">
				<a class="menu" href="#"><li>Home <span class="glyphicon glyphicon-home" style="float:right;"></span></li></a>
				<a class="menu" href="member.php"><li>Data Member <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="post.php"><li>Data Post <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="prov.php"><li>Data Provinsi <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="kota.php"><li>Data Kota <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="admin.php"><li>Data Admin <span class="glyphicon glyphicon-user" style="float:right;"></span></li></a>
				<a class="menu" href="tambah.php"><li>Tambah Admin <span class="glyphicon glyphicon-plus" style="float:right;"></span></li></a>
				<a class="menu active" href="laporan.php"><li>Cetak Laporan <span class="glyphicon glyphicon-print" style="float:right;"></span></li></a>
				<hr>
				<a class="menu" href="../core/logout.php" style="text-align:center;"><li>Sign-Out <span class="glyphicon glyphicon-log-out"></span></li></a>
			</ul>
		</div>
	</div>
<!--end-->
</script>
	<div class="col-sm-2" style="float:left; padding:0; height:100%; z-index:-999">&nbsp;</div>

	<div class="col-sm-10" style="padding:0;">
		<div class="col-sm-12" style="background-color:#3a3a3a;">&nbsp;
			<h3 style="margin:0; padding-bottom:2%;">Cetak Laporan</h3>
		</div>
		<div class="col-sm-10" style="margin-top:5%; margin-left:5%;color:black">
			<div class="col-sm-4">
			 <div class="panel panel-primary">
		      <div class="panel-heading" style="background-color:#3a3a3a;text-align:center"> <b> Cetak Laporan Member  </b></div>
		        <div class="panel-body" style="text-align:center">
		        	 <img src="../img/Profile01.png" style="height:160px">
		        	 <form action="../admin/laporan/member.php" id="frmdata" method="get">
		        	 <label for="daftar">Pilih Daftar:</label>
				      <select class="form-control" name="daftarmember">
				        <option value="semua">Semua Member</option>
				        <option value="username">  Username</option>
				        <option value="nama">Nama</option>
				        <option value="tgl_lahir">Tanggal Lahir</option>
				        <option value="waktu_pembuatan">Tanggal Pembuatan</option>
				      </select>
				    <br>
				     <input type="text" class="form-control" name="cekmember" value=""> <br>
				     <input type="submit" name="cetakmember" class="btn btn-danger btn-md" value="Cetak"> </input>
				    </form>
		        </div> 
		      </div>
			
			</div>
			<div class="col-sm-4">
			 <div class="panel panel-primary">
		      
		      <div class="panel-heading" style="background-color:#3a3a3a;text-align:center"> <b> Cetak Laporan Post  </b></div>
		        <div class="panel-body" style="text-align:center">
		        	 <img src="../img/megaphone.png" style="height:125px;margin:15px 0px 20px 0px;">
		        	 <form action="../admin/laporan/post.php" id="frmdata" method="get" onchange="showDiv(this)">
		        	 <label for="daftar" >Pilih Daftar:</label>
				      <select class="form-control" name="daftarpost">
				        <option value="semua">Semua Post</option>
				        <option value="username">Username</option>
				        <option value="kota">Kota</option>
				        <option value="caption">Caption</option>
				        <option value="tgl">Tanggal Post</option>
				      </select>
				 	<br>
				     <input type="text" class="form-control" name="cekpost" value="" id="hiddendiv"> <br>
				     <input type="submit" name="cetakpost" class="btn btn-danger btn-md" value="Cetak"> </input>
				      </form>
		        </div> 
		      </div>
			
			</div>
			<div class="col-sm-4">
			 <div class="panel panel-primary">
		      
		      <div class="panel-heading" style="background-color:#3a3a3a;text-align:center"> <b> Cetak Laporan Admin  </b></div>
		        <div class="panel-body" style="text-align:center">
		        	 <span class="glyphicon glyphicon-user" style="font-size:125px;margin:15px 0px 20px 0px;"> </span>
		        	 <form action="../admin/laporan/admin.php" method="GET">
		        	 <label for="daftar" >Pilih Daftar:</label>
				      <select class="form-control" id="sel2" name="daftaradmin">
				        <option value="semua">Semua Admin</option>
				        <option value="username">Username</option>
				        <option value="nama">Nama</option>
				        <option value="waktu_pembuatan">Tanggal Pembuatan</option>
				      </select>
				 	<br>
				     <input type="text" class="form-control" name="cekadmin" value=""> <br>
				     <input type="submit" name="cetakadmin" class="btn btn-danger btn-md" value="Cetak"> </input>
				      </form>
		        </div> 
		      </div>
			
			</div>
			<div class="col-sm-4">
			 <div class="panel panel-primary">
		      <div class="panel-heading" style="background-color:#3a3a3a;text-align:center"> <b> Cetak Laporan Provinsi  </b></div>
		        <div class="panel-body" style="text-align:center">
		        	 <img src="../img/map-provinsi.png" style="height:160px;"> 
		        	 <form action="../admin/laporan/provinsi.php" method="GET">
		        	 <label for="daftar">Pilih Daftar:</label>
				      <select class="form-control" id="sel1" name="daftarprovinsi">
				        <option value="semua">Semua Provinsi</option>
				      	<option value="provinsi">Provinsi</option>
				      </select>
				      <br>
				     <input type="text" class="form-control" name="cekprovinsi" value=""> <br>
				     <input type="submit" name="cetakprovinsi" class="btn btn-danger btn-md" value="Cetak"> </input>
				      </form>
		        </div> 
		      </div>
			</div>
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
			 <div class="panel panel-primary">
		      <div class="panel-heading" style="background-color:#3a3a3a;text-align:center"> <b> Cetak Laporan Kota  </b></div>
		        <div class="panel-body" style="text-align:center">
		        	 <img src="../img/map_kota.png" style="height:125px;margin:15px 0px 20px 0px;"> 
		        	 <form action="../admin/laporan/kota.php" method="GET">
		        	 <label for="daftar">Pilih Daftar:</label>
				      <select class="form-control" id="sel1" name="daftarkota">
				        <option value="semua">Semua Kota</option>
				      	<option value="provinsi">Provinsi</option>
				      	<option value="kota">Kota</option>
				      </select>
				      <br>
				     <input type="text" class="form-control" name="cekkota" value=""> <br>
				     <input type="submit" name="cetakkota" class="btn btn-danger btn-md" value="Cetak"> </input>
				      </form>
		        </div> 
		      </div>
			
			</div>
		</div>	
	</div>
</body>
</html>