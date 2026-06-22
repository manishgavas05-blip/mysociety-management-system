<?php
session_start();
include("../config/db.php");

$society_id = $_SESSION['society_id'];

$result = mysqli_query($conn,"
SELECT * FROM notices
WHERE society_id='$society_id'
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Society Notices</title>
<link rel="stylesheet" href="../assets/css/light-royal.css">
</head>

<body>

<div class="container">
<h2>Society Notices</h2>

<?php while($n=mysqli_fetch_assoc($result)){ ?>

<div class="card">
    <h3><?= $n['title'] ?></h3>
    <p><?= nl2br($n['message']) ?></p>
    <small>Posted on: <?= $n['created_at'] ?></small>
</div>
<br>

<?php } ?>

</div>

</body>
</html>
