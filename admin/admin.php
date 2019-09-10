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
		background-color: #fff;
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
  	.results tr[visible='false'],
	.no-result{
	  display:none;
	}

	.results tr[visible='true']{
	  display:table-row;
	}

	.counter{
	  padding:8px; 
	  color:#ccc;
	}
	</style>
	<script type="text/javascript">
		$(document).ready(function() {
		  $(".search").keyup(function () {
		    var searchTerm = $(".search").val();
		    var listItem = $('.results tbody').children('tr');
		    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
		    
		  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
		        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
		    }
		  });
		    
		  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
		    $(this).attr('visible','false');
		  });

		  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
		    $(this).attr('visible','true');
		  });

		  var jobCount = $('.results tbody tr[visible="true"]').length;
		    $('.counter').text(jobCount + ' item');

		  if(jobCount == '0') {$('.no-result').show();}
		    else {$('.no-result').hide();}
				  });
		});
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
				<a class="menu"  href="member.php"><li>Data Member <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="post.php"><li>Data Post <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="prov.php"><li>Data Provinsi <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu" href="kota.php"><li>Data Kota <span class="glyphicon glyphicon-pencil" style="float:right;"></span></li></a>
				<a class="menu active" href="#"><li>Data Admin <span class="glyphicon glyphicon-user" style="float:right;"></span></li></a>
				<a class="menu" href="tambah.php"><li>Tambah Admin <span class="glyphicon glyphicon-plus" style="float:right;"></span></li></a>
				<hr>
				<a class="menu" href="../core/logout.php" style="text-align:center;"><li>Sign-Out <span class="glyphicon glyphicon-log-out"></span></li></a>
			</ul>
		</div>
	</div>
<!--end-->
	<div class="col-sm-2" style="float:left; padding:0; height:100%; z-index:-999">&nbsp;</div>

	<div class="col-sm-10" style="padding:0">
		<div class="col-sm-12" style="background-color:#3a3a3a;">&nbsp;
			<h3 style="margin:0; padding-bottom:2%;">Data Admin</h3>
		</div>
		<div class="col-sm-11" style="margin-top:5%; margin-left:5%;">
			<div class="col-sm-12" style="color:#3a3a3a">
				<h4>Admin Saat Ini</h4>
				<div class="form-group pull-right">
				    <input type="text" class="search form-control" placeholder="Cari..">
				</div>
				<span class="counter pull-right"></span>
				<table class="table table-hover table-bordered results">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th class="col-md-5 col-xs-5">Nama</th>
				      <th class="col-md-5 col-xs-5">Username</th>
				      <th colspan="3" class="col-md-2 col-xs-2">Option</th>
				    </tr>
				    <tr class="warning no-result">
				      <td colspan="4"><i class="fa fa-warning"></i> No result</td>
				    </tr>
				  </thead>
				    <tbody>
					<?php

						$query=mysqli_query($konek,"SELECT * FROM admin order by id_admin asc");
						if(!$query){
							die("Gagal Membaca : ".mysqli_error());
						}
						while($row=mysqli_fetch_array($query)){


					?>
					    <tr>
					      <th scope="row"><?php echo $row['id_admin'] ?></th>
					      <td><?php echo $row['nama'] ?></td>
					      <td><?php echo $row['username'] ?></td>
					      <td>
							<form action="../admin/ubah/admin.php" method="get">
							      	<input type="hidden" name="id" value="<?php echo $row['id_admin']?>">
									<center> 
										<button type="submit" style="background:none; border:none;padding:0;">
											<span class="glyphicon glyphicon-pencil"></span>&nbsp;  
										</button>
									</center>
								</form>
							</td>
							<td>
								<center> 
									<button type="button" style="background:none; border:none;padding:0;" onclick="hapus(<?php echo $row['id_admin']?>)"> 
										<span class="glyphicon glyphicon-trash"></span>&nbsp; 
									</button>
								</center>
								<script language="javascript">
									function hapus(hapusid){
										if(confirm("Apakah kamu mau hapus ?")){
											window.location.href='../admin/hapus/admin.php?hapus_id=' +hapusid+ '';
											return true;
										}
									}
								</script>
							</td>
					</tr>
					<?php } ?>
				  </tbody>
				</table>
			</div>
		</div>	
	</div>
</body>
</html>
