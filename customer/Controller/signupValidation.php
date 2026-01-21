<?php
session_start();
include "../Model/databaseConnection.php";

$name      = trim($_POST['username'] ?? '');
$email     = trim($_POST['email'] ?? '');
$password  = $_POST['password'] ?? '';
$confirm   = $_POST['confirm_password'] ?? '';
$user_type = $_POST['user_type'] ?? '';

$errors = [];
$values = [];

if(empty($name)){
    $errors["username"] = "Name is required.";
}

if(empty($email)){
    $errors["email"] = "Email is required.";
} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors["email"] = "Invalid email format.";
}

if(empty($password)){
    $errors["password"] = "Password is required.";
} elseif(strlen($password) < 6){
    $errors["password"] = "Password must be at least 6 characters.";
} elseif(!strpbrk($password, '@#')){ 
    $errors["password"] = "Password must contain @ or #.";
} elseif($password !== $confirm){
    $errors["password"] = "Passwords do not match.";
}


if(empty($user_type)){
    $errors["user_type"] = "User Type is required.";
}

if(count($errors) > 0){
    $_SESSION['usernameErr'] = $errors["username"] ?? "";
    $_SESSION['emailErr'] = $errors["email"] ?? "";
    $_SESSION['passwordErr'] = $errors["password"] ?? "";
    $_SESSION['userTypeErr'] = $errors["user_type"] ?? "";
    
    $_SESSION['previousValues'] = [
        "username" => $name,
        "email" => $email,
        "user_type" => $user_type
    ];

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
    
    $_SESSION['previousValues'] = ["username" => $name, "email" => $email];
    header("Location: ../View/signup.php");
    exit();
} else {

    $sql = "INSERT INTO users (email, password, usertype, Name) VALUES ('$email', '$password', '$user_type', '$name')";
    
    if($conn->query($sql)){
        $_SESSION['loginErr'] = "Account created! Please login.";
        header("Location: ../View/login.php");
    } else {
        $_SESSION['signupErr'] = "Database Error: " . $conn->error;
        header("Location: ../View/signup.php");
    }
}
$db->closeConnection();
?>