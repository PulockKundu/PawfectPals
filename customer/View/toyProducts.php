<?php 
session_start();


if(!isset($_SESSION["isLoggedIn"])){ 
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
    <title>Pet Toys</title>
    <style>
        body { background-color:#c6d2d2; 
        font-family:Arial, sans-serif; 
        margin: 0; 
        padding: 0; }

        
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
            z-index: 1000;
        }

        .user-info { 
            color: white; 
            font-size: 14px; }
        .logout-btn { 
            color: red; 
            background: white; 
            text-decoration: none; 
            padding: 5px 10px; 
            border-radius: 4px; 
            font-weight: bold; 
            margin-left: 10px; }
        .view-cart-link { 
            background: #FAF3E0; 
            color: #1e6c90; 
            padding: 8px 15px; 
            text-decoration: none; 
            border-radius: 5px; 
            font-weight: bold; 
            border: 1px solid #1e6c90; }

       
        #cart-popup {
            display: none; 
            position: fixed; 
            top: 80px; 
            right: 20px;
            background-color: #28a745; 
            color: white; 
            padding: 15px 25px;
            border-radius: 8px; 
            box-shadow: 0px 4px 10px rgba(0,0,0,0.2); 
            z-index: 2000; 
            font-weight: bold;
        }

       
        .product-container {
            display: flex; 
            flex-wrap: wrap; 
            justify-content: flex-start;
            padding: 40px; 
            gap: 2.5%; 
        }

        
        .product-box {
            flex: 0 0 31.6%; 
            height: 480px;
            border: 1px solid #2c1b02;
            background-color: #FAF3E0;
            padding: 20px;
            text-align: center;
            box-sizing: border-box;
            transition: 0.3s;
            margin-bottom: 20px;
        }

        .product-box:hover { 
            outline:2px solid #1b5b69; 
            outline-offset:8px; }
        .product-img { width: 100%; 
        height: 280px; 
        object-fit: cover; 
        border-radius: 5px; }
        .product-name { 
            font-size: 18px; 
            font-weight: bold; 
            margin: 15px 0; 
            color: #333; 
            height: 45px; 
            overflow: hidden; }
        .price { 
            color: #1e6c90; 
            font-weight: bold; 
            font-size: 18px; 
            margin-bottom: 15px; }
        
        .add-btn {
            width: 160px; 
            height: 35px; 
            background-color: #daffa6;
            border: 1px solid #333; 
            border-radius: 5px; 
            cursor: pointer;
            font-weight: bold; 
            transition: 0.3s;
        }
        .add-btn:hover { 
            background-color: #b6e86b; }

        .footer_style { 
            width:100%; 
            height: 100px; 
            background-color: #4cb8eb; 
            text-align: center; 
            line-height: 100px; 
            margin-top: 50px; }
    </style>
</head>
<body>

    <div id="cart-popup">✔ Toy added to cart!</div>

    <div class="searchbar">
        <div class="user-info">
            <a href="dashboard.php" style="color: white; text-decoration: none; margin-right:15px;">← Home</a>
            Hi, <b><?php echo $userName; ?></b>
            <a href="../Controller/logout.php" class="logout-btn">Logout</a>
        </div>
        

        <div class="cart-section">
            <a href="viewCart.php" class="view-cart-link">View Cart (<span id="cart-count"><?php echo $cartCount; ?></span>)
            </a>
        </div>
    </div>

    <div class="product-container">
        <div class="product-box">
            <img src="../images/ball.jpg" class="product-img">
            <div class="product-name">Interactive Rubber Ball</div>
            <div class="price">৳150</div>
            <button class="add-btn" onclick="addToCart('Interactive Rubber Ball', 150, '../images/ball.jpg')">Add to Cart</button>
        </div>

        <div class="product-box">
            <img src="../images/toynip.jpg" class="product-img">
            <div class="product-name">Cat Chew Toy Fill With Cat Nip</div>
            <div class="price">৳300</div>
            <button class="add-btn" onclick="addToCart('Cat Chew Toy Fill With Cat Nip', 300, '../images/toynip.jpg')">Add to Cart</button>
        </div>

        <div class="product-box">
            <img src="../images/petbed.jpg" class="product-img">
            <div class="product-name">Durable Cotton Chew Rope</div>
            <div class="price">৳250</div>
            <button class="add-btn" onclick="addToCart('Durable Cotton Chew Rope', 250, '../images/petbed.jpg')">Add to Cart</button>
        </div>
    </div>

    <div class="footer_style">
        <footer>@copyright 2026</footer>
    </div>

    <script>
    function addToCart(pName, pPrice, pImg) {
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "../Controller/cartController.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("cart-count").innerHTML = this.responseText;
                let popup = document.getElementById("cart-popup");
                popup.style.display = "block";
                setTimeout(() => { popup.style.display = "none"; }, 2000);
            }
        };
        xhttp.send("action=add&name=" + pName + "&price=" + pPrice + "&image=" + pImg);
    }
    </script>
</body>
</html>