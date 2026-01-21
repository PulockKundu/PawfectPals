<?php
session_start();
$cartItems = $_SESSION['cart'] ?? [];
$grandTotal = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart Summary</title>
    <style>
        body { 
            font-family: Arial; 
            background: #c6d2d2; 
            padding: 40px; }
        .cart-container { 
            background: white; 
            padding: 20px; 
            border-radius: 10px; 
            max-width: 900px; 
            margin: auto; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 15px; }
        th, td { 
            padding: 12px; 
            border: 1px solid #ddd; 
            text-align: center; }
        th { background: #4cb8eb; 
             color: white; }
        .qty-btn { 
            text-decoration: none; 
            background: #eee; 
            padding: 2px 10px; 
            border: 1px solid #ccc; 
            color: #333; 
            border-radius: 3px; 
            font-weight: bold; }
        .qty-btn:hover { 
            background: #ddd; }
        .remove-link { 
            color: #ff4d4d; 
            text-decoration: none; 
            font-size: 12px; 
            font-weight: bold; }
        .total { 
            font-size: 22px; 
            font-weight: bold; 
            text-align: right; 
            padding: 20px; 
            color: #1e6c90; }
        .btn-main { 
            padding: 10px 20px; 
            text-decoration: none; 
            color: white; 
            border-radius: 5px; 
            font-weight: bold; 
            display: inline-block; }
    </style>
</head>
<body>
    <div class="cart-container">
        <h2 style="text-align:center;"> Shopping Cart</h2>
        <table>
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
            <?php if(empty($cartItems)): ?>
                <tr><td colspan="6">Your cart is empty! <br><br><a href="dashboard.php" style="color:#1e6c90;">Go back to shop</a></td></tr>
            <?php else: ?>
                <?php foreach ($cartItems as $name => $item): 
                    $qty = $item['qty'] ?? 1;
                    $subtotal = $item['price'] * $qty;
                    $grandTotal += $subtotal; 
                ?>
                <tr>
                    <td><img src="<?php echo $item['image']; ?>" width="50" style="border-radius:5px;"></td>
                    <td><?php echo $item['name']; ?></td>
                    <td>৳<?php echo $item['price']; ?></td>
                    <td>
                        <a href="../Controller/cartController.php?remove=<?php echo urlencode($name); ?>" class="qty-btn">-</a>
                        
                        <span style="margin: 0 15px;"><strong><?php echo $qty; ?></strong></span>
                        
                        <a href="../Controller/cartController.php?add_one=<?php echo urlencode($name); ?>" class="qty-btn">+</a>
                    </td>
                    <td>৳<?php echo $subtotal; ?></td>
                    <td>
                        <a href="../Controller/cartController.php?delete_full=<?php echo urlencode($name); ?>" class="remove-link">Delete All</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>

        <?php if(!empty($cartItems)): ?>
            <div class="total">Grand Total: ৳<?php echo $grandTotal; ?></div>
            <div style="text-align: center; margin-top: 20px;">
                <a href="dashboard.php" class="btn-main" style="background:#1e6c90;">← Continue Shopping</a>
                <a href="../Controller/cartController.php?clear=1" class="btn-main" style="background:#666;">Clear Cart</a>
                <a href="checkout.php" class="btn-main" style="background:#28a745; margin-left:10px;">Place Order</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>