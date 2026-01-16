<?php
require_once "../model/DatabaseConnection.php";

if(isset($_POST['orderid'], $_POST['status'])){

    $orderid = $_POST['orderid'];
    $status  = $_POST['status'];

    $db = new DatabaseConnection();
    $connection = $db->openConnection();

    $success = $db->updateOrderStatus($connection, $orderid, $status);
    if ($success) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status";
    }

    $db->closeConnection($connection);
}
?>
