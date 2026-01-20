<?php 
session_start();
if(!isset($_SESSION["isLoggedIn"])){ header("Location: login.php"); exit(); }
$email = $_SESSION["email"] ?? "";
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cat Products</title>
    <style>
        body { background-color:#c6d2d2; 
        font-family:Arial; 
        margin: 0; 
        padding: 0; }
        .searchbar { 
        position: sticky; 
        top:0; 
        width:100%;
        height: 60px; 
        background-color: #4cb8eb;
        display: flex; justify-content: center;
        align-items: center;
        z-index: 1000; 
        border-bottom: 2px solid #1e6c90;}
        .user-greet { 
        position: absolute; 
        left: 20px; 
        color: white; 
        font-size: 14px; }
        .logout-btn { 
            color: red; 
            background: white; 
            text-decoration: none; 
            padding: 2px 5px; border-radius: 3px; 
            font-weight: bold; 
            margin-left:10px; }
        
        /* Cart Link Style */
        .cart-header { position: absolute; right: 20px; }
        .view-cart-link { background: #FAF3E0; color: #1e6c90; padding: 8px 15px; text-decoration: none; border-radius: 5px; font-weight: bold; border: 1px solid #1e6c90; }

        /* Popup SMS Style */
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

        .product-container { display: flex; flex-wrap: wrap; justify-content: center; padding: 20px; gap: 20px; }
        .product-box { flex: 0 0 30%; height: 450px; border: 1px solid #2c1b02; background-color: #FAF3E0; padding: 20px; text-align: center; box-sizing: border-box; transition: 0.3s; }
        .product-box:hover { outline:2px solid #1b5b69; outline-offset:8px; }
        .product-img { width: 70%; height: 230px; object-fit: cover; border-radius: 5px; }
        .product-name { font-size: 17px; font-weight: bold; margin: 10px 0; height: 40px; }
        .price { color: #1e6c90; font-weight: bold; margin-bottom: 10px; }
        .add-btn { width: 140px; height: 35px; background-color: #daffa6; border: 1px solid #333; border-radius: 5px; cursor: pointer; font-weight: bold; }
        .add-btn:hover { background-color: #b6e86b; }
    </style>
</head>
<body>

    <div id="cart-popup">✔ Item added to cart!</div>

    <div class="searchbar">
        <div class="user-greet">
            <a href="dashboard.php" style="color: white; text-decoration: none; margin-right:15px;">← Home</a>
            Hi, <?php echo $email; ?>
            <a href="../Controller/logout.php" class="logout-btn">Logout</a>
        </div>
        <div class="cart-header">
            <a href="viewCart.php" class="view-cart-link">View Cart (<span id="cart-count"><?php echo $cartCount; ?></span>)</a>
        </div>
    </div>

    <div class="product-container">
        <div class="product-box">
            <img src="../images/catfood.jpg" class="product-img">
            <div class="product-name">Premium Cat Food</div>
            <div class="price">৳1200</div>
            <button class="add-btn" onclick="addToCart('Premium Cat Food', 1200, '../images/catfood.jpg')">Add to Cart</button>
        </div>
        <div class="product-box">
            <img src="../images/catlitter.jpg" class="product-img">
            <div class="product-name">Cat Litter Sand</div>
            <div class="price">৳800</div>
            <button class="add-btn" onclick="addToCart('Cat Litter Sand', 800, '../images/catlitter.jpg')">Add to Cart</button>
        </div>
        <div class="product-box">
            <img src="../images/catstick.jpg" class="product-img">
            <div class="product-name">Peien Cat Stick Treat 15g</div>
            <div class="price">৳450</div>
            <button class="add-btn" onclick="addToCart('Peien Cat Stick Treat 15g', 450, '../images/catstick.jpg')">Add to Cart</button>
        </div>
        <div class="product-box">
            <img src="../images/creamy.jpg" class="product-img">
            <div class="product-name">Real Fish Tuna Creamy Treats</div>
            <div class="price">৳950</div>
            <button class="add-btn" onclick="addToCart('Real Fish Tuna Creamy Treats', 950, '../images/creamy.jpg')">Add to Cart</button>
        </div>
        <div class="product-box">
            <img src="../images/treats.jpg" class="product-img">
            <div class="product-name">Catit Creamy Lickable Treats</div>
            <div class="price">৳1800</div>
            <button class="add-btn" onclick="addToCart('Catit Creamy Lickable Treats', 1800, '../images/treats.jpg')">Add to Cart</button>
        </div>
        <div class="product-box">
            <img src="../images/can.jpg" class="product-img">
            <div class="product-name">LEONARDO Cat food</div>
            <div class="price">৳350</div>
            <button class="add-btn" onclick="addToCart('LEONARDO Cat food', 350, '../images/can.jpg')">Add to Cart</button>
        </div>
        <div class="product-box">
            <img src="../images/dryfood.jpg" class="product-img">
            <div class="product-name">Prodiet 1.3kg Kitten Dry Food</div>
            <div class="price">৳900</div>
            <button class="add-btn" onclick="addToCart('Prodiet 1.3kg Kitten Dry Food', 900, '../images/dryfood.jpg')">Add to Cart</button>
        </div>
        <div class="product-box">
            <img src="../images/litter.jpg" class="product-img">
            <div class="product-name">Greenenqi Bentonite Litter 5L</div>
            <div class="price">৳2200</div>
            <button class="add-btn" onclick="addToCart('Greenenqi Bentonite Litter 5L', 2200, '../images/litter.jpg')">Add to Cart</button>
        </div>
        <div class="product-box">
            <img src="../images/catnip.jpg" class="product-img">
            <div class="product-name">Dried Catnip Natural 100g</div>
            <div class="price">৳1500</div>
            <button class="add-btn" onclick="addToCart('Dried Catnip Natural 100g', 1500, '../images/catnip.jpg')">Add to Cart</button>
        </div>
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