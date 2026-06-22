<?php
require("../fpdf/fpdf.php");
include("../config/db.php");

$txn = $_GET['txn'];

$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT p.*, b.month, b.year, m.name, m.flat_no
FROM payments p
JOIN bills b ON p.bill_id=b.id
JOIN members m ON p.member_id=m.id
WHERE p.transaction_id='$txn'
"));

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","B",16);
$pdf->Cell(0,10,"SOCIETY MAINTENANCE RECEIPT",0,1,"C");

$pdf->Ln(8);
$pdf->SetFont("Arial","",12);

$pdf->Cell(0,8,"Receipt No: ".$data['transaction_id'],0,1);
$pdf->Cell(0,8,"Member Name: ".$data['name'],0,1);
$pdf->Cell(0,8,"Flat No: ".$data['flat_no'],0,1);
$pdf->Cell(0,8,"Billing Period: ".$data['month']." ".$data['year'],0,1);

$pdf->Ln(5);
$pdf->SetFont("Arial","B",12);
$pdf->Cell(0,8,"Amount Paid: Rs. ".$data['amount'],0,1);

$pdf->Ln(10);
$pdf->SetFont("Arial","",11);
$pdf->Cell(0,8,"Status: SUCCESS",0,1);
$pdf->Cell(0,8,"Thank you for your payment.",0,1);

$pdf->Output("I","receipt.pdf");
