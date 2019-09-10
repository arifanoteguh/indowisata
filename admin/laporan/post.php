<?php


// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');
include "../../core/koneksi.php";

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = '../../img/logojpg.jpg';
        $this->Image($image_file, 15, 7, 16, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 15);
        // Title
        $this->Ln(5);
        $this->Cell(25);
        $this->Cell(5, 20, 'Sosial Media IndoWisata', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'I', 13, '', 'false');
        $this->Ln(8);
        $this->Cell(25);
        $this->Cell(5, 20, 'Address Website : Indowisata.com', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->SetLineWidth(1);
        $this->Line(13,24,197,24);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

/// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Laporan Post');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// set font
$pdf->SetFont('Times', '', 9);

// add a page

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

$pdf->AddPage();

// create some HTML content
if(isset($_GET['cetakpost'])){ 

    $listpost = $_GET['daftarpost'];
    $cekpost1 = $_GET['cekpost'];
    $query = mysqli_query($konek,"SELECT * FROM post JOIN user ON post.id_user=user.id_user JOIN kota ON post.id_kota=kota.id_kota JOIN provinsi ON post.id_prov=provinsi.id_prov where $listpost LIKE '%$cekpost1%' order by id_post");
    $query1 = mysqli_query($konek,"SELECT * FROM post JOIN user ON post.id_user=user.id_user JOIN kota ON post.id_kota=kota.id_kota JOIN provinsi ON post.id_prov=provinsi.id_prov where $listpost='$cekpost1' order by id_post");
    $pdf->Ln(1);
    $html = '<span style="font-size:13px;text-align:center"><u> Laporan Post </u></span>';
    $pdf->writeHTML($html, true, false, true, false, '');

    if(empty($cekpost1)){
        if(($listpost == 'username') || ($listpost == 'kota') || ($listpost == 'caption') || ($listpost == 'tgl')){
          ?><script>
               window.alert("Data Harus Diisi");
               window.history.back();          
          </script><?php
        }
    }

    if ($listpost == 'username') {
       $hitungpost=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM post JOIN user ON post.id_user=user.id_user JOIN kota ON post.id_kota=kota.id_kota JOIN provinsi ON post.id_prov=provinsi.id_prov where $listpost='$cekpost1'"));
       
       $html ='<span>Username     : <b>'.$cekpost1.' </b> <br></span>
                <span>Banyak Data  : <b>'.$hitungpost.' </b> <br><br></span>
                     <table  border="1" cellpadding="3">
                  
                        <tr>
                        
                            <th width="30" style="text-align:center"> ID </th>
                            <th width="120" style="text-align:center"> FOTO</th>
                            <th width="120" style="text-align:center"> KOTA</th>
                            <th width="100" style="text-align:center"> ALAMAT</th>
                            <th width="170" style="text-align:center"> CAPTION</th>
                            <th width="100" style="text-align:center"> PEMBUATAN</th>
                      
                        </tr>
                        </thread> </table>
                ';
                $pdf->writeHTML($html, false, false, true, false, '');
        foreach ($query1 as $data ) {
        
                $foto = "../../core/upload/".$data['id_user']."/".$data['foto_nama'];
                $id_post = $data['id_post'];
                $kota = $data['kota'];
                $alamat = $data['alamat'];
                $caption = $data['caption'];
                $waktu_pembuatan = $data['tgl'];
        
            $html ='<table  border="1" cellpadding="3">
                        <tr>
                            <td width="30px" style="text-align:center">'.$id_post.'</td>
                            <td width="120"> <img src="'.$foto.'" width="300px" height="250px"></td>
                            <td width="120"><p style="margin-right:5px">'.$kota.' </p></td>
                            <td width="100">'.$alamat.'</td>
                            <td width="170">'.$caption.'</td>
                            <td  width="100">'.$waktu_pembuatan.'</td>
                        </tr>
                         </table>
                    ';
                    $pdf->writeHTML($html, false, false, true, false, '');
        }   
    }
    else if ($listpost == 'kota') {
        $hitungpost=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM post JOIN user ON post.id_user=user.id_user JOIN kota ON post.id_kota=kota.id_kota JOIN provinsi ON post.id_prov=provinsi.id_prov where $listpost LIKE '%$cekpost1%'"));
       
        $html ='<span>Kota     : <b>'.$cekpost1.' </b> <br></span>
                <span>Banyak Data  : <b>'.$hitungpost.' </b> <br><br></span>
                     <table  border="1" cellpadding="3">
                        <tr>
                            <th width="30" style="text-align:center"> ID </th>
                            <th width="120" style="text-align:center"> FOTO</th>
                            <th width="120" style="text-align:center"> USERNAME</th>
                            <th width="100" style="text-align:center"> ALAMAT</th>
                            <th width="170" style="text-align:center"> CAPTION</th>
                            <th width="100" style="text-align:center"> PEMBUATAN</th>
                      
                        </tr>
                        </thread> </table>
                ';
                $pdf->writeHTML($html, false, false, true, false, '');
        foreach ($query as $data ) {
        
                $foto = "../../core/upload/".$data['id_user']."/".$data['foto_nama'];
                $id_post = $data['id_post'];
                $username = $data['username'];
                $alamat = $data['alamat'];
                $caption = $data['caption'];
                $waktu_pembuatan = $data['tgl'];
        
            $html ='<table  border="1" cellpadding="3">
                        <tr>
                            <td width="30px" style="text-align:center">'.$id_post.'</td>
                            <td width="120"> <img src="'.$foto.'" width="300px" height="250px"></td>
                            <td width="120"><p style="margin-right:5px">'.$username.' </p></td>
                            <td width="100">'.$alamat.'</td>
                            <td width="170">'.$caption.'</td>
                            <td  width="100">'.$waktu_pembuatan.'</td>
                        </tr>
                         </table>
                    ';
                    $pdf->writeHTML($html, false, false, true, false, '');
        }
    } 
    else if ($listpost == 'caption') {
        $hitungpost=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM post JOIN user ON post.id_user=user.id_user JOIN kota ON post.id_kota=kota.id_kota JOIN provinsi ON post.id_prov=provinsi.id_prov where $listpost LIKE '%$cekpost1%'"));
       
        $html ='<span>Caption     : <b>'.$cekpost1.' </b> <br></span>
                <span>Banyak Data  : <b>'.$hitungpost.' </b> <br><br></span>
                     <table  border="1" cellpadding="3">
                        <tr>
                            <th width="30" style="text-align:center"> ID </th>
                            <th width="120" style="text-align:center"> FOTO</th>
                            <th width="80" style="text-align:center"> USERNAME</th>
                            <th width="80" style="text-align:center"> KOTA</th>
                            <th width="80" style="text-align:center"> ALAMAT</th>
                            <th width="160" style="text-align:center"> CAPTION</th>
                            <th width="100" style="text-align:center"> PEMBUATAN</th>
                        </tr>
                        </thread> </table>
                ';
                $pdf->writeHTML($html, false, false, true, false, '');
        foreach ($query as $data ) {
        
                $foto = "../../core/upload/".$data['id_user']."/".$data['foto_nama'];
                $id_post = $data['id_post'];
                $username = $data['username'];
                $kota = $data['kota'];
                $alamat = $data['alamat'];
                $caption = $data['caption'];
                $waktu_pembuatan = $data['tgl'];
        
            $html ='
                     <table  border="1" cellpadding="3">
                        <tr>
                            <td width="30px" style="text-align:center">'.$id_post.'</td>
                            <td width="120"> <img src="'.$foto.'" width="300px" height="250px"></td>
                            <td width="80"><p style="margin-right:5px">'.$username.' </p></td>
                            <td width="80"><p style="margin-right:5px">'.$kota.' </p></td>
                            <td width="80">'.$alamat.'</td>
                            <td width="160">'.$caption.'</td>
                            <td  width="100">'.$waktu_pembuatan.'</td>
                        </tr>
                         </table>
                    ';
                    $pdf->writeHTML($html, false, false, true, false, '');
        }
    }
    else if ($listpost == 'tgl') {
        $hitungpost=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM post JOIN user ON post.id_user=user.id_user JOIN kota ON post.id_kota=kota.id_kota JOIN provinsi ON post.id_prov=provinsi.id_prov where $listpost LIKE '%$cekpost1%'"));
       
        $html ='<span>Pembuatan     : <b>'.$cekpost1.' </b> <br></span>
                <span>Banyak Data  : <b>'.$hitungpost.' </b> <br><br></span>
                     <table  border="1" cellpadding="3">
                        <tr>
                            <th width="30" style="text-align:center"> ID </th>
                            <th width="120" style="text-align:center"> FOTO</th>
                            <th width="80" style="text-align:center"> USERNAME</th>
                            <th width="80" style="text-align:center"> KOTA</th>
                            <th width="80" style="text-align:center"> ALAMAT</th>
                            <th width="160" style="text-align:center"> CAPTION</th>
                            <th width="100" style="text-align:center"> PEMBUATAN</th>
                        </tr>
                      </table>
                ';
                $pdf->writeHTML($html, false, false, true, false, '');
        foreach ($query as $data ) {
        
                $foto = "../../core/upload/".$data['id_user']."/".$data['foto_nama'];
                $id_post = $data['id_post'];
                $username = $data['username'];
                $kota = $data['kota'];
                $alamat = $data['alamat'];
                $caption = $data['caption'];
                $waktu_pembuatan = $data['tgl'];
                
            $html =' <table  border="1" cellpadding="3">
                        <tr>
                             <td width="30px" style="text-align:center">'.$id_post.'</td>
                            <td width="120"> <img src="'.$foto.'" width="300px" height="250px"></td>
                            <td width="80"><p style="margin-right:5px">'.$username.' </p></td>
                            <td width="80"><p style="margin-right:5px">'.$kota.' </p></td>
                            <td width="80">'.$alamat.'</td>
                            <td width="160">'.$caption.'</td>
                            <td  width="100">'.$waktu_pembuatan.'</td>    
                        </tr>
                         </table>
                    ';
                    $pdf->writeHTML($html, false, false, true, false, '');
        }
    }
    else if ($listpost == 'semua') {
        $query = mysqli_query($konek,"SELECT * FROM post JOIN user ON post.id_user=user.id_user JOIN kota ON post.id_kota=kota.id_kota JOIN provinsi ON post.id_prov=provinsi.id_prov  order by id_post");
        $hitungpost=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM post JOIN user ON post.id_user=user.id_user JOIN kota ON post.id_kota=kota.id_kota JOIN provinsi ON post.id_prov=provinsi.id_prov"));
        
        $html ='<span> Semua Data <br></span>
                <span>Banyak Data  : <b>'.$hitungpost.' </b> <br><br></span>
                     <table  border="1" cellpadding="3">
                        <tr>
                            <th width="30" style="text-align:center"> ID </th>
                            <th width="120" style="text-align:center"> FOTO</th>
                            <th width="80" style="text-align:center"> USERNAME</th>
                            <th width="80" style="text-align:center"> KOTA</th>
                            <th width="80" style="text-align:center"> ALAMAT</th>
                            <th width="160" style="text-align:center"> CAPTION</th>
                            <th width="100" style="text-align:center"> PEMBUATAN</th>
                        </tr>
                        </thread> </table>
                ';
                $pdf->writeHTML($html, false, false, true, false, '');
        foreach ($query as $data ) {
        
                $foto = "../../core/upload/".$data['id_user']."/".$data['foto_nama'];
                $id_post = $data['id_post'];
                $username = $data['username'];
                $kota = $data['kota'];
                $alamat = $data['alamat'];
                $caption = $data['caption'];
                $waktu_pembuatan = $data['tgl'];
        
            $html ='<table  border="1" cellpadding="3">
                        <tr>
                            <td width="30px" style="text-align:center">'.$id_post.'</td>
                            <td width="120"> <img src="'.$foto.'" width="300px" height="250px"></td>
                            <td width="80"><p style="margin-right:5px">'.$username.' </p></td>
                            <td width="80"><p style="margin-right:5px">'.$kota.' </p></td>
                            <td width="80">'.$alamat.'</td>
                            <td width="160">'.$caption.'</td>
                            <td  width="100">'.$waktu_pembuatan.'</td>
                        </tr>
                         </table>
                    ';
                    $pdf->writeHTML($html, false, false, true, false, '');
        }
    }
    

}

$pdf->Output('post.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================