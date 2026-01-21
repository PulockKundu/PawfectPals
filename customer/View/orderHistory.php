<?php
session_start();
include "../Model/databaseConnection.php";

if(!isset($_SESSION["isLoggedIn"])){ 
    header("Location: login.php"); 
    exit(); 
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$currentCustomer = $_SESSION["userName"]; 

$sql = "SELECT * FROM orderdetails WHERE customername = '$currentCustomer' ORDER BY orderid DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Order History</title>
    <style>
        body { 
            font-family: Arial; 
            background: #c6d2d2; 
            padding: 20px; }
        .history-container { 
            background: white; 
            padding: 20px; 
            border-radius: 10px; }
        table { 
            width: 100%; 
            border-collapse: collapse; }
        th, td { 
            padding: 10px; 
            border: 1px solid #ddd; 
            text-align: left; }
        .status-processing { 
            color: orange; 
            font-weight: bold; }
        .status-delivered { 
            color: green; 
            font-weight: bold; }
    </style>
</head>
<body>
    <div class="history-container">
        <h2>Welcome <?php echo $currentCustomer; ?>, Your Orders:</h2>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Location</th>
                <th>Status</th>
            </tr>
            <?php if($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>#<?php echo $row['orderid']; ?></td>
                    <td><?php echo $row['orderdate']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td class="status-<?php echo strtolower(str_replace(' ', '', $row['status'])); ?>">
                        <?php echo $row['status']; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">No orders found.</td></tr>
            <?php endif; ?>
        </table>
        <br>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>