<?php
session_start();
include("config/db.php");

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($conn,
        "SELECT * FROM users 
         WHERE username='$username' 
         AND password='$password'");

    if(mysqli_num_rows($query) == 1){

        $user = mysqli_fetch_assoc($query);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        // ✅ REDIRECT
        if($user['role'] == "admin"){
            header("Location: admin/dashboard.php");
            exit;
        } else {
            header("Location: member/dashboard.php");
            exit;
        }

    } else {
        header("Location: index.php?error=1");
        exit;
    }
}
?>
