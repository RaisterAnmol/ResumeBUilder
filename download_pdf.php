<?php
require('fpdf.php');
include("config.php");

$id=$_GET['id'];
$res=$conn->query("SELECT * FROM resumes WHERE id=$id");
$data=$res->fetch_assoc();

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","B",16);
$pdf->Cell(0,10,$data['full_name'],0,1);

$pdf->SetFont("Arial","",12);
$pdf->Cell(0,10,"Email: ".$data['email'],0,1);
$pdf->Cell(0,10,"Phone: ".$data['phone'],0,1);

$pdf->MultiCell(0,10,"Skills: ".$data['skills']);
$pdf->MultiCell(0,10,"Education: ".$data['education']);
$pdf->MultiCell(0,10,"Experience: ".$data['experience']);

$pdf->Output();
?>