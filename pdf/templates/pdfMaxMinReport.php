<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['login_user_id'])) {
    die("<br><br><center>
        You are presently logged out. Please log in to access this page.
        <br><br>
        <a href='auth/Login.php'>Click here to log in</a>
    </center>");
}

require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../fpdf181/fpdf.php';

/* =========================
   INPUT PARAMETERS
========================= */
$visitType = $_GET['visit_type'] ?? $_POST['visit_type'] ?? ''; // maximum | minimum
if (!in_array($visitType, ['maximum','minimum'])) {
    die("<center>Invalid report type selected.</center>");
}

$startDate = $_GET['start_date'] ?? $_POST['start_date'] ?? '';
$endDate   = $_GET['end_date'] ?? $_POST['end_date'] ?? '';

/* =========================
   PDF INIT
========================= */
$pdf = new FPDF('L'); // Landscape
$pdf->AddPage();

/* =========================
   HEADER LOGO
========================= */
$logoWidth  = 20;
$logoHeight = 20;
$pageWidth  = $pdf->GetPageWidth();
$x = ($pageWidth - $logoWidth) / 2;

$logoPath = __DIR__ . '/../../assets/images/Logo.jpeg';

$pdf->Image($logoPath, $x, $y, $logoWidth, $logoHeight);

/* =========================
   HEADER TEXT
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
$title = ($visitType==='maximum') ? "Maximum Foreign Visit Frequency Report" : "Minimum Foreign Visit Frequency Report";
$pdf->Cell(0,10,$title,1,1,'C');

$pdf->SetFont('Arial','',9);
$pdf->Cell(0,5,"Report generated on ".date("Y-m-d")." (YYYY-MM-DD)",0,1,'C');

// Optional: show date range if provided
if (!empty($startDate) && !empty($endDate)) {
    $pdf->Cell(0,5,"Date Range: $startDate to $endDate",0,1,'C');
}

$pdf->Ln(3);

/* =========================
   SQL QUERY
========================= */
$order = ($visitType==='maximum') ? 'DESC' : 'ASC';

$dateCondition = '';
if (!empty($startDate) && !empty($endDate)) {
    $startDateEscaped = $db->real_escape_string($startDate);
    $endDateEscaped   = $db->real_escape_string($endDate);
    $dateCondition = " AND StartDate BETWEEN '$startDateEscaped' AND '$endDateEscaped'";
}

$sql = "
    SELECT 
        ServiceID,
        Name,
        Designation,
        Office,
        DestinationCountry,
        FundingSource,
        Purpose,
        COUNT(*) AS visit_times
    FROM ForeignVisit
    WHERE 1=1
    $dateCondition
    GROUP BY ServiceID, Name, Designation, Office, DestinationCountry, FundingSource, Purpose
    ORDER BY visit_times $order
";

$query = $db->query($sql);

/* =========================
   TABLE HEADER
========================= */
$pdf->SetFont('Arial','B',9);
$pdf->Cell(10,8,"SL",1,0,'C');
$pdf->Cell(22,8,"Service ID",1,0,'C');
$pdf->Cell(45,8,"Name",1,0,'C');
$pdf->Cell(60,8,"Designation & Office",1,0,'C');
$pdf->Cell(40,8,"Country",1,0,'C');
$pdf->Cell(30,8,"Funding",1,0,'C');
$pdf->Cell(45,8,"Purpose",1,0,'C');
$pdf->Cell(20,8,"Visits",1,1,'C');

/* =========================
   TABLE DATA
========================= */
$pdf->SetFont('Arial','',8);
$sl = 1;

if ($query && $query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        $pdf->Cell(10,8,$sl++,1,0,'C');
        $pdf->Cell(22,8,$row['ServiceID'],1,0,'C');
        $pdf->Cell(45,8,$row['Name'],1,0,'L');
        $pdf->Cell(60,8,$row['Designation'].", ".$row['Office'],1,0,'L');
        $pdf->Cell(40,8,$row['DestinationCountry'],1,0,'C');
        $pdf->Cell(30,8,$row['FundingSource'],1,0,'C');
        $pdf->Cell(45,8,$row['Purpose'],1,0,'L');
        $pdf->Cell(20,8,$row['visit_times'],1,1,'C');
    }
} else {
    $pdf->Cell(272,8,"No records found",1,1,'C'); // total width of table
}

/* =========================
   FOOTNOTE
========================= */
$pdf->Ln(4);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(
    0,6,
    "N.B.: This is a system generated report and does NOT require any signature.",
    0,1,'L'
);

/* =========================
   OUTPUT PDF
========================= */
$filename = ucfirst($visitType) . "_Foreign_Visit_Report.pdf";
$pdf->Output($filename,'I');
$db->close();
