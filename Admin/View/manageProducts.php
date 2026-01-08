<?php
session_start();
include "../Model/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->openConnection();

if(isset($_POST["add"])){
    $name = $_POST["name"];
    $price = $_POST["price"];
    $conn->query("INSERT INTO products(name,price) VALUES('$name','$price')");
}

$result = $conn->query("SELECT * FROM products");
?>

<html>
<head>
<style>
body{
    font-family: Arial;
    background:#fffaf0;
}
form, table{
    width:60%;
    margin:auto;
    background:white;
    padding:15px;
}
input{
    padding:6px;
    margin:5px;
}
table{
    border-collapse:collapse;
}
th,td{
    border:1px solid #ccc;
    padding:8px;
    text-align:center;
}
th{
    background:#fdebd0;
}
</style>
</head>

<body>

<h2 style="text-align:center;">Manage Products</h2>

<form method="post">
<input type="text" name="name" placeholder="Product Name">
<input type="number" name="price" placeholder="Price">
<input type="submit" name="add" value="Add Product">
</form>

<table>
<tr>
<th>ID</th><th>Name</th><th>Price</th>
</tr>

<?php while($row=$result->fetch_assoc()){ ?>
<tr>
<td><?php echo $row["id"]; ?></td>
<td><?php echo $row["name"]; ?></td>
<td><?php echo $row["price"]; ?></td>
</tr>
<?php } ?>
</table>

<p style="text-align:center;">
<a href="AdminDashboard.php">⬅ Back</a>
</p>

</body>
</html>
