
<?php
include("../config/db.php");

$txn = $_GET['txn'];

$payment = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT p.*, b.month, b.year, m.name, m.flat_no
        FROM payments p
        JOIN bills b ON p.bill_id=b.id
        JOIN members m ON p.member_id=m.id
        WHERE p.transaction_id='$txn'
    ")
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment Receipt</title>
<link rel="stylesheet" href="../assets/css/light-royal.css">
</head>

<body>

<div class="container">

<h2>Payment Receipt</h2>

<div class="card">
    <p><b>Receipt No:</b> <?= $payment['transaction_id'] ?></p>
    <p><b>Member:</b> <?= $payment['name'] ?></p>
    <p><b>Flat:</b> <?= $payment['flat_no'] ?></p>
    <p><b>Month:</b> <?= $payment['month']." ".$payment['year'] ?></p>
    <p><b>Amount Paid:</b> ₹<?= $payment['amount'] ?></p>
    <p><b>Status:</b> SUCCESS</p>

    <a class="btn" href="../member/dashboard.php">Go Dashboard</a>
    <a class="btn" href="invoice-pdf.php?txn=<?= $payment['transaction_id'] ?>">
    Download PDF Invoice
</a>
</div>

</div>

</body>
</html>
