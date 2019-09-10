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

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Laporan Admin');

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
if(isset($_GET['cetakadmin'])){ 

    $listadmin = $_GET['daftaradmin'];
    $cekadmin1 = $_GET['cekadmin'];


    $pdf->Ln(1);
    $html = '<span style="font-size:13px;text-align:center"><u>Laporan Admin</u></span>';
    
    $pdf->writeHTML($html, true, false, true, false, '');

   if(empty($cekadmin1)){
        if(($listadmin == 'username') || ($listadmin == 'nama') || ($listadmin == 'waktu_pembuatan')){
          ?><script>
               window.alert("Data Harus Diisi");
               window.history.back();          
          </script><?php
        }
    }
    
    if ($listadmin == 'semua') {
       $query = mysqli_query($konek,"SELECT * FROM admin order by id_admin");
       $hitungmember=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM admin"));
       $html ='<span>Semua Data <br></span>
               <span>Banyak Data  : <b>'.$hitungmember.' </b> <br><br></span>
                     <table  border="1" cellpadding="3">
                        <tr>
                            <th width="30" style="text-align:center"> ID </th>
                            <th width="130" style="text-align:center"> USERNAME</th>
                            <th width="130" style="text-align:center"> NAMA</th>
                            <th width="130" style="text-align:center"> KONTAK</th>
                            <th width="130" style="text-align:center"> PEMBUATAN</th>
                        </tr>
                     </table>
                ';
                $pdf->writeHTML($html, false, false, true, false, '');
        foreach ($query as $data ) {
                $id_admin = $data['id_admin'];
                $username = $data['username'];
                $nama = $data['nama'];
                $kontak = $data['kontak'];
                $waktu_pembuatan = $data['waktu_pembuatan'];
            $html ='
                     <table  border="1" cellpadding="3">
                        <tr>
                            <td width="30" style="text-align:center">  '.$id_admin.'</td>
                            <td width="130"><p style="margin-left:25px"> '.$username.' </p></td>
                            <td width="130"><p style="margin-right:5px"> '.$nama.' </p></td>
                            <td width="130">'.$kontak.'</td>
                            <td width="130">'.$waktu_pembuatan.'</td>
                        </tr>
                         </table>
                    ';
                    $pdf->writeHTML($html, false, false, true, false, '');
        } 
    }
    else if ($listadmin == 'username') { 
       $query = mysqli_query($konek,"SELECT * FROM admin where $listadmin='$cekadmin1' order by id_admin"); 
       $hitungmember=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM admin where $listadmin='$cekadmin1'"));
       $html ='<span>Username     : <b>'.$cekadmin1.' </b> <br></span>
               <span>Banyak Data  : <b>'.$hitungmember.' </b> <br><br></span>
                     <table  border="1" cellpadding="3">
                        <tr>
                            <th width="30" style="text-align:center"> ID </th>
                            <th width="130" style="text-align:center"> NAMA</th>
                            <th width="130" style="text-align:center"> KONTAK</th>
                            <th width="130" style="text-align:center"> PEMBUATAN</th>
                      
                        </tr>
                     </table>
                ';
                $pdf->writeHTML($html, false, false, true, false, '');
        foreach ($query as $data ) {
                $id_admin = $data['id_admin'];
                $nama = $data['nama'];
                $kontak = $data['kontak'];
                $waktu_pembuatan = $data['waktu_pembuatan'];
            $html ='
                     <table  border="1" cellpadding="3">
                        <tr>
                            <td width="30" style="text-align:center"> '.$id_admin.'</td>
                            <td width="130"><p style="margin-right:5px"> '.$nama.' </p></td>
                            <td width="130">'.$kontak.'</td>
                            <td width="130">'.$waktu_pembuatan.'</td>
                        </tr>
                         </table>
                    ';
                    $pdf->writeHTML($html, false, false, true, false, '');        
        } 
    }
    else if ($listadmin == 'nama') {
     $query = mysqli_query($konek,"SELECT * FROM admin where $listadmin LIKE '%$cekadmin1%' order by id_admin"); 
     $hitungmember=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM admin where $listadmin LIKE '%$cekadmin1%'"));
       $html ='<span>Nama         : <b>'.$cekadmin1.' </b> <br></span>
               <span>Banyak Data  : <b>'.$hitungmember.' </b> <br><br></span>
                     <table  border="1" cellpadding="3">
                        <tr>
                           <th width="30" style="text-align:center"> ID </th>
                            <th width="130" style="text-align:center"> USERNAME</th>
                            <th width="130" style="text-align:center"> NAMA</th>
                            <th width="130" style="text-align:center"> KONTAK</th>
                            <th width="130" style="text-align:center"> PEMBUATAN</th>
                      
                        </tr>
                     </table>
                ';
                $pdf->writeHTML($html, false, false, true, false, '');
        foreach ($query as $data ) {
                $id_admin = $data['id_admin'];
                $username = $data['username'];
                $nama = $data['nama'];
                $kontak = $data['kontak'];
                $waktu_pembuatan = $data['waktu_pembuatan'];
            $html ='<table  border="1" cellpadding="3">
                        <tr>
                            <td width="30" style="text-align:center"> '.$id_admin.'</td>
                            <td width="130"><p style="margin-left:25px"> '.$username.' </p></td>
                            <td width="130"><p style="margin-right:5px"> '.$nama.' </p></td>
                            <td width="130">'.$kontak.'</td>
                            <td width="130">'.$waktu_pembuatan.'</td>
                        </tr>
                         </table>
                    ';
                    $pdf->writeHTML($html, false, false, true, false, '');        
        } 
    }
    else if ($listadmin == 'waktu_pembuatan') {
      $query = mysqli_query($konek,"SELECT * FROM admin where $listadmin LIKE '%$cekadmin1%' order by id_admin"); 
      $hitungmember=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM admin where $listadmin LIKE '%$cekadmin1%'"));
         $html ='<span>Pembuatan : <b>'.$cekadmin1.' </b> <br></span>
                 <span>Banyak Data  : <b>'.$hitungmember.' </b> <br><br></span>
                     <table  border="1" cellpadding="3">
                        <tr>
                           <th width="30" style="text-align:center"> ID </th>
                            <th width="130" style="text-align:center"> USERNAME</th>
                            <th width="130" style="text-align:center"> NAMA</th>
                            <th width="130" style="text-align:center"> KONTAK</th>
                            <th width="130" style="text-align:center"> PEMBUATAN</th>
                      
                        </tr>
                     </table>
                ';
                $pdf->writeHTML($html, false, false, true, false, '');
        foreach ($query as $data ) {
                $id_admin = $data['id_admin'];
                $username = $data['username'];
                $nama = $data['nama'];
                $kontak = $data['kontak'];
                $waktu_pembuatan = $data['waktu_pembuatan'];
            $html ='
                     <table  border="1" cellpadding="3">
                        <tr>
                            <td width="30" style="text-align:center"> '.$id_admin.'</td>
                            <td width="130"><p style="margin-left:25px"> '.$username.' </p></td>
                            <td width="130"><p style="margin-right:5px"> '.$nama.' </p></td>
                            <td width="130">'.$kontak.'</td>
                            <td width="130">'.$waktu_pembuatan.'</td>
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