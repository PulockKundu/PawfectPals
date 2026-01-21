<?php 
include "../model/DatabaseConnection.php";

error_reporting(E_ALL);
ini_set("display_error", 1);

session_start();

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];
$usertype = $_REQUEST["usertype"];

$errors = [];
$values = [];

// if(!$email){
//     $errors["email"] = "This is a required field";
// }
// elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
//     $errors["email"] = "Please Enter the correct email";
// }
// else {
//     $values["email"] = $email;  
// }

// if(!$password){
//     $errors["password"] = "Password field is required";
// }
// elseif(strlen($password) < 6){
//     $errors["password"] = "Password must be at least 6 characters";
// }
// elseif(!preg_match('/[@#]/', $password)){
//     $errors["password"] = "Password must contain @ or #";
// }

// if(!$usertype){
//     $errors["usertype"] = "usertype field is required";
// }
// else {
//     $values["usertype"] = $usertype; 
// }

if(count($errors) > 0){
    if($errors["email"] != ""){
        $_SESSION["emailErr"] = $errors["email"];
    }else{
        unset($_SESSION["emailErr"]);
    }
    if($errors["password"] != ""){
        $_SESSION["passwordErr"] = $errors["password"];
    }else{
        unset($_SESSION["passwordErr"]);
    }
    if($errors["usertype"] != ""){
        $_SESSION["usertypeErr"] = $errors["usertype"];
    }else{
        unset($_SESSION["usertypeErr"]);
    }


$values["email"] = $email;

$_SESSION["previousValues"] = $values;

Header("Location: ..\View\signup.php");

}else{
    
    $db = new DatabaseConnection();
    $connection = $db->openConnection();
    $result = $db->signUp($connection, "users", $email, $password, $usertype);
    if($result){
        $_SESSION["successMsg"] = "Signup successful!";
     Header("Location: ..\..\Admin\View\AdminDashboard.php");
     
      
    }else{
        $_SESSION["signUpErr"] = "Failed to signup";
        Header("Location: ..\View\signup.php");
    }
    
}

?>
