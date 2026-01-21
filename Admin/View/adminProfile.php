<?php
session_start();
if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true) {
    header("Location: AdminLogin.php");
    exit();
}

include "../Model/DatabaseConnection.php";

$adminId = $_SESSION["userId"]; 
$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "SELECT * FROM users WHERE id = $adminId";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<html>
<head>
    <title>My Profile</title>
    <style>
        body { 
            font-family: Arial; 
            background-color: #fffaf0; 
            text-align: center; 
            padding-top: 50px;
        }
        .profile-card { 
            background: white; 
            padding: 30px; 
            display: inline-block; 
            border-radius: 10px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border: 1px solid #ccc;
            width: 320px;
        }
        input { 
            display: block; 
            margin: 10px auto; 
            padding: 10px; 
            width: 90%; 
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        label {
            font-size: 13px;
            font-weight: bold;
            display: block;
            text-align: left;
            margin-left: 5%;
        }
        input[readonly] {
            background-color: #eeeeee;
            cursor: not-allowed;
        }
        .btn-update {
            background-color: #2e86c1; 
            color: white; 
            border: none; 
            cursor: pointer;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn-update:hover {
            background-color: #21618c;
        }
    </style>
</head>
<body>
    <script>
    function validateForm() {
        var password = document.getElementsByName("password")[0].value;
        if (password !== "" && password.length < 8) {
            alert("New password must be at least 8 characters long.");
            return false; 
        }
        return true;
    }
    </script>

    <div class="profile-card">
        <h2>My Profile</h2>
        
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'updated'): ?>
            <p style="color: green; font-size: 14px;">Profile updated successfully!</p>
        <?php endif; ?>

        <form method="POST" action="../Controller/handleProfileUpdate.php" onsubmit="return validateForm()">
            <label>Full Name (Fixed):</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($user['Name']); ?>" readonly>
            
            <label>Email Address:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            
            <label>New Password:</label>
            <input type="password" name="password" placeholder="Leave blank to stay same">
            
            <input type="submit" name="updateProfile" value="Update My Info" class="btn-update">
        </form>
        <hr>
        <a href="AdminDashboard.php" style="text-decoration: none; color: #666; font-size: 14px;">Back to Dashboard</a>
    </div>
</body>
</html>