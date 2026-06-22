<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['member_id'])){
    header("Location: ../member-auth/member-login.php");
    exit;
}

$member_id = $_SESSION['member_id'];

$bills = mysqli_query($conn,"
SELECT * FROM bills
WHERE member_id='$member_id'
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Bills</title>
<link rel="stylesheet" href="../assets/css/light-royal.css">
</head>

<body>

<div class="container">
    

<h2>My Maintenance Bills</h2>

<table class="table">
<tr>
<th>Month</th>
<th>Amount</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($bills)){ ?>
<tr>
<td><?= $row['month']." ".$row['year'] ?></td>
<td>₹<?= $row['amount'] ?></td>
<td><?= $row['status'] ?></td>

<td>
<?php if(strtolower($row['status'])=="pending"){ ?>
    <a href="../payment/fake-gateway.php?bill_id=<?= $row['id'] ?>" class="btn">
    Pay Now
</a>

<?php } else { ?>
    Paid ✅
<?php } ?>
</td>

</tr>
<?php } ?>

</table>

</div>

</body>
</html>
