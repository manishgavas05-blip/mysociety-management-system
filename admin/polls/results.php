<?php
session_start();
include("../../config/db.php");

if(!isset($_SESSION['admin_id'])){
    header("Location: ../../admin-auth/admin-login.php");
    exit;
}

$society_id = $_SESSION['society_id'];

$polls = mysqli_query($conn,"
SELECT * FROM polls
WHERE society_id='$society_id'
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Poll Results</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

<style>

/* BODY */
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,#0f172a,#1e3a8a);
    color:white;
}

/* MAIN */
.main{
    max-width:800px;
    margin:40px auto;
    padding:20px;
}

/* TITLE */
h2{
    text-align:center;
    margin-bottom:30px;
}

/* CARD */
.card{
    background:white;
    color:black;
    padding:20px;
    border-radius:16px;
    margin-bottom:25px;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
    animation:fade 0.5s ease;
}

@keyframes fade{
    from{opacity:0; transform:translateY(15px);}
    to{opacity:1;}
}

/* QUESTION */
.card h3{
    margin-bottom:15px;
}

/* OPTION */
.option{
    margin:12px 0;
}

/* BAR */
.bar{
    height:12px;
    background:#e2e8f0;
    border-radius:10px;
    overflow:hidden;
    margin-top:5px;
}

.fill{
    height:12px;
    background:linear-gradient(90deg,#22c55e,#16a34a);
    border-radius:10px;
}

/* TEXT */
.vote-text{
    font-size:13px;
    color:#64748b;
}

</style>

</head>

<body>

<div class="main">

<h2>📊 Poll Results</h2>

<?php while($p=mysqli_fetch_assoc($polls)){ ?>

<div class="card">

<h3><?= $p['question'] ?></h3>

<?php
$options = mysqli_query($conn,"
SELECT o.*, COUNT(v.id) AS votes
FROM poll_options o
LEFT JOIN poll_votes v ON o.id = v.option_id
WHERE o.poll_id='".$p['id']."'
GROUP BY o.id
");

$total = 0;
$temp = [];

while($o=mysqli_fetch_assoc($options)){
    $total += $o['votes'];
    $temp[] = $o;
}

foreach($temp as $o){

    $percent = $total > 0 ? ($o['votes']/$total)*100 : 0;
?>

<div class="option">
    <b><?= $o['option_text'] ?></b>
    <div class="vote-text"><?= $o['votes'] ?> votes (<?= round($percent) ?>%)</div>

    <div class="bar">
        <div class="fill" style="width:<?= $percent ?>%"></div>
    </div>
</div>

<?php } ?>

</div>

<?php } ?>

</div>

</body>
</html>