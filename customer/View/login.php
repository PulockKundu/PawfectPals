<?php
session_start();

if ($_SESSION['isLoggedIn'] ?? false) {
    header("Location: dashboard.php");
    exit();
}

$loginErr = $_SESSION['loginErr'] ?? "";
$usernameErr = $_SESSION['usernameErr'] ?? "";
$passwordErr = $_SESSION['passwordErr'] ?? "";
$previousValues = $_SESSION['previousValues'] ?? [];

unset($_SESSION['loginErr']);
unset($_SESSION['usernameErr']);
unset($_SESSION['passwordErr']);
unset($_SESSION['previousValues']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
    body {
        margin:0; 
        padding:0; 
        font-family:Arial; 
        display:flex; 
        justify-content:center; 
        align-items:center; 
        height:100vh;
        background-image:url('../images/login.jpg'); 
        background-size:cover; 
        background-position:center; 
        background-repeat:no-repeat;
    }

    .top-nav {
        position: absolute;
        top: 25px;
        right: 30px;
    }
    .top-nav a {
        text-decoration: none;
        color: #543112;
        font-weight: bold;
        margin-left: 20px;
        font-size: 16px;
    }
    .top-nav a:hover {
        color: #60c0ed;
    }

    .login-container { 
        background-color:rgb(255,255,255); 
        padding:40px; 
        width:350px; 
        border-radius:10px; 
        text-align:center; 
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .login-container h2 { 
        margin-bottom:30px; 
        color:#60c0ed; }
    .login-container input[type="text"], input[type="password"] { 
        width:90%; 
        padding:12px; 
        margin:8px 0; 
        border:1px solid #ccc; 
    }
    .login-container input[type="submit"] { 
        width:95%; 
        padding:12px; 
        margin-top:20px; 
        border:none; 
        background-color:#60c0ed; 
        color:white; 
        font-size:16px; 
        cursor:pointer; 
    }
    .login-container input[type="submit"]:hover { 
        background-color:#3a9ad9; }
    .login-container a { 
        display:block; 
        margin-top:15px; 
        color:#60c0ed; 
        text-decoration:none; 
        font-size:14px; 
    }
    .login-container a:hover { text-decoration: underline; }
    .site-title { 
        position:absolute; 
        top:20px; left:20px; 
        color:#543112; 
        font-size:36px; 
        font-weight:bold; 
    }
    .error { 
        color:red; 
        font-size:12px; 
        display:block; 
        text-align: left; 
        margin-left: 5%; }
    </style>
</head>
<body>

<h1 class="site-title">PAWFECT PETSHOP ONLINE</h1>

<div class="top-nav">
    <a href="../../Admin/view/login.php">Admin</a>
    <a href="../../Delivery_Staff/view/login.php">Delivery Staff</a>
</div>

<div class="login-container">
    <h2>Login</h2>
    
    <?php if($loginErr) echo "<span class='error' style='text-align:center; margin-bottom:10px;'>$loginErr</span>"; ?>

    <form action="../Controller/loginValidation.php" method="post">
        <input type="text" name="username" placeholder="Username" 
               value="<?php echo $previousValues['username'] ?? ''; ?>">
        <?php if($usernameErr) echo "<span class='error'>$usernameErr</span>"; ?>

        <input type="password" name="password" placeholder="Password">
        <?php if($passwordErr) echo "<span class='error'>$passwordErr</span>"; ?>

        <input type="submit" value="Login">
    </form>
    
    <a href="forgotPassword.php">Forgot Password?</a>
    <a href="signup.php">Create an Account</a>
</div>

</body>
</html>