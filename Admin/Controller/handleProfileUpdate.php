<?php
session_start();
include "../Model/DatabaseConnection.php";

if(isset($_POST['updateProfile'])) {
    $id = $_SESSION["userId"];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    if(!empty($password)) {
        $sql = "UPDATE users SET Name='$name', email='$email', password='$password' WHERE id=$id";
    } else {
        $sql = "UPDATE users SET Name='$name', email='$email' WHERE id=$id";
    }

    if($conn->query($sql)) {
        $_SESSION["userName"] = $name; 
        header("Location: ../View/AdminProfile.php?msg=updated");
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>