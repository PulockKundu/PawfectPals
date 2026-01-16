<?php 

class DatabaseConnection{
    function openConnection(){
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "pawfect";

        $connection  = new mysqli($db_host, $db_user, $db_password, $db_name);
        if($connection->connect_error){
            die("Could not connect database ".$connection->connect_error);
        }
        return $connection;
    }

    function signUp($connection, $tableName, $email, $password, $usertype){
        $sql = "INSERT INTO ".$tableName." (email, password, usertype) VALUES ('".$email."', '".$password."', '".$usertype."')";
        $result = $connection->query($sql);
        return $result;
    }
    function signin($connection, $tableName, $email, $password){
        $sql = "SELECT * FROM ".$tableName." WHERE email='".$email."' AND password='".$password."'";
        $result = $connection->query($sql);
        return $result;
    }
 function getOrdersByEmail($connection, $tableName, $email){
    $sql = "SELECT * FROM ".$tableName." WHERE deliverystaffemail = '".$email."'";
    $result = $connection->query($sql);
    return $result;
}
function getAssignedOrdersCount($connection, $tableName, $email){
    $sql = "SELECT COUNT(*) AS total 
            FROM ".$tableName." 
            WHERE deliverystaffemail = '".$email."'";
    $result = $connection->query($sql);
    return $result;
}
function getOutForDeliveryCount($connection, $tableName, $email){
    $sql = "SELECT COUNT(*) AS total 
            FROM ".$tableName." 
            WHERE deliverystaffemail = '".$email."' 
            AND status = 'Out for Delivery'";
    $result = $connection->query($sql);
    return $result;
}
function getDeliveredCount($connection, $tableName, $email){
    $sql = "SELECT COUNT(*) AS total 
            FROM ".$tableName." 
            WHERE deliverystaffemail = '".$email."' 
            AND status = 'Delivered'";
    $result = $connection->query($sql);
    return $result;
}
function getCancelledCount($connection, $tableName, $email){
    $sql = "SELECT COUNT(*) AS total 
            FROM ".$tableName." 
            WHERE deliverystaffemail = '".$email."' 
            AND status = 'Cancelled'";
    $result = $connection->query($sql);
    return $result;
}

public function updateOrderStatus($connection, $orderId, $status) {
    $sql = "UPDATE orderdetails SET status = ? WHERE orderid = ?";  
    $stmt = $connection->prepare($sql);  
    $stmt->bind_param("si", $status, $orderId);  
    return $stmt->execute();
}

function getAllUsers($connection, $tableName){
        $sql = "SELECT * FROM ".$tableName;
        $result = $connection->query($sql);
        return $result;
    }




    function closeConnection($connection){
        $connection->close();
    }
}

?>