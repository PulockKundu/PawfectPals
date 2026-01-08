<?php
class DatabaseConnection{

    function openConnection(){
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db   = "pawfect";

        $connection = new mysqli($host, $user, $pass, $db);

        if($connection->connect_error){
            die("Database connection failed");
        }
        return $connection;
    }

    function signin($connection, $table, $email, $password){
        $sql = "SELECT * FROM ".$table." 
                WHERE email='".$email."' 
                AND password='".$password."' 
                AND role='admin'";
        return $connection->query($sql);
    }
}
?>
