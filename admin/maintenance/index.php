<?php
session_start();
include("../../config/db.php");

/* 🔐 admin check */
if(!isset($_SESSION['admin_id'])){
    header("Location: ../../admin-auth/admin-login.php");
    exit;
}

$society_id = $_SESSION['society_id'];

/* ✅ FINAL QUERY (BILLS BASED STATUS) */
$query = mysqli_query($conn,"
SELECT 
    m.id,
    m.name,
    m.flat_no,
    COALESCE(b.amount, 0) AS amount,
    COALESCE(b.status, 'Pending') AS status

FROM members m

LEFT JOIN bills b 
    ON m.id = b.member_id 
    AND b.society_id = '$society_id'

WHERE m.society_id = '$society_id'

ORDER BY m.flat_no ASC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Maintenance Status</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

<style>

/* BODY */
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:#f1f5f9;
}

/* MAIN */
.main{
    padding:30px;
}

/* TITLE */
h2{
    margin-bottom:20px;
    color:#0f172a;
}

/* TABLE */
.table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,0.05);
}

.table th{
    background:#2563eb;
    color:white;
    padding:14px;
    text-align:left;
}

.table td{
    padding:12px;
    border-bottom:1px solid #eee;
}

.table tr:hover{
    background:#f8fafc;
}

/* STATUS */
.paid{
    color:#16a34a;
    font-weight:600;
}

.unpaid{
    color:#dc2626;
    font-weight:600;
}

</style>

</head>

<body>

<div class="main">

<h2>🧾 Maintenance Status</h2>

<table class="table">

<tr>
    <th>Flat No</th>
    <th>Member Name</th>
    <th>Amount</th>
    <th>Status</th>
</tr>

<?php while($row = mysqli_fetch_assoc($query)){ ?>

<tr>
    <td><?= $row['flat_no'] ?></td>
    <td><?= $row['name'] ?></td>
    <td>₹<?= $row['amount'] ?></td>

    <td>
        <?php if(strtolower($row['status']) == "paid"){ ?>
            <span class="paid">✔ Paid</span>
        <?php } else { ?>
            <span class="unpaid">✖ Unpaid</span>
        <?php } ?>
    </td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>