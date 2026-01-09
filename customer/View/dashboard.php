<?php
session_start();
if(!($_SESSION['isLoggedIn'] ?? false)){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<style>
body { background-color:#c6d2d2; font-family:Arial; margin:0; padding:0; }
.searchbar { position:sticky; top:0; width:100%; height:60px; background-color:#4cb8eb; display:flex; justify-content:center; align-items:center; }
.searchbar_input { width:40%; padding:10px; border-radius:5px; border:none; outline:none; }
.logout { position:absolute; right:20px; background:#e74c3c; color:white; padding:8px 15px; border-radius:5px; text-decoration:none; font-size:14px; }
.logout:hover { background:#c0392b; }
.welcome {
    width: 100%;
    height: 100vh;  /* Full viewport height */
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;   /* Ensures no scrollbars if image is large */
}

.welcome img {
    width: 100%;
    height: 100%;
    object-fit: cover;  /* Makes it cover entire div without distortion */
}
.product-container { display:flex; justify-content:space-evenly; flex-wrap:wrap; margin-top:20px; padding:20px; }
.product-box { width:500px; height:450px; border:1px solid #2c1b02; background-color:#FAF3E0; margin:20px; padding:20px; text-align:center; transition:0.3s; }
.product-box:hover { outline:2px solid #1b5b69; outline-offset:8px; }
.product-img { width:500px; height:400px; object-fit:cover; }
button { width:190px; height:30px; background-color:#daffa6; font-size:16px; cursor:pointer; }
.footer_style { width:100%; height:300px; background-color:#4cb8eb; text-align:center; }
</style>
</head>
<body>

<div class="searchbar">
    <input type="text" placeholder="Search here....." class="searchbar_input">
    <a href="../Controller/logout.php" class="logout">Logout</a>
</div>

<div class="welcome">
    <img src="../images/home.png" alt="Welcome" />
</div>


<div class="product-container">
    <div class="product-box">
        <img src="../images/cutecat.avif" class="product-img"><br><br>
        <a href="catProducts.php"><button><b>Cat Product</b></button></a>
    </div>
    <div class="product-box">
        <img src="../images/doghome.jpg" class="product-img"><br><br>
        <a href="dogProducts.php"><button><b>Dog Product</b></button></a>
    </div>
    <div class="product-box">
        <img src="../images/toy.png" class="product-img"><br><br>
        <button><b>Pet Toy</b></button>
    </div>
    <div class="product-box">
        <img src="../images/grom.png" class="product-img"><br><br>
        <button><b>Grooming Product</b></button>
    </div>
</div>

<div class="footer_style">
    <hr>
    <footer>@copyright2025</footer>
</div>

</body>
</html>
