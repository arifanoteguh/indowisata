<?php
include 'core/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>IndoWisata</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js\bootstrap.min.js"></script>

	<style type="text/css">
	body{
		background-color:#FEFFE8;
	}
	.col-xs-6{
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
              <form class="navbar-form navbar-left" role="search">
                <div class="form-group input-group">
                  <input type="text" class="form-control" placeholder="Search..">
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
              <li class="active"><a href="login.php">Sign-In <span class="glyphicon glyphicon-log-in"></span></a></li>
              <li><a href="signup.php">Sign-Up <span class="glyphicon glyphicon-plus"></span></a></li>
              <li><a href="search.php"><span class="glyphicon glyphicon-search"></span></a></li>
            <?php
            } ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
	<div class="col-xs-6 col-xs-offset-3" style="background-color:#f72727;"><h3 style="color:#ffffff">- Login -</h3></div>
	<div class="col-xs-6 col-xs-offset-3" style="background-color:#efefef; border-radius: 0px; padding-top: 2%; padding-bottom: 2%;">
		<form action="core/login.php" method="post">
			<div class="form-group has-feedback">
			    <input type="text" class="form-control" placeholder="Username" name="user" />
			    <i class="glyphicon glyphicon-user form-control-feedback"></i>
			</div>
			<div class="form-group has-feedback">
			    <input type="password" class="form-control" placeholder="Password" name="pass" />
			    <i class="glyphicon glyphicon-lock form-control-feedback"></i>
			</div>
			<input type="submit" name="login" class="btn btn-danger btn-md" value="Sign-In">
		</form>
			<a href="signup.php" style="font-size: 8pt;">Sign-Up</a>
	</div>
</div>
</body>
</html>