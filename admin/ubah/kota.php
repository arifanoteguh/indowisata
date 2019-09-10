<?php

include '../../core/koneksi.php';
include '../../core/login.php';
session_start();
if(!isset($_SESSION['login_admin'])){ //LOGIN
	?><script>
		window.alert("Admin Harap Login!");
		window.location.href="login.php";
	</script>
	<?php
}
  $id=$_GET['id'];
  $get = "SELECT * FROM kota JOIN provinsi ON kota.id_prov=provinsi.id_prov where id_kota='$id'";
   $run = mysqli_query($konek,$get);
   $row = mysqli_fetch_array($run);

   $kota_id = $row['id_kota'];
   $nama_prov = $row['provinsi'];
   $kota    = $row['kota'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>IndoWisata</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="..\..\css\bootstrap.min.css">
	<script src="..\..\js\jquery.min.js"></script>
	<script src="..\..\js\bootstrap.min.js"></script>
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
</head>
<body>
<!--Side navbar-->
	<div class="col-sm-2" style="float:left; background-color: #3a3a3a; text-align:center; padding:0; height:100%; position:fixed; z-index:999;">  
		<div class="container-fluid">
			<h3>Admin Access</h3>
			<hr>
			<ul class="nav navbar-nav">
				<a class="menu" href="..\index.php"><li>Home <span class="glyphicon glyphicon-home" style="float:right;"></span></li></a>
				<a class="menu" href="..\member.php"><li>Data Member <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="..\post.php"><li>Data Post <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="..\prov.php"><li>Data Provinsi <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu active" href="..\kota.php"><li>Data Kota <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="..\admin.php"><li>Data Admin <span class="glyphicon glyphicon-user" style="float:right;"></span></li></a>
				<a class="menu" href="..\tambah.php"><li>Tambah Admin <span class="glyphicon glyphicon-plus" style="float:right;"></span></li></a>
				<hr>
				<a class="menu" href="../../core/logout.php" style="text-align:center;"><li>Sign-Out <span class="glyphicon glyphicon-log-out"></span></li></a>
			</ul>
		</div>
	</div>
<!--end-->
	<div class="col-sm-2" style="float:left; padding:0; height:100%; z-index:-999">&nbsp;</div>
	<div class="col-sm-10" style="padding:0;">
		<div class="col-sm-12" style="background-color:#3a3a3a;">&nbsp;
			<h3 style="margin:0; padding-bottom:2%;"> Ubah Kota </h3>
		</div>
		<div class="col-sm-10" style="margin-top:5%; margin-left:8%;">
		      <div class="panel-group" style="background-color:white;color:black">
		      <div class="panel panel-default" style="border-color:red;">
		       <div class="panel-heading"><h4> Kota <br> </h4> <h6> Ubah pengaturan Kota. </h6></div>
		        <div class="panel-body">
		        <form method="post" enctype="multipart/form-data">	        
		              <input type="hidden" class="form-control" name="id" value="<?php echo $row['id_kota']?>"/>
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="idkota"> Id Kota </label>
		              <div class="col-sm-9">
		               <input type="id" class="form-control" name="id" value="<?php echo $kota_id;?>"  disabled>
		              </div> <br><br>
		          </div>    
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="namaprovinsi"> Provinsi </label>
		              <div class="col-sm-9">
		                <input type="provinsi" class="form-control" name="provinsi" value="<?php echo $nama_prov;?>" disabled/>
		              </div> <br><br>
		          </div>
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="namakota"> Kota </label>
		              <div class="col-sm-9">
		                <input type="kota" class="form-control" name="kota" value="<?php echo $kota;?>"/>
		              </div> <br><br>
		          </div>
		           <div class="form-group" style="margin:15px 15px 0px 0px; text-align:right;">
		              <input type="submit" name="update" class="btn btn-danger btn-md" value="Simpan"/>
		           </div>
		        </form>
		        </div>
		        </div>
		      </div>
    	
		</div>	
	</div>

	<?php

          if(isset($_POST['update'])){
          	$id = $_POST['id'];
         	$kota = $_POST['kota'];

            $update = "update kota set kota='$kota' where id_kota='$id'";

            $run = mysqli_query($konek,$update);

            if($run){
               echo "<script> alert('Profile sudah diperbarui') </script>";
               echo "<script> window.open('../kota.php','_self') </script>";
            }
        }
          ?>      
</body>
</html>