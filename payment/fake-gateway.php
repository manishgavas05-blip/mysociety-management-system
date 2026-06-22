<?php
session_start();
include("../config/db.php");

$bill_id = $_GET['bill_id'];
$bill = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM bills WHERE id='$bill_id'"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Secure Payment</title>
<link rel="stylesheet" href="../assets/css/light-royal.css">
<style>
.paybox{
    width:420px;
    margin:auto;
    background:#fff;
    border-radius:18px;
    padding:25px;
    box-shadow:0 20px 50px rgba(0,0,0,.15);
}
.tabs button{
    padding:10px 15px;
    border:none;
    background:#f1f5f9;
    margin:5px;
    border-radius:8px;
    cursor:pointer;
}
.tabs button.active{
    background:#2563eb;
    color:white;
}
input{
    width:100%;
    padding:12px;
    margin:10px 0;
}
.success{
    text-align:center;
    display:none;
}
.check{
    width:90px;
    height:90px;
    border-radius:50%;
    background:#22c55e;
    margin:20px auto;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:50px;
}
</style>
</head>

<body>

<div class="paybox">

<h3>Pay Maintenance</h3>
<p><b>Amount:</b> ₹<?= $bill['amount'] ?></p>

<div class="tabs">
    <button class="active" onclick="show('upi',this)">UPI</button>
    <button onclick="show('card',this)">Card</button>
</div>

<div id="upi">
    <input placeholder="example@upi">
    <button class="btn" onclick="pay()">Pay ₹<?= $bill['amount'] ?></button>
</div>

<div id="card" style="display:none">
    <input placeholder="Card Number">
    <input placeholder="MM/YY">
    <input placeholder="CVV">
    <button class="btn" onclick="pay()">Pay ₹<?= $bill['amount'] ?></button>
</div>

<div class="success" id="success">
    <div class="check">✔</div>
    <h3>Payment Successful</h3>
</div>

</div>

<script>
function show(id,btn){
    document.getElementById('upi').style.display='none';
    document.getElementById('card').style.display='none';
    document.getElementById(id).style.display='block';
    document.querySelectorAll('.tabs button').forEach(b=>b.classList.remove('active'));
    btn.classList.add('active');
}

function pay(){
    document.getElementById("success").style.display="block";
    setTimeout(()=>{
        window.location.href="success.php?bill_id=<?= $bill_id ?>";
    },2000);
}
</script>

</body>
</html>
