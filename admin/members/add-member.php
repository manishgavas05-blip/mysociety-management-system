<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../../config/db.php");

/* 🔐 admin check */
if(!isset($_SESSION['admin_id'])){
    header("Location: ../../admin-auth/admin-login.php");
    exit;
}

$society_id = $_SESSION['society_id'] ?? 0;

/* ADD MEMBER */
if(isset($_POST['add'])){

    $name  = $_POST['name'] ?? '';
    $flat  = $_POST['flat'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';

    if($name && $flat && $phone){

        /* 🔥 DEFAULT PASSWORD = admin */
        $password = md5("admin");

        mysqli_query($conn,"
        INSERT INTO members (society_id,name,flat_no,phone,email,password)
        VALUES ('$society_id','$name','$flat','$phone','$email','$password')
        ");

        header("Location: index.php?success=1");
        exit;
    }

    $error = "Please fill all required fields.";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Member</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

<style>

/* BODY */
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:#f1f5f9;
}

/* MAIN */
.main{
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

/* FORM CARD */
.form-box{
    width:400px;
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
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
    background:#2563eb;
    color:white;
    border:none;
    border-radius:8px;
    font-weight:600;
    cursor:pointer;
}

button:hover{
    background:#1d4ed8;
}

/* MSG */
.success{
    color:green;
    text-align:center;
    font-weight:600;
}

.error{
    color:red;
    text-align:center;
    font-weight:600;
}

.note{
    font-size:13px;
    text-align:center;
    color:#64748b;
    margin-top:5px;
}

</style>

</head>

<body>

<div class="main">

<div class="form-box">

<h2>Add New Member</h2>

<p class="note">Default password is <b>admin</b></p>

<?php if(isset($_GET['success'])){ ?>
<p class="success">✅ Member added successfully</p>
<?php } ?>

<?php if(isset($error)){ ?>
<p class="error"><?= $error ?></p>
<?php } ?>

<form method="POST">

<input type="text" name="name" placeholder="Member Name" required>

<input type="text" name="flat" placeholder="Flat Number" required>

<input type="text" name="phone" placeholder="Mobile Number" required>

<input type="email" name="email" placeholder="Email Address">

<button type="submit" name="add">Add Member</button>

</form>

</div>
</div>

</body>
</html>