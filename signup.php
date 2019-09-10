<?php
include 'core/koneksi.php';
include 'core/login.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>IndoWisata</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\bootstrap-select.min.css">
	<script src="js\jquery.min.js"></script>
	<script src="js\bootstrap-select.min.js"></script>
	<script src="js\bootstrap.min.js"></script>

	<style type="text/css">
		body{
			background-color:#FEFFE8;
		}		.col-xs-8{
			border-radius: 10px 10px 0px 0px;
		}
		.container{
			text-align: center;
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

		function leapYear(year){
		  return ((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0);
		}
	</script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li style="margin-top:0.75%; margin-right:-70%; margin-left:-3%;"><img src="img/logo.png" width="10%"></li>
        <?php
          if(isset($_SESSION['login_user'])){ //LOGIN
            ?><li><a href="profile.php"><?php echo($_SESSION['login_user']) ?> <span class="glyphicon glyphicon-user"></span></a></li>
            <li><a href="index.php">Timeline</a></li>
              <form class="navbar-form navbar-left" role="search" action="search.php" method="get">
                <div class="form-group input-group">
                  <input type="text" class="form-control" placeholder="Search.." name="cari">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
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
			  <li><a href="post.php">Post Here</a></li>
              <li><a href="core/logout.php">Sign-Out <span class="glyphicon glyphicon-log-out"></span></a></li>
            <?php
          }else{ //BELUM LOGIN
            ?>
              <li><a href="login.php">Sign-In <span class="glyphicon glyphicon-log-in"></span></a></li>
              <li class="active"><a href="#">Sign-Up <span class="glyphicon glyphicon-plus"></span></a></li>
              <li><a href="search.php"><span class="glyphicon glyphicon-search"></span></a></li>
            <?php
            } ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
	<div class="col-xs-8 col-xs-offset-2" style="background-color:#f72727;"><h3 style="color:#ffffff">- Sign Up -</h3></div>
	<div class="col-xs-8 col-xs-offset-2" style="background-color:#efefef; border-radius: 0px; padding-top: 2%; padding-bottom: 2%;">
	<script>

		$(document).ready(function() {
		  $("#user").keyup(validateuser);
		  $("#password1").keyup(validate1);
		  $("#password2").keyup(validate2);
		  $('select').change(function(){
			  var tgl=+$('#tanggal').val();
			  var bln=+$('#bulan').val();
			  var thn=+$('#tahun').val();
			  $( "select option:selected" ).each(function() {
				  if(((leapYear(thn)==true) && (bln==2) && (tgl>29)) || ((leapYear(thn)==false) && (bln==2) && (tgl>28))){
				  	$('#notif').html("").html("<p style='color:red;'>Tanggal Tidak Benar</p>");
				  }
				  else{
				    $("#tahun").css("background-color","white");
			        $("#tanggal").css("background-color","white");
			        $("#bulan").css("background-color","white");
				  	$('#notif').html("").html("");
				  }	
			  });

		  })
		});

	</script>
		<form action="core/signup.php" method="post">
			<div class="form-group has-feedback">
			    <input type="text" class="form-control" placeholder="Username *" name="user" id="user" maxlength="20" />
			    <i class="glyphicon glyphicon-user form-control-feedback"></i>
			</div>
			<p id="check-length-user" style="color:red;"></p>
			<div class="form-group has-feedback">
			    <input type="password" class="form-control" placeholder="Password *" name="pass" id="password1" maxlength="20" />
			    <i class="glyphicon glyphicon-lock form-control-feedback"></i>
			</div>
			<p id="check-length" style="color:red;"></p>
			<div class="form-group has-feedback">
			    <input type="password" class="form-control" placeholder="Password *" name="pass" id="password2" maxlength="20" />
				<span id="validate-status"></span>
			</div>
			 <p id="validate-status-p" style="color:red;"></p>
			<div class="form-group has-feedback">
			    <input type="text" class="form-control" placeholder="Email *" name="email" maxlength="35" />
			    <i class="glyphicon glyphicon-envelope form-control-feedback"></i>
			</div>
			<div class="form-group has-feedback">
			    <input type="text" class="form-control" placeholder="Nama *" name="nama" maxlength="30" />
			    <i class="glyphicon glyphicon-font form-control-feedback"></i>
			</div>
			<div class="form-group has-feedback">
				<div class="col-sm-4">
				    <select class="form-control" name="tanggal" id="tanggal">
				    	<option value="" selected disabled>Tanggal</option>
				    	<?php

				    	$tgl=1;
				    	while ($tgl<=31) {
				    		?>
				    	<option value="<?php echo $tgl ?>"><?php echo $tgl ?></option>
				    	<?php
				    	$tgl=$tgl+1;
				    	}

				    	?>
				    </select>
				</div>
				<div class="col-sm-4">
				    <select class="form-control" name="bulan" id="bulan" >
				    	<option value="" selected disabled>Bulan</option>
				    	<?php

				    	$bln=1;
				    	while ($bln<=12) {
					    	
					    	if($bln==1){
					    		$blnn="Jan";
					    	}elseif($bln==2){
					    		$blnn="Feb";
					    	}elseif($bln==3){
					    		$blnn="Mar";
					    	}elseif($bln==4){
					    		$blnn="Apr";
					    	}elseif($bln==5){
					    		$blnn="Mei";
					    	}elseif($bln==6){
					    		$blnn="Jun";
					    	}elseif($bln==7){
					    		$blnn="Jul";
					    	}elseif($bln==8){
					    		$blnn="Agu";
					    	}elseif($bln==9){
					    		$blnn="Sep";
					    	}elseif($bln==10){
					    		$blnn="Okt";
					    	}elseif($bln==11){
					    		$blnn="Nov";
					    	}elseif($bln==12){
					    		$blnn="Des";
					    	}
				    		
				    		?>
				    	<option value="<?php echo $bln ?>"><?php echo $blnn ?></option>
				    	<?php
				    	$bln=$bln+1;
				    	}

				    	?>
				    </select>
				</div>
				<div class="col-sm-4">
				    <select class="form-control" name="tahun" id="tahun">
				    	<option value="" selected disabled>Tahun</option>
				    	<?php

				    	$thn=1960;
				    	while ($thn<=date(Y)-17) {
				    		?>
				    	<option value="<?php echo $thn ?>"><?php echo $thn ?></option>
				    	<?php
				    	$thn=$thn+1;
				    	}

				    	?>
				    </select>
				</div>
			</div>
			<p id="notif"></p>
			<input type="submit" name="signup" class="btn btn-danger btn-md" value="Sign-Up" style="margin-top:2%;">
		</form>
	</div>
</div>
</body>
</html>