<?php 
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if(isset($_SESSION['login_user'])) {
    $word = $_SESSION['login_user'];
} else {
    die("<br><br><center>
        You are presently logged out. Please log in to access this page.
        <br><br>
        <a href='./Login.php'>Click here to log in</a>
    </center>");
}

include("config.php");
require('fpdf181/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();

/* =========================
   HEADER LOGO (PERFECT CENTER)
========================= */
$logoWidth  = 20;
$logoHeight = 20;
$pageWidth  = $pdf->GetPageWidth();
$x = ($pageWidth - $logoWidth) / 2; // calculate center
$y = 10; // top margin
$pdf->Image('Logo.jpeg', $x, $y, $logoWidth, $logoHeight);

/* =========================
   INPUT PARAMETERS
========================= */
$purposeReqEncoded = $_GET['purposeReq'];   
$purposeReq = urldecode($purposeReqEncoded);
$startDate = $_GET['FromDate'];
$endDate   = $_GET['ToDate'];

$dateS = strtotime($startDate); 
$dateE = strtotime($endDate);
$daysInitial = round(($dateE - $dateS) / (60*60*24));

if ($daysInitial < 0) {
    die("<br><br><center>Sorry. To Date must be later than From Date.</center><br><br>");
}

$dateSq = date('Y-m-d', $dateS);
$dateEq = date('Y-m-d', $dateE);

/* =========================
   QUERY
========================= */
$sql = "SELECT * FROM ForeignVisit 
        WHERE Purpose = '$purposeReq' 
        ORDER BY StartDate DESC";
$query = $db->query($sql);

/* =========================
   PDF HEADER TEXT
========================= */
$pdf->Ln(25);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,"Government of the People's Republic of Bangladesh",0,1,'C');
$pdf->Cell(0,5,"Ministry of Finance",0,1,'C');
$pdf->Cell(0,5,"Internal Resources Division (IRD)",0,1,'C');

$pdf->SetFont('Arial','',10);
$pdf->Cell(0,4,"Bangladesh Secretariat, Dhaka-1000",0,1,'C');
$pdf->Cell(0,4,"www.ird.gov.bd",0,1,'C');

$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(
    0,10,
    "Foreign Visit Record of $purposeReq from $startDate to $endDate",
    1,1,'C'
);

$pdf->SetFont('Arial','',8);
$pdf->Cell(
    0,6,
    "(IO = International Organisation, FS = Foreign Scholarship, BS = Bangladeshi Scholarship,
    EBL = Ex-Bangladesh Leave, EL = Extraordinary Leave)",
    0,1,'C'
);
$pdf->Cell(0,4,"Report generated on ".date("Y-m-d")." (YYYY-MM-DD)",0,1,'C');

$pdf->Ln(3);

/* =========================
   TABLE HEADER
========================= */
$pdf->SetFont('Arial','B',8);
$pdf->Cell(8,7,"SL",1,0,'C');
$pdf->Cell(12,7,"ID",1,0,'C');
$pdf->Cell(48,7,"Name",1,0,'C');
$pdf->Cell(60,7,"Designation",1,0,'C');
$pdf->Cell(35,7,"Country",1,0,'C');
$pdf->Cell(13,7,"Funding",1,0,'C');
// $pdf->Cell(13,7,"Purpose",1,0,'C');
$pdf->Cell(15,7,"From",1,0,'C');
$pdf->Cell(8,7,"Days",1,0,'C');

/* =========================
   TABLE DATA
========================= */
$sl = 1;

if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {

        $dateDBS = strtotime($row["StartDate"]); 
        $dateDBSq = date('Y-m-d', $dateDBS);

        if ($dateDBSq >= $dateSq && $dateDBSq <= $dateEq) {

            $pdf->SetFont('Arial','',7);
            $pdf->Ln();

            $pdf->Cell(8,7,$sl++,1,0,'C');
            $pdf->Cell(12,7,$row["ServiceID"],1,0,'C');
            $pdf->Cell(48,7,$row["Name"],1,0,'C');
            $pdf->Cell(60,7,$row["Designation"]. " (Grade-" . $row["Grade"] . "), " . $row["Office"], 1,0,'C');
            $pdf->Cell(35,7,$row["DestinationCountry"],1,0,'C');
            $pdf->Cell(13,7,$row["FundingSource"],1,0,'C');
            // $pdf->Cell(13,7,$row["Purpose"],1,0,'C');
			$pdf->Cell(15,7,$row["StartDate"],1,0,'C');
            $pdf->Cell(8,7,$row["Days"],1,0,'C');
        }
    }
}

/* =========================
   FOOTNOTE
========================= */
$pdf->Ln();
$pdf->SetFont('Arial','B',8);
$pdf->Cell(
    0,6,
    "N.B.: This is a system generated report and does NOT require any signature.",
    0,1,'L'
);

/* =========================
   OUTPUT
========================= */
$pdf->Output('ForeignVisitRecord.pdf','I');
$db->close();
?>
