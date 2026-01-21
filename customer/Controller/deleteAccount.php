<?php
session_start();
include "../Model/databaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->openConnection();

$uid = $_SESSION["userId"];

$sql = "DELETE FROM users WHERE id='$uid'";

if($conn->query($sql)) {
    session_destroy();
    echo "<script>alert('Account Deleted Successfully'); window.location.href='../View/login.php';</script>";
}
$conn->close();
?>