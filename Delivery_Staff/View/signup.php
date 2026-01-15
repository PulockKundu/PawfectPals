
<?php 
session_start();

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if($isLoggedIn){
    Header("Location: dashboard.php");
}
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
</head>
<body>
<!-- <pre><?php echo $previousValues["email"];?></php></pre> -->
 <div class="login-container">
<form method="post" onsubmit="" action="..\controller\signup_validation.php" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email"  placeholder="Enter your email" value="<?php echo $previousValues["email"] ?? "" ?>"/> </td>
            <td class="error"><?php echo $emailErr; ?></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password"  placeholder="Enter password" /></td>
            <td class="error"><?php  echo $passwordErr; ?></td>
        </tr>
        <tr>
            <td>User Type</td>
             <td>
    <select name="usertype" id="usertype">
        <option value="" <?php if($usertype== '') echo 'selected'; ?>></option>
        <option value="customer" <?php if($usertype== 'customer') echo 'selected'; ?>>Customer</option>
        <option value="deliverystaff" <?php if($usertype == 'deliverystaff') echo 'selected'; ?>>Delivery Staff</option>
        <option value="admin" <?php if($usertype == 'admin') echo 'selected'; ?>>Admin</option>
    </select>
</td>
<td class="error"><?php echo $usertypeErr; ?></td>


        </tr>

        <tr>
            <td></td>
            <td class="error"><?php echo $signUpErr; ?></td>
        </tr>
        <tr>
            <td><input type="submit" name="signup" value="Sign Up"/> </td>
        </tr>
    </table>
</form>
</div>
</body>
</html>