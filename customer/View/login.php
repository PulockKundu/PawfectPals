<?php
session_start();
if ($_SESSION['isLoggedIn'] ?? false) {
    header("Location: dashboard.php");
    exit();
}

$loginErr = $_SESSION['loginErr'] ?? "";
unset($_SESSION['loginErr']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
    body {
        margin:0; padding:0; font-family:Arial; display:flex; justify-content:center; align-items:center; height:100vh;
        background-image:url('../images/login.jpg'); background-size:cover; background-position:center; background-repeat:no-repeat;
    }
    .login-container { background-color:rgba(255,255,255,0.9); padding:40px; width:350px; border-radius:10px; text-align:center; }
    .login-container h2 { margin-bottom:30px; color:#60c0ed; }
    .login-container input[type="text"], input[type="password"] { width:90%; padding:12px; margin:10px 0; border-radius:5px; border:1px solid #ccc; }
    .login-container input[type="submit"] { width:95%; padding:12px; margin-top:20px; border:none; border-radius:5px; background-color:#60c0ed; color:white; font-size:16px; cursor:pointer; }
    .login-container input[type="submit"]:hover { background-color:#3a9ad9; }
    .login-container a { display:block; margin-top:15px; color:#60c0ed; text-decoration:none; font-size:14px; }
    .site-title { position:absolute; top:20px; left:20px; color:#543112; font-size:36px; font-weight:bold; }
    .error { color:red; font-size:14px; display:block; margin-bottom:10px; }
    </style>
</head>
<body>

<h1 class="site-title">PAWFECT PETSHOP ONLINE</h1>

<div class="login-container">
    <h2>Login</h2>
    <?php if($loginErr) echo "<span class='error'>$loginErr</span>"; ?>
    <form action="../Controller/loginValidation.php" method="post">
        <input type="text" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <a href="#">Forgot Password?</a>
    <a href="#">Create an Account</a>
</div>

</body>
</html>
