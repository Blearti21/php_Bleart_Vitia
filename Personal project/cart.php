<?php
session_start();

$products = [
    1 => ["name" => "T-shirt", "price" => 15],
    2 => ["name" => "Jeans", "price" => 40],
    3 => ["name" => "Sneakers", "price" => 60],
    4 => ["name" => "Hat", "price" => 10]
];

// Remove item logic
if (isset($_GET['remove'])) {
    $id = (int)$_GET['remove'];
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
    header("Location: cart.php");
    exit;
}

// Clear cart
if (isset($_GET['clear'])) {
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
</head>
<body>
    <h1>Your Cart</h1>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $id => $qty):
                    $product = $products[$id];
                    $subtotal = $product['price'] * $qty;
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo $qty; ?></td>
                    <td>$<?php echo $product['price']; ?></td>
                    <td>$<?php echo $subtotal; ?></td>
                    <td><a href="?remove=<?php echo $id; ?>">Remove</a></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td colspan="2"><strong>$<?php echo $total; ?></strong></td>
                </tr>
            </tbody>
        </table>
        <p><a href="cart.php?clear=1">Clear Cart</a></p>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>

    <p><a href="index.php">Continue Shopping</a></p>

</body>
</html>


