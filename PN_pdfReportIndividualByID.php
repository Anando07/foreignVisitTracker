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

$idReqEncoded = $_GET['idReq'];   
$idReq = urldecode($idReqEncoded);

$sql = "SELECT * from PassNID WHERE ServiceID = " . $idReq;

$query = $db->query($sql); //or die(mysql_error());
if ($query == false){
	//echo mysql_error();
}
else {
	//echo "Success to select all ";
}

if($query->num_rows > 0){
	//echo "num_rows more than zero";
}
//$results=$query->fetchAll(PDO::FETCH_OBJ);
//$results=$query->fetch_assoc();
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


$pdf->SetFont('Arial','',12);
$pdf->Ln();	
$pdf->Ln();	
//$this->Cell(0,10,'Center text:',0,0,'C');
$pdf->SetTextColor(0,0,0); 
//$pdf->Cell(0,10,'Foreign Visit Record by Name',0.0,0.0,'C');
$pdf->Cell(0,10,'Passport/NID Information of Service ID: '.$idReq,1.0,0.0,'C');
$pdf->SetFont('Arial','',8);
$pdf->Ln();	
$pdf->Cell(0,4,'Report generated on '.date("Y-m-d")." (YYYY-MM-DD)",0,1,'C');
//$pdf->InsertText("Line one\n\nLine two");
//$pdf->Cell(169,7,"List of all Pending Cases",1);
//$pdf->SetFont('Arial','',7);
$pdf->Ln();	
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(12,7,"ID",1,0,'C');
$pdf->Cell(20,7,"Cadre",1,0,'C');
$pdf->Cell(32,7,"Name",1,0,'C');
$pdf->Cell(60,7,"Designation",1,0,'C');
$pdf->Cell(23,7,"Passport No",1,0,'C');
$pdf->Cell(20,7,"Expiry Date",1,0,'C');
$pdf->Cell(27,7,"NID",1,0,'C');

if($query->num_rows > 0)
{
	//echo " rowCount is more than zero ";
	while($row = $query->fetch_assoc()) {  
		//echo " foreaches entered ";
		$pdf->SetFont('Arial','',7);	
		$pdf->Ln();
		$pdf->Cell(12,7,$row["ServiceID"],1,0,'C');
		$pdf->Cell(20,7,$row["Cadre"],1,0,'C');
		$pdf->Cell(32,7,$row["Name"],1,0,'C');
		$pdf->Cell(60,7,$row["Designation"]. " (Grade-" . $row["Grade"] . "), ". $row["Office"],1,0,'C');
		$pdf->Cell(23,7,$row["Passport"],1,0,'C');
		$pdf->Cell(20,7,$row["ExpiryDate"],1,0,'C');
		$pdf->Cell(27,7,$row["NID_Num"],1,0,'C');
	} 
}

$pdf->Output('ForeignVisitRecord.pdf','I');
$db->close();
?>