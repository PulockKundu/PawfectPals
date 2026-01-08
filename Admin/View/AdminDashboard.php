<?php
session_start();
if(!($_SESSION["isLoggedIn"] ?? false)){
    header("Location: AdminLogin.php");
}
?>

<html>
<head>
<title>Admin Dashboard</title>

<style>
body{
    margin:0;
    font-family: Arial, sans-serif;
    background: #cce6ff; 
}

/* Top Header */
.header{
    background: #1e3a8a; 
    color:white;
    padding:20px;
    text-align:center;
    font-size:26px;
    font-weight:bold;
}

/* Main Layout */
body, html{
    height:100%;
}

.main{
    display:flex;
    height:100%;
}

/* Left Sidebar */
.sidebar{
    width:260px;
    background:#3b82f6; 
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
}

.sidebar h2{
    text-align:center;
    border-bottom:2px solid rgba(255,255,255,0.6);
    padding-bottom:10px;
}

/* Right Content */
.content{
    flex:1;
    background:#e0f0ff;   
    margin:30px;
    padding:40px;
    position:relative;
}

/* Welcome text */
.welcome{
    text-align:center;
    font-size:18px;
    margin-bottom:40px;
    color:#1e3a8a; 
}

/* Cards */
.cards{
    display:flex;
    gap:20px;
}

.card{
    flex:1;
    background:#93c5fd; 
    padding:30px;
    text-align:center;
    text-decoration:none;
    color:#1e3a8a; 
}

.card h3{
    margin-bottom:10px;
}

.card:hover{
    background:#1e40af;  
    color:white;
}

/* Logout Button */
.logout{
    position:absolute;
    bottom:25px;
    right:25px;
    padding:12px 20px;
    background:#ef4444;  /* bright red */
    color:white;
    text-decoration:none;
}

.logout:hover{
    background:#b91c1c;  
}

</style>
</head>

<body>

<div class="header">
    Pawfect Pals
</div>

<div class="main">

    <!-- Left Sidebar -->
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
    </div>

    <!-- Right Content -->
    <div class="content">

        <div class="welcome">
            Welcome, <b><?php echo $_SESSION["email"]; ?></b><br>
        </div>

        <div class="cards">
            <a href="manageUsers.php" class="card">
                <h3>Manage Users</h3>
            </a>

            <a href="manageProducts.php" class="card">
                <h3>Manage Products</h3>
            </a>

            <a href="orders.php" class="card">
                <h3>View Orders</h3>
            </a>
        </div>

        <a href="../Controller/AdminLogout.php" class="logout">Logout</a>

    </div>

</div>
</body>
</html>
