<?php
session_start();
include "../Model/databaseConnection.php";

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if($email == "" || $password == ""){
    $_SESSION['loginErr'] = "Email and Password are required";
    header("Location: ../View/login.php");
    exit();
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if($result && $result->num_rows == 1){
    $_SESSION['isLoggedIn'] = true;
    $_SESSION['email'] = $email;
    header("Location: ../View/dashboard.php");
    exit();
} else {
    $_SESSION['loginErr'] = "Invalid email or password";
    header("Location: ../View/login.php");
    exit();
}
?>
