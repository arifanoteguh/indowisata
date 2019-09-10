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
  $get = "SELECT * FROM admin where id_admin='$id'";
   $run = mysqli_query($konek,$get);
   $row = mysqli_fetch_array($run);

   $admin_id = $row['id_admin'];
   $nama = $row['nama'];
   $username = $row['username'];
   $kontak = $row['kontak'];
   //$password    = $row['password'];
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
				<a class="menu" href="..\kota.php"><li>Data Kota <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu active" href="..\admin.php"><li>Data Admin <span class="glyphicon glyphicon-user" style="float:right;"></span></li></a>
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
			<h3 style="margin:0; padding-bottom:2%;"> Ubah Admin </h3>
		</div>
		<div class="col-sm-10" style="margin-top:5%; margin-left:8%;">
		 <ul class="nav nav-tabs">
		    <li class="active"><a data-toggle="tab" href="#akun">Akun</a></li>
		    <li><a data-toggle="tab" href="#katasandi">Kata Sandi</a></li>
  		 </ul>
  		 <br>
  		 <div class="tab-content">
  		   <div id="akun" class="tab-pane fade in active">
		      <div class="panel-group" style="background-color:white;color:black">
		      <div class="panel panel-default" style="border-color:red;">
		       <div class="panel-heading"><h4> Admin <br> </h4> <h6> Ubah pengaturan Akun Admin. </h6></div>
		        <div class="panel-body">
		        <form method="post" enctype="multipart/form-data" name="formakun">	        
		              <input type="hidden" class="form-control" name="id" value="<?php echo $row['id_admin']?>"/>
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="idadmin"> Id Admin </label>
		              <div class="col-sm-9">
		               <input type="text" class="form-control" name="id" value="<?php echo $admin_id;?>"  disabled>
		              </div> <br><br>
		          </div>    
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="nama"> Nama </label>
		              <div class="col-sm-9">
		                <input type="text" class="form-control" name="nama" value="<?php echo $nama;?>"/>
		              </div> <br><br>
		          </div>
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="username"> Username </label>
		              <div class="col-sm-9">
		                <input type="text" class="form-control" name="username" value="<?php echo $username;?>"/>
		              </div> <br><br>
		          </div>
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="kontak"> Kontak </label>
		              <div class="col-sm-9">
		                <input type="text" class="form-control" name="kontak" value="<?php echo $kontak;?>"/>
		              </div> <br><br>
		          </div>
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="namakota"> Kata sandi lama </label>
		              <div class="col-sm-9">
		                <input type="password" class="form-control" name="katasandiver" value=""/>
		              </div> <br><br>
		          </div>
		           <div class="form-group" style="margin:15px 15px 0px 0px; text-align:right;">
		              <input type="submit" name="updateakun" class="btn btn-danger btn-md" value="Simpan" />
		           </div>
		        </form>
		        </div>
		        </div>
		      </div>
		  </div>
 		   <div id="katasandi" class="tab-pane fade">
		      <div class="panel-group" style="background-color:white;color:black">
		      <div class="panel panel-default" style="border-color:red;">
		       <div class="panel-heading"><h4> Admin <br> </h4> <h6> Ubah pengaturan Kata Sandi. </h6></div>
		        <div class="panel-body">
		        <form method="post" enctype="multipart/form-data" name="formkatasandi">	        
		              <input type="hidden" class="form-control" name="id" value="<?php echo $row['id_admin']?>"/>
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="idadmin"> Kata sandi lama</label>
		              <div class="col-sm-9">
		               <input type="password" class="form-control" name="sandilama" />
		              </div> <br><br>
		          </div>    
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="namaadmin">  Kata sandi baru</label>
		              <div class="col-sm-9">
		                <input type="password" class="form-control" name="sandibaru"/>
		              </div> <br><br>
		          </div>
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="namakota"> Verifikasi kata sandi </label>
		              <div class="col-sm-9">
		                <input type="password" class="form-control" name="versandi"/>
		              </div> <br><br>
		          </div>
		           <div class="form-group" style="margin:15px 15px 0px 0px; text-align:right;">
		              <input type="submit" name="gantipassword" class="btn btn-danger btn-md" value="Simpan"/>
		           </div>
		        </form>
		        </div>
		        </div>
		      </div>
		  </div>
		</div>
		</div>
	</div>

	<?php
          if(isset($_POST['updateakun'])){
          	$id = $_POST['id'];
         	$namaadmin = $_POST['nama'];
         	$usernameadmin = $_POST['username'];
         	$kontak = $_POST['kontak'];
         	$katasandiver = $_POST['katasandiver'];
         	$select = "select password from admin where id_admin='$id'";
         	$runcek = mysqli_query($konek,$select);
         	$rowcek = mysqli_fetch_array($runcek);

         	$verkatasandi = $rowcek['password'];

         	if ($katasandiver==$verkatasandi) {
         		$update = "update admin set nama='$namaadmin', username='$usernameadmin' where id_admin='$id'";
				$run = mysqli_query($konek,$update);

            	if($run){
	               echo "<script> alert('Profile sudah diperbarui') </script>";
	               echo "<script> window.open('../admin.php','_self') </script>";
            	}
         	}else
         	{
         		echo "<script> alert('Kata Sandi Salah') </script>";
         	}
            
          }
          else{
          	if (isset($_POST['gantipassword'])) {
                       $id = $_POST['id'];
                       $passwordlama = $_POST['sandilama'];
                       $passwordbaru = $_POST['sandibaru'];
                       $passwordrevisi = $_POST['versandi'];

                       $get_user = "select password from admin where id_admin='$id'";
                       $run1 = mysqli_query($konek,$get_user);
                       $row1 = mysqli_fetch_array($run1);

                       $passwordlamapisan = $row1['password'];

                      //check pass
                      if ($passwordlama==$passwordlamapisan)
                      {
                           //check twonew pass
                          if ($passwordbaru==$passwordrevisi)
                          {
                          //success
                          //change pass in db
                              if (strlen($passwordbaru)>25||strlen($passwordbaru)<6)   
                              {
                                echo "<script> alert('Kata sandi minimal 6 digit'); </script>";
                              }
                              else
                              {        
                                  $updatepass = "UPDATE admin SET password='$passwordbaru' WHERE id_admin='$id'";
                                  $run1 = mysqli_query($konek,$updatepass);
                                  echo "<script> alert('Kata Sandi sudah diperbarui') </script>";
                                  echo "<script> window.open('../admin.php','_self') </script>";
                              }
                          }
                          else
                              echo "<script> alert('Verifikasi dan kata sandi baru tidak cocok'); </script>";  
                      }
                      else
                          echo "<script>alert('Kata sandi lama salah'); </script>";
                    }
         	 }
          ?>      
</body>
</html>