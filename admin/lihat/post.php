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

   $nama = $row['nama'];
   $idpost = $row['id_post'];
   $alamat = $row['alamat'];
   $username = $row['username'];
   $provinsi = $row['provinsi'];
   $kota = $row['kota'];
   $caption = $row['caption'];
   $waktu_post = $row['tgl'];
  
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
  <div class="col-sm-2" style="float:left; padding:0; height:100%; z-index:-999">&nbsp;</div>
  <div class="col-sm-10" style="padding:0;">
    <div class="col-sm-12" style="background-color:#3a3a3a;">&nbsp;
      <h3 style="margin:0; padding-bottom:2%;"> Tampil Post</h3>
    </div>
    <div class="col-sm-10" style="margin-top:5%; margin-left:10%;color:black">
      <div class="col-sm-11">
          <div class="panel panel-primary">
            <div class="panel-heading" style="background-color:#3a3a3a;"> <?php echo $username?> <span style="float:right"> <?php echo $waktu_post?></span></div>
            <ul class="list-group">
            <li class="list-group-item"  style="padding:1%"> 
                <div class="panel-body"><img src="<?php echo $foto ?>" class="img-responsive" style="width:100%" alt="Image"> </div>
            </li>
            <li class="list-group-item" style="padding:1%" > 
                         <table class="table">
                          <tr>
                              <td> ID Post  </td> 
                              <td>: </td>  
                              <td><?php echo $idpost?></td>
                          </tr>
                          <tr>
                              <td> Alamat  </td> 
                              <td>: </td>  
                              <td><?php echo $alamat ?></td>
                          </tr>
                          <tr>
                              <td> Provinsi  </td> 
                              <td>: </td>  
                              <td><?php echo $provinsi?></td>
                          </tr>
                          <tr>
                              <td> Kota  </td> 
                              <td>: </td>  
                              <td><?php echo $kota?></td>
                          </tr> 
                          <tr>
                              <td> Caption </td> 
                              <td>: </td>  
                              <td><?php echo $caption ?></td>
                          </tr>
                         </table>    
                  
             </li>            
                  </div>
          </div>       
    </div>  
  </div>
  </div>
</body>
</html>