<?php 
session_start(); 
$signupErr = $_SESSION['signupErr'] ?? "";
$usernameErr = $_SESSION['usernameErr'] ?? "";
$emailErr = $_SESSION['emailErr'] ?? "";
$passwordErr = $_SESSION['passwordErr'] ?? "";
$userTypeErr = $_SESSION['userTypeErr'] ?? "";
$previousValues = $_SESSION['previousValues'] ?? [];

unset($_SESSION['signupErr'], $_SESSION['usernameErr'], $_SESSION['emailErr'], $_SESSION['passwordErr'], $_SESSION['userTypeErr'], $_SESSION['previousValues']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up - Pet Shop</title>
    <style>
        body { 
        background-color:#c6d2d2; 
        font-family:Arial; 
        display: flex; 
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
        .error { 
            color: red; 
            font-size: 12px; 
            display: block; 
            margin-bottom: 5px; 
            min-height: 15px;}
    </style>
</head>
<body>
    <div class="signup-box">
        <h2 style="text-align:center; color: #1e6c90;">Create Account</h2>
        
        <?php if($signupErr) echo "<p class='error' style='text-align:center;'>$signupErr</p>"; ?>

        <form action="../Controller/signupValidation.php" method="POST" onsubmit="return validateSignup()">
            
            <input type="text" id="username" name="username" placeholder="Full Name" 
                   value="<?php echo $previousValues['username'] ?? ''; ?>">
            <span class="error" id="usernameErr"><?php echo $usernameErr; ?></span>

            <input type="text" id="email" name="email" placeholder="Email Address" 
                   value="<?php echo $previousValues['email'] ?? ''; ?>">
            <span class="error" id="emailErr"><?php echo $emailErr; ?></span>
            
            <select name="user_type" id="user_type">
                <option value="" disabled <?php echo !isset($previousValues['user_type']) ? 'selected' : ''; ?>>Select User Type</option>
                <option value="customer" <?php echo ($previousValues['user_type'] ?? '') == 'customer' ? 'selected' : ''; ?>>Customer</option>
            </select>
            <span class="error" id="userTypeErr"><?php echo $userTypeErr; ?></span>

            <input type="password" id="password" name="password" placeholder="Password">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
            <span class="error" id="passwordErr"><?php echo $passwordErr; ?></span>

            <button type="submit" class="btn">Sign Up</button>
        </form>
        <p style="font-size: 14px; text-align: center;">Already have an account? <a href="login.php" style="color: #4cb8eb; text-decoration: none;">Login</a></p>
    </div>

    <script>
    function validateSignup() {
        let name = document.getElementById("username").value.trim();
        let email = document.getElementById("email").value.trim();
        let password = document.getElementById("password").value;
        let confirm = document.getElementById("confirm_password").value;
        let usertype = document.getElementById("user_type").value;

        document.getElementById("usernameErr").innerHTML = "";
        document.getElementById("emailErr").innerHTML = "";
        document.getElementById("passwordErr").innerHTML = "";
        document.getElementById("userTypeErr").innerHTML = "";

        let valid = true;

        if (name === "") {
            document.getElementById("usernameErr").innerHTML = "Name is required.";
            valid = false;
        }

        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "") {
            document.getElementById("emailErr").innerHTML = "Email is required.";
            valid = false;
        } else if (!emailPattern.test(email)) {
            document.getElementById("emailErr").innerHTML = "Invalid email format.";
            valid = false;
        }

        if (usertype === "") {
            document.getElementById("userTypeErr").innerHTML = "Select user type.";
            valid = false;
        }

       
        if (password === "") {
            document.getElementById("passwordErr").innerHTML = "Password is required.";
            valid = false;
        } else if (password.length < 6) {
            document.getElementById("passwordErr").innerHTML = "Min 6 characters required.";
            valid = false;
        } else if (!password.includes("@") && !password.includes("#")) {
            document.getElementById("passwordErr").innerHTML = "Must contain @ or #.";
            valid = false;
        } else if (password !== confirm) {
            document.getElementById("passwordErr").innerHTML = "Passwords do not match.";
            valid = false;
        }

        return valid;
    }
    </script>
</body>
</html>