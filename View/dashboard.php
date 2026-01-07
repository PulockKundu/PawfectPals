<?php
session_start();
$isLoggedIn= $_SESSION["isLoggedIn"] ?? false;
if(!$isLoggedIn){
    Header("Location: login.php");
}
// if($isLoggedIn){
//     Header("Location: orders.php");
// }

$email = $_SESSION["email"] ??"";
// <a href="..\controller\logout.php">Logout</a>
setcookie("webtech_section_u", "Theory", time()+3600);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delivery Dashboard | Pawfect Pals</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

<!-- 🔹 NAVBAR -->
<nav class="navbar">
    <div class="logo"> Pawfect Pals</div>

    <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="#">Assigned Orders</a></li>
        <li><a href="#">Delivery History</a></li>
        <li><a href="#">View Profile</a></li>
        <li><a href="../controller/logout.php" class="logout">Logout</a></li>
    </ul>
</nav>
    


<!-- 🔹 MAIN CONTENT -->
<div class="container">
    <p class="subtitle">Delivery Staff Dashboard</p>
    <h2>Welcome, <?php echo htmlspecialchars($email); ?></h2>
    
    <img src="..\images\deliveryimg.jpg" alt="Delivery-van-driver-img" style="width:100%;height:300px;">

    <!-- 🔹 SUMMARY CARDS -->
    <div class="cards">

        <div class="card">
            <h3>Assigned Orders</h3>
            <p>5</p>
        </div>

        <div class="card">
            <h3>Out for Delivery</h3>
            <p>2</p>
        </div>

        <div class="card">
            <h3>Delivered</h3>
            <p>18</p>
        </div>

    </div>

    <!-- 🔹 ASSIGNED ORDERS TABLE -->
    <div class="table-box">
        
        <h3>Assigned Deliveries</h3>
         <?php
        include "orders.php";
        ?>
        

        <!-- <table>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Location</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <tr>
                <td>#1023</td>
                <td>Rahim</td>
                <td>Dhaka</td>
                <td>Pending</td>
                <td>
                    <select>
                        <option>Pending</option>
                        <option>Out for Delivery</option>
                        <option>Delivered</option>
                        <option>Canceled</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>#1024</td>
                <td>Karim</td>
                <td>Uttara</td>
                <td>Out for Delivery</td>
                <td>
                    <select>
                        <option>Pending</option>
                        <option>Out for Delivery</option>
                        <option>Delivered</option>
                        <option>Canceled</option>
                    </select>
                </td>
            </tr>

        </table> -->


    </div>

</div>

</body>
</html>
