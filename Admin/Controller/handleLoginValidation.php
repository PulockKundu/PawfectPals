<?php
session_start();
include "../Model/DatabaseConnection.php";

$email = $_POST["email"];
$password = $_POST["password"];

$db = new DatabaseConnection();
$conn = $db->openConnection();

$result = $db->signin($conn,"users",$email,$password);

if($result->num_rows > 0){
    $_SESSION["isLoggedIn"] = true;
    $_SESSION["email"] = $email;
    header("Location: ../View/AdminDashboard.php");
}else{
    $_SESSION["loginErr"] = "Invalid email or password";
    header("Location: ../View/AdminLogin.php");
}
?>
