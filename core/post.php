<?php
include 'koneksi.php';
include 'login.php';
session_start();

if(isset($_POST['kirim'])){

	$prov = $_POST['provinsi'];
	$kota = $_POST['kota'];
	$alamat = $_POST['alamat'];
	$capt = $_POST['capt'];
	$alamat = stripslashes($alamat);
	$capt = stripslashes($capt);
	$alamat = mysql_real_escape_string($alamat);
	$capt = mysql_real_escape_string($capt);
	
	//Ambil User ID
    $user = $_SESSION['login_user'];
    $get_user = "select * from user where username='$user'";
    $run = mysqli_query($konek,$get_user);
    $row = mysqli_fetch_array($run);
    $user_id = $row['id_user'];

	//Upload Foto/Gambar
	$rand_digit=rand(00000,99999);
	$target_dir = "upload/".$user_id."/";
	if(!file_exists($target_dir)){
		mkdir($target_dir,0777,true);
	}
	$nama_file = $rand_digit.$_FILES['upfoto']['name'];
	$target_file = $target_dir.basename($nama_file);
	$ukuran_file = $_FILES['upfoto']['size'];
	$tipe_file = $_FILES['upfoto']['type'];	
	$tmp_file = $_FILES['upfoto']['tmp_name'];
	$tgl = date('Y-m-d');
	
	if(empty($prov) || empty($kota) || empty($alamat) || empty($nama_file)){
		?><script>
			window.alert("Semua Data Harus Diisi");
			window.history.back();
		</script><?php
	}else{
			if($tipe_file == "image/jpeg" || $tipe_file == "image/png" || $tipe_file == "image/jpg"){ 
				if($ukuran_file<=20000000){
					if(move_uploaded_file($tmp_file,$target_file)){
						$query = mysqli_query($konek,"INSERT INTO post (id_user, id_prov, id_kota, foto_nama, foto_size, foto_tipe, caption, alamat, tgl) VALUES('$user_id', '$prov', '$kota', '$nama_file', '$ukuran_file', '$tipe_file', '$capt', '$alamat', '$tgl')");
						if($query){
						?><script>
							window.alert("Postingan anda berhasil di upload");
							window.location.href='../index.php';
						</script><?php	
						}
					}
				}else{
						?><script>
							window.alert("Ukuran Foto Tidak Boleh Lebih Dari 20MB");
							window.history.back();
						</script><?php	
				}
			}else{
				?><script>
					window.alert("Hanya Bisa Mengupload File Foto");
					window.history.back();
				</script><?php	
			}
		echo mysqli_error($konek);
	}
	mysqli_close($konek);
}
?>