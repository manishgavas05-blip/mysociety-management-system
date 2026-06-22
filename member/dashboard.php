<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../config/db.php");

/* 🔐 login check */
if(!isset($_SESSION['member_id'])){
    header("Location: ../member-auth/member-login.php");
    exit;
}

$member_id  = $_SESSION['member_id'] ?? 1;
$society_id = $_SESSION['society_id'] ?? 1;

/* ✅ member fetch */
$member_q = mysqli_query($conn,"SELECT name, flat_no FROM members WHERE id='$member_id'");
$member = mysqli_fetch_assoc($member_q);

/* fallback (demo safe) */
$name = $member['name'] ?? "Demo User";
$flat = $member['flat_no'] ?? "101";

/* pending bills */
$pending = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(amount) total FROM bills
WHERE member_id='$member_id' AND status='Pending'
"));

/* notices */
$notices = mysqli_num_rows(mysqli_query($conn,"
SELECT id FROM notices WHERE society_id='$society_id'
"));

/* events */
$events = mysqli_num_rows(mysqli_query($conn,"
SELECT id FROM events WHERE society_id='$society_id'
"));

/* complaints */
$complaints = mysqli_num_rows(mysqli_query($conn,"
SELECT id FROM complaints WHERE member_id='$member_id'
"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Member Dashboard</title>
<link rel="stylesheet" href="../assets/css/member-dashboard.css">
</head>

<body>

<div class="sidebar">
    <h3>Member Panel</h3>

    <a href="dashboard.php">🏠 Home</a>
    <a href="bills.php">💰 My Bills</a>
    <a href="notices.php">📢 Notices</a>
    <a href="events.php">🎉 Events</a>
    <a href="polls.php">🗳 Voting</a>
    <a href="complaints.php">🛠 Complaints</a>
    <a href="society-profile.php">🏢 Society Info</a>
    <a href="../logout.php">🚪 Logout</a>
</div>

<div class="main">

<div class="header">
    <h2>Welcome, <?= $name ?> 👋</h2>
    <span>Flat <?= $flat ?></span>
</div>

<div class="cards">

    <div class="card">
        <h3>Pending Maintenance</h3>
        <p>₹<?= $pending['total'] ?? 0 ?></p>
        <a href="bills.php">Pay Now →</a>
    </div>

    <div class="card">
        <h3>Notices</h3>
        <p><?= $notices ?></p>
        <a href="notices.php">View →</a>
    </div>

    <div class="card">
        <h3>Events</h3>
        <p><?= $events ?></p>
        <a href="events.php">View →</a>
    </div>

    <div class="card">
        <h3>Complaints</h3>
        <p><?= $complaints ?></p>
        <a href="complaints.php">Track →</a>
    </div>

</div>

</div>

</body>
</html>]