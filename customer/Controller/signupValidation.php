<?php
session_start();
include "../Model/databaseConnection.php";

$name      = trim($_REQUEST['username'] ?? '');
$email     = trim($_REQUEST['email'] ?? '');
$password  = $_REQUEST['password'] ?? '';
$confirm   = $_REQUEST['confirm_password'] ?? '';
$user_type = $_REQUEST['user_type'] ?? '';

$errors = [];
$values = [];

if(empty($name)){
    $errors["username"] = "Name is required.";
}
if(empty($email)){
    $errors["email"] = "Email is required.";
}
if(empty($password)){
    $errors["password"] = "Password is required.";
}
if(empty($user_type)){
    $errors["user_type"] = "User Type is required.";
}
if($password !== $confirm && !empty($password)){
    $errors["password"] = "Passwords do not match.";
}

if(count($errors) > 0){
    $_SESSION['usernameErr'] = $errors["username"] ?? "";
    $_SESSION['emailErr'] = $errors["email"] ?? "";
    $_SESSION['passwordErr'] = $errors["password"] ?? "";
    $_SESSION['userTypeErr'] = $errors["user_type"] ?? "";
    
    $values["username"] = $name;
    $values["email"] = $email;
    $values["user_type"] = $user_type;
    $_SESSION['previousValues'] = $values;

    header("Location: ../View/signup.php");
    exit();
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$checkUser = "SELECT email, Name FROM users WHERE email='$email' OR Name='$name'";
$result = $conn->query($checkUser);

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    
    if($row['email'] === $email) {
        $_SESSION['signupErr'] = "Email already exists.";
    } else {
        $_SESSION['signupErr'] = "This Name is already taken.";
    }
    
    $values["username"] = $name;
    $values["email"] = $email;
    $_SESSION['previousValues'] = $values;

    header("Location: ../View/signup.php");
    exit();
} else {
    $sql = "INSERT INTO users (email, password, usertype, Name) 
            VALUES ('$email', '$password', '$user_type', '$name')";
    
    if($conn->query($sql)){
        $_SESSION['loginErr'] = "Account created! Please login.";
        header("Location: ../View/login.php");
    } else {
        $_SESSION['signupErr'] = "Error: " . $conn->error;
        header("Location: ../View/signup.php");
    }
}
$db->closeConnection();
?>