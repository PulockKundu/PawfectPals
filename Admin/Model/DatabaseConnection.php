<?php
class DatabaseConnection {
    function openConnection() {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db   = "pawfect"; 
        
        $connection = new mysqli($host, $user, $pass, $db);
        
        if($connection->connect_error) {
            die("Database connection failed: " . $connection->connect_error);
        }
        return $connection;
    }

    function signin($connection, $table, $email, $password) {
        $sql = "SELECT * FROM $table WHERE email = '$email' AND password = '$password' AND usertype = 'admin'";
        return $connection->query($sql);
    }

    function getAllUsers($connection) {
        $sql = "SELECT id, Name, email, usertype FROM users WHERE usertype != 'admin'";
        return $connection->query($sql);
    }

    function getAllOrders($connection) {
        $sql = "SELECT o.*, u.Name as staffName 
                FROM orderdetails o 
                LEFT JOIN users u ON o.deliverystaffemail = u.email 
                ORDER BY o.orderid DESC";
        return $connection->query($sql);
    }

    public function getDeliveryStaff($conn) {
    $sql = "SELECT Name, email FROM users WHERE usertype = 'deliverystaff'";
    return $conn->query($sql);
}

    function getAllProducts($connection) {
        $sql = "SELECT product_id, product_name, price, category FROM productitem";
        return $connection->query($sql);
    }

    function addProduct($connection, $name, $price, $category, $image_path = '../images/placeholder.jpg') {
        $name = mysqli_real_escape_string($connection, $name);
        $category = mysqli_real_escape_string($connection, $category);
        $sql = "INSERT INTO productitem (product_name, price, category, image_path) 
                VALUES ('$name', '$price', '$category', '$image_path')";
        return $connection->query($sql);
    }

    function searchProductAjax($connection, $name) {
        $sql = "SELECT product_id, product_name, price FROM productitem WHERE product_name LIKE '%$name%'";
        return $connection->query($sql);
    }

    function getSalesSummary($connection) {
        return $connection->query("SELECT status, COUNT(*) as total FROM orderdetails GROUP BY status");
    }

    function getInventorySummary($connection) {
        return $connection->query("SELECT category, COUNT(*) as count FROM productitem GROUP BY category");
    }
}
?>