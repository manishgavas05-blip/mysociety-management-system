<?php
session_start();
include("../../config/db.php");

$society_id = $_SESSION['society_id'];

if(isset($_POST['save'])){
    $title = $_POST['title'];
    $date = $_POST['event_date'];
    $time = $_POST['event_time'];
    $venue = $_POST['venue'];
    $desc = $_POST['description'];

    mysqli_query($conn,"
        INSERT INTO events
        (society_id,title,event_date,event_time,venue,description)
        VALUES
        ('$society_id','$title','$date','$time','$venue','$desc')
    ");

    echo "<script>alert('Event added successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Event</title>
<link rel="stylesheet" href="../../assets/css/light-royal.css">
</head>

<body>

<div class="container">
<h2>Add Society Event</h2>

<form method="POST" class="card">

<input type="text" name="title" placeholder="Event Title" required>

<input type="date" name="event_date" required>

<input type="text" name="event_time" placeholder="Event Time (eg: 6 PM)" required>

<input type="text" name="venue" placeholder="Venue" required>

<textarea name="description" placeholder="Event Details" required></textarea>

<button name="save">Save Event</button>

</form>

</div>

</body>
</html>
