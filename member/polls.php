<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['member_id'])){
    header("Location: ../member-auth/member-login.php");
    exit;
}

$member_id = $_SESSION['member_id'];
$society_id = $_SESSION['society_id'];

$polls = mysqli_query($conn,"
SELECT * FROM polls WHERE society_id='$society_id'
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Voting Polls</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

<style>

/* BODY */
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,#1e3a8a,#3b82f6);
    color:white;
}

/* MAIN */
.main{
    max-width:700px;
    margin:40px auto;
    padding:20px;
}

/* TITLE */
h2{
    text-align:center;
    margin-bottom:20px;
}

/* CARD */
.card{
    background:white;
    color:black;
    padding:20px;
    border-radius:14px;
    margin-bottom:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
    animation:fade 0.5s ease;
}

@keyframes fade{
    from{opacity:0; transform:translateY(10px);}
    to{opacity:1;}
}

/* OPTIONS */
.option{
    margin:10px 0;
    padding:10px;
    border-radius:8px;
    background:#f1f5f9;
    cursor:pointer;
    transition:0.3s;
}

.option:hover{
    background:#e0e7ff;
}

/* BUTTON */
button{
    margin-top:10px;
    padding:10px 15px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
    width:100%;
}

button:hover{
    background:#1d4ed8;
}

/* SUCCESS */
.success{
    background:#22c55e;
    padding:10px;
    border-radius:8px;
    text-align:center;
    margin-bottom:15px;
}

</style>

</head>

<body>

<div class="main">

<h2>🗳 Voting Polls</h2>

<?php if(isset($_GET['success'])){ ?>
<div class="success">✅ Vote Submitted Successfully!</div>
<?php } ?>

<?php while($p=mysqli_fetch_assoc($polls)){ ?>

<div class="card">

<h3><?= $p['question'] ?></h3>

<form method="POST" action="vote.php">

<input type="hidden" name="poll_id" value="<?= $p['id'] ?>">

<?php
$options = mysqli_query($conn,"
SELECT * FROM poll_options WHERE poll_id='".$p['id']."'
");

while($o=mysqli_fetch_assoc($options)){
?>

<label class="option">
<input type="radio" name="option_id" value="<?= $o['id'] ?>" required>
<?= $o['option_text'] ?>
</label>

<?php } ?>

<button type="submit">Submit Vote</button>

</form>

</div>

<?php } ?>

</div>

</body>
</html>