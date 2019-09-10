<?php
include 'core/koneksi.php';
include 'core/login.php';
session_start();
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
  .inline h4, .inline p{
    display:inline;
    vertical-align:top;
  }
  .inline p{
    border-bottom: 1px solid #c9302c;
  }
  .inline h4{
    color: #c9302c;
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

    .list-group-item.active,
    .list-group-item.active:hover,
    .list-group-item.active:focus {
      z-index: 2;
      color: #fff;
      background-color:  #f72727;
      border-color:  #f72727;}

    /* End of Navbar Color */
	</style>
  <script>
  $(document).ready(function (){
    $('#komen').keyup(function(){
      var len = $(this).val().length;
      if(len>0){
        $('#kirim').prop("disabled",false);
      }
      else{
        $('#kirim').prop("disabled",true);  
      }
    });
  });
  </script>
</head>
<body>
  
  <?php
  
  
  if(isset($_SESSION['login_user'])){
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
  }
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
              <li><a href="search.php"><span class="glyphicon glyphicon-search"></span></a></li>
            <?php
            } ?>
      </ul>
    </div>
  </div>
</nav>

<?php

  $id_post=$_GET['id'];
if(isset($_SESSION['login_user'])){
  $username=$_SESSION['login_user'];
  $query=mysqli_query($konek,"SELECT id_user FROM user where username='$username'");
  if($row=mysqli_fetch_array($query)){
    $user_id=$row['id_user'];
  }
}
  $query=mysqli_query($konek,"SELECT * FROM post JOIN user ON post.id_user=user.id_user JOIN provinsi ON post.id_prov=provinsi.id_prov JOIN kota ON post.id_kota=kota.id_kota where id_post='$id_post'");
    if(!$query){
      die("Gagal : ".mysql_error());
    }
    if($row=mysqli_fetch_array($query)){
      $id_user_post=$row['id_user'];
      $nama=$row['nama'];
      $user=$row['username'];
      $foto = "core/upload/".$row['id_user']."/".$row['foto_nama'];
      $alamat=$row['alamat'];
      $caption=$row['caption'];
      $provinsi=$row['provinsi'];
      $kota=$row['kota'];

      //tandain udah di baca
    if(isset($_SESSION['login_user'])){
      if($id_user_post==$user_id){
        $qnotif=mysqli_query($konek,"UPDATE komentar set baca='sudah' where id_post='$id_post'");
        if($qnotif){}
      }
    }
?>

<div class="container">
	
  <div >
	<div class="col-sm-2"> </div>
  
		<div class="col-sm-10" style="border:0px solid;padding:20px; margin-left:-30px;">
			<div class="row">
				<div class="col-sm-10">
					<div class="panel panel-primary">
						<div class="panel-heading" style="background-color:#e32929; border-color:#e32929"> <?php echo $nama;
                if(isset($_SESSION['login_user'])){
                  if($user==($_SESSION['login_user'])){
                    ?>
                      <form method="post" action="#" style="float:right">
                        <button type="submit" style="background:none; border:none;padding:0;" name="hapus">
                          <span class="glyphicon glyphicon-trash"></span> 
                        </button>
                      </form>
                      <form method="get" action="editpost.php?id=<?php echo $id_post ?>" style="float:right; margin-right:10px; margin-left:10px;">
                        <input type="hidden" value="<?php echo $id_post ?>" name="id">
                        <button type="submit" style="background:none; border:none;padding:0;" name="edit">
                          <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                      </form>
                    <?php
                  }
                }
              ?>
            </div>
						<div class="panel-body"><img src="<?php echo $foto ?>" class="img-responsive" style="width:100%" alt="Image"> 
                  <hr>
                  <table class="col-sm-12">
                    <th class="col-sm-12" style="border-bottom:1px solid #e32929; float:left;">Provinsi - Kota</th>
                      <tr class="col-sm-12">
                        <td style="float:right;"><?php echo $provinsi." - ".$kota ?></td>
                      </tr>
                    <th class="col-sm-12" style="border-bottom:1px solid #e32929; float:left;">Alamat</th>
                      <tr class="col-sm-12">
                        <td style="float:right;"><?php echo $alamat ?></td>
                      </tr>
                    <th class="col-sm-12" style="border-bottom:1px solid #e32929; float:left;">Caption</th>
                      <tr class="col-sm-12">
                        <td style="float:right;"><?php echo $caption ?></td>
                      </tr>
                  </table>
                  <br><br><br><br><br><br>
                    <hr>
                    <?php

                    if(isset($_SESSION['login_user'])){

                    ?>
                    <form action="#" method="post">
                      <input type="hidden" name="id_post" value="<?php echo $id_post ?>">
                      <input type="hidden" name="id_user_post" value="<?php echo $id_user_post ?>">
                      <!-- Cari ID yang berkomentar -->
                      <?php

                        $username=$_SESSION['login_user'];
                        $qkomen=mysqli_query($konek,"SELECT id_user FROM user where username='$username'");
                        if($row=mysqli_fetch_array($qkomen)){
                          $id_user=$row['id_user'];
                        }

                      ?>
                      <input type="hidden" name="id_user" value="<?php echo $id_user ?>">
                      <textarea class="form-control" name="komentar" style="width:100%;margin:10px 0px 10px 0px;" placeholder="Komentar" id="komen"></textarea>
                      <input type="submit" name="btnkomen" class="btn btn-danger" style="float:right" value="Kirim" id="kirim" disabled/> 
                    </form><br>
                    <?php
                  }
                    ?><hr>
                    <div style="overflow-y:auto; max-height:300px">
                      <table class="col-sm-12">
                    <?php

                    $qgetkomen=mysqli_query($konek,"SELECT * FROM komentar JOIN user ON komentar.id_user=user.id_user where id_post='$id_post' order by id_komentar desc");
                    if(!$qgetkomen){
                      die("Gagal : ".mysql_error());
                    }
                    $num=mysqli_num_rows($qgetkomen);
                    if($num!=0){
                      ?>
                        <th class="col-sm-12" style="border-bottom:1px solid #e32929; float:left; margin-bottom:15px;">Komentar</th>
                      <?php
                    }
                    while($row=mysqli_fetch_array($qgetkomen)){
                      $nama=$row['nama'];
                      $tgl=$row['tanggal'];
                      $komentar=$row['komentar'];
                      ?>

                        <th class="col-sm-12" style="border-bottom:1px solid #FC9D9D; float:left;"><?php echo $nama ?><span style="float:right;"><?php echo $tgl ?></span></th>
                        <tr class="col-sm-12" style="margin-bottom:25px; background-color:#f9f9f9;">
                          <td><?php echo $komentar ?></td>
                        </tr>
                      <?php
                    }
                    ?>
                      </table>
                    </div>
                  </div>
          </div>  
				</div>

			</div>
      
          
      
      </div>
		</div>
	</div>
<?php } ?>
</body>
</html>

<?php

  if(isset($_POST['hapus'])){
    $query=mysqli_query($konek,"DELETE from post where id_post='$id_post'");
    if($query){
      echo "<script> alert('Post sudah di hapus') </script>";
      echo "<script> window.open('profile.php','_self') </script>";
    }
  }

  if(isset($_POST['btnkomen'])){
    $id_post=$_POST['id_post'];
    $id_user_post=$_POST['id_user_post'];
    $id_user=$_POST['id_user'];
    $komentar=$_POST['komentar'];
    $komentar=stripslashes($komentar);
    $komentar=mysql_real_escape_string($komentar);
    $tgl=date("Y-m-d");

    $query=mysqli_query($konek,"INSERT into komentar (id_post, id_user_post, id_user, komentar, tanggal, baca) VALUES('$id_post', '$id_user_post', '$id_user', '$komentar', '$tgl', 'belum')");
    if($query){
      echo "<script> window.open('detailpost.php?id=".$_GET['id']."','_self') </script>";
    }
  }

?>