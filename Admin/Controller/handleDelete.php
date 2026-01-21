<?php
session_start();
include "../Model/DatabaseConnection.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = new DatabaseConnection();
    $conn = $db->openConnection();
    
    $sql = "DELETE FROM productitem WHERE product_id = $id";
    $conn->query($sql);
    
    header("Location: ../View/manageProducts.php");
    exit();
}
?>