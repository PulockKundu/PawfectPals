<?php 
session_start();
include "../model/DatabaseConnection.php";

if(!isset($_SESSION["isLoggedIn"]) || !isset($_SESSION["userId"])){
    header("Location: login.php");
    exit();
}

$db = new DatabaseConnection();
$conn = $db->openConnection();
$uid = $_SESSION["userId"]; 

$sql = "SELECT * FROM users WHERE id = '$uid'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User session expired. Please log in again.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Account</title>
    <style>
        body { 
            background-color:#c6d2d2; 
            font-family:Arial, sans-serif; 
            margin: 0; 
            padding: 0; 
        }
        
        .header-bar {
            background-color: #4cb8eb;
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            color: white;
            border-bottom: 2px solid #1e6c90;
        }

        .container { 
            background: white; 
            padding: 30px; 
            width: 450px; 
            margin: 50px auto; 
            border: 1px solid #1e6c90;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        h2 { 
            color: #1e6c90; 
            margin-top: 0; 
            border-bottom: 1px solid #eee; 
            padding-bottom: 10px; }
        
        label { 
            font-weight: bold; 
            display: block; 
            margin-top: 15px; 
            font-size: 14px; }
        
        input { 
            width: 100%; 
            padding: 12px; 
            margin: 8px 0; 
            border: 1px solid #ccc; 
            box-sizing: border-box; 
            border-radius: 4px;
        }

        .readonly-field {
            background-color: #f2f2f2;
            color: #777;
            cursor: not-allowed;
            border: 1px solid #ddd;
        }

        .btn-update { 
            background: #4cb8eb; 
            color: white; 
            border: none; 
            padding: 12px; 
            cursor: pointer; 
            width: 100%; 
            font-weight: bold; 
            font-size: 16px;
            margin-top: 10px;
        }

        .btn-update:hover { background: #3a96c2; }

        .btn-delete { 
            background: #ff4d4d; 
            color: white; 
            border: none; 
            padding: 10px; 
            cursor: pointer; 
            margin-top: 25px; 
            width: 100%; 
            font-weight: bold;
        }

        .btn-delete:hover { background: #cc0000; }

        .back-link { 
            display: block; 
            margin-top: 20px; 
            text-align: center; 
            text-decoration: none; 
            color: #1e6c90; 
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header-bar">
        <h3>Pawfect Pet Shop | Account Settings</h3>
    </div>

    <div class="container">
        <h2>Manage Profile</h2>
        
        <form action="../controller/update_profile_data.php" method="POST">
            <label>Name (Fixed):</label>
            <input type="text" name="userName" value="<?php echo htmlspecialchars($user['Name']); ?>" 
                   class="readonly-field" readonly>
            
            <label>Email Address:</label>
            <input type="email" name="userEmail" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            
            <hr style="margin-top: 20px; border: 0; border-top: 1px solid #eee;">
            
            <h3>Security</h3>
            <label>Reset Password:</label>
            <input type="password" name="newPassword" placeholder="Enter new password to change">
            
            <button type="submit" class="btn-update">Save Changes</button>
        </form>

    
        <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
    </div>

</body>
</html>
