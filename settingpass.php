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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js\bootstrap.min.js"></script>
  <style type="text/css">
    body{
      background-color:#FEFFE8;
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
  $(document).ready(function() {
      $("#password1").keyup(validate1);
      $("#password2").keyup(validate2);
        
    });

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
<div class="container">

 <div class="row" style="margin-top:15px;">
    <div class="col-sm-4 col-md-4" >      
       <div class="list-group">
          <a href="setting.php" class="list-group-item"> Akun <i class="glyphicon glyphicon-chevron-right form-control-feedback"></i></a>
          <a href="settingpass.php" class="list-group-item active">Kata Sandi <i class="glyphicon glyphicon-chevron-right form-control-feedback"></i></a>
      </div>
        
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
  
   $tanggal=$row['tgl_lahir'];

   $array1=explode("-",$tanggal);
   $thn=$array1[0];
   $bln=$array1[1];
   $tgl=$array1[2];
   ?>
    <div class="col-sm-8">
      <div class="panel-group" style="background-color:white;">
      <div class="panel panel-default" style="border-color:red;">
       <div class="panel-heading"><h4> Kata Sandi <br> </h4> <h6> Ubah pengaturan kata sandi Anda. </h6></div>
        <div class="panel-body">

         <form method="post" enctype="multipart/form-data" name="gantipassword">
                    <div class="form-group">
                      <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="nama"> Kata sandi lama</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" name="passwordlama" required/>
                        </div><br><br>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="katasandiibaru"> Kata sandi baru</label>
                      <div class="col-sm-8">
                        <input id="password1" type="password" class="form-control" name="passwordbaru" required/>
                        <p id="check-length" style="color:red;"></p>
                      </div><br><br>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="verifikasikatasandi"> Verifikasi kata sandi </label>
                      <div class="col-sm-8">
                        <input id="password2"  type="password" class="form-control" name="passwordrevisi" required/>
                        <p id="validate-status-p" style="color:red;"></p>
                      </div><br><br>
                    </div>
                    <div class="form-group" style="margin:15px 65px 0px 0px; text-align:right;">
                      <input type="submit" class="btn btn-danger btn-md" name="gantipassword" value="Simpan"/>
                    </div>
                </form>
        </div>
        </div>
      </div>
    </div>

    <?php
      if (isset($_POST['gantipassword'])) {
                       $user = $_SESSION['login_user'];
                       $passwordlama = $_POST['passwordlama'];
                       $passwordbaru = $_POST['passwordbaru'];
                       $passwordrevisi = $_POST['passwordrevisi'];

                       $get_user = "select password from user where username='$user'";
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
                                echo "<script> alert('Kata sandi minimal 8 digit'); </script>";
                              }
                              else
                              {        
                                  $updatepass = "UPDATE user SET password='$passwordbaru' WHERE username='$user'";
                                  $run1 = mysqli_query($konek,$updatepass);
                                  echo "<script> alert('Kata Sandi sudah diperbarui') </script>";
                                  echo "<script> window.open('setting.php','_self') </script>";
                              }
                          }
                          else
                              echo "<script> alert('Verifikasi dan kata sandi baru tidak cocok'); </script>";
                          
                      }
                      else
                          echo "<script>alert('Kata sandi lama salah'); </script>";
                    }
          ?>      
 </div>

 
</body>
</html>

               
               
    

