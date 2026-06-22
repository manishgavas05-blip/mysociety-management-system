<?php
session_start();
include("../config/db.php");

$member_id = $_SESSION['member_id'];
$bill_id = $_GET['bill_id'];

$txn = "TXN".time().rand(100,999);

$bill = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT amount FROM bills WHERE id='$bill_id'")
);

mysqli_query($conn,"
INSERT INTO payments
(bill_id, member_id, transaction_id, amount, payment_status)
VALUES
('$bill_id','$member_id','$txn','{$bill['amount']}','Success')
");

mysqli_query($conn,"
UPDATE bills SET status='Paid'
WHERE id='$bill_id'
");

header("Location: invoice-pdf.php?txn=$txn");
exit;
