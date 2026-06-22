<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header("Location: ../../index.php");
    exit;
}

include("../../config/db.php");

$result = mysqli_query($conn,"SELECT * FROM members");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Members</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>

<body>

<div class="main">

    <h2>Society Members</h2>

    <!-- ✅ ADD MEMBER BUTTON -->
    <a href="add-member.php" class="btn-add">+ Add Member</a>

    <br><br>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Flat</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['flat_no'] ?></td>
            <td><?= $row['mobile'] ?></td>
            <td><?= $row['email'] ?></td>
            <td>
                <a href="edit-member.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                <a href="delete-member.php?id=<?= $row['id'] ?>" 
                   class="btn-delete"
                   onclick="return confirm('Delete this member?')">
                   Delete
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>
