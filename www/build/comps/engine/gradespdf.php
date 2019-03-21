<?php
require('fpdf181/fpdf.php');
include_once "../engine/loader.php";
$classR->clrid = $_GET['dataID'];
$getData = $classR->GetDataClr();
$row = $getData->fetchArray(SQLITE3_ASSOC);

$pdf = new FPDF('L','mm','Legal');
$pdf->AddPage();
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,6, 'Class Record ID : '.$_GET['dataID'],0,1,'L');
$pdf->Cell(0,6, 'School : '.$row['sch_desc'],0,1,'L');
$pdf->Cell(0,6, 'Subject / Section : '.$row['subj_desc'].' ('.$row['Sec_desc'].')',0,1,'L');
$pdf->Cell(0,6, 'Time / Day : '.$row['cr_timeDay'],0,1,'L');
$pdf->Cell(0,6, 'Term / School Year : '.$row['cr_term'].'/ '.$row['cr_sy'],0,1,'L');
$filename= $row['subj_desc'].' ('.$row['Sec_desc'].').pdf';
$pdf->Output($filename,'D');
// $pdf->Output();
?>