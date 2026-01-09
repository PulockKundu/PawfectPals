<?php
class DatabaseConnection {
    public function openConnection() {
        $conn = new mysqli("localhost", "root", "", "pawfect");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
?>
