<?php
session_start();
include "../Model/databaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->openConnection();

$uid = $_SESSION["userId"];
$name = $_POST['userName'];
$email = $_POST['userEmail'];
$newPass = $_POST['newPassword'];


$sql = "UPDATE users SET Name='$name', email='$email' WHERE id='$uid'";

if($conn->query($sql)) {
    if(!empty($newPass)) {
        $conn->query("UPDATE users SET password='$newPass' WHERE id='$uid'");
    }
    $_SESSION["userName"] = $name; 
    echo "<script>alert('Profile Updated!'); window.location.href='../View/profile.php';</script>";
}
$conn->close();
?>