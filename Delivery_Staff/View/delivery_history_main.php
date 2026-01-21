<?php
session_start();
$email = $_SESSION["email"] ??"";
include "../controller/dashboard_card_value.php";
?>

<html>
<head>
     <link rel="stylesheet" href="../css/dashboard.css">
</head>

    <body>
<nav class="navbar">
    <div class="logo"> Pawfect Pals</div>

    <ul class="nav-links">
        <li><a href="dashboard.php">Home</a></li>
        <!-- <li><a href="#">Assigned Orders</a></li> -->
        <li><a href="delivery_history_main.php" target="_self">Delivery History</a></li>
       
       <li><a href="order_filtered.php">Filtered Order</a></li>
        <!-- <a href="dashboard.php" style=" background-color: red; font-size: 18px; ">Back</a> -->
        <!-- <li><a href="dashboard.php" class="logout"><--Back</a></li> -->



        <li><a href="../controller/logout.php" class="logout">Logout</a></li>
    </ul>
</nav>




        <img src="..\images\deliveredimg2.png" alt="Delivered img -img" style="width:100%;height:300px;">
        
       <div class="cards">

        <div class="card">
            <h3>Out for Delivery</h3>
            <p><?php echo $outForDelivery; ?></p>
        </div>

        <div class="card">
            <h3>Delivered</h3>
            <p><?php echo $deliveredCount; ?></p>
        </div>
        <div class="card">
            <h3>Cancelled</h3>
            <p><?php echo $cancelledCount; ?></p>
        </div>

        <!-- <div class="card">
            <h3><a href="dashboard.php" style=" background-color: red; font-size: 24px; ">Back</a></h3>
        </div>  
         -->

    </div>

    <div class="table-box">
        
        <h3>Delivered Orders</h3>
         <?php
        include "delivery_history.php";
        ?>
        

    </div> 
    </body>
</html>