<?php
session_start();
if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true) {
    header("Location: AdminLogin.php");
    exit();
}

include "../Model/DatabaseConnection.php";
$db = new DatabaseConnection();
$conn = $db->openConnection();

$salesSummary = $db->getSalesSummary($conn);
$inventorySummary = $db->getInventorySummary($conn);
?>

<html>
<head>
    <title>Business Reports</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f4f4f4; 
            padding: 30px; 
        }
        .report-header { 
            text-align: center; 
            margin-bottom: 30px; 
        }
        .report-box { 
            background: white; 
            padding: 20px; 
            border: 1px solid #333; 
            margin-bottom: 30px; 
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        h2 { 
            background-color: #1abc9c; 
            color: white; 
            padding: 10px; 
            margin-top: 0; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        th, td { 
            padding: 10px; 
            border-bottom: 1px solid #ddd; 
            text-align: left; 
        }
        th { 
            background: #f2f2f2; 
        }
        .btn { 
            text-decoration: none; 
            padding: 10px 20px; 
            background: #34495e; 
            color: white; 
            display: inline-block; 
        }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>

<div class="report-header">
    <h1>Analytics Report</h1>
    <p>Generated on: <?php echo date("F j, Y"); ?></p>
</div>

<div class="report-box">
    <h2>Sales & Order Status</h2>
    <table>
        <thead>
            <tr>
                <th>Order Status</th>
                <th>Total Orders</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $grandTotalOrders = 0;
            while($row = $salesSummary->fetch_assoc()): 
                $grandTotalOrders += $row['total'];
            ?>
            <tr>
                <td><?php echo $row['status']; ?></td>
                <td><b><?php echo $row['total']; ?></b></td>
            </tr>
            <?php endwhile; ?>
            <tr style="background: #eee;">
                <td><strong>Grand Total</strong></td>
                <td><strong><?php echo $grandTotalOrders; ?></strong></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="report-box">
    <h2>Inventory by Category</h2>
    <table>
        <thead>
            <tr>
                <th>Category</th>
                <th>Items in Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $totalProducts = 0;
            while($row = $inventorySummary->fetch_assoc()): 
                $totalProducts += $row['count'];
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['category']); ?></td>
                <td><b><?php echo $row['count']; ?></b></td>
            </tr>
            <?php endwhile; ?>
            <tr style="background: #eee;">
                <td><strong>Total Products</strong></td>
                <td><strong><?php echo $totalProducts; ?></strong></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="no-print" style="text-align: center;">
    <a href="AdminDashboard.php" class="btn">Back to Dashboard</a>
    <button onclick="window.print()" class="btn" style="background:#1abc9c; cursor:pointer; border:none;">Print Report</button>
</div>

</body>
</html>