<?php
include 'core/koneksi.php';
$content_per_page=6;
if($_POST)
{
extract($_POST);
$start = ceil($group_no * $content_per_page);
$sql = mysqli_query("SELECT * FROM posts 
ORDER BY id_post DESC LIMIT $start, $content_per_page");
while($row=mysqli_fetch_array($sql)) {
	$foto = "core/upload/".$row['id_user']."/".$row['foto_nama'];
	$id_post=$row['id_post'];
 ?>
<?php   }
}
?>