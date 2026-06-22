<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../config/db.php");

if(!isset($_SESSION['member_id'])){
    die("Login required");
}

$member_id = $_SESSION['member_id'];
$poll_id   = $_POST['poll_id'] ?? '';
$option_id = $_POST['option_id'] ?? '';

/* VALIDATION */
if(!$poll_id || !$option_id){
    die("Invalid data");
}

/* CHECK ALREADY VOTED */
$check = mysqli_query($conn,"
SELECT id FROM poll_votes
WHERE poll_id='$poll_id' AND member_id='$member_id'
");

if(mysqli_num_rows($check) > 0){
    die("You already voted!");
}

/* INSERT VOTE */
$insert = mysqli_query($conn,"
INSERT INTO poll_votes (poll_id, option_id, member_id)
VALUES ('$poll_id','$option_id','$member_id')
");

/* ERROR CHECK */
if(!$insert){
    die("Error: ".mysqli_error($conn));
}

/* SUCCESS */
header("Location: polls.php?success=1");
exit;