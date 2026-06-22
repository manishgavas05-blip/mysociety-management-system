<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['admin_id'])){
    header("Location: ../admin-auth/admin-login.php");
    exit;
}

$society_id = $_SESSION['society_id'];
$admin_id   = $_SESSION['admin_id'];

$admin = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT admin_name FROM admins WHERE id='$admin_id'")
);

$members = mysqli_num_rows(
    mysqli_query($conn,"SELECT id FROM members WHERE society_id='$society_id'")
);

$pending = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT SUM(amount) total FROM bills
        WHERE society_id='$society_id' AND status='Pending'
    ")
);

$paid = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT SUM(amount) total FROM payments
        WHERE society_id='$society_id' AND payment_status='Success'
    ")
);

$notices = mysqli_num_rows(
    mysqli_query($conn,"SELECT id FROM notices WHERE society_id='$society_id'")
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../assets/css/admin-new-dashboard.css">
</head>

<body>

<div class="sidebar">
    <h2><?= $admin['admin_name'] ?></h2>

    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="members/index.php">👥 Members</a>
    <a href="maintenance/index.php">🧾 Maintenance</a>
    <a href="billing/generate-bill.php">💰 Bills</a>
    <a href="notices/add.php">📢 Notices</a>
    <a href="events/add.php">🎉 Events</a>
    <a href="polls/create.php">🗳 Voting</a>
    <a href="polls/results.php">🗳 Voting Results</a>
    <a href="complaints/view.php">🛠 Complaints</a>
    <a href="society/profile.php">Society info</a>


    <a href="../logout.php">🚪 Logout</a>
</div>

<div class="main">

    <div class="header">
        <h2>Welcome, <?= $admin['admin_name'] ?> 👋</h2>
        <span>Society Admin Dashboard</span>
    </div>

    <div class="cards">

        <div class="card">
            <h3>Total Members</h3>
            <p><?= $members ?></p>
        </div>

        <div class="card">
            <h3>Pending Amount</h3>
            <p>₹<?= $pending['total'] ?? 0 ?></p>
        </div>

        <div class="card">
            <h3>Total Collection</h3>
            <p>₹<?= $paid['total'] ?? 0 ?></p>
        </div>

        <div class="card">
            <h3>Notices</h3>
            <p><?= $notices ?></p>
        </div>

    </div>

</div>

</body>
</html>
