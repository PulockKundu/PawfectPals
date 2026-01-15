
<?php
require_once "../Model/DatabaseConnection.php";

$db = new DatabaseConnection();
$connection = $db->openConnection();


$assignedRes  = $db->getAssignedOrdersCount($connection, "orderdetails", $email);
$outRes       = $db->getOutForDeliveryCount($connection, "orderdetails", $email);
$deliveredRes = $db->getDeliveredCount($connection, "orderdetails", $email);
$cancelledRes = $db->getCancelledCount($connection, "orderdetails", $email);

$assignedCount   = $assignedRes->fetch_assoc()['total'];
$outForDelivery  = $outRes->fetch_assoc()['total'];
$deliveredCount  = $deliveredRes->fetch_assoc()['total'];
$cancelledCount  = $cancelledRes->fetch_assoc()['total'];
?>