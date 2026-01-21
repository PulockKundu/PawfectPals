<?php
session_start();

$_SESSION = array();

session_destroy();

header("Location: ../../customer/view/login.php");
exit();
?>