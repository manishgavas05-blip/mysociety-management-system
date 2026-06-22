<?php
session_start();
include("../../config/db.php");

$society_id = $_SESSION['society_id'];

if(isset($_POST['save'])){
    $title = $_POST['title'];
    $msg = $_POST['message'];

    mysqli_query($conn,"
        INSERT INTO notices (society_id,title,message)
        VALUES ('$society_id','$title','$msg')
    ");

    echo "<script>alert('Notice published successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Notice</title>
<link rel="stylesheet" href="../../assets/css/light-royal.css">
</head>

<body>

<div class="container">

<h2>Publish Notice</h2>

<form method="POST" class="card">

<input type="text" name="title" placeholder="Notice Title" required>

<textarea name="message" placeholder="Notice description" required></textarea>

<button name="save">Publish Notice</button>

</form>

</div>

</body>
</html>
