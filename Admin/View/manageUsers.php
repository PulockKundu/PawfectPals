<?php
session_start();
if(!($_SESSION["isLoggedIn"] ?? false)){
    header("Location: AdminLogin.php");
    exit();
}

include "../Model/DatabaseConnection.php";
$db = new DatabaseConnection();
$conn = $db->openConnection();
$result = $db->getAllUsers($conn); 
?>

<html>
<head>
    <title>Manage Users</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: #fffaf0; 
            padding: 20px; 
        }
        .container { 
            background: white; 
            padding: 20px; 
            width: 85%; 
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
            background: #d5f5e3; 
            color: #333; 
        }
        .add-user-form { 
            text-align: center; 
            margin-bottom: 30px; 
            padding: 20px; 
            background: #e8f8f5; 
            border-radius: 8px; 
            border: 1px solid #a3e4d7; 
        }
        input, select { 
            padding: 8px; 
            margin: 5px; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
        }
        .btn-add { 
            background: #16a085; 
            color: white; 
            border: none; 
            padding: 8px 20px; 
            cursor: pointer; 
            border-radius: 4px; 
            font-weight: bold; 
        }
        .btn-edit { 
            color: #2e86c1; 
            text-decoration: none; 
            font-weight: bold; 
            margin-right: 10px; 
        }
        .btn-delete { 
            color: #e74c3c; 
            text-decoration: none; 
            font-weight: bold; 
        }
    </style>
</head>
<body>

<div class="container">
    <h2 style="text-align:center;">Admin: User Management</h2>

    <div class="add-user-form">
        <h4>Add New User</h4>
        <form method="POST" action="../Controller/handleUserAdd.php">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="usertype" required>
                <option value="customer">Customer</option>
                <option value="delivery">Delivery Staff</option>
            </select>
            <input type="submit" name="addUser" value="Add User" class="btn-add">
        </form>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $row["id"]; ?></td> 
                <td><?php echo htmlspecialchars($row["Name"]); ?></td> 
                <td><?php echo htmlspecialchars($row["email"]); ?></td> 
                <td><span style="text-transform: capitalize;"><?php echo $row["usertype"]; ?></span></td> 
                <td>
                    <a href="editUser.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                    <a href="../Controller/handleUserDelete.php?id=<?php echo $row['id']; ?>" 
                       class="btn-delete" onclick="return confirm('Delete user?')">Delete</a>
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