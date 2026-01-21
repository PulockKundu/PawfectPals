<?php
session_start();
if(!($_SESSION["isLoggedIn"] ?? false)){
    header("Location: AdminLogin.php");
    exit();
}
?>

<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial; background: #f4f7f6; margin: 0; display: flex; }
        .sidebar { width: 250px; background: #2c3e50; color: white; height: 100vh; padding: 20px; }
        .sidebar h2 { text-align: center; color: #1abc9c; }
        .sidebar a { display: block; color: white; padding: 15px; text-decoration: none; border-bottom: 1px solid #34495e; }
        .sidebar a:hover { background: #34495e; }
        .main-content { flex: 1; padding: 40px; }
        .card-container { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .btn-logout { background: #e74c3c; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; float: right; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Pawfect Pals</h2>
    <a href="AdminDashboard.php">Dashboard</a>
    <a href="manageUsers.php">Manage Users</a>
    <a href="manageProducts.php">Manage Products</a>
    <a href="manageOrders.php">Monitor Orders</a>
    <a href="AdminReports.php">View Reports</a> 
    <a href="AdminProfile.php">Account Settings</a> 
    <a href="../Controller/handleLogout.php" style="color: #edbb99;">Logout</a>
</div>

<div class="main-content">
    <a href="../Controller/handleLogout.php" class="btn-logout">Logout</a>
    <h1>Welcome, <?php echo $_SESSION["userName"]; ?>!</h1>
    <p>Admin Control Panel</p>

    <div class="card-container">
        <div class="card">
            <h3>Users</h3>
            <p>Add, Remove, or Edit Roles</p>
            <a href="manageUsers.php">Go to Users</a>
        </div>
        <div class="card">
            <h3>Inventory</h3>
            <p>Update stock and prices</p>
            <a href="manageProducts.php">Go to Inventory</a>
        </div>
        <div class="card">
            <h3>My Profile</h3>
            <p>Change password & info</p>
            <a href="AdminProfile.php">Manage Account</a>
        </div>
    </div>
</div>

</body>
</html>