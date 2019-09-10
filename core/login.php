<?php
include 'koneksi.php';

if(isset($_POST['login'])){
	if($_POST['user']=='' || $_POST['pass']==''){
		?><script>
			window.alert("Username atau Password Tidak Boleh Kosong");
			window.location.href='../login.php';
		</script><?php
	}else{
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$user = stripslashes($user);
		$pass = stripslashes($pass);
		$user = mysql_real_escape_string($user);
		$pass = mysql_real_escape_string($pass);

		$query = mysqli_query($konek,"SELECT * FROM user WHERE username='$user' AND password='$pass'");
		echo mysqli_error($konek);
		$rows =mysqli_num_rows($query);
		if($rows==1){
			session_start();
			$_SESSION['login_user']=$user;		
			?><script>
				window.location.href='../index.php';
			</script><?php
		}else{
			?><script>
				window.alert("Username atau Password Salah");
				window.location.href='../login.php';
			</script><?php
		}
		mysqli_close($konek);
	}
}
elseif(isset($_POST['loginadmin'])){
	if($_POST['user']=='' || $_POST['pass']==''){
		?><script>
			window.alert("Username atau Password Tidak Boleh Kosong");
			window.location.href='../admin/login.php';
		</script><?php
	}else{
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$user = stripslashes($user);
		$pass = stripslashes($pass);
		$user = mysql_real_escape_string($user);
		$pass = mysql_real_escape_string($pass);

		$query = mysqli_query($konek,"SELECT * FROM admin WHERE username='$user' AND password='$pass'");
		echo mysqli_error($konek);
		$rows =mysqli_num_rows($query);
		if($rows==1){
			session_start();
			$_SESSION['login_admin']=$user;		
			?><script>
				window.location.href='../admin/index.php';
			</script><?php
		}else{
			?><script>
				window.alert("Username atau Password Salah");
				window.location.href='../admin/login.php';
			</script><?php
		}
		mysqli_close($konek);
	}
}
?>