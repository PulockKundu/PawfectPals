<?php 
session_start();
include "../Model/databaseConnection.php";

$userIdentifer = $_REQUEST['username'] ?? ''; 
$password = $_REQUEST['password'] ?? '';

$errors = [];
$values = [];

if(empty(trim($userIdentifer))){
    $errors["username"] = "Username is a required field";
}
if(empty(trim($password))){
    $errors["password"] = "Password field is required";
}

if(count($errors) > 0){
    $_SESSION['usernameErr'] = $errors["username"] ?? "";
    $_SESSION['passwordErr'] = $errors["password"] ?? "";
    
    $values["username"] = $userIdentifer;
    $_SESSION['previousValues'] = $values;

    header("Location: ../View/login.php");
    exit();
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "SELECT * FROM users WHERE Name='$userIdentifer' AND password='$password'";
$result = $conn->query($sql);

if($result && $result->num_rows == 1){
    $row = $result->fetch_assoc();
    
    $_SESSION['isLoggedIn'] = true;
    $_SESSION['userName'] = $row['Name']; 
    $_SESSION['email'] = $row['email']; 
    $_SESSION['userId'] = $row['id']; 
    
    header("Location: ../View/dashboard.php");
    exit();
} else {
    $_SESSION['loginErr'] = "Invalid username or password";
    $values["username"] = $userIdentifer;
    $_SESSION['previousValues'] = $values;
    
    header("Location: ../View/login.php");
    exit();
}
?>