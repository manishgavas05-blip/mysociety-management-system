<?php
session_start();
include("../config/db.php");

$member_id  = $_SESSION['member_id'];
$society_id = $_SESSION['society_id'];

if(isset($_POST['submit'])){
    $cat = $_POST['category'];
    $desc = $_POST['description'];

    mysqli_query($conn,"
        INSERT INTO complaints
        (society_id,member_id,category,description)
        VALUES
        ('$society_id','$member_id','$cat','$desc')
    ");

    echo "<script>alert('Complaint submitted successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Raise Complaint</title>
<link rel="stylesheet" href="../assets/css/light-royal.css">
</head>

<body>

<div class="container">
<h2>Raise Complaint</h2>

<form method="POST" class="card">

<select name="category" required>
<option value="">Select Category</option>
<option>Water</option>
<option>Lift</option>
<option>Electricity</option>
<option>Parking</option>
<option>Security</option>
<option>Other</option>
</select>

<textarea name="description" placeholder="Describe your issue" required></textarea>

<button name="submit">Submit Complaint</button>

</form>
</div>

</body>
</html>
