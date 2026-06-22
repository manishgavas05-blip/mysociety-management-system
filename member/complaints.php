<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['member_id'])){
    header("Location: ../member-auth/member-login.php");
    exit;
}

$member_id = $_SESSION['member_id'];
$society_id = $_SESSION['society_id'];

/* ADD COMPLAINT */
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $message = $_POST['message'];

    mysqli_query($conn,"
    INSERT INTO complaints (society_id, member_id, title, message)
    VALUES ('$society_id','$member_id','$title','$message')
    ");

    $success = "Complaint submitted successfully!";
}

/* FETCH MY COMPLAINTS */
$data = mysqli_query($conn,"
SELECT * FROM complaints
WHERE member_id='$member_id'
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Complaints</title>

<style>
body{font-family:Poppins;background:#f1f5f9;margin:0;}
.container{padding:30px;}
form{background:white;padding:20px;border-radius:10px;margin-bottom:20px;}
input,textarea{width:100%;padding:10px;margin:10px 0;}
button{background:#2563eb;color:white;padding:10px;border:none;}
.table{width:100%;background:white;border-collapse:collapse;}
.table th,.table td{padding:10px;border-bottom:1px solid #eee;}
.pending{color:red;}
.resolved{color:green;}
</style>

</head>

<body>

<div class="container">

<h2>🛠 Raise Complaint</h2>

<?php if(isset($success)) echo "<p style='color:green'>$success</p>"; ?>

<form method="POST">
<input type="text" name="title" placeholder="Complaint Title" required>
<textarea name="message" placeholder="Write your issue..." required></textarea>
<button name="submit">Submit Complaint</button>
</form>

<h3>My Complaints</h3>

<table class="table">
<tr>
<th>Title</th>
<th>Message</th>
<th>Status</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>
<tr>
<td><?= $row['title'] ?></td>
<td><?= $row['message'] ?></td>
<td>
<?php if($row['status']=="Resolved"){ ?>
<span class="resolved">Resolved</span>
<?php } else { ?>
<span class="pending">Pending</span>
<?php } ?>
</td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>