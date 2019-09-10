<?php
include 'koneksi.php';

if(isset($_POST['signup'])){

	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$email = $_POST['email'];
	$nama = ucwords($_POST['nama']);
	$tgl = $_POST['tanggal'];
	$bln = $_POST['bulan'];
	$thn = $_POST['tahun'];
	$user = stripslashes($user);
	$pass = stripslashes($pass);
	$user = mysql_real_escape_string($user);
	$pass = mysql_real_escape_string($pass);

	$tgl_lahir=$thn."-".$bln."-".$tgl;

	$cekuser=mysqli_num_rows(mysqli_query($konek,"select * from user where username='$user'"));
	$cekemail=mysqli_num_rows(mysqli_query($konek,"select * from user where email='$email'"));

	if(empty($user) || empty($pass) || empty($email) || empty($nama) || empty($tgl) || empty($thn) || empty($bln) || empty($tgl_lahir)){
		?><script>
			window.alert("Semua Data Harus Diisi");
			window.history.back();
		</script><?php
	}elseif($cekuser>0){
		?><script>
			window.alert("Username telah digunakan, silahkan menggunakan username lain");
			window.history.back();
		</script><?php
	}elseif($cekemail>0){
		?><script>
			window.alert("Email telah digunakan, silahkan menggunakan username lain");
			window.history.back();
		</script><?php
	}else{
		$date=date("Y-m-d");
		$query = mysqli_query($konek,"INSERT INTO user  (username, password, email, nama, tgl_lahir, waktu_pembuatan) VALUES('$user', '$pass', '$email', '$nama', '$tgl_lahir', '$date')");
		if($query){
		?><script>
			window.alert("Sign-Up Success, silahkan melakukan Sign-In");
			window.location.href='../login.php';
		</script><?php			
		}
		echo mysqli_error($konek);
	}
	mysqli_close($konek);
}elseif(isset($_POST['signupadmin'])){

	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$nama = $_POST['nama'];
	$kontak = $_POST['kontak'];
	$user = stripslashes($user);
	$pass = stripslashes($pass);
	$user = mysql_real_escape_string($user);
	$pass = mysql_real_escape_string($pass);

	$query=mysqli_query($konek,"select * from admin where username='$user'");
	$hitung=mysqli_num_rows($query);

	if(empty($user) || empty($pass) || strlen($user)<8 || strlen($pass)<8){
		?><script>
			window.alert("Semua Data Harus Diisi");
			window.history.back();
		</script><?php
	}elseif($hitung>0){
		?><script>
			window.alert("Username telah digunakan, silahkan menggunakan username lain");
			window.history.back();
		</script><?php
	}else{
		$query = mysqli_query($konek,"INSERT INTO admin (username, password, nama, waktu_pembuatan, kontak) VALUES('$user', '$pass', '$nama', now(), $kontak)");
		if($query){
		?><script>
			window.alert("Penambahan Admin Success");
			window.location.href='../admin/index.php';
		</script><?php			
		}
		echo mysqli_error($konek);
	}
	mysqli_close($konek);
}
?>