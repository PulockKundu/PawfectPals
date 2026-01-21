<?php
session_start();
$isLoggedIn= $_SESSION["isLoggedIn"] ?? false;
if(!$isLoggedIn){
    Header("Location: login.php");
}

$email = $_SESSION["email"] ??"";
require_once "../controller/dashboard_card_value.php";


setcookie("webtech_section_u", "Theory", time()+3600);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delivery Dashboard | Pawfect Pals</title>
    <link rel="stylesheet" href="../css/dashboard.css">
   
</head>

<body>

<nav class="navbar">
    <div class="logo"> Pawfect Pals</div>

    <ul class="nav-links">
        <li><a href="dashboard.php">Home</a></li>
       
        <li><a href="delivery_history_main.php" target="_self">Delivery History</a></li>
       
        <li><a href="order_filtered.php">Filtered Order</a></li>

        <li><a href="update_profile.php">Profile</a></li>

        <li><a href="../controller/logout.php" class="logout">Logout</a></li>
    </ul>
</nav>
    



<div class="container">
    <p class="subtitle">Delivery Staff Dashboard</p>
    <h2>Welcome, <?php echo htmlspecialchars($email); ?></h2>
    
    <img src="..\images\deliveryimg.jpg" alt="Delivery-van-driver-img" style="width:100%;height:300px;">

    <div class="cards">

        <div class="card">
            <h3>Assigned Orders</h3>
            <p><?php echo $assignedCount; ?></p>
        </div>

    </div>

    <!--  assigned order -->
    <div class="table-box">
        
        <h3>Assigned Deliveries</h3>
         <?php
        include "orders.php";
        ?>
        

    </div>

</div>
<script src="../controller/JS/update_status.js"></script>
</body>
</html>
