<?php
header('Content-type: application/pdf');
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
$inst=$_SESSION['institutionID'];


require('pdf_mysql.php');
class PDF extends PDF_MySQL_Table {
	function Header() {
	    //Title
	    $this->SetFont('Arial','',22);
	    $title_value= "VAHVISTUSKOODIT " .date('o');
	    $this->Cell(0,60,$title_value,0,1,'C');
	    $this->Ln(30);
	    //Ensure table header is output
	    parent::Header();
	}
}

$pdf = new PDF('P','pt','A4');
$pdf->SetFont('Arial','',16);
$pdf->AddPage();

$sql_statement = "SELECT week_year, code FROM institution_code_" .$inst. " WHERE RIGHT(week_year, 4)='" .date('o') ."' ORDER BY LENGTH(week_year), week_year ASC";
$pdf->AddCol('week_year','40%','Viikko_Vuosi');
$pdf->AddCol('code','60%','Koodi');
$prop=array('HeaderColor'=>array(0, 80, 176),'width'=>400, 'padding'=>2.5);

$pdf->Table($conn, $sql_statement, $prop);
$pdf->Output() ;  			
?>
