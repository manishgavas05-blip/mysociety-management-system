<?php
session_start();
include("../../config/db.php");

$society_id = $_SESSION['society_id'];

$members = mysqli_query($conn,"
SELECT * FROM members WHERE society_id='$society_id'
");
?>

<link rel="stylesheet" href="../../assets/css/members-ui.css">

<div class="main">

<div class="top-bar">
    <h2>Society Members</h2>
    <a href="add-member.php" class="btn">+ Add Member</a>
</div>

<div class="grid">

<?php while($m=mysqli_fetch_assoc($members)){ ?>

<div class="card">
    <div class="avatar"><?= strtoupper($m['name'][0]) ?></div>
    <h3><?= $m['name'] ?></h3>
    <p>Flat: <?= $m['flat_no'] ?></p>
    <p>📞 <?= $m['phone'] ?></p>

    <div class="actions">
        <a href="edit-member.php?id=<?= $m['id'] ?>" class="edit">Edit</a>
        <a href="delete-member.php?id=<?= $m['id'] ?>" class="delete"
           onclick="return confirm('Delete member?')">Delete</a>
    </div>
</div>

<?php } ?>

</div>
</div>
