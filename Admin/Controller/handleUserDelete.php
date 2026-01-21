<?php
session_start();
include "../Model/DatabaseConnection.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = new DatabaseConnection();
    $conn = $db->openConnection();
    
    $sql = "DELETE FROM users WHERE id = $id AND usertype != 'admin'";
    $conn->query($sql);
    
    header("Location: ../View/manageUsers.php");
    exit();
}
?>