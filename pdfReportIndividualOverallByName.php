<?php 
error_reporting (E_ALL ^ E_NOTICE);
session_start();
if(isset($_SESSION['login_user'])) {
    $word = $_SESSION['login_user'];
    //echo "Welcome, " . $word; 
} else {
    die("<br><br><center>You are presently logged out. Please log in to access this page. <br> <br> <a href = ./Login.php> Click here to log in </a></center>");  
}
include("config.php");
require ('fpdf181/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
//$pdf->Image('Logo.jpeg', 183, 250, 25, 25); 
$pdf->Image('BD50.png', 10,5, 20, 20); //$x, $y, $width, $height
//$pdf->Image('Logo.jpeg', 95,5, 20, 20); //$x, $y, $width, $height
$pdf->Image('Mujib100.png', 182,5, 25, 20); //$x, $y, $width, $height 
$pdf->SetFont('Arial','B',12);	
$pdf->SetTextColor(255,0,0);

$nameOverallReqEncoded = $_GET['nameOverallReq'];   
$nameOverallReq = urldecode($nameOverallReqEncoded);

$sql = "SELECT * from ForeignVisit WHERE Name LIKE '" ."%" . $nameOverallReq . "%" . "' ORDER BY StartDate desc";
$query = $db->query($sql); //or die(mysql_error());

$pdf->SetFont('Arial','',12); 
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	

//$this->Cell(0,10,'Center text:',0,0,'C');     
//$pdf->SetTextColor(255,0,0);  
$pdf->SetTextColor(0,0,0);
//$pdf->Cell(0,10,'Foreign Visit Record by Name',0.0,0.0,'C');
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
$pdf->Cell(0,5,'Government of the People'."'s".' Republic of Bangladesh',0.0,1.0,'C');
$pdf->Cell(0,5,'Ministry of Finance',0.0,1.0,'C');
$pdf->Cell(0,5,'Internal Resources Division (IRD)',0.0,1.0,'C');
$pdf->SetFont('Arial','',10); 
$pdf->Cell(0,4,'Bangladesh Secretariat, Dhaka-1000',0.0,1.0,'C');
$pdf->Cell(0,4,'www.ird.gov.bd',0.0,1.0,'C');
//$pdf->Ln();	
$pdf->SetFont('Arial','B',12); 
$pdf->Ln();	
$pdf->Ln();	
$pdf->Cell(0,10,'Foreign Visit Record of '.$nameOverallReq,1.0,0.0,'C');
$pdf->SetFont('Arial','',8);
$pdf->Ln();	
$pdf->Cell(0,6,'(IO = International Organisation, FS = Foreign Scholarship, BS = Bangladeshi Scholarship, EBL = Ex-Bangladesh Leave, EL = Extraordinary Leave)',0,1,'C');
$pdf->Cell(0,4,'Report generated on '.date("Y-m-d")." (YYYY-MM-DD)",0,1,'C');
//$pdf->InsertText("Line one\n\nLine two");
//$pdf->Cell(169,7,"List of all Pending Cases",1);
//$pdf->SetFont('Arial','',7);
$pdf->Ln();	
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(11,7,"ID",1,0,'C');
$pdf->Cell(48,7,"Name",1,0,'C'); 
$pdf->Cell(60,7,"Designation",1,0,'C'); //41
$pdf->Cell(30,7,"Country",1,0,'C');
$pdf->Cell(14,7,"Funding",1,0,'C');
$pdf->Cell(14,7,"Purpose",1,0,'C');
$pdf->Cell(15,7,"From",1,0,'C');
//$pdf->Cell(19,7,"To",1,0,'C');
$pdf->Cell(7,7,"Days",1,0,'C'); 

//$cnt=1;
//if($query->rowCount() > 0)
if($query->num_rows > 0)
{
	//echo " rowCount is more than zero ";
	while($row = $query->fetch_assoc()) { 
		$pdf->SetFont('Arial','',7);	
		$pdf->Ln();
		$pdf->Cell(11,7,$row["ServiceID"],1,0,'C');
		$pdf->Cell(48,7,$row["Name"],1,0,'C');
		//$pdf->Cell(55,7,$row["Designation"]. " (Grade-" . $row["Grade"] . "), " . $row["Office"],1,0,'C');
		$pdf->Cell(60,7,$row["Designation"]. " (Grade-" . $row["Grade"] . "), " . $row["Office"], 1,0,'C');
		$pdf->Cell(30,7,$row["DestinationCountry"],1,0,'C');
		$pdf->Cell(14,7,$row["FundingSource"],1,0,'C');
		$pdf->Cell(14,7,$row["Purpose"],1,0,'C');
		$pdf->Cell(15,7,$row["StartDate"],1,0,'C');
		//$pdf->Cell(19,7,$row["EndDate"],1,0,'C');
		$pdf->Cell(7,7,$row["Days"],1,0,'C');
		
	} 
}
$pdf->Ln();	
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1,6,'N.B.: This is a system generated report and does NOT require any signature.',0,1,'L');
$pdf->Output('ForeignVisitRecord.pdf','I');
//$pdf->Output();
//$pdf->Output($filename,'D');
$db->close();
?>