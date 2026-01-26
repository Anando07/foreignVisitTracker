<?php
include 'PDFMerger.php';

$pdf = new PDFMerger;

$pdf->addPDF('doc1_v1.pdf'); // with links
$pdf->addPDF('doc2_v1.pdf'); 
//$pdf->addPDF('./three.pdf', 'all');
 
$pdf->merge('file', 'test.pdf'); // generate the file
$pdf->output();

?>  