<?php

include '../core/koneksi.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>IndoWisata</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="..\css\bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="..\js\bootstrap.min.js"></script>
	<style type="text/css">
	body{
		background-color: #f5f5f5;
	} 
	.form-control{
		width:50%;
		display:inline;
		transition:ease-in-out .15s;
		margin-bottom: 3%;
	}
	.form-control:focus{
		width:70%;
		transition:ease-in-out .15s;
	}
	</style>
</head>
<body>
	<div class="container"><center>
		<div class="col-sm-3">&nbsp;</div>
		<div class="col-sm-6" style="margin-top:15%;">
			<div class="panel panel-primary">
				<div class="panel-heading"><h3>- LOGIN -</h3></div>
				<div class="panel-body">
				<form action="../core/login.php" method="post">
					<span class="glyphicon glyphicon-user"></span>
					<input type="text" name="user" maxlength="20" placeholder="Username" class="form-control">
					<br>
					<span class="glyphicon glyphicon-lock"></span>
					<input type="password" name="pass" placeholder="Password" class="form-control">
				    <br>
					<input type="submit" class="btn btn-primary btn-md" name="loginadmin" value="Sign-In">
				</form>
				</div>
			</div>
		</div>
		<div class="col-sm-3">&nbsp;</div>
	</center></div>
</body>
</html>