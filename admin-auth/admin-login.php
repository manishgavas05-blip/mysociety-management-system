<?php
session_start();
include("../config/db.php");

if(isset($_POST['login'])){

    $mobile   = $_POST['mobile'];
    $password = md5($_POST['password']);

    $query = mysqli_query($conn,"
        SELECT * FROM admins
        WHERE mobile='$mobile' AND password='$password'
    ");

    if(mysqli_num_rows($query) == 1){

        $admin = mysqli_fetch_assoc($query);

        $_SESSION['admin_id']   = $admin['id'];
        $_SESSION['society_id'] = $admin['society_id'];
        $_SESSION['role']       = "admin";

        header("Location: ../admin/dashboard.php");
        exit;

    } else {
        $error = "Invalid mobile number or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="../assets/css/form-royal.css">
</head>

<body>

<div class="form-box">
<h2>Admin Login</h2>

<?php if(isset($error)){ ?>
<p style="color:red;"><?= $error ?></p>
<?php } ?>

<form method="POST">

<input type="text" name="society_code" placeholder="Society Code" required>

<input type="text" name="mobile" placeholder="Mobile Number" required>

<input type="password" name="password" placeholder="Password" required>

<button name="login">Login</button>

</form>
</div>

</body>
</html>
