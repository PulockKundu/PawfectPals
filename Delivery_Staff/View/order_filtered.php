
<head>
<link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>
    <nav class="navbar">
    <div class="logo"> Pawfect Pals</div>

    <ul class="nav-links">
        <li><a href="dashboard.php">Home</a></li>
    
        <li><a href="delivery_history_main.php" target="_self">Delivery History</a></li>
       
        <li><a href="order_filtered.php">Filtered Order</a></li>
         <li><a href="update_profile.php">Profile</a></li>
        <li><a href="../controller/logout.php" class="logout">Logout</a></li>
    </ul>
</nav>

<img src="..\images\deliveredbylocation.png" alt="Delivered img -img" style="width:100%;height:300px;">
<h2>Order By Location</h2>
</body>

<?php
require_once "../model/DatabaseConnection.php";

// table order by location
function TableHeader(){
    echo "
    <table style='border:3px solid black; border-collapse:collapse; border-color:#25d27b; width:100%;'>
        <tr>
            <th>Location</th>
            <th>Total Orders</th>
        </tr>
    ";
}

function TableRow(){
    $db = new DatabaseConnection();
    $connection = $db->openConnection();

    $result = $db->getOrdersGroupedByLocation($connection, "orderdetails");

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "
            <tr>
                <td>".$row['location']."</td>
                <td>".$row['total']."</td>
            </tr>
            ";
        }
    }

    echo "</table>";
}

TableHeader();
TableRow();
// 2nd table order by date
function DateTableHeader(){
    echo "
    <h3></h3>
    <h3>Orders by Date</h3>  
    <table style='border:3px solid black; border-collapse:collapse; border-color:#25d27b; width:100%;'>
        <tr>
            <th>Order Date</th>
            <th>Total Orders</th>
        </tr>
    ";
}

function DateTableRow(){
    $db = new DatabaseConnection();
    $connection = $db->openConnection();

    $result = $db->getOrdersGroupedByDate($connection, "orderdetails");

    while($row = $result->fetch_assoc()){
        echo "
        <tr>
            <td>".$row['orderdate']."</td>
            <td>".$row['total']."</td>
        </tr>
        ";
    }
    echo "</table>";
}

DateTableHeader();
DateTableRow();

?>