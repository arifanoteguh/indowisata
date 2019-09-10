<?php
include 'core/koneksi.php';
include 'core/login.php';
session_start();
if(!isset($_SESSION['login_user'])){ //LOGIN
  ?><script>
    window.alert("Harap Login!");
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
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="js\bootstrap.min.js"></script>

	<style type="text/css">
	body{
		background-color:#FEFFE8;
	}
	.btn-file {
        position: relative;
        overflow: hidden;
		background-color: #d9534f;
		border-color:#ac2925;
		color:white;
    }
	.btn-file:hover {
		background-color: #e32929;
		border-color:#ac2925;
		color:white;
	}
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
    .navbar{
      font-size: 10pt;
      margin-bottom: 50px;
      border-radius: 0;
    }
    .glyphicon.glyphicon-log-in,
    .glyphicon.glyphicon-plus{
      font-size: 15px;
    }
    .glyphicon.glyphicon-search{
      color: #ecf0f1;
    }
    .glyphicon.glyphicon-search:hover{
      color: #ffffff;
    }
	
	.panel.panel-primary{
      border-color: #e32929;
	}
	
    /* Navbar Color */
    .navbar-default {
      background-color: #f72727;
      border-color: #e32929;
    }
    .navbar-default .navbar-brand {
      color: #ecf0f1;
    }
    .navbar-default .navbar-brand:hover,
    .navbar-default .navbar-brand:focus {
      color: #ffffff;
    }
    .navbar-default .navbar-text {
      color: #ecf0f1;
    }
    .navbar-default .navbar-nav > li > a {
      color: #ecf0f1;
    }
    .navbar-default .navbar-nav > li > a:hover,
    .navbar-default .navbar-nav > li > a:focus {
      color: #ffffff;
      background-color: #e32929;
    }
    .navbar-default .navbar-nav > .active > a,
    .navbar-default .navbar-nav > .active > a:hover,
    .navbar-default .navbar-nav > .active > a:focus {
      color: #ffffff;
      background-color: #e32929;
    }
    .navbar-default .navbar-nav > .open > a,
    .navbar-default .navbar-nav > .open > a:hover,
    .navbar-default .navbar-nav > .open > a:focus {
      color: #ffffff;
      background-color: #e32929;
    }
    .navbar-default .navbar-toggle {
      border-color: #e32929;
    }
    .navbar-default .navbar-toggle:hover,
    .navbar-default .navbar-toggle:focus {
      background-color: #e32929;
    }
    .navbar-default .navbar-toggle .icon-bar {
      background-color: #ecf0f1;
    }
    .navbar-default .navbar-collapse,
    .navbar-default .navbar-form {
      border-color: #ecf0f1;
    }
    .navbar-default .navbar-link {
      color: #ecf0f1;
    }
    .navbar-default .navbar-link:hover {
      color: #ffffff;
    }

    @media (max-width: 767px) {
      .navbar-default .navbar-nav .open .dropdown-menu > li > a {
        color: #ecf0f1;
      }
      .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
      .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
        color: #ffffff;
      }
      .navbar-default .navbar-nav .open .dropdown-menu > .active > a,
      .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
      .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
        color: #ffffff;
        background-color: #e32929;
      }
    }
    /* End of Navbar Color */
	</style>

<script type="text/javascript">
$(document).ready(function()
{
 $(".country").change(function()
 {
  var id=$(this).val();
  var dataString = 'id='+ id;
 
  $.ajax
  ({
   type: "POST",
   url: "get_state.php",
   data: dataString,
   cache: false,
   success: function(html)
   {
      $(".state").html(html);
   } 
   });
  });
 
});
</script>
</head>
<body>

  <?php
  
  $username=$_SESSION['login_user'];
  $query = mysqli_query($konek,"SELECT id_user FROM user where username='$username'");
  if($row=mysqli_fetch_array($query)){
    $id_user_post=$row['id_user'];
  }
  $query = mysqli_query($konek,"SELECT * FROM komentar JOIN post ON komentar.id_post=post.id_post where baca='belum' AND post.id_user='$id_user_post'");
  if(!$query){
    die("Gagal : ".mysql_error());
  }
  $num=mysqli_num_rows($query);
  ?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li style="margin-top:0.75%; margin-right:-70%; margin-left:-3%;"><img src="img/logo.png" width="10%"></li>
        <?php
          if(isset($_SESSION['login_user'])){ //LOGIN
            ?><li style="margin-left:3%;"><a href="profile.php"><?php echo($_SESSION['login_user']) ?> <span class="glyphicon glyphicon-user"></span></a></li>
            <li><a href="index.php">Timeline</a></li>
              <form class="navbar-form navbar-left" role="search" method="get" action="search.php" >
                <div class="form-group input-group">
                  <input type="text" class="form-control" placeholder="Search.." name="cari">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                       <span class="glyphicon glyphicon-search"></span>
                    </button>
                  </span>        
                </div>
              </form>
            <?php }else{
                ?><li><a href="index.php">Timeline</a></li>
              <?php } ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
          if(isset($_SESSION['login_user'])){ //LOGIN
           ?>
        <li><a href="notifikasi.php"><?php echo $num ?> <span class="glyphicon glyphicon-bell" style="font-size:12pt;" alt="notifikasi"></span></a></li>
			  <li class="active"><a href="#">Post Here</a></li>
			  <li><a href="setting.php"><span class="glyphicon glyphicon-cog" style="font-size:12pt;" alt="setting"></span></a></li>
              <li><a href="core/logout.php">Sign-Out <span class="glyphicon glyphicon-log-out"></span></a></li>
            <?php
          }else{ //BELUM LOGIN
            ?>
              <li><a href="login.php">Sign-In <span class="glyphicon glyphicon-log-in"></span></a></li>
              <li><a href="signup.php">Sign-Up <span class="glyphicon glyphicon-plus"></span></a></li>
              <li><a href="search.php"><span class="glyphicon glyphicon-search"></span></a></li>
            <?php
            } ?>
      </ul>
    </div>
  </div>
</nav>

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

<div class="container">
	<div>
		<form action="core/post.php" method="post" enctype="multipart/form-data">
		<div class="col-sm-12" style="border:0px solid;padding:20px;">
			<div class="row">
				<div class="col-sm-6">
					<div class="panel panel-primary">
						<div class="panel-heading" style="background-color:#e32929; border-color:#e32929">Foto Preview</div>
						<div class="panel-body"><img id="prv" src="img/pict_default.png" class="img-responsive" style="width:100%" alt="Image"></div>
					</div>
					<span class="btn btn-default btn-file">
						Pilih Foto <input type="file" name="upfoto" onchange="readURL(this);" accept="image/*">
					</span>
				</div>
				<div class="col-sm-6">
					<select name="provinsi" placeholder="Pilih Provinsi.." class="form-control country">
						<option value="" disabled selected>Pilih Provinsi</option>
            <?php

            $qprov=mysqli_query($konek,"SELECT * FROM provinsi");
            while($row=mysqli_fetch_array($qprov)) {
              ?>
						<option value="<?php echo $row['id_prov'] ?>" ><?php echo $row['provinsi'] ?></option>
            <?php } ?>
					</select>
					<br>
					<select name="kota" placeholder="Pilih Kota.." class="form-control state">
						<option value="" disabled selected>Pilih Kota</option>
          </select>
					<br>
					<input type="text" name="alamat" placeholder="Alamat" class="form-control"><br>
					<textarea name="capt" placeholder="Caption" style="height:180px;" class="form-control"></textarea><br>
					<div class="form-group" style="text-align:right;">
						<input type="submit" name="kirim" class="btn btn-danger btn-md" value="Simpan">
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>

</body>
</html>