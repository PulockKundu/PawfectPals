
<?php 
include "../model/DatabaseConnection.php";

session_start();

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];

$errors = [];
$values = [];

if(!$email){
    $errors["email"] = "This is a required field";
}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors["email"] = "Enter the correct email";
}

if(!$password){
    $errors["password"] = "Password field is required";
}
elseif(strlen($password) < 6){
    $errors["password"] = "Password must be at least 6 characters";
}
elseif(!preg_match('/[@#]/', $password)){
    $errors["password"] = "Password must contain @ or #";
}

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
$values["email"] = $email;

$_SESSION["previousValues"] = $values;

Header("Location: ..\View\login.php");

}else{
    $db = new DatabaseConnection();
    $connection = $db->openConnection();
    $result = $db->signin($connection, "users", $email, $password);
    if($result->num_rows > 0){
      
        $user = $result->fetch_assoc(); 

   
    $_SESSION["userId"] = $user["id"]; 
    $_SESSION["isLoggedIn"] = true;    
    $_SESSION["email"] = $email;      
    $_SESSION["userName"] = $user["Name"]; 

    Header("Location: ..\View\dashboard.php");

    }else{
        $_SESSION["loginErr"] = "Email or password is invalid";
        $_SESSION["previousValues"] = ["email" => $email];
        Header("Location: ..\View\login.php");
    }
    
}




?>