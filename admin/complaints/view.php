<?php
session_start();
include("../../config/db.php");

if(!isset($_SESSION['admin_id'])){
    header("Location: ../../admin-auth/admin-login.php");
    exit;
}

$society_id = $_SESSION['society_id'];

/* 🔥 UPDATE STATUS */
if(isset($_GET['status']) && isset($_GET['id'])){
    $id = $_GET['id'];
    $status = $_GET['status'];

    mysqli_query($conn,"
    UPDATE complaints 
    SET status='$status' 
    WHERE id='$id' AND society_id='$society_id'
    ");
}

/* FETCH DATA */
$data = mysqli_query($conn,"
SELECT c.*, m.name, m.flat_no
FROM complaints c
JOIN members m ON c.member_id = m.id
WHERE c.society_id='$society_id'
ORDER BY c.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Complaints</title>

<style>
body{font-family:Poppins;background:#f1f5f9;margin:0;}
.container{padding:30px;}
.table{width:100%;background:white;border-collapse:collapse;}
.table th,.table td{padding:12px;border-bottom:1px solid #eee;}

.pending{color:red;}
.progress{color:orange;}
.resolved{color:green;}

.btn{
    padding:5px 10px;
    text-decoration:none;
    border-radius:5px;
    color:white;
    font-size:12px;
}

.btn-yellow{background:orange;}
.btn-green{background:green;}
</style>

</head>

<body>

<div class="container">

<h2>📋 Complaints Management</h2>

<table class="table">
<tr>
<th>Flat</th>
<th>Name</th>
<th>Title</th>
<th>Message</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>
<tr>

<td><?= $row['flat_no'] ?></td>
<td><?= $row['name'] ?></td>
<td><?= $row['title'] ?></td>
<td><?= $row['message'] ?></td>

<td>
<?php if($row['status']=="Resolved"){ ?>
    <span class="resolved">Resolved</span>
<?php } elseif($row['status']=="In Progress"){ ?>
    <span class="progress">In Progress</span>
<?php } else { ?>
    <span class="pending">Pending</span>
<?php } ?>
</td>

<td>

<?php if($row['status']=="Pending"){ ?>
    <a href="?id=<?= $row['id'] ?>&status=In Progress" class="btn btn-yellow">
        Start
    </a>
<?php } ?>

<?php if($row['status']!="Resolved"){ ?>
    <a href="?id=<?= $row['id'] ?>&status=Resolved" class="btn btn-green">
        Resolve
    </a>
<?php } ?>

</td>

</tr>
<?php } ?>

</table>

</div>

</body>
</html>