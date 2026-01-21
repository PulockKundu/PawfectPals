<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        $pName = $_POST['name'];
        $pPrice = (int)$_POST['price'];
        $pImage = $_POST['image'];

        if (!isset($_SESSION['cart'])) { $_SESSION['cart'] = []; }

        if (isset($_SESSION['cart'][$pName])) {
            $_SESSION['cart'][$pName]['qty'] += 1;
        } else {
            $_SESSION['cart'][$pName] = [
                'name' => $pName, 'price' => $pPrice, 'image' => $pImage, 'qty' => 1
            ];
        }
        echo count($_SESSION['cart']);
        exit();
    }
}

if (isset($_GET['add_one'])) {
    $itemKey = $_GET['add_one'];
    if (isset($_SESSION['cart'][$itemKey])) {
        $_SESSION['cart'][$itemKey]['qty'] += 1;
    }
    header("Location: ../View/viewCart.php");
    exit();
}

if (isset($_GET['remove'])) {
    $itemKey = $_GET['remove'];
    if (isset($_SESSION['cart'][$itemKey])) {
        if ($_SESSION['cart'][$itemKey]['qty'] > 1) {
            $_SESSION['cart'][$itemKey]['qty'] -= 1;
        } else {
            unset($_SESSION['cart'][$itemKey]);
        }
    }
    header("Location: ../View/viewCart.php");
    exit();
}

if (isset($_GET['delete_full'])) {
    $itemKey = $_GET['delete_full'];
    if (isset($_SESSION['cart'][$itemKey])) {
        unset($_SESSION['cart'][$itemKey]);
    }
    header("Location: ../View/viewCart.php");
    exit();
}

if (isset($_GET['clear'])) {
    unset($_SESSION['cart']);
    header("Location: ../View/viewCart.php");
    exit();
}
?>