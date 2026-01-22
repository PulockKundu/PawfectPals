<?php
session_start();
include "../Model/databaseConnection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    $customerName = $_SESSION['userName']; 
    $location = $_POST['location'];         
    $status = "Processing";                 
    $orderDate = date("Y-m-d");             

    $sql = "INSERT INTO orderdetails (customername, location, status, orderdate) 
            VALUES ('$customerName', '$location', '$status', '$orderDate')";

    if ($conn->query($sql)) {
        $newOrderID = $conn->insert_id; 

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $pName = $item['name'];
                $pQty  = $item['qty'];
                $pPrice = $item['price'];
                
                $sqlItem = "INSERT INTO order_items (orderid, product_name, quantity, price) 
                            VALUES ('$newOrderID', '$pName', '$pQty', '$pPrice')";
                $conn->query($sqlItem);
            }
        }

        unset($_SESSION['cart']);
        echo "<script>
                alert('Order #$newOrderID Placed Successfully!');
                window.location.href='../View/dashboard.php';
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
    $db->closeConnection();
}
?>
