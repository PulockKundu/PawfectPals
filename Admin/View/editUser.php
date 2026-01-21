<?php
session_start();
if(!($_SESSION["isLoggedIn"] ?? false)) {
    header("Location: AdminLogin.php");
    exit();
}

include "../Model/DatabaseConnection.php";

$id = $_GET['id'];
$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<html>
<head>
    <title>Edit User</title>
</head>
<body style="font-family: Arial; text-align: center; background: #fffaf0; padding: 50px;">
    <div style="background: white; padding: 30px; display: inline-block; border-radius: 10px; border: 1px solid #ccc;">
        <h3>Update for: <?php echo htmlspecialchars($user['email']); ?></h3>
        
        <form method="POST" action="../Controller/handleUserUpdate.php">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            
            <label>Select New Role:</label><br><br>
            <select name="usertype" style="padding: 5px; width: 200px;">
                <option value="customer" <?php if($user['usertype'] == 'customer') echo 'selected'; ?>>Customer</option>
                <option value="deliverystaff" <?php if($user['usertype'] == 'deliverystaff') echo 'selected'; ?>>Delivery Staff</option>
                <option value="admin" <?php if($user['usertype'] == 'admin') echo 'selected'; ?>>Admin</option>
            </select><br><br>
            
            <input type="submit" name="update" value="Save Changes" style="background: #27ae60; color: white; border: none; padding: 10px 20px; cursor: pointer;">
            <br><br>
            <a href="manageUsers.php">Cancel</a>
        </form>
    </div>
</body>
</html>