<?php 
session_start();

$emailErr = $_SESSION["emailErr"] ?? "";
$passwordErr = $_SESSION["passwordErr"] ?? "";
$usertypeErr = $_SESSION["usertypeErr"] ?? "";
$signUpErr = $_SESSION["signUpErr"] ?? "";

$previousValues = $_SESSION["previousValues"] ?? [];
$usertype = $previousValues['usertype'] ?? '';

unset($_SESSION["previousValues"]);
unset($_SESSION["emailErr"]);
unset($_SESSION["passwordErr"]);
unset($_SESSION["usertypeErr"]);
unset($_SESSION["signUpErr"]);
?>

<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="../css/login.css">
    <script src="../controller/JS/checkEmail.js"></script>
</head>

<body>
<div class="login-container">

<form method="post"
      action="../controller/signup_validation.php"
      onsubmit="return validateSignup();">

<table>
    <tr>
        <td>Email</td>
        <td>
                   <input type="text" id="email" name="email" value="<?php echo $previousValues['email'] ?? '' ?>" onkeyup="findExistingEmail()"/>
                   
        </td>
         <td><p id="ajaxResponse"></p></td>
        <td class="error" id="emailErr"><?php echo $emailErr; ?></td>
    </tr>

    <tr>
        <td>Password</td>
        <td>
            <input type="password" id="password" name="password"
                   placeholder="Enter password">
        </td>
        <td class="error" id="passwordErr"><?php echo $passwordErr; ?></td>
    </tr>

    <tr>
        <td>User Type</td>
        <td>
            <select name="usertype" id="usertype">
                <option value=""></option>
               
                <option value="deliverystaff" <?php if($usertype=='deliverystaff') echo 'selected'; ?>>Delivery Staff</option>
              
            </select>
        </td>
        <td class="error" id="usertypeErr"><?php echo $usertypeErr; ?></td>
    </tr>

    <tr>
        <td></td>
        <td class="error"><?php echo $signUpErr; ?></td>
    </tr>

    <tr>
        <td><input type="submit" value="Sign Up"></td>
    </tr>
     <tr>
        <td>
            <a href="..\..\Admin\View\AdminDashboard.php"> <--Back</a>
        </td>
    </tr>


</table>

</form>
</div>

<script src="../controller/JS/signup_validation.js"></script>
</body>
</html>
