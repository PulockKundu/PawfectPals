<?php 
session_start();

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if($isLoggedIn){
    Header("Location: dashboard.php");
    
}
$emailErr = $_SESSION["emailErr"] ?? "";
$passwordErr = $_SESSION["passwordErr"] ?? "";
$loginErr = $_SESSION["loginErr"] ?? "";

$previousValues = $_SESSION["previousValues"] ?? [];


unset($_SESSION["previousValues"]);
unset($_SESSION["emailErr"]);
unset($_SESSION["passwordErr"]);
unset($_SESSION["loginErr"]);


?>

<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
<!-- <pre><?php echo $previousValues["email"];?></php></pre> -->
 <div class="login-container">
    <h2>Delivery Man Login</h2>
<form method="post" onsubmit="" action="..\controller\login_validation.php">
    <table>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email"  placeholder="Enter your email" value="<?php echo $previousValues["email"] ?? "" ?>"/> </td>
            <!-- <td><?php echo $emailErr; ?></td> -->
        </tr>
        <tr>
          <td></td>
          <td class="error"><?php echo $emailErr; ?></td>
         </tr>


        <tr>
            <td>Password</td>
            <td><input type="password" name="password"  placeholder="Enter password" /></td>
            <!-- <td><?php  echo $passwordErr; ?></td> -->
        </tr>
        <tr>
    <td></td>
    <td class="error"><?php echo $passwordErr; ?></td>
</tr>

        <tr>
            <td></td>
            <td><?php echo $loginErr; ?></td>
        </tr>
        <tr>
            <td><input type="submit" name="login" value="Login"/> </td>
        </tr>
    </table>
</form>
</div>
</body>
</html>