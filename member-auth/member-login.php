<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../config/db.php");

/* 🔐 already logged in */
if(isset($_SESSION['member_id'])){
    header("Location: ../member/dashboard.php");
    exit;
}

if(isset($_POST['login'])){

    $society_code = $_POST['society_code'] ?? '';
    $mobile       = $_POST['mobile'] ?? '';
    $password     = $_POST['password'] ?? '';

    if($society_code && $mobile && $password){

        $query = mysqli_query($conn,"
        SELECT m.*, s.society_code
        FROM members m
        JOIN societies s ON m.society_id = s.id
        WHERE s.society_code='$society_code'
        AND m.phone='$mobile'
        LIMIT 1
        ");

        if(mysqli_num_rows($query) == 1){

            $member = mysqli_fetch_assoc($query);

            /* 🔐 PASSWORD CHECK */
            if($member['password'] == md5($password)){

                $_SESSION['member_id']  = $member['id'];
                $_SESSION['society_id'] = $member['society_id'];
                $_SESSION['member_name'] = $member['name'];
                $_SESSION['role'] = "member";

                header("Location: ../member/dashboard.php");
                exit;

            } else {
                $error = "Incorrect Password (Hint: use 'admin')";
            }

        } else {
            $error = "Invalid Society Code or Mobile Number";
        }

    } else {
        $error = "Please fill all fields";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Member Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

<style>

body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,#2563eb,#3b82f6);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* LOGIN BOX */
.login-box{
    width:350px;
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
    animation:fade 0.5s ease;
}

@keyframes fade{
    from{opacity:0; transform:translateY(-10px);}
    to{opacity:1;}
}

h2{
    text-align:center;
    margin-bottom:15px;
}

/* INPUT */
input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:8px;
    border:1px solid #ddd;
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    background:#22c55e;
    color:white;
    border:none;
    border-radius:8px;
    font-weight:600;
    cursor:pointer;
}

button:hover{
    background:#16a34a;
}

/* ERROR */
.error{
    color:red;
    text-align:center;
    font-weight:600;
}

/* NOTE */
.note{
    font-size:13px;
    text-align:center;
    color:#64748b;
}

</style>

</head>

<body>

<div class="login-box">

<h2>Member Login</h2>

<p class="note">Default Password: <b>admin</b></p>

<?php if(isset($error)){ ?>
<p class="error"><?= $error ?></p>
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