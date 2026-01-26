<?php
require('fpdf_merge.php');

$merge = new FPDF_Merge();
$merge->add('doc1.pdf');
$merge->add('doc2_v1.pdf');
$merge->output();
?>
