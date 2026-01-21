<?php
session_start();
$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if($isLoggedIn){
    header("Location: AdminDashboard.php");
    exit();
}
?>

<html>
<head>
<title>Admin Login</title>
<style>
body{
    font-family: Arial;
    background: #d0f0f7;
}
.box{
    width: 350px;
    margin: 120px auto;
    background: white;
    padding: 30px;
}
h2{
    text-align: center;
    color: #2e86c1;
}
input{
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
button{
    width: 100%;
    padding: 10px;
    background: #2e86c1;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}
button:hover{
    background: #21618c;
}
.error{
    color: red;
    text-align: center;
}
</style>
</head>
<body>
<div class="box">
<h2>Admin</h2>
<form method="post" action="../Controller/handleLoginValidation.php">
    Email<br>
    <input type="text" name="email">
    Password<br>
    <input type="password" name="password"><br><br>
    <button type="submit">Login</button>
</form>
<p class="error">
    <?php 
    if(isset($_SESSION["loginErr"])){
        echo $_SESSION["loginErr"]; 
        unset($_SESSION["loginErr"]);
    }
    ?>
</p>
</div>
</body>
</html>