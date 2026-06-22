<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['member_id'])){
    header("Location: ../member-auth/member-login.php");
    exit;
}

if(!isset($_GET['bill_id'])){
    die("Bill ID missing");
}

$bill_id = $_GET['bill_id'];

$bill = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM bills WHERE id='$bill_id'")
);

if(!$bill){
    die("Invalid Bill");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Fake Payment</title>
<link rel="stylesheet" href="../assets/css/light-royal.css">
</head>

<body>

<div class="container">

<h2>Maintenance Payment</h2>

<div class="card">
    <p><b>Month:</b> <?= $bill['month']." ".$bill['year'] ?></p>
    <p><b>Amount:</b> ₹<?= $bill['amount'] ?></p>

    <a class="btn" href="fake-success.php?bill_id=<?= $bill_id ?>">
        Pay Successfully
    </a>

</div>

</div>

</body>
</html>
