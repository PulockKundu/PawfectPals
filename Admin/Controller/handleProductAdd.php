<?php
session_start();
include "../Model/DatabaseConnection.php";

if(isset($_POST["add"])){
    $name = $_POST["name"];
    $price = $_POST["price"];
    $category = $_POST["category"];

    $db = new DatabaseConnection();
    $conn = $db->openConnection();
    
    $sql = "INSERT INTO productitem (product_name, price, category) 
            VALUES ('$name', '$price', '$category')";
    
    $conn->query($sql);
    header("Location: ../View/manageProducts.php");
    exit();
}
?>