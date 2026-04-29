<?php
require('fpdf/fpdf.php');
include 'db.php';

$table = $_GET['table'];

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

$pdf->Cell(190,10,"Cotton Report - $table",1,1,'C');

$res = $conn->query("SELECT * FROM `$table`");

while($row = $res->fetch_assoc()){
    $line = $row['farmer_name']." | ".$row['weight']." | ".$row['total']." | ".$row['created_at'];
    $pdf->Cell(190,10,$line,1,1);
}

$pdf->Output();
?>
