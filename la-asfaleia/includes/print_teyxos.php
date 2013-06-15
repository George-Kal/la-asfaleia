<?php
/*
Copyright (C) 2013 - Labros Asfaleia v.1.0 beta
Author: Labros Karoyntzos 

Labros Asfaleia v.1.0 beta from Labros Karountzos is free software: 
you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 3 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License version 3
along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.

Το παρόν με την ονομασία Labros Asfaleia v.1.0 beta με δημιουργό τον Λάμπρο Καρούντζο
στοιχεία επικοινωνίας info@chem-lab.gr www.chem-lab.gr
είναι δωρεάν λογισμικό. Μπορείτε να το τροποποιήσετε και επαναδιανείμετε υπό τους
όρους της άδειας GNU General Public License όπως δίδεται από το Free Software Foundation
στην έκδοση 3 αυτής της άδειας.
Το παρόν σχόλιο πρέπει να παραμένει ως έχει ώστε να τηρείται η παραπάνω άδεια κατά τη διανομή.
*/
?>

<?php
define('INCLUDE_CHECK',true);
require_once('/tcpdf/config/tcpdf_config.php');
require_once('/tcpdf/tcpdf.php');
require("connection.php");
require("session.php");
require("medoo.php");

confirm_logged_in();
confirm_meleti_isset();

$printteyxos = new medoo(DB_NAME);

$teyxos = "";
//$teyxos = file_get_contents('../javascripts/bootstrap/css/bootstrap.css');

//επιλογή στοιχείων μελέτης
$tb_teyxos = "meleti_teyxos";
$col_teyxos = "*";
$where_teyxos = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
$kefalaia = $printteyxos->select($tb_teyxos,$col_teyxos,$where_teyxos);


foreach($kefalaia as $kefalaio){
$teyxos .= $kefalaio["text"];
$teyxos .= "<p style=\"page-break-before:always;\">&nbsp;</p>";
}



// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
	//Page header
	public function Header() {
		// Logo
		//$image_file = '../images/home-s.png';
		//$this->Image($image_file, 10, 5, 8, 8, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('dejavusans', 'B', 10);
		// Title
		$this->Cell(0, 15, 'Μελέτη εκτίμησης επαγγελματικών κινδύνων', 'B', false, 'C', 0, '', 0, false, 'M', 'B');
	}
	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('dejavusans', 'N', 8);
		
		$this->Cell(0, 10, date("Y-m-d H:i:s"), 'T', false, 'L', 0, '', 0, false, 'T', 'M');
		// Page number
		$this->Cell(0, 10, 'Σελ. '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 'T', false, 'R', 0, '', 0, false, 'T', 'M');
		//$this->Cell(0, 10, date("Y-m-d H:i:s"), 'T', false, 'R', 0, '', 0, false, 'T', 'M');
	}
}

set_time_limit (120);
ob_end_flush();
ob_flush();
flush();
ob_start();

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('La-asfaleia');
$pdf->SetSubject('');
$pdf->SetKeywords('');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//set some language-dependent strings
$pdf->setLanguageArray($l);
// ---------------------------------------------------------
// set font
$pdf->SetFont('dejavusans', 'N', 8);
// add a page
$pdf->AddPage();
$pdf->writeHTML($teyxos, $ln = true, $fill = false, $reseth = true, $cell = false, $align = '' ) ;

ob_end_clean();
// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output("../output/ta_user".$_SESSION['user_id']."-meleti".$_SESSION['meleti_id']."-teyxos.pdf", 'F');

?>

<script type="text/javascript">
window.open("../output/ta_user" + <?php echo $_SESSION['user_id']?> + "-meleti" + <?php echo $_SESSION['meleti_id']?> + "-teyxos.pdf");
window.close();
</script>