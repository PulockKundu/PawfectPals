<?php
session_start();
include "../Model/DatabaseConnection.php";

$email = $_POST["email"];
$password = $_POST["password"];

$db = new DatabaseConnection();
$conn = $db->openConnection();

$result = $db->signin($conn, "users", $email, $password);

if($result->num_rows > 0){
    $row = $result->fetch_assoc();

    $_SESSION["isLoggedIn"] = true;
    $_SESSION["userId"] = $row["id"];
    $_SESSION["userName"] = $row["Name"];
    $_SESSION["email"] = $email;

    header("Location: ../View/AdminDashboard.php");
    exit();
} else {
    $_SESSION["loginErr"] = "Invalid email or password";
    header("Location: ../View/AdminLogin.php");
    exit();
}
?>