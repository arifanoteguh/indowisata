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

$hitungmember=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM user"));
$hitungmember=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM post"));
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
  	.panel{
  		border-color: #3a3a3a;
  		text-align: center;
  	}
  	.panel-heading{
  		background-color: #3a3a3a;
  		color:#fff;
  	}

	</style>
	<script type="text/javascript">
	$(document).ready(function() {
		  $("#user").keyup(validateuser);
		  $("#password1").keyup(validate1);
		  $("#password2").keyup(validate2);
	  		
		});

		function validateuser(){
		  var user = $("#user").val();
			if(user.length < 8){
				$("#check-length-user").text("Minimal 8 Karakter");
			}
			else{
				$("#check-length-user").text("");				
			}
		}

		function validate1(){
		  var password1 = $("#password1").val();
			if(password1.length < 8){
				$("#check-length").text("Minimal 8 Karakter");
			}
			else{
				$("#check-length").text("");				
			}
		}

		function validate2() {
		  var password1 = $("#password1").val();
		  var password2 = $("#password2").val();
	 
		    if(password1 == password2) {
		       $("#validate-status").html("").html("<span class='glyphicon glyphicon-ok form-control-feedback' style='color:green;'></span>");       
		       $("#validate-status-p").text("");      
			    }
		    else {
		       $("#validate-status").html("").html("<span class='glyphicon glyphicon-remove form-control-feedback' style='color:red; disable='none'></span>");
		       $("#validate-status-p").text("Password Tidak Sama");
		    }
		}

	</script>
</head>
<body>
<!--Side navbar-->
	<div class="col-sm-2" style="float:left; background-color: #3a3a3a; text-align:center; padding:0; height:100%; position:fixed; z-index:999;">   
		<div class="container-fluid">
			<h3>Admin Access</h3>
			<hr>
			<ul class="nav navbar-nav">
				<a class="menu" href="index.php"><li>Home <span class="glyphicon glyphicon-home" style="float:right;"></span></li></a>
				<a class="menu" href="member.php"><li>Data Member <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="post.php"><li>Data Post <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="prov.php"><li>Data Provinsi <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="kota.php"><li>Data Kota <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="admin.php"><li>Data Admin <span class="glyphicon glyphicon-user" style="float:right;"></span></li></a>
				<a class="menu active" href="tambah.php"><li>Tambah Admin <span class="glyphicon glyphicon-plus" style="float:right;"></span></li></a>
				<hr>
				<a class="menu" href="../core/logout.php" style="text-align:center;"><li>Sign-Out <span class="glyphicon glyphicon-log-out"></span></li></a>
			</ul>
		</div>
	</div>
<!--end-->
	<div class="col-sm-2" style="float:left; padding:0; height:100%; z-index:-999">&nbsp;</div>

	<div class="col-sm-10" style="padding:0">
		<div class="col-sm-12" style="background-color:#3a3a3a;">&nbsp;
			<h3 style="margin:0; padding-bottom:2%;">Tambah Admin Baru</h3>
		</div>
		<div class="col-sm-10" style="margin-top:5%; margin-left:5%;">
			<div class="col-sm-10" style="color:#3a3a3a">
				<div class="panel">
				<div class="panel-heading"><h3>- Sign Up -</h3></div>
				<div class="panel-body">
				<form action="../core/signup.php" method="post" id="FormCheckPassword">
					<div class="form-group has-feedback">
						<input type="text" name="user" maxlength="20" placeholder="Username" class="form-control" id="user">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
				    <p id="check-length-user" style="color:red;"></p>
					<div class="form-group has-feedback">
						<input type="password" name="pass" placeholder="Password" class="form-control" id="password1">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				    </div>
				    <p id="check-length" style="color:red;"></p>
					<div class="form-group has-feedback">
						<input type="password" name="pass" placeholder="Validasi Password" class="form-control" id="password2">
						<span id="validate-status"></span>
				    </div>
				    <p id="validate-status-p" style="color:red;"></p>
				    <div class="form-group has-feedback">
						<input type="text" name="nama" maxlength="20" placeholder="Nama" class="form-control" id="nama">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="text" name="kontak" maxlength="20" placeholder="Kontak" class="form-control" id="nama">
						<span class="glyphicon glyphicon-earphone form-control-feedback"></span>
					</div>
		  		<input type="submit" class="btn btn-danger btn-md" name="signupadmin" value="Sign-Up"">
				</form>
				</div>
			</div>
			</div>
		</div>	
	</div>

</body>
</html>