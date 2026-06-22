<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../config/db.php");

/* 🔐 LOGIN CHECK */
if(!isset($_SESSION['member_id'])){
    header("Location: ../member-auth/member-login.php");
    exit;
}

$society_id = $_SESSION['society_id'] ?? 0;

/* FETCH DATA */
$result = mysqli_query($conn,"
SELECT * FROM society_profile
WHERE society_id='$society_id'
LIMIT 1
");

$data = mysqli_fetch_assoc($result);

/* DEFAULT SAFE DATA */
$data = $data ?? [
    'society_name'=>'-',
    'registration_no'=>'-',
    'address'=>'-',
    'city'=>'-',
    'state'=>'-',
    'pincode'=>'-',
    'chairman_name'=>'-',
    'secretary_name'=>'-',
    'treasurer_name'=>'-',
    'contact_number'=>'-',
    'email'=>'-',
    'total_flats'=>'-',
    'total_blocks'=>'-',
    'parking_slots'=>'-',
    'bank_name'=>'-',
    'account_number'=>'-',
    'ifsc_code'=>'-',
    'emergency_contact'=>'-',
    'society_rules'=>'-'
];
?>

<!DOCTYPE html>
<html>
<head>
<title>Society Information</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

<style>

body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:#f1f5f9;
}

.main{
    padding:30px;
}

h2{
    margin-bottom:20px;
}

/* CARD */
.card{
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.05);
}

/* GRID */
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:15px;
}

.item{
    background:#f8fafc;
    padding:12px;
    border-radius:8px;
}

.label{
    font-size:13px;
    color:#64748b;
}

.value{
    font-weight:600;
}

.rules{
    margin-top:20px;
    background:#eef2ff;
    padding:15px;
    border-radius:10px;
}

</style>

</head>

<body>

<div class="main">

<h2>🏢 Society Information</h2>

<div class="card">

<div class="grid">

<div class="item"><div class="label">Society Name</div><div class="value"><?= $data['society_name'] ?></div></div>

<div class="item"><div class="label">Registration No</div><div class="value"><?= $data['registration_no'] ?></div></div>

<div class="item"><div class="label">Address</div><div class="value"><?= $data['address'] ?></div></div>

<div class="item"><div class="label">City</div><div class="value"><?= $data['city'] ?></div></div>

<div class="item"><div class="label">State</div><div class="value"><?= $data['state'] ?></div></div>

<div class="item"><div class="label">Pincode</div><div class="value"><?= $data['pincode'] ?></div></div>

<div class="item"><div class="label">Chairman</div><div class="value"><?= $data['chairman_name'] ?></div></div>

<div class="item"><div class="label">Secretary</div><div class="value"><?= $data['secretary_name'] ?></div></div>

<div class="item"><div class="label">Treasurer</div><div class="value"><?= $data['treasurer_name'] ?></div></div>

<div class="item"><div class="label">Contact Number</div><div class="value"><?= $data['contact_number'] ?></div></div>

<div class="item"><div class="label">Email</div><div class="value"><?= $data['email'] ?></div></div>

<div class="item"><div class="label">Total Flats</div><div class="value"><?= $data['total_flats'] ?></div></div>

<div class="item"><div class="label">Total Blocks</div><div class="value"><?= $data['total_blocks'] ?></div></div>

<div class="item"><div class="label">Parking Slots</div><div class="value"><?= $data['parking_slots'] ?></div></div>

<div class="item"><div class="label">Bank Name</div><div class="value"><?= $data['bank_name'] ?></div></div>


<div class="item"><div class="label">Emergency Contact</div><div class="value"><?= $data['emergency_contact'] ?></div></div>

</div>



</div>

</div>

</body>
</html>