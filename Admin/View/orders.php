<?php
include "../Model/DatabaseConnection.php";
$db = new DatabaseConnection();
$conn = $db->openConnection();
$result = $conn->query("SELECT * FROM orders");
?>

<html>
<head>
<style>
body{
    font-family: Arial;
    background:#eef2f3;
}
table{
    width:60%;
    margin:auto;
    border-collapse:collapse;
    background:white;
}
th,td{
    border:1px solid #bbb;
    padding:10px;
    text-align:center;
}
th{
    background:#d5dbdb;
}
</style>
</head>

<body>
<h2 style="text-align:center;">Orders</h2>

<table>
<tr>
<th>ID</th>
<th>Customer</th>
<th>Status</th>
</tr>

<?php while($row=$result->fetch_assoc()){ ?>
<tr>
<td><?php echo $row["id"]; ?></td>
<td><?php echo $row["customer_email"]; ?></td>
<td><?php echo $row["status"]; ?></td>
</tr>
<?php } ?>
</table>

<p style="text-align:center;">
<a href="AdminDashboard.php">⬅ Back</a>
</p>

</body>
</html>
