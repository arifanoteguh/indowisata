<?php 

include '../../../core/koneksi.php';
ob_start();

?>

<script src="composer.json" ></script>
<page backtop="5%" backbottom="5%" backleft="5%" backright="5%"> 
	<table style="width:100%">
		<tr>
			<th> ID  	 </th>
			<th> FOTO		 </th>
			<th> NAMA		 </th>
			<th> EMAIL		    </th>
			<th> TANGGAL LAHIR </th>
			<th> TANGGA PEMBUATAN </th>
		</tr>
		<?php
			$query = mysqli_query($konek,"SELECT * FROM user");
		while($row=mysqli_fetch_array($query)){
			$foto = "../../core/upload/".$row['id_user']."/".$row['nama_foto'];
		?>
		<tr>

		    <td><?php echo $row['id_user'];?></td>
		    <td><img src="<?php echo $foto?>"> </td>
		    <td><?php echo $row['nama'];?> 	</td>
		    <td><?php echo $row['email'];?> 	</td>
		    <td><?php echo $row['tgl_lahir'];?> 	</td>
			<td><?php echo $row['waktu_pembuatan'];?> 	</td>
		</tr>
		<?php 
		}
		?>
	</table>

</page>

<?php

$content = ob_get_clean();

require ('html2pdf.class.php');


$pdf = new HTML2PDF('P','A4','fr','true','UTF-8');
$pdf->writeHTML($content);
$pdf->pdf->IncludeJS('print(true)');
$pdf->Output('member.pdf');

?>