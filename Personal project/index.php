<?php
session_start();
require 'db.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Products array (can be moved to DB later)
$products = [
    1 => ["name" => "T-shirt", "price" => 15],
    2 => ["name" => "Jeans", "price" => 40],
    3 => ["name" => "Sneakers", "price" => 60],
    4 => ["name" => "Hat", "price" => 10]
];

// Add to cart logic - user specific cart
if (isset($_GET['add'])) {
    $id = (int)$_GET['add'];
    if (isset($products[$id])) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = 0;
        }
        $_SESSION['cart'][$id]++;
    }
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Shopping - Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></title>
</head>
<body>
    <h1>Products</h1>
    <p>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>! <a href="logout.php">Logout</a></p>

    <ul>
        <?php foreach ($products as $id => $product): ?>
            <li>
                <?php echo htmlspecialchars($product['name']); ?> - $<?php echo $product['price']; ?>
                <a href="?add=<?php echo $id; ?>">Add to Cart</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <p><a href="cart.php">View Cart (<?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?> items)</a></p>
</body>
</html>
