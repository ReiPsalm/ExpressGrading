<?php
require('fpdf181/fpdf.php');

$pdf = new FPDF('L','mm','Legal');
$pdf->AddPage();
$pdf->SetFont('Arial','',16);
$pdf->Cell(40,10,'Hello World!');
$filename="test.pdf";
$pdf->Output($filename,'D');
?>