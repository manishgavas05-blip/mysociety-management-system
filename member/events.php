<?php
session_start();
include("../config/db.php");

$society_id = $_SESSION['society_id'];

$events = mysqli_query($conn,"
SELECT * FROM events
WHERE society_id='$society_id'
ORDER BY event_date ASC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Society Events</title>
<link rel="stylesheet" href="../assets/css/light-royal.css">
</head>

<body>

<div class="container">
<h2>Upcoming Events</h2>

<?php while($e=mysqli_fetch_assoc($events)){ ?>

<div class="card">
    <h3><?= $e['title'] ?></h3>
    <p><b>Date:</b> <?= $e['event_date'] ?></p>
    <p><b>Time:</b> <?= $e['event_time'] ?></p>
    <p><b>Venue:</b> <?= $e['venue'] ?></p>
    <p><?= nl2br($e['description']) ?></p>
</div>
<br>

<?php } ?>

</div>

</body>
</html>
