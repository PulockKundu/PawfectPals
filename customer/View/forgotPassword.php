<?php 
session_start();

$nameErr = $_SESSION['nameErr'] ?? "";
$emailErr = $_SESSION['emailErr'] ?? "";
$passErr = $_SESSION['passErr'] ?? "";
$previousValues = $_SESSION['previousValues'] ?? [];

unset($_SESSION['nameErr'], $_SESSION['emailErr'], $_SESSION['passErr'], $_SESSION['previousValues']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <style>
        body { 
            background-color:#c6d2d2; 
            font-family:Arial, sans-serif; 
            padding: 50px; }
        .container { 
            background: white; 
            padding: 30px; 
            width: 400px; 
            margin: auto; 
            border: 1px solid #1e6c90; 
            border-radius: 8px;}
        h2 { 
            color: #1e6c90; 
            text-align: center; }
        label { 
            font-weight: bold; 
            display: block; 
            margin-top: 15px; }
        input { 
            width: 100%; 
            padding: 10px; 
            margin: 5px 0; 
            border: 1px solid #ccc; 
            box-sizing: border-box; 
            border-radius: 4px;}
        .btn-reset { 
            background: #4cb8eb; 
            color: white; 
            border: none; 
            padding: 12px; 
            cursor: pointer; 
            width: 100%; 
            font-weight: bold; 
            margin-top: 10px; 
            border-radius: 4px;}
        .btn-reset:hover { background: #3a9ad9; }
        .back-link { 
            display: block; 
            margin-top: 15px; 
            text-align: center; 
            text-decoration: none; 
            color: #1e6c90; 
            font-size: 14px; }
        .error { 
            color: red; 
            font-size: 12px; 
            display: block; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <p style="font-size: 13px; color: #666; text-align: center;">Verify your account details to set a new password.</p>
        
        <form action="../Controller/forgotPasswordController.php" method="POST">
            <label>Full Name:</label>
            <input type="text" name="userName" placeholder="Enter your registered name" 
                   value="<?php echo $previousValues['userName'] ?? ''; ?>">
            <span class="error"><?php echo $nameErr; ?></span>
            
            <label>Email Address:</label>
            <input type="email" name="userEmail" placeholder="Enter your registered email" 
                   value="<?php echo $previousValues['userEmail'] ?? ''; ?>">
            <span class="error"><?php echo $emailErr; ?></span>
            
            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">
            
            <label>New Password:</label>
            <input type="password" name="newPassword" placeholder="Enter new password">
            <span class="error"><?php echo $passErr; ?></span>
            
            <button type="submit" class="btn-reset">Update Password</button>
        </form>
        <a href="login.php" class="back-link">← Back to Login</a>
    </div>
</body>
</html>