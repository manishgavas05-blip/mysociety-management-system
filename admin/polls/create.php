<?php
session_start();
include("../../config/db.php");

if(!isset($_SESSION['admin_id'])){
    header("Location: ../../admin-auth/admin-login.php");
    exit;
}

$society_id = $_SESSION['society_id'];

if(isset($_POST['create'])){

    $question = $_POST['question'];

    mysqli_query($conn,"
    INSERT INTO polls (society_id, question)
    VALUES ('$society_id','$question')
    ");

    $poll_id = mysqli_insert_id($conn);

    foreach($_POST['options'] as $opt){
        if(!empty($opt)){
            mysqli_query($conn,"
            INSERT INTO poll_options (poll_id, option_text)
            VALUES ('$poll_id','$opt')
            ");
        }
    }

    $success = "Poll Created Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Create Poll</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

<style>

/* BODY */
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,#1e3a8a,#3b82f6);
}

/* CONTAINER */
.container{
    max-width:500px;
    margin:60px auto;
    background:white;
    padding:25px;
    border-radius:16px;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

/* TITLE */
h2{
    text-align:center;
    margin-bottom:20px;
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

/* SUCCESS */
.success{
    background:#22c55e;
    color:white;
    padding:10px;
    border-radius:8px;
    text-align:center;
    margin-bottom:15px;
}

</style>

</head>

<body>

<div class="container">

<h2>🗳 Create Poll</h2>

<?php if(isset($success)){ ?>
<div class="success"><?= $success ?></div>
<?php } ?>

<form method="POST">

<input type="text" name="question" placeholder="Enter Poll Question" required>

<input type="text" name="options[]" placeholder="Option 1" required>
<input type="text" name="options[]" placeholder="Option 2" required>
<input type="text" name="options[]" placeholder="Option 3">
<input type="text" name="options[]" placeholder="Option 4">

<button name="create">Create Poll</button>

</form>

</div>

</body>
</html>