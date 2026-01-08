<?php
session_start();
include "../Model/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->openConnection();
$result = $conn->query("SELECT email,role FROM users");
?>

<html>
<head>
<style>
body{
    font-family: Arial;
    background:#f9f9f9;
}
table{
    width:60%;
    margin:auto;
    border-collapse:collapse;
    background:white;
}
th,td{
    padding:10px;
    border:1px solid #ccc;
    text-align:center;
}
th{
    background:#d6eaf8;
}
</style>
</head>

<body>
<h2 style="text-align:center;">Users List</h2>

<table>
<tr>
<th>Email</th>
<th>Role</th>
</tr>

<?php while($row=$result->fetch_assoc()){ ?>
<tr>
<td><?php echo $row["email"]; ?></td>
<td><?php echo $row["role"]; ?></td>
</tr>
<?php } ?>
</table>

<p style="text-align:center;">
<a href="AdminDashboard.php">⬅ Back</a>
</p>
</body>
</html>
