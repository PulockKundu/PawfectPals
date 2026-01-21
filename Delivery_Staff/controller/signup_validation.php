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

    
    $result = $db->checkExistingUser($connection, "users", $email);

    if ($result->num_rows > 0) {
       
        $_SESSION["emailErr"] = "Email is already used!";
        $_SESSION["previousValues"] = ["email" => $email]; 
        Header("Location: ..\View\signup.php");
      
    }

    $signUpResult = $db->signUp($connection, "users", $email, $password, $usertype);
    
    if ($signUpResult) {
        $_SESSION["successMsg"] = "Signup successful!";
        Header("Location: ..\..\Admin\View\AdminDashboard.php");
    } else {
        $_SESSION["signUpErr"] = "Failed to signup";
        Header("Location: ..\View\signup.php");
    }

}

?>
