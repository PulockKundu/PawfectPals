<?php
session_start();
if(!($_SESSION["isLoggedIn"] ?? false)) {
    header("Location: AdminLogin.php");
    exit();
}

include "../Model/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->openConnection();
$result = $db->getAllProducts($conn); 
?>

<html>
<head>
    <title>Manage Products</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: #fffaf0; 
            padding: 20px; 
        }
        .container { 
            background: white; 
            padding: 20px; 
            width: 70%; 
            margin: auto; 
            border-radius: 8px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        th, td { 
            border: 1px solid #ccc; 
            padding: 12px; 
            text-align: center; 
        }
        th { 
            background: #fdebd0; 
            color: #333; 
        }
        tr:hover { 
            background-color: #f9f9f9; 
        }
        form { 
            text-align: center; 
            margin-bottom: 20px; 
            padding: 15px; 
            background: #fdf2e9; 
            border-radius: 8px; 
        }
        input, select { 
            padding: 8px; 
            margin: 5px; 
        }
        .btn-delete { 
            color: #e74c3c; 
            text-decoration: none; 
            font-weight: bold; 
        }
        .btn-delete:hover { 
            text-decoration: underline; 
        }
    </style>
</head>
<body>

<div class="container">
    <h2 style="text-align:center;">🐾 Inventory Management</h2>

    <form method="post" action="../Controller/handleProductAdd.php">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" name="price" placeholder="Price (BDT)" required>
        <select name="category" required>
            <option value="">Select Category</option>
            <option value="Cat">Cat</option>
            <option value="Dog">Dog</option>
            <option value="Toy">Toy</option>
        </select>
        <input type="submit" name="add" value="Add Product">
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $row["product_id"]; ?></td> 
                <td><?php echo htmlspecialchars($row["product_name"]); ?></td> 
                <td><?php echo $row["category"]; ?></td> 
                <td><?php echo number_format($row["price"], 2); ?> BDT</td>
                <td>
                    <a href="../Controller/handleDelete.php?id=<?php echo $row['product_id']; ?>" 
                       class="btn-delete" 
                       onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <p style="text-align:center; margin-top: 20px;">
        <a href="AdminDashboard.php" style="text-decoration:none; color:#2e86c1;">⬅ Back to Dashboard</a>
    </p>
</div>

</body>
</html>