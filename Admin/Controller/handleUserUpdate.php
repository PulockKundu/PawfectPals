<?php
include "../Model/DatabaseConnection.php";

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $usertype = $_POST['usertype'];

    $db = new DatabaseConnection();
    $conn = $db->openConnection();
    
    $sql = "UPDATE users SET usertype = '$usertype' WHERE id = $id";
    
    if($conn->query($sql)) {
        header("Location: ../View/manageUsers.php?success=1");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>