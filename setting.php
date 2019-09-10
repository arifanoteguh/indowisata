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
    .col-sm-8{
      border: 0px solid;
      border-color: #e32929;
    }

    .col-sm-3{
      margin-right: 10px;
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
  .panel-group{
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
			  <li class="active"><a href="#"><span class="glyphicon glyphicon-cog" style="font-size:12pt;" alt="setting"></span></a></li>
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
 <div class="row" style="margin-top:15px;">
    <div class="col-sm-4 col-md-4" >
       <div class="list-group">
          <a href="setting.php" class="list-group-item active"> Akun <i class="glyphicon glyphicon-chevron-right form-control-feedback"></i></a>
          <a href="settingpass.php" class="list-group-item">Kata Sandi <i class="glyphicon glyphicon-chevron-right form-control-feedback"></i></a>
      </div>
   <?php

   $user = $_SESSION['login_user'];
   $get_user = "select * from user where username='$user'";
   $run = mysqli_query($konek,$get_user);
   $row = mysqli_fetch_array($run);

   $user_id = $row['id_user'];
   $user_nama = $row['username'];
   $nama = $row['nama'];
   $email = $row['email']; 
   $kontak = $row['kontak']; 
   if($row['nama_foto']==""){
    $foto="img/pict_default.png";
   }
   else{
    $foto = "core/upload/".$row['id_user']."/".$row['nama_foto'];
   }

   $tanggal=$row['tgl_lahir'];

   $array1=explode("-",$tanggal);
   $thn=$array1[0];
   $bln=$array1[1];
   $tgl=$array1[2];
   ?>
        <form action="#" method="post" enctype="multipart/form-data">
      <div class="panel panel-primary">
        <div class="panel-body"><img id="prv" src="<?php echo $foto ?>" class="img-responsive" style="width:100%;" alt="Image"></div>
      </div>
          <span class="btn btn-default btn-file" style="margin-top:-5%; margin-bottom:5%;">
            Pilih Foto <input type="file" name="upfoto" onchange="readURL(this);">
          </span>        
    </div>
    <div class="col-sm-8">
      <div class="panel-group" style="background-color:white;">
      <div class="panel panel-default" style="border-color:red;">
       <div class="panel-heading"><h4> Akun <br> </h4> <h6> Ubah pengaturan dasar akun Anda. </h6></div>
        <div class="panel-body">

          <div class="form-group">
              <label class="control-label col-sm-2 text-right" style="margin-top:5px;" for="nama"> Nama </label>
              <div class="col-sm-10">
                <input type="nama" class="form-control" name="nama" value="<?php echo $nama;?>"/>
              </div> <center> <p id="user"> </p> </center><br><br>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-2 text-right" style="margin-top:5px;"> Email </label>
              <div class="col-sm-10">
              <input type="email" class="form-control" name="email" value="<?php echo $email;?>"/>
              </div>
          </div><br><br><br>
          <div class="form-group">
              <label class="control-label col-sm-2 text-right" style="margin-top:5px;"> Kontak </label>
              <div class="col-sm-10">
              <input type="text" class="form-control" name="kontak" value="<?php echo $kontak;?>"/>
              </div><br><br>
          </div>
      <div class="form-group has-feedback">
        <label class="control-label col-sm-2 text-right" > Tanggal lahir (DD/MM/YYYY) </label>
        <div class="col-sm-3">
            <select class="form-control" name="tanggal" id="tanggal">
              <?php

              $tgll=1;
              while ($tgll<=31) {
                if($tgll!=$tgl){
                  if($tgll<=9){
                    $tgll="0".$tgll;
                  }
                  ?>
                  <option value="<?php echo $tgll ?>"><?php echo $tgll ?></option>
                  <?php
                }
                elseif($tgll==$tgl){
                  ?>
                  <option value="<?php echo $tgl ?>" selected><?php echo $tgl ?></option>
                  <?php
                }
              $tgll=$tgll+1;
              }

              ?>
            </select>
        </div>
        <div class="col-sm-3">
            <select class="form-control" name="bulan" id="bulan" >
              <?php

              $blnn=1;
              while ($blnn<=12) {
                
                if($blnn==1){
                  $blnnn="Jan";
                }elseif($blnn==2){
                  $blnnn="Feb";
                }elseif($blnn==3){
                  $blnnn="Mar";
                }elseif($blnn==4){
                  $blnnn="Apr";
                }elseif($blnn==5){
                  $blnnn="Mei";
                }elseif($blnn==6){
                  $blnnn="Jun";
                }elseif($blnn==7){
                  $blnnn="Jul";
                }elseif($blnn==8){
                  $blnnn="Agu";
                }elseif($blnn==9){
                  $blnnn="Sep";
                }elseif($blnn==10){
                  $blnnn="Okt";
                }elseif($blnn==11){
                  $blnnn="Nov";
                }elseif($blnn==12){
                  $blnnn="Des";
                }
                
                if($blnn!=$bln){
                  ?>
                  <option value="<?php echo $blnn ?>"><?php echo $blnnn?></option>
                  <?php
                }
                elseif($blnn==$bln){
                  ?>
                  <option value="<?php echo $bln?>" selected><?php echo $blnnn ?></option>    
                  <?php
                }
              $blnn=$blnn+1;
              }

              ?>
            </select>
        </div>
        <div class="col-sm-3">
            <select class="form-control" name="tahun" id="tahun">
              <?php

              $thnn=1960;
              while ($thnn<=date(Y)-17) {

                if($thnn!=$thn){
                  ?>
                  <option value="<?php echo $thnn ?>"><?php echo $thnn ?></option>
                  <?php
                }
                elseif($thnn==$thn){
                  ?>
                  <option value="<?php echo $thn ?>" selected><?php echo $thn ?></option>
                  <?php    
                }
              $thnn=$thnn+1;
              }

              ?>
            </select>
        </div>
      </div>
      <center><p id="notif"></p></center><br><br>
           <div class="form-group" style="margin:15px 15px 0px 0px; text-align:right;">
              <input type="submit" name="update" class="btn btn-danger btn-md" value="Simpan"/>
           </div>
        </form>
        </div>
        </div>
      </div>
    </div>

    <?php
        $user = $_SESSION['login_user'];
          if(isset($_POST['update'])){
            
            $name = $_POST['nama'];
            $email = $_POST['email'];
            $tgl = $_POST['tanggal'];
            $bln = $_POST['bulan'];
            $thn = $_POST['tahun'];
            $kontak = $_POST['kontak'];

            $rand_digit=rand(00000,99999);
            $target_dir = "core/upload/".$user_id."/";
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
                    $update = "update user set nama='$name', email='$email', tgl_lahir='$tgl_lahir', nama_foto='$nama_file', size_foto='$ukuran_file', tipe_foto='$tipe_file', kontak='$kontak' where username='$user'";

                    $run = mysqli_query($konek,$update);
                    if($run){
                       echo "<script> alert('Profile sudah diperbarui') </script>";
                       echo "<script> window.open('setting.php','_self') </script>";
                    }
                   }
                  }else{
                       echo "<script> alert('Ukuran Foto Tidak Boleh Lebih Dari 20MB') </script>";
                  }
                }
              }else{
                $update = "update user set nama='$name', email='$email', tgl_lahir='$tgl_lahir', kontak='$kontak' where username='$user'";

                $run = mysqli_query($konek,$update);

                if($run){
                  echo "<script> alert('Profile sudah diperbarui') </script>";
                  echo "<script> window.open('setting.php','_self') </script>";
                }
              }
            }
          ?>      
 </div>

 
</body>
</html>