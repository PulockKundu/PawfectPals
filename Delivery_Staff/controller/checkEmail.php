<?php
include "../model/DatabaseConnection.php";
$email="";
$email=$_POST["email"];

if($email==""){
    echo "Email Empty";
}
else{
   
    $db=new DatabaseConnection();
    $connection=$db->openConnection();
    $result=$db->checkExistingUser($connection,"users",$email);
    if ($result->num_rows > 0)
    {
       echo "Email Already Used";
    }

    else{
            echo "Unique Email, can be used";
    }
    
}




?>
