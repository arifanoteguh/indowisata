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
   $get = "SELECT * FROM post JOIN user ON post.id_user=user.id_user JOIN kota ON post.id_kota=kota.id_kota JOIN provinsi ON post.id_prov=provinsi.id_prov where id_post='$id'";
   $run = mysqli_query($konek,$get);
   $row = mysqli_fetch_array($run);

   $user_id = $row['id_user'];
   $id_post = $row['id_post']; 
   $nama = $row['nama'];
   $username = $row['username'];
   $alamat = $row['alamat'];
   $nama = $row['nama'];
   $provinsi = $row['provinsi'];
   $kota = $row['kota'];
   $caption = $row['caption'];
  
   $foto = "../../core/upload/".$row['id_user']."/".$row['foto_nama'];

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
				<a class="menu active" href="..\post.php"><li>Data Post <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="..\prov.php"><li>Data Provinsi <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="..\kota.php"><li>Data Kota <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="..\admin.php"><li>Data Admin <span class="glyphicon glyphicon-user" style="float:right;"></span></li></a>
				<a class="menu" href="..\tambah.php"><li>Tambah Admin <span class="glyphicon glyphicon-plus" style="float:right;"></span></li></a>
				<hr>
				<a class="menu" href="../../core/logout.php" style="text-align:center;"><li>Sign-Out <span class="glyphicon glyphicon-log-out"></span></li></a>
			</ul>
		</div>
	</div>
<!--end-->

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#prv').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

	<div class="col-sm-2" style="float:left; padding:0; height:100%; z-index:-999">&nbsp;</div>
	<div class="col-sm-10" style="padding:0;">
		<div class="col-sm-12" style="background-color:#3a3a3a;">&nbsp;
			<h3 style="margin:0; padding-bottom:2%;"> Ubah Post </h3>
		</div>
		<div class="col-sm-10" style="margin-top:5%; margin-left:8%;">
			<div class="col-sm-4">
		      <div class="panel panel-primary">
		      <form method="post" enctype="multipart/form-data">
		      <div class="panel-heading" style="background-color:#3a3a3a;"> Foto </div>
		        <div class="panel-body"><img id="prv" src="<?php echo $foto?>" class="img-responsive" alt="Image"></div> 
		      </div>
		      <span class="btn btn-default btn-file col-sm-12">
					Pilih Foto <input type="file" name="upfoto" onchange="readURL(this);"/>
			   </span>
      			
      		</div>
      		<div class="col-sm-8" style="color:black;">
		      <div class="panel-group" style="background-color:white;">
		      <div class="panel panel-default" style="border-color:#337ab7;">
		       <div class="panel-heading"><h4> Post <br> </h4> <h6> Ubah pengaturan Post. </h6></div>
		        <div class="panel-body">

		        
		          <input type="hidden" class="form-control" name="id" value="<?php echo $row['id_post'] ?>"/>    
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="idpost"> Id Post </label>
		              <div class="col-sm-9">
		               <input type="text" class="form-control" name="id" value="<?php echo $id_post?>"  disabled/>
		              </div> <br><br>
		          </div>    
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="username"> Username </label>
		              <div class="col-sm-9">
		                <input type="text" class="form-control" name="username" value="<?php echo $username;?>" disabled/>
		              </div> <br><br>
		          </div>
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="username">  Alamat </label>
		              <div class="col-sm-9">
		                <input type="text" class="form-control" name="alamat" value="<?php echo $alamat;?>"/>
		              </div> <br><br>
		          </div>
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;"> Caption </label>
		              <div class="col-sm-9">
		              <textarea class="form-control" rows="5" name="caption"> <?php echo $caption?></textarea>
		              </div><br><br>
		          </div>
		           <div class="form-group" style="text-align:right;">
		              <input type="submit" name="update" class="btn btn-danger btn-md" style="margin:15px 15px 0px 0px" value="Simpan"/>
		           </div>
		        </form>
		        </div>
		        </div>
		      </div>
    		</div>
		</div>	
	</div>

	<?php

          if(isset($_POST['update'])){
           $id = $_POST['id'];
		   $alamat = $_POST['alamat'];
		   $nama = $_POST['nama'];
		   $provinsi = $_POST['provinsi'];
		   $kota = $_POST['kota'];
		   $caption = $_POST['caption'];

		   $rand_digit=rand(00000,99999);
            $target_dir = "../../core/upload/".$user_id."/";
            if(!file_exists($target_dir)){
              mkdir($target_dir,0777,true);
            }
            $nama_file = $rand_digit.$_FILES['upfoto']['name'];
            $target_file = $target_dir.basename($nama_file);
            $ukuran_file = $_FILES['upfoto']['size'];
            $tipe_file = $_FILES['upfoto']['type']; 
            $tmp_file = $_FILES['upfoto']['tmp_name'];
            
            $tgl_lahir=$thn."-".$bln."-".$tgl;
            if($ukuran_file!=""){
              if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ 
                if($ukuran_file<=20000000){
                  if(move_uploaded_file($tmp_file,$target_file)){
                    $update = "update post set foto_nama='$nama_file', foto_size='$ukuran_file', foto_tipe='$tipe_file', alamat='$alamat', caption='$caption' where id_post='$id'";

                    $run = mysqli_query($konek,$update);
                    if($run){
                       echo "<script> alert('Profile sudah diperbarui') </script>";
                       echo "<script> window.open('../post.php','_self') </script>";
                    }
                   }
                  }else{
                       echo "<script> alert('Ukuran Foto Tidak Boleh Lebih Dari 20MB') </script>";
                  }
                }
              }else{
                $update = "update post set alamat='$alamat', caption='$caption' where id_post='$id'";

                $run = mysqli_query($konek,$update);

                if($run){
                  echo "<script> alert('Profile sudah diperbarui') </script>";
                  echo "<script> window.open('../post.php','_self') </script>";
                }
              }
        }
          ?>      
</body>
</html>