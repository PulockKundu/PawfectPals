<?php
session_start();
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: dashboard.php");
    exit();
}

$grandTotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $grandTotal += ($item['price'] * $item['qty']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Pet Shop</title>
    <style>
        body { 
            font-family: Arial; 
            background: #c6d2d2; 
            padding: 40px; }
        .checkout-box { 
            background: white; 
            padding: 30px; 
            border-radius: 10px; 
            max-width: 500px; 
            margin: auto; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        input, select { 
            width: 100%; 
            padding: 10px; 
            margin: 10px 0; 
            border: 1px solid #ccc; 
            border-radius: 5px; }
        .confirm-btn { 
            width: 100%; 
            background: #28a745; 
            color: white; 
            border: none; 
            padding: 12px; 
            border-radius: 5px; 
            cursor: pointer; 
            font-weight: bold; }
    </style>
</head>
<body>
    <div class="checkout-box">
        <h2>Confirm Your Order</h2>
        <p>Customer: <b><?php echo $_SESSION['userName']; ?></b></p>
        <p>Total Amount: <b>৳<?php echo $grandTotal; ?></b></p>
        
        <form action="../Controller/confirmOrder.php" method="POST">
            <label>Delivery Location:</label>
            <select name="location" required>
                <option value="Dhanmondi">Dhanmondi</option>
                <option value="Bashundhara R/A">Bashundhara R/A</option>
                <option value="Uttara">Uttara</option>
                <option value="Kuril">Kuril</option>
            </select>
            <button type="submit" class="confirm-btn">Confirm & Place Order</button>
        </form>
    </div>
</body>
</html>