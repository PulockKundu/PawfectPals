<?php 

class DatabaseConnection{
    function openConnection(){
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "section_u";

        $connection  = new mysqli($db_host, $db_user, $db_password, $db_name);
        if($connection->connect_error){
            die("Could not connect database ".$connection->connect_error);
        }
        return $connection;
    }

    function signUp($connection, $tableName, $email, $password, $filepath){
        $sql = "INSERT INTO ".$tableName." (email, password, filepath) VALUES ('".$email."', '".$password."', '".$filepath."')";
        $result = $connection->query($sql);
        return $result;
    }
    function signin($connection, $tableName, $email, $password){
        $sql = "SELECT * FROM ".$tableName." WHERE email='".$email."' AND password='".$password."'";
        $result = $connection->query($sql);
        return $result;
    }
   public function getAssignedOrders($conn, $email) {
    $sql = "SELECT * FROM orders WHERE delivery_email='$email'";
    return $conn->query($sql);
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