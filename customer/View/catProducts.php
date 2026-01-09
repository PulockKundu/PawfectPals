<?php
session_start();
if(!($_SESSION['isLoggedIn'] ?? false)){
    header("Location: login.php");
    exit();
}

include "../Model/databaseConnection.php";
$db = new DatabaseConnection();
$conn = $db->openConnection();

// Fetch cat products from the database
$result = $conn->query("SELECT * FROM products WHERE category='cat'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Cat Products</title>
<style>
body { background-color:#c6d2d2; font-family:Arial; margin:0; padding:0; }
.searchbar { position:sticky; top:0;width:100%; height:60px; background-color:#4cb8eb; display:flex; justify-content:center; align-items:center; }
.searchbar_input { width:40%; padding:10px; border-radius:5px; border:none; outline:none; }
.product-container { display:flex; flex-wrap:wrap; justify-content:center; margin-top:20px; padding:20px; gap:20px; }
.product-box { flex:0 0 30%; height:450px; border:1px solid #2c1b02; background-color:#FAF3E0; padding:20px; text-align:center; transition:0.3s; box-sizing:border-box; }
.product-box:hover { outline:2px solid #1b5b69; outline-offset:8px; }
.product-img { width:70%; height:280px; object-fit:cover; border-radius:5px; }
.product-name { font-size:18px; color:#333; margin:10px 0; font-weight:bold; }
.price { font-size:16px; color:#60c0ed; margin-bottom:5px; }
.stock { font-size:14px; color:green; margin-bottom:15px; }
.product-box button { width:150px; height:35px; background-color:#daffa6; font-size:15px; border:none; border-radius:5px; cursor:pointer; transition:0.3s; }
.product-box button:hover { background-color:#b6e86b; }
.footer_style { width:100%; height:100px; position:static; bottom:0; background-color:#4cb8eb; text-align:center; line-height:100px; }
.logout, .back { position:absolute; top:20px; padding:10px 15px; border-radius:5px; text-decoration:none; color:white; }
.logout { right:20px; background:#e74c3c; }
.logout:hover { background:#c0392b; }
.back { left:20px; background:#3498db; }
.back:hover { background:#2980b9; }
</style>
</head>
<body>

<a href="dashboard.php" class="back">Back</a>
<a href="logout.php" class="logout">Logout</a>

<div class="searchbar">
    <input type="text" placeholder="Search cat products..." class="searchbar_input">
</div>

<div class="product-container">
<?php
if($result && $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo '<div class="product-box">';
        echo '<img src="../images/'.$row['image'].'" class="product-img" alt="'.$row['name'].'">';
        echo '<div class="product-name">'.$row['name'].'</div>';
        echo '<div class="price">Price: ৳'.$row['price'].'</div>';
        echo '<div class="stock">In Stock</div>';
        echo '<button>Add to Cart</button>';
        echo '</div>';
    }
} else {
    echo "<p>No cat products found.</p>";
}
?>
</div>

<div class="footer_style">@copyright2025</div>

</body>
</html>
