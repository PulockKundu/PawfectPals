<?php
session_start();
include "../Model/DatabaseConnection.php";

if(isset($_POST['addUser'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $type = $_POST['usertype'];

    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    $sql = "INSERT INTO users (Name, email, password, usertype) 
            VALUES ('$name', '$email', '$pass', '$type')";

    if($conn->query($sql)) {
        header("Location: ../View/manageUsers.php?success=added");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>