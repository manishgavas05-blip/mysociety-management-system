<?php
session_start();
include("../../config/db.php");

$society_id = $_SESSION['society_id'];

$paid = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(amount) total FROM payments
WHERE payment_status='Success'
"));

$pending = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(amount) total FROM bills
WHERE society_id='$society_id' AND status='Pending'
"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Reports</title>
<link rel="stylesheet" href="../../assets/css/light-royal.css">
</head>

<body>

<div class="container">
<h2>Financial Reports</h2>

<div class="card-grid">

<div class="card">
<h3>Total Collection</h3>
<p>₹<?= $paid['total'] ?? 0 ?></p>
</div>

<div class="card">
<h3>Pending Amount</h3>
<p>₹<?= $pending['total'] ?? 0 ?></p>
</div>

</div>

</div>
</body>
</html>
