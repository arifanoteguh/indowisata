<?php
include 'core/koneksi.php';
if($_POST['id'])
{
 $id=$_POST['id'];
 $stmt = mysqli_query($konek,"SELECT * FROM kota WHERE id_prov='$id'");
 ?><option selected="selected" disabled>Pilih Kota</option><?php
 while($row=mysqli_fetch_array($stmt)){
  ?>
        <option value="<?php echo $row['id_kota']; ?>"><?php echo $row['kota']; ?></option>
        <?php
 }
}
?>