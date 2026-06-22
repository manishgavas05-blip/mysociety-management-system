<?php
session_start();
include("../../config/db.php");

$id = $_GET['id'];

$member = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM members WHERE id='$id'")
);

if(isset($_POST['update'])){
    mysqli_query($conn,"
        UPDATE members SET
        name='{$_POST['name']}',
        phone='{$_POST['phone']}',
        flat_no='{$_POST['flat_no']}'
        WHERE id='$id'
    ");
    header("Location: index.php");
}
?>

<link rel="stylesheet" href="../../assets/css/members-ui.css">

<div class="form-box">
<h2>Edit Member</h2>

<form method="POST">
<input name="name" value="<?= $member['name'] ?>" required>
<input name="phone" value="<?= $member['phone'] ?>" required>
<input name="flat_no" value="<?= $member['flat_no'] ?>" required>
<button name="update">Update</button>
</form>
</div>
