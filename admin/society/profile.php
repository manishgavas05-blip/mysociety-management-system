<?php
session_start();
include("../../config/db.php");

$society_id = $_SESSION['society_id'];

$data = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT * FROM society_profile
        WHERE society_id='$society_id'
    ")
);

if(isset($_POST['save'])){

    if($data){
        mysqli_query($conn,"
        UPDATE society_profile SET
        society_name='{$_POST['society_name']}',
        registration_no='{$_POST['registration_no']}',
        address='{$_POST['address']}',
        city='{$_POST['city']}',
        state='{$_POST['state']}',
        pincode='{$_POST['pincode']}',

        chairman_name='{$_POST['chairman']}',
        secretary_name='{$_POST['secretary']}',
        treasurer_name='{$_POST['treasurer']}',

        contact_number='{$_POST['contact']}',
        email='{$_POST['email']}',

        total_flats='{$_POST['flats']}',
        total_blocks='{$_POST['blocks']}',
        parking_slots='{$_POST['parking']}',

        bank_name='{$_POST['bank']}',
        account_no='{$_POST['account']}',
        ifsc='{$_POST['ifsc']}',

        emergency_contact='{$_POST['emergency']}',
        rules='{$_POST['rules']}'

        WHERE society_id='$society_id'
        ");
    } else {
        mysqli_query($conn,"
        INSERT INTO society_profile
        (society_id,society_name,registration_no,address,city,state,pincode,
        chairman_name,secretary_name,treasurer_name,
        contact_number,email,total_flats,total_blocks,parking_slots,
        bank_name,account_no,ifsc,emergency_contact,rules)

        VALUES
        ('$society_id','{$_POST['society_name']}','{$_POST['registration_no']}',
        '{$_POST['address']}','{$_POST['city']}','{$_POST['state']}','{$_POST['pincode']}',
        '{$_POST['chairman']}','{$_POST['secretary']}','{$_POST['treasurer']}',
        '{$_POST['contact']}','{$_POST['email']}','{$_POST['flats']}','{$_POST['blocks']}',
        '{$_POST['parking']}','{$_POST['bank']}','{$_POST['account']}','{$_POST['ifsc']}',
        '{$_POST['emergency']}','{$_POST['rules']}'
        )
        ");
    }

    echo "<script>alert('Society information saved successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Society Profile</title>
<link rel="stylesheet" href="../../assets/css/form-royal.css">
</head>

<body>

<div class="form-box">
<h2>Society Information</h2>

<form method="POST">

<input name="society_name" placeholder="Society Name" value="<?= $data['society_name'] ?? '' ?>">
<input name="registration_no" placeholder="Registration Number" value="<?= $data['registration_no'] ?? '' ?>">
<textarea name="address" placeholder="Address"><?= $data['address'] ?? '' ?></textarea>

<input name="city" placeholder="City" value="<?= $data['city'] ?? '' ?>">
<input name="state" placeholder="State" value="<?= $data['state'] ?? '' ?>">
<input name="pincode" placeholder="Pincode" value="<?= $data['pincode'] ?? '' ?>">

<input name="chairman" placeholder="Chairman Name" value="<?= $data['chairman_name'] ?? '' ?>">
<input name="secretary" placeholder="Secretary Name" value="<?= $data['secretary_name'] ?? '' ?>">
<input name="treasurer" placeholder="Treasurer Name" value="<?= $data['treasurer_name'] ?? '' ?>">

<input name="contact" placeholder="Contact Number" value="<?= $data['contact_number'] ?? '' ?>">
<input name="email" placeholder="Email" value="<?= $data['email'] ?? '' ?>">

<input name="flats" placeholder="Total Flats" value="<?= $data['total_flats'] ?? '' ?>">
<input name="blocks" placeholder="Total Blocks" value="<?= $data['total_blocks'] ?? '' ?>">
<input name="parking" placeholder="Parking Slots" value="<?= $data['parking_slots'] ?? '' ?>">

<input name="bank" placeholder="Bank Name" value="<?= $data['bank_name'] ?? '' ?>">


<input name="emergency" placeholder="Emergency Contact" value="<?= $data['emergency_contact'] ?? '' ?>">


<button name="save">Save Information</button>

</form>
</div>

</body>
</html>
