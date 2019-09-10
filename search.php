<?php
include 'core/koneksi.php';
include 'core/login.php';
session_start();
error_reporting(0);
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
			  <li><a href="post.php">Post Here</a></li>
			  <li><a href="setting.php"><span class="glyphicon glyphicon-cog" style="font-size:12pt;" alt="setting"></span></a></li>
              <li><a href="core/logout.php">Sign-Out <span class="glyphicon glyphicon-log-out"></span></a></li>
            <?php
          }else{ //BELUM LOGIN
            ?>
              <li><a href="login.php">Sign-In <span class="glyphicon glyphicon-log-in"></span></a></li>
              <li><a href="signup.php">Sign-Up <span class="glyphicon glyphicon-plus"></span></a></li>
              <li class="active"><a href="search.php"><span class="glyphicon glyphicon-search"></span></a></li>
            <?php
            } ?>
      </ul>
    </div>
  </div>
</nav>

    <?php
    if(!isset($_SESSION['login_user'])){ //BELUM LOGIN ?>
	<form method="get" action="search.php" style="margin-top:-3%;">
	    <div class="form-group input-group">
			  <input type="text" class="form-control" placeholder="Search.." name="cari">
        <span class="input-group-btn">
				  <button class="btn btn-default" type="submit">
					   <span class="glyphicon glyphicon-search"></span>
				  </button>
        </span>        
      </div>
    </form>
	<?php } 


    $cari = $_GET['cari'];

    $query = mysqli_query($konek,"SELECT * FROM post JOIN user ON post.id_user=user.id_user JOIN provinsi ON post.id_prov=provinsi.id_prov JOIN kota ON post.id_kota=kota.id_kota where username like '%$cari%' OR nama like '%$cari%' OR caption like '%$cari%' OR provinsi like '%$cari%' OR kota like '%$cari%' order by id_post desc");

    if(!$query){
      die("Gagal : ".mysql_error());
    }

    function potong_caption($x,$length){
      if(strlen($x)<=$length){
        echo $x;
      }
      else{
        $y=substr($x,0,$length)."...";
        echo $y; 
     }
    }
    
    while($row=mysqli_fetch_array($query)){
    $foto = "core/upload/".$row['id_user']."/".$row['foto_nama'];
    $id_post=$row['id_post'];

  ?>
    <form method="get" action="detailpost.php?id=<?php echo $id_post ?>" name="<?php echo $id_post ?>">
    <a href="javascript:;" onclick="parentNode.submit();">
    <input type="hidden" name="id" value="<?php echo $id_post ?>">
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading" style="background-color:#e32929; border-color:#e32929"><?php echo ucfirst($row['nama']) ?><span style="float:right">di <?php echo ($row['provinsi']); ?></span></div>
          <div class="panel-body"><center><img src="<?php echo $foto ?>" class="img-responsive" style="height:220px;" alt="Image"></center></div>
          <div class="panel-footer"><?php potong_caption($row['caption'],47) ?>&nbsp;</div>
        </div>
      </div>
      </a>
    </form>
  <?php } ?>
</body>
</html>