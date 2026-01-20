<?php 
session_start();

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if(!$isLoggedIn){
    header("Location: login.php");
    exit();
}

$userName = $_SESSION["userName"] ?? "User";

$cartCount = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['qty'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
    body {
        background-color:#c6d2d2;
        font-family:Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .searchbar {
        position: sticky; 
        top:0;
        width:100%;
        height: 60px;
        background-color: #4cb8eb;
        display: flex;
        justify-content: space-between; 
        align-items: center;
        border:1px solid #1e6c90 ;
        padding: 0 20px;
        box-sizing: border-box;
        z-index: 100;
    }

    .searchbar_input {
        width: 30%; 
        padding: 10px;
        border-radius: 5px;
        border: none;
        outline: none;
    }

    .user-info {
        color: white;
        font-size: 14px;
        display: flex;
        align-items: center;
    }

    .logout-btn {
        color: #ff0000;
        text-decoration: none;
        background: white;
        padding: 5px 10px;
        border-radius: 4px;
        margin-left: 10px;
        font-weight: bold;
    }

    
    .view-cart-link {
        background: #FAF3E0;
        color: #1e6c90;
        padding: 8px 15px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        border: 1px solid #1e6c90;
        font-size: 14px;
    }

    .view-cart-link:hover {
        background: #fdfaf0;
    }

    .welcome{
        width:100%;
        height: 500px;
        background-color:#ffe0a6;
        display: flex;
        border-bottom: 2px solid #000;
    }

    .product-container {
        display: flex;
        justify-content: space-evenly;
        flex-wrap: wrap;
        margin-top: 20px;
        padding: 20px;
    }

   .product-box {
        display: inline-block;
        width: 500px;             
        height: 450px;
        border: 1px solid #2c1b02;
        background-color: #FAF3E0;
        margin: 20px;        
        padding: 20px;
        text-align: center;
        transition: 0.3s;
    }

    button {
        width: 190px;
        height:30px;
        background-color: #daffa6;
        font-size: 16px;
        cursor: pointer;
        border: 1px solid #000;
    }

    .product-box:hover {
        outline:2px solid #1b5b69;
        outline-offset:8px;
    }

    .product-img {
        width:100%;
        height:400px;
        object-fit:cover;
    }

    .home-img {
        width:100%;
        height:500px;
        object-fit:cover;
    }

    .footer_style {
        width:100%;
        height: 150px;
        background-color: #4cb8eb;
        text-align: center;
        padding-top: 20px;
        margin-top: 50px;
    }
    
    a {
        text-decoration: none;
    }
    </style>
</head>

<body>

    <div class="searchbar">
        <div class="user-info">
            Welcome, <b><?php echo $userName; ?></b>
            <a href="../Controller/logout.php" class="logout-btn">Logout</a>
        </div>
        
        <input type="text" placeholder="Search here....." class="searchbar_input">

        <div class="cart-section">
            <a href="viewCart.php" class="view-cart-link">
             View Cart (<?php echo $cartCount; ?>)
            </a>
        </div>
    </div>

    <div class="welcome">
        <img src="../images/home.png" class="home-img">
    </div>

    <div class="product-container">

        <div class="product-box">
            <img src="../images/cutecat.avif" class="product-img">
            <br><br>
            <a href="catProducts.php">
                <button type="button"><b>Cat Product</b></button>
            </a>
        </div>

        <div class="product-box">
            <img src="../images/doghome.jpg" class="product-img">
            <br><br>
            <a href="dogProducts.php">
                <button type="button"><b>Dog Product</b></button>
            </a>
        </div>

        <div class="product-box">
            <img src="../images/toy.png" class="product-img">
            <br><br>
            <a href="toyProducts.php">
                <button type="button"><b>Pet Toy</b></button>
            </a>
        </div>

        <div class="product-box">
            <img src="../images/grom.png" class="product-img">
            <br><br>
            <a href="groomingProduct.php">
                <button type="button"><b>Grooming Product</b></button>
            </a>
        </div>

    </div>

    <div class="footer_style">
        <hr>
        <footer>@copyright 2026</footer>
    </div>

</body>
</html>