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
$pdf->Image('BD50.png', 10,5, 20, 20); //$x, $y, $width, $height
//$pdf->Image('Logo.jpeg', 95,5, 20, 20); //$x, $y, $width, $height
$pdf->Image('Mujib100.png', 182,5, 25, 20); //$x, $y, $width, $height 
$pdf->SetFont('Arial','B',12);	
$pdf->SetTextColor(255,0,0); 

/*$nameReqEncoded = $_POST['nameReq'];   
$nameReq = urldecode($nameReqEncoded);  
$startDate = $_POST['FromDate'];
$endDate = $_POST['ToDate'];*///$_GET['link'] 

$countryReqEncoded = $_GET['countryReq'];   
$countryReq = urldecode($countryReqEncoded);
$startDate = $_GET['FromDate'];
$endDate = $_GET['ToDate'];

$dateS = strtotime($startDate); 
$dateE = strtotime($endDate);
$dateDiff = ($dateE - $dateS);
$daysInitial = round(($dateDiff)/(60*60*24)); 
//$days = $daysInitial + 1;

if($daysInitial < 0){
	die("<br><br><center> Sorry. To Date has to be later than From Date. <center><br><br>");
} 

$dateSq = date('Y-m-d',$dateS);
$dateEq = date('Y-m-d',$dateE);


$sql = "SELECT * from ForeignVisit WHERE DestinationCountry = '" . $countryReq . "' ORDER BY StartDate desc";
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
//$pdf->Cell(0,10,'Foreign Visit Record by Name',0.0,0.0,'C');
$pdf->Cell(0,10,'Record of Foreign Visits to '.$countryReq." from ".$startDate." to ".$endDate,1.0,0.0,'C');
$pdf->SetFont('Arial','',8);
$pdf->Ln();	
$pdf->Cell(0,6,'(IO = International Organisation, FS = Foreign Scholarship, BS = Bangladeshi Scholarship, EBL = Ex-Bangladesh Leave, EL = Extraordinary Leave)',0,1,'C');
$pdf->Cell(0,4,'Report generated on '.date("Y-m-d")." (YYYY-MM-DD)",0,1,'C');
//$pdf->InsertText("Line one\n\nLine two");
//$pdf->Cell(169,7,"List of all Pending Cases",1);
//$pdf->SetFont('Arial','',7);
$pdf->Ln();	
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',8);$pdf->Cell(12,7,"ID",1,0,'C');
$pdf->Cell(48,7,"Name",1,0,'C');
$pdf->Cell(60,7,"Designation",1,0,'C');
//$pdf->Cell(49,7,"Workplace",1,0,'C');
$pdf->Cell(25,7,"Country",1,0,'C');
$pdf->Cell(13,7,"Funding",1,0,'C');
$pdf->Cell(13,7,"Purpose",1,0,'C');
$pdf->Cell(8,7,"Days",1,0,'C'); 

//$cnt=1;
//if($query->rowCount() > 0)
if($query->num_rows > 0)
{
	//echo " rowCount is more than zero ";
	while($row = $query->fetch_assoc()) { 
		$dateDBS = strtotime($row["StartDate"]); 
    	$dateDBSq = date('Y-m-d',$dateDBS);

    	if(($dateDBSq >= $dateSq) && ($dateDBSq <= $dateEq)) {
		//echo " foreaches entered ";
		$pdf->SetFont('Arial','',7);	
		$pdf->Ln();
		$pdf->Cell(12,7,$row["ServiceID"],1,0,'C');
		$pdf->Cell(48,7,$row["Name"],1,0,'C');
		//$pdf->Cell(50,7,$row["Designation"]. " (Grade-" . $row["Grade"] . ")",1,0,'C');
		$pdf->Cell(60,7,$row["Designation"]. " (Grade-" . $row["Grade"] . "), " . $row["Office"], 1,0,'C');
		//$pdf->Cell(49,7,$row["Workplace"] . ", " . $row["Office"],1,0,'C');
		$pdf->Cell(25,7,$row["DestinationCountry"],1,0,'C');
		$pdf->Cell(13,7,$row["FundingSource"],1,0,'C');
		$pdf->Cell(13,7,$row["Purpose"],1,0,'C');
		$pdf->Cell(8,7,$row["Days"],1,0,'C');
		}
	} 
}
$pdf->Ln();	
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1,6,'N.B.: This is a system generated report and does NOT require any signature.',0,1,'L');
$pdf->Output('ForeignVisitRecord.pdf','I');
$db->close();
?>