<?php
include("../../config/db.php");

$polls = mysqli_query($conn,"SELECT * FROM polls ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Poll Results</title>
<link rel="stylesheet" href="../../assets/css/light-royal.css">
</head>

<body>

<div class="container">

<h2>Voting Polls</h2>

<?php while($p=mysqli_fetch_assoc($polls)){ ?>

<div class="card">
<h3><?= $p['question'] ?></h3>

<?php
$options = mysqli_query($conn,"SELECT * FROM poll_options WHERE poll_id='{$p['id']}'");
while($o=mysqli_fetch_assoc($options)){
    echo "<p>{$o['option_text']} : {$o['votes']} votes</p>";
}
?>

</div>
<br>

<?php } ?>

</div>

</body>
</html>
