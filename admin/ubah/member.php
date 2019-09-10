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
  $get = "select * from user where id_user='$id'";
   $run = mysqli_query($konek,$get);
   $row = mysqli_fetch_array($run);

   $user_id = $row['id_user'];
   $user_nama = $row['username'];
   $nama = $row['nama'];
   $email = $row['email']; 
   $tanggal=$row['tgl_lahir'];
   $kontak=$row['kontak'];

   $array1=explode("-",$tanggal);
   $thn=$array1[0];
   $bln=$array1[1];
   $tgl=$array1[2];
   $temptgl =$array1[2];

    $foto = "../../core/upload/".$row['id_user']."/".$row['nama_foto'];
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
<!--Side navbar-->
	<div class="col-sm-2" style="float:left; background-color: #3a3a3a; text-align:center; padding:0; height:100%; position:fixed; z-index:999;">  
		<div class="container-fluid">
			<h3>Admin Access</h3>
			<hr>
			<ul class="nav navbar-nav">
				<a class="menu" href="..\index.php"><li>Home <span class="glyphicon glyphicon-home" style="float:right;"></span></li></a>
				<a class="menu active" href="..\member.php"><li>Data Member <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="..\post.php"><li>Data Post <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
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
			<h3 style="margin:0; padding-bottom:2%;"> Ubah Member </h3>
		</div>
		<div class="col-sm-10" style="margin-top:5%; margin-left:8%;">
			<div class="col-sm-4">
		      <div class="panel panel-primary">
		      <div class="panel-heading" style="background-color:#3a3a3a;"> Foto </div>
		        <div class="panel-body"><img id="usr" src="<?php echo $foto;?>" class="img-responsive" alt="Image"></div> 
		      	</div>
      		</div>
      		<div class="col-sm-8" style="color:black;">
		      

		      <div class="panel-group" style="background-color:white;">
		      <div class="panel panel-default" style="border-color:#337ab7;">
		      <div class="panel-heading"><h4> Member <br> </h4> <h6> Ubah pengaturan Member. </h6></div>
		        <div class="panel-body">
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
							  	$('#notif').html("").html("<p style='color:red;margin-left:250px;'>Tanggal Tidak Benar</p>");
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
		        <form method="post" enctype="multipart/form-data">	        
		              <input type="hidden" class="form-control" name="id" value="<?php echo $row['id_user']?>"/>
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="iduser"> Id Member </label>
		              <div class="col-sm-9">
		               <input type="text" class="form-control" name="id" value="<?php echo $user_id?>"  disabled>
		              </div> <br><br>
		          </div>    
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="nama"> Nama </label>
		              <div class="col-sm-9">
		                <input type="text" class="form-control" name="nama" value="<?php echo $nama;?>"/>
		              </div> <br><br>
		          </div>
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;" for="username"> Username </label>
		              <div class="col-sm-9">
		                <input type="text" class="form-control" name="username" value="<?php echo $user_nama;?>" id="user"/>
		              </div> <br><br>
		          </div>
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;"> Email </label>
		              <div class="col-sm-9">
		              <input type="email" class="form-control" name="email" value="<?php echo $email;?>"/>
		              </div><br><br>
		          </div>
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" style="margin-top:5px;"> Kontak </label>
		              <div class="col-sm-9">
		              <input type="text" class="form-control" name="kontak" value="<?php echo $kontak;?>"/>
		              </div><br><br>
		          </div>
		          <div class="form-group">
		              <label class="control-label col-sm-3 text-right" > Tanggal lahir (DD/MM/YYYY) </label>
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
					    	<option value="<?php echo $bln ?>"><?php echo $blnn ?></option>
					    	<?php
					    	$bln=$bln+1;
					    	

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
						
					<p id="notif"></p> <br><br>
		           </div>
		           <div class="form-group" style="margin:15px 15px 0px 0px; text-align:right;">
		              <input type="submit" name="update" class="btn btn-danger btn-md" value="Simpan"/>
		           </div>
		        </form>
		        </div>
		        </div>
		      </div>
    		</div>
		</div>	
	</div>

	<?php

          if(isset($_POST['update'])){
          	$id = $_POST['id'];
            $name = $_POST['nama'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $kontak = $_POST['kontak'];
            $tgl = $_POST['tanggal'];
            $bln = $_POST['bulan'];
            $thn = $_POST['tahun'];
            
            $tgl_lahir=$thn."-".$bln."-".$tgl;

            $update = "update user set username='$username', nama='$name', email='$email', tgl_lahir='$tgl_lahir',kontak='$kontak' where id_user='$id'";

            $run = mysqli_query($konek,$update);

            if($run){
               echo "<script> alert('Profile sudah diperbarui') </script>";
               echo "<script> window.open('../member.php','_self') </script>";
            }
        }
          ?>      
</body>
</html>