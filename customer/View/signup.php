<?php 
session_start(); 

$signupErr = $_SESSION['signupErr'] ?? "";
$usernameErr = $_SESSION['usernameErr'] ?? "";
$emailErr = $_SESSION['emailErr'] ?? "";
$passwordErr = $_SESSION['passwordErr'] ?? "";
$userTypeErr = $_SESSION['userTypeErr'] ?? "";
$previousValues = $_SESSION['previousValues'] ?? [];

unset($_SESSION['signupErr']);
unset($_SESSION['usernameErr']);
unset($_SESSION['emailErr']);
unset($_SESSION['passwordErr']);
unset($_SESSION['userTypeErr']);
unset($_SESSION['previousValues']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up - Pet Shop</title>
    <style>
        body { 
            background-color:#c6d2d2; 
            font-family:Arial; display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; }
        .signup-box { 
            background: white; 
            padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1); 
            width: 350px; }
        input, select { 
            width: 100%; 
            padding: 10px; 
            margin: 5px 0; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
            box-sizing: border-box; }
        .btn { 
            width: 100%; 
            background: #4cb8eb; 
            color: white; 
            border: none; 
            padding: 10px; 
            border-radius: 5px; 
            cursor: pointer; 
            font-weight: bold; 
            margin-top: 10px;}
        .error { color: red; font-size: 12px; display: block; margin-bottom: 5px;}
    </style>
</head>
<body>
    <div class="signup-box">
        <h2 style="text-align:center; color: #1e6c90;">Create Account</h2>
        
        <?php if($signupErr) echo "<p class='error' style='text-align:center;'>$signupErr</p>"; ?>

        <form action="../Controller/signupValidation.php" method="POST">
            
            <input type="text" name="username" placeholder="Full Name" 
                   value="<?php echo $previousValues['username'] ?? ''; ?>">
            <span class="error"><?php echo $usernameErr; ?></span>

            <input type="email" name="email" placeholder="Email Address" 
                   value="<?php echo $previousValues['email'] ?? ''; ?>">
            <span class="error"><?php echo $emailErr; ?></span>
            
            <select name="user_type">
                <option value="" disabled <?php echo !isset($previousValues['user_type']) ? 'selected' : ''; ?>>Select User Type</option>
                <option value="customer" <?php echo ($previousValues['user_type'] ?? '') == 'customer' ? 'selected' : ''; ?>>customer</option>
            </select>
            <span class="error"><?php echo $userTypeErr; ?></span>

            <input type="password" name="password" placeholder="Password">
            <input type="password" name="confirm_password" placeholder="Confirm Password">
            <span class="error"><?php echo $passwordErr; ?></span>

            <button type="submit" class="btn">Sign Up</button>
        </form>
        <p style="font-size: 14px; text-align: center;">Already have an account? <a href="login.php" style="color: #4cb8eb; text-decoration: none;">Login</a></p>
    </div>
</body>
</html>