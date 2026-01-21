<?php
//include "../model/DatabaseConnection.php";
require_once "../model/DatabaseConnection.php";


function TableHeader(){
    echo "<table style='border:3px solid black; border-collapse:collapse; border-color: #25d27b; '><tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Location</th>
            <th>Status</th>
            <th>Order Date</th>
            <th>Delivery Date</th>
            <th>Delivery Staff </th>
            <th>Update Status </th>
          </tr>";
}
function TableRow(){
    $db = new DatabaseConnection();
    $connection = $db->openConnection();
    $email = $_SESSION['email'];

    $result = $db->getOrdersByEmail($connection, "orderdetails", $email);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){

            $status = $row['status'];

            echo '
            <tr>
                <td>'.$row["orderid"].'</td>
                <td>'.$row["customername"].'</td>
                <td>'.$row["location"].'</td>
                <td id="status_'.$row["orderid"].'">'.$status.'</td>
                <td>'.$row["orderdate"].'</td>
                <td>'.$row["deliverydate"].'</td>
                <td>'.$row["deliverystaffemail"].'</td>

                <td>
                    <select onchange="update_status('.$row["orderid"].', this.value)">
                        <option value="Processing" '.($status=="Processing"?"selected":"").'>Processing</option>
                        <option value="Out for Delivery" '.($status=="Out for Delivery"?"selected":"").'>Out for Delivery</option>
                        <option value="Delivered" '.($status=="Delivered"?"selected":"").'>Delivered</option>
                        <option value="Cancelled" '.($status=="Cancelled"?"selected":"").'>Cancelled</option>
                    </select>
                </td>
            </tr>';
        }
    }
    echo "</table>";
}




TableHeader();
TableRow();
// $db = new DatabaseConnection();
//     $connection = $db->openConnection();
// $db->closeConnection($connection);

?>
<!-- // <body>
// <script src="../controller/JS/update_status.js"></script>
// </body> -->
