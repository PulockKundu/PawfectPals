<?php
session_start();
include "../Model/databaseConnection.php";

$name = trim($_REQUEST['userName'] ?? '');
$email = trim($_REQUEST['userEmail'] ?? '');
$newPass = trim($_REQUEST['newPassword'] ?? '');

$errors = [];
$values = [];

if(empty($name)) { $errors['name'] = "Name is required for verification"; }
if(empty($email)) { $errors['email'] = "Email is required for verification"; }
if(empty($newPass)) { $errors['pass'] = "Please provide a new password"; }

if(count($errors) > 0) {
    $_SESSION['nameErr'] = $errors['name'] ?? "";
    $_SESSION['emailErr'] = $errors['email'] ?? "";
    $_SESSION['passErr'] = $errors['pass'] ?? "";
    
    $_SESSION['previousValues'] = ['userName' => $name, 'userEmail' => $email];
    header("Location: ../View/forgotPassword.php");
    exit();
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "SELECT * FROM users WHERE Name='$name' AND email='$email'";
$result = $conn->query($sql);

if($result && $result->num_rows == 1) {
    $updateSql = "UPDATE users SET password='$newPass' WHERE Name='$name' AND email='$email'";
    
    if($conn->query($updateSql)) {
        $_SESSION['loginErr'] = "Password reset successful! Please login.";
        header("Location: ../View/login.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    $_SESSION['nameErr'] = "Verification failed: Name/Email mismatch.";
    $_SESSION['previousValues'] = ['userName' => $name, 'userEmail' => $email];
    header("Location: ../View/forgotPassword.php");
    exit();
}

$conn->close();
?>