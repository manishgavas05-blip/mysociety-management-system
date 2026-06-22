<?php
session_start();
include("../../config/db.php");

/* 🔴 ERROR SHOW KARNE KE LIYE */
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['generate'])){

    $month  = $_POST['month'];
    $year   = $_POST['year'];
    $amount = $_POST['amount'];
    $due    = $_POST['due'];

    // ✅ members yaha se fetch karo
    $members = mysqli_query($conn, "SELECT id FROM members");

    while($m = mysqli_fetch_assoc($members)){

        mysqli_query($conn,
            "INSERT INTO bills (member_id, month, year, amount, due_date)
             VALUES (
                '{$m['id']}',
                '$month',
                '$year',
                '$amount',
                '$due'
             )"
        );
    }

    echo "<script>alert('Bills Generated Successfully');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Generate Bill</title>
<link rel="stylesheet" href="../../assets/css/generate-bill.css">
</head>

<body>

<div class="main">
<h2>Generate Maintenance Bills</h2>

<form method="POST" class="card">

<select name="month" required>
    <option value="">Select Month</option>
    <option>January</option>
    <option>February</option>
    <option>March</option>
    <option>April</option>
    <option>May</option>
    <option>June</option>
    <option>July</option>
    <option>August</option>
    <option>September</option>
    <option>October</option>
    <option>November</option>
    <option>December</option>
</select>

<input type="number" name="year" value="2026" required>
<input type="number" name="amount" placeholder="Maintenance Amount" required>
<input type="date" name="due" required>

<button type="submit" name="generate">Generate Bill</button>

</form>

</div>

</body>
</html>
