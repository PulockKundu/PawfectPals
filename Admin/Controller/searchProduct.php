<?php
include "../Model/DatabaseConnection.php";
$query = $_REQUEST["q"] ?? "";

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "SELECT product_id as id, product_name as name, price 
        FROM productitem 
        WHERE product_name LIKE '%$query%'";

$result = $conn->query($sql);

$data = [];
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data); 
?>