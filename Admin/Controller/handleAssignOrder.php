<?php
session_start();
include "../Model/DatabaseConnection.php";

if(isset($_POST['assign'])) {
    $orderid = $_POST['orderid'];
    $staff_email = $_POST['staff_email'];
    $delivery_date = $_POST['delivery_date'];
    $status = isset($_POST['new_status']) ? $_POST['new_status'] : 'Processing';

    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    $sql = "UPDATE orderdetails SET 
            deliverystaffemail = '$staff_email', 
            deliverydate = '$delivery_date', 
            status = '$status' 
            WHERE orderid = $orderid";

    if($conn->query($sql)) {
        header("Location: ../View/manageOrders.php?msg=success");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>