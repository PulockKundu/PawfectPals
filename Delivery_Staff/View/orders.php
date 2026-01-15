<?php
//include "../Model/DatabaseConnection.php";
require_once "../Model/DatabaseConnection.php";
// session_start(); //  

function TableHeader(){
    echo "<table style='border:3px solid black; border-collapse:collapse; border-color: #25d27b; '><tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Location</th>
            <th>Status</th>
            <th>Order Date</th>
            <th>Delivery Date</th>
            <th>Delivery Staff </th>
          </tr>";
}
function TableRow(){
    $db = new DatabaseConnection();
    $connection = $db->openConnection();
    $email = $_SESSION['email'];
    $result = $db->getOrdersByEmail($connection, "orderdetails", $email);
    //$result = $db->getAllUsers($connection, "orderdetails");
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<tr>
                <td>".$row['orderid']."</td>
                <td>".$row['customername']."</td>         
                <td>".$row['location']."</td>
                <td>".$row['status']."</td>
                <td>".$row['orderdate']."</td>
                <td>".$row['deliverydate']."</td>
                <td>".$row['deliverystaffemail']."</td>
          </tr>";
        }
    }
    echo "</table>";
}


TableHeader();
TableRow();
$db = new DatabaseConnection();
    $connection = $db->openConnection();
$db->closeConnection($connection);

?>