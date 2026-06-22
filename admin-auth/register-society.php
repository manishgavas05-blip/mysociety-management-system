<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../config/db.php");

/* 🔹 GENERATE SOCIETY CODE */
function generateCode(){
    return "SOC".rand(1000,9999);
}

if(isset($_POST['register'])){

    $society_name = $_POST['society_name'];
    $address      = $_POST['address'];
    $city         = $_POST['city'];

    $admin_name   = $_POST['admin_name'];
    $mobile       = $_POST['mobile'];
    $email        = $_POST['email'];
    $password     = md5($_POST['password']);

    $society_code = generateCode();

    /* INSERT SOCIETY */
    mysqli_query($conn,"
    INSERT INTO societies (society_name,address,city,society_code)
    VALUES ('$society_name','$address','$city','$society_code')
    ");

    $society_id = mysqli_insert_id($conn);

    /* INSERT ADMIN */
    mysqli_query($conn,"
    INSERT INTO admins (society_id,admin_name,mobile,email,password)
    VALUES ('$society_id','$admin_name','$mobile','$email','$password')
    ");

    $success_msg = "Your society registered successfully!";
    $generated_code = $society_code;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register Society</title>

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

/* MAIN CARD */
.container{
    width:420px;
    background:white;
    padding:30px;
    border-radius:14px;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
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

/* SUCCESS BOX */
.success-box{
    background:#f0fdf4;
    border:1px solid #22c55e;
    padding:15px;
    border-radius:10px;
    text-align:center;
    margin-bottom:15px;
}

.success-box h3{
    color:#16a34a;
}

.code{
    font-size:20px;
    font-weight:600;
    background:#2563eb;
    color:white;
    padding:8px;
    border-radius:8px;
    margin:10px 0;
}

.btn-login{
    display:inline-block;
    padding:10px 18px;
    background:#2563eb;
    color:white;
    text-decoration:none;
    border-radius:8px;
    margin-top:10px;
}

hr{
    margin:15px 0;
}

</style>

</head>

<body>

<div class="container">

<h2>🏢 Register Society</h2>

<?php if(isset($success_msg)){ ?>
<div class="success-box">
    <h3><?= $success_msg ?></h3>
    <p>Your Society Code:</p>
    <div class="code"><?= $generated_code ?></div>
    <a href="admin-login.php" class="btn-login">Go to Admin Login</a>
</div>
<?php } ?>

<form method="POST">

<input type="text" name="society_name" placeholder="Society Name" required>

<input type="text" name="address" placeholder="Address" required>

<input type="text" name="city" placeholder="City" required>

<hr>

<input type="text" name="admin_name" placeholder="Admin Name" required>

<input type="text" name="mobile" placeholder="Mobile Number" required>

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button name="register">Create Society</button>

</form>

</div>

</body>
</html>