<?php
session_start();
if(!($_SESSION["isLoggedIn"] ?? false)) {
    header("Location: AdminLogin.php");
    exit();
}

include "../Model/DatabaseConnection.php";
$db = new DatabaseConnection();
$conn = $db->openConnection();
$orders = $db->getAllOrders($conn);
?>

<html>
<head>
    <title>Manage Orders</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { background-color: white; padding: 20px; border: 1px solid #000; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 12px; text-align: left; }
        th { background-color: #eeeeee; }
        .btn-update { 
            background-color: #4CAF50; color: white; padding: 6px 12px; 
            cursor: pointer; border: none; font-weight: bold; width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 style="text-align:center;">Order Management</h2>
    <p><a href="AdminDashboard.php" style="text-decoration: none; color: #2c3e50; font-weight: bold;">← Back to Dashboard</a></p>

    <table>
        <thead>
            <tr>
                <th>Order Details</th>
                <th>Update Status & Assign Staff</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $orders->fetch_assoc()): ?>
            <tr>
                <td>
                    <b>Order ID:</b> <?php echo $row['orderid']; ?><br>
                    <b>Customer:</b> <?php echo htmlspecialchars($row['customername']); ?><br>
                    <b>Location:</b> <?php echo htmlspecialchars($row['location']); ?><br>
                    <b>Current Status:</b> <?php echo $row['status']; ?><br>
                    <b>Staff Email:</b> <?php echo $row['deliverystaffemail'] ?? "Not Assigned"; ?><br>
                    <b>Delivery Date:</b> <?php echo ($row['deliverydate'] == '0000-00-00') ? "N/A" : $row['deliverydate']; ?>
                </td>
                <td>
                    <form action="../Controller/handleAssignOrder.php" method="POST">
                        <input type="hidden" name="orderid" value="<?php echo $row['orderid']; ?>">
                        
                        <label><b>Assign Staff Name:</b></label><br>
                        <select name="staff_email" required style="width: 100%; padding: 5px;">
                            <option value="">-- Select Staff Member --</option>
                            <?php 
                            $staffResult = $db->getDeliveryStaff($conn);
                            if($staffResult) {
                                while($staff = $staffResult->fetch_assoc()){
                                    // Value is the Email, Text shown is the Name
                                    $selected = ($staff['email'] == $row['deliverystaffemail']) ? 'selected' : '';
                                    echo "<option value='".$staff['email']."' $selected>".$staff['Name']."</option>";
                                }
                            }
                            ?>
                        </select>
                        <br><br>

                        <label><b>Set Date:</b></label><br>
                        <input type="date" name="delivery_date" value="<?php echo $row['deliverydate']; ?>" required style="width: 100%; padding: 5px;">
                        <br><br>

                        <label><b>Update Status:</b></label><br>
                        <select name="new_status" style="width: 100%; padding: 5px;">
                            <option value="Processing" <?php if($row['status']=='Processing') echo 'selected'; ?>>Processing</option>
                            <option value="Delivered" <?php if($row['status']=='Delivered') echo 'selected'; ?>>Delivered</option>
                            <option value="Cancelled" <?php if($row['status']=='Cancelled') echo 'selected'; ?>>Cancelled</option>
                        </select>
                        <br><br>

                        <input type="submit" name="assign" value="Update Order" class="btn-update">
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>