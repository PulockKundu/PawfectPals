<?php 
session_start();
$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if(!$isLoggedIn){
    header("Location: login.php");
    exit();
}

$userName = $_SESSION["userName"] ?? "User";


$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dog Products</title>

    <style>
    body { 
        background-color:#c6d2d2; 
        font-family:Arial, 
        sans-serif; margin: 0; 
        padding: 0; }

    .searchbar {
        position: sticky; 
        top:0; 
        width:100%; 
        height: 60px;
        background-color: #4cb8eb; 
        display: flex;
        justify-content: center; 
        align-items: center;
        border:1px solid #1e6c90 ; 
        z-index: 1000;
    }

    .user-greet { 
        position: absolute; 
        left: 20px; 
        color: white; 
        font-size: 14px; }
    .logout-btn { 
        margin-left: 10px; 
        color: red; 
        background: white; 
        text-decoration: none; 
        padding: 2px 5px; 
        border-radius: 3px; 
        font-weight: bold; }

    
    .cart-header { 
        position: absolute; 
        right: 20px; }
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
        top: 80px; right: 20px;
        background-color: #28a745; 
        color: white; 
        padding: 15px 25px;
        border-radius: 8px; 
        box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
        z-index: 2000; 
        font-weight: bold;
    }
    

    .searchbar_input { 
        width: 40%; 
        padding: 10px; 
        border-radius: 5px; 
        border: none; 
        outline: none; }
    .product-container { 
        display: flex; 
        flex-wrap: wrap; 
        justify-content: center; 
        margin-top: 20px; 
        padding: 20px; 
        gap: 20px; }
    .product-box { 
        flex: 0 0 30%; 
        height: 450px; 
        border: 1px solid #2c1b02; 
        background-color: #FAF3E0; 
        padding: 20px; 
        text-align: center; 
        transition: 0.3s; 
        box-sizing: border-box; }
    .product-box:hover { 
        outline:2px solid #1b5b69; 
        outline-offset:8px; }
    .product-img { 
        width: 60%; 
        height: 260px; 
        object-fit: cover; 
        border-radius: 5px; }
    .product-name { 
        font-size: 18px; 
        color: #333; 
        margin: 10px 0; 
        font-weight: bold; }
    .price { 
        font-size: 16px; 
        color: #1e6c90; 
        margin-bottom: 5px; 
        font-weight: bold; }
    .stock { 
        font-size: 14px; 
        color: green; 
        margin-bottom: 15px; }
    
    .product-box button { 
        width: 150px; 
        height: 35px; 
        background-color: #daffa6; 
        font-size: 15px; 
        border: 1px solid #333; 
        border-radius: 5px; 
        cursor: pointer; 
        transition: 0.3s; 
        font-weight: bold; }
    .product-box button:hover { 
        background-color: #b6e86b; }

    .footer_style { 
        width:100%; 
        height: 100px; 
        background-color: #4cb8eb; 
        text-align: center; 
        line-height: 100px; }
    </style>
</head>

<body>
    <div id="cart-popup">✔ Dog item added to cart!</div>

    <div class="searchbar">
        <div class="user-greet">
            <a href="dashboard.php" style="color: white; text-decoration: none; margin-right:15px;">← Home</a>
            Hi, <?php echo $userName; ?>
            <a href="../Controller/logout.php" class="logout-btn">Logout</a>
        </div>

        <input type="text" placeholder="Search dog products..." class="searchbar_input">

        <div class="cart-header">
            <a href="viewCart.php" class="view-cart-link">View Cart (<span id="cart-count"><?php echo $cartCount; ?></span>)</a>
        </div>
    </div>

    <div class="product-container">
        <div class="product-box">
            <img src="../images/dogfood.jpg" class="product-img" alt="Dog Food">
            <div class="product-name">Pedigree Nutrition Dry Food</div>
            <div class="price">৳1200</div>
            <div class="stock">In Stock</div>
            <button onclick="addToCart('Pedigree Nutrition Dry Food', 1200, '../images/dogfood.jpg')">Add to Cart</button>
        </div>

        <div class="product-box">
            <img src="../images/drydog.jpg" class="product-img" alt="Dry Dog Food">
            <div class="product-name">Dry Dog Food 5Kg-Chicken</div>
            <div class="price">৳800</div>
            <div class="stock">In Stock</div>
            <button onclick="addToCart('Dry Dog Food 5Kg-Chicken', 800, '../images/drydog.jpg')">Add to Cart</button>
        </div>

        <div class="product-box">
            <img src="../images/doglitter.jpg" class="product-img" alt="Dog Litter">
            <div class="product-name">Dog Nature Litter Sand</div>
            <div class="price">৳450</div>
            <div class="stock">In Stock</div>
            <button onclick="addToCart('Dog Nature Litter Sand', 450, '../images/doglitter.jpg')">Add to Cart</button>
        </div>

        <div class="product-box">
            <img src="../images/homemade.jpg" class="product-img" alt="Homemade Treats">
            <div class="product-name">Homemade Dog Treats</div>
            <div class="price">৳950</div>
            <div class="stock">In Stock</div>
            <button onclick="addToCart('Homemade Dog Treats', 950, '../images/homemade.jpg')">Add to Cart</button>
        </div>

        <div class="product-box">
            <img src="../images/milkbone.jpg" class="product-img" alt="Milk Bone">
            <div class="product-name">Milk Bone Soft & Chewy</div>
            <div class="price">৳1800</div>
            <div class="stock">In Stock</div>
            <button onclick="addToCart('Milk Bone Soft & Chewy', 1800, '../images/milkbone.jpg')">Add to Cart</button>
        </div>

        <div class="product-box">
            <img src="../images/chew.jpg" class="product-img" alt="Dog Chews">
            <div class="product-name">Long Lasting Dog Chews</div>
            <div class="price">৳350</div>
            <div class="stock">In Stock</div>
            <button onclick="addToCart('Long Lasting Dog Chews', 350, '../images/chew.jpg')">Add to Cart</button>
        </div>
    </div>

    <div class="footer_style">
        @copyright 2026
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