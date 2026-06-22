<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header("Location: ../../index.php");
    exit;
}

include("../../config/db.php");

$society_id = $_SESSION['society_id'];

$result = mysqli_query($conn,"
SELECT 
    b.*, 
    m.name, 
    m.flat_no
FROM bills b
JOIN members m ON b.member_id = m.id
WHERE b.society_id = '$society_id'
ORDER BY b.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Maintenance Bills</title>
    <link rel="stylesheet" href="../../assets/css/members-royal.css">
</head>

<body>

<div class="main">

    <h2>Maintenance Bills</h2>

    <!-- GENERATE BILL -->
    <a href="generate-bill.php" class="btn-add">+ Generate Maintenance Bill</a>

    <br><br>

    <table class="table">
        <tr>
            <th>Bill No</th>
            <th>Member</th>
            <th>Flat</th>
            <th>Billing Period</th>
            <th>Amount</th>
            <th>Due Date</th>
            <th>Status</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?= $row['bill_no'] ?? "BILL-".$row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['flat_no'] ?></td>
            <td><?= $row['month']." ".$row['year'] ?></td>
            <td>₹<?= $row['amount'] ?></td>
            <td><?= $row['due_date'] ?? '-' ?></td>
            <td>
                <?php if($row['status']=="Paid"){ ?>
                    <span style="color:green;font-weight:600;">Paid</span>
                <?php } else { ?>
                    <span style="color:red;font-weight:600;">Pending</span>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>
