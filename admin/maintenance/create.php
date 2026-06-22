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

/* ===============================
   CREATE MAINTENANCE
==================================*/
if(isset($_POST['save'])){

    $title     = $_POST['title'] ?? '';
    $amount    = $_POST['amount'] ?? 0;
    $frequency = $_POST['frequency'] ?? '';
    $month     = $_POST['month'] ?? '';
    $year      = $_POST['year'] ?? '';
    $due_days  = $_POST['due_days'] ?? 0;
    $late_fee  = $_POST['late_fee'] ?? 0;

    if($title && $amount){

        mysqli_query($conn,"
            INSERT INTO maintenance_master
            (society_id,title,amount,frequency,start_month,start_year,due_after_days,late_fee,status)
            VALUES
            ('$society_id','$title','$amount','$frequency','$month','$year','$due_days','$late_fee','Active')
        ");

        header("Location: index.php?created=1");
        exit;
    }

    $error = "Please fill required fields.";
}
?>

<!-- 🔹 ONLY FORM — USE YOUR EXISTING DASHBOARD LAYOUT -->

<div class="main">

<div class="form-box">
<h2>Create Maintenance</h2>

<?php if(isset($error)){ ?>
<p style="color:red;font-weight:600;"><?= $error ?></p>
<?php } ?>

<form method="POST">

<label>Maintenance Title</label>
<input type="text" name="title" required>

<label>Amount (₹)</label>
<input type="number" step="0.01" name="amount" required>

<label>Frequency</label>
<select name="frequency" required>
    <option value="">Select</option>
    <option>Monthly</option>
    <option>Quarterly</option>
    <option>Yearly</option>
</select>

<label>Start Month</label>
<select name="month" required>
<option>January</option>
<option>February</option>
<option>March</option>
<option>April</option>
<option>May</option>
<option>June</option>
<option>July</option>
<option>August</option>
<option>September</option>
<option>October</option>
<option>November</option>
<option>December</option>
</select>

<label>Start Year</label>
<input type="number" name="year" value="<?= date('Y') ?>" required>

<label>Due After (days)</label>
<input type="number" name="due_days" value="10">

<label>Late Fee (₹)</label>
<input type="number" step="0.01" name="late_fee" value="0">

<br><br>
<button class="btn" name="save">Create Maintenance</button>

</form>
</div>

</div>
