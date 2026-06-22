<!DOCTYPE html>
<html>
<head>
<title>MySociety</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,#1e3a8a,#3b82f6);
    color:white;
}

/* NAVBAR */
.nav{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 60px;
}

.logo{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:22px;
    font-weight:600;
}

.logo img{
    width:40px;
}

/* HERO */
.hero{
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    height:80vh;
    text-align:center;
    padding:20px;
}

.hero img{
    width:100px;
    margin-bottom:20px;
}

.hero h1{
    font-size:50px;
    font-weight:600;
}

.hero p{
    margin-top:10px;
    opacity:0.9;
}

/* BUTTONS */
.buttons{
    margin-top:30px;
}

.btn{
    padding:14px 26px;
    margin:10px;
    border-radius:10px;
    text-decoration:none;
    font-weight:500;
    display:inline-block;
    transition:0.3s;
}

/* COLORS */
.btn-green{
    background:#22c55e;
    color:white;
}

.btn-white{
    background:white;
    color:#1e3a8a;
}

.btn-dark{
    background:#0f172a;
    color:white;
}

.btn:hover{
    transform:scale(1.05);
}

/* FEATURES */
.features{
    display:flex;
    justify-content:center;
    gap:30px;
    padding:50px;
    flex-wrap:wrap;
    background:white;
    color:black;
}

.feature{
    width:280px;
    padding:25px;
    border-radius:14px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.feature h3{
    margin:10px 0;
}

.feature p{
    font-size:14px;
    color:#64748b;
}

/* ACTION CARDS */
.actions{
    display:flex;
    justify-content:center;
    gap:30px;
    padding:50px;
    flex-wrap:wrap;
    background:#f1f5f9;
}

.action{
    width:280px;
    padding:25px;
    border-radius:14px;
    color:white;
    text-decoration:none;
    text-align:center;
    font-weight:500;
}

.green{background:#22c55e;}
.blue{background:#2563eb;}
.dark{background:#0f172a;}

.action:hover{
    transform:translateY(-5px);
}

/* FOOTER */
.footer{
    text-align:center;
    padding:20px;
    background:#1e3a8a;
}

</style>

</head>

<body>

<!-- NAVBAR -->
<div class="nav">
    <div class="logo">
        <img src="assets/images/logo.png">
        MySociety
    </div>
    <div>Smart Living Simplified</div>
</div>

<!-- HERO -->
<div class="hero">

<img src="assets/images/logo.png">

<h1>MySociety</h1>
<p>Smart Society Management System</p>

<div class="buttons">
    <a href="admin-auth/register-society.php" class="btn btn-green">Get Started</a>
    <a href="admin-auth/admin-login.php" class="btn btn-white">Admin Login</a>
    <a href="member-auth/member-login.php" class="btn btn-dark">Member Login</a>
</div>

</div>

<!-- FEATURES -->
<div class="features">

<div class="feature">
    <h3>🏢 Society Management</h3>
    <p>Manage all operations digitally with ease</p>
</div>

<div class="feature">
    <h3>👥 Member Portal</h3>
    <p>Members can view bills, notices and complaints</p>
</div>

<div class="feature">
    <h3>⚡ Fast & Secure</h3>
    <p>Secure and smooth login system</p>
</div>

</div>

<!-- ACTION CARDS -->
<div class="actions">

<a href="admin-auth/register-society.php" class="action green">
    Register Your Society
</a>

<a href="admin-auth/admin-login.php" class="action blue">
    Admin Login
</a>

<a href="member-auth/member-login.php" class="action dark">
    Member Login
</a>

</div>

<!-- FOOTER -->
<div class="footer">
    © 2026 MySociety | Field Project
</div>

</body>
</html>