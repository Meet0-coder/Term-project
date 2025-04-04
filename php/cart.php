<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'eshop_db', 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_id'])) {
    $removeId = $_POST['remove_id'];
    if (isset($_SESSION['cart'][$removeId])) {
        $_SESSION['cart'][$removeId]['quantity']--;
        if ($_SESSION['cart'][$removeId]['quantity'] <= 0) {
            unset($_SESSION['cart'][$removeId]);
        }
    }
    header("Location: cart.php");
    exit();
}

// Handle update quantity request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'], $_POST['quantity'])) {
    $updateId = $_POST['update_id'];
    $quantity = intval($_POST['quantity']);
    if ($quantity > 0 && isset($_SESSION['cart'][$updateId])) {
        $_SESSION['cart'][$updateId]['quantity'] = $quantity;
    }
    header("Location: cart.php");
    exit();
}

$cart = $_SESSION['cart'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart | E-Shop</title>
    <link rel="stylesheet" href="../css/example.css">
    <style>
        body { font-family: Arial; padding: 30px; background: #f6f6f6; }
        .cart-container { background: white; padding: 20px; border-radius: 8px; max-width: 900px; margin: auto; }
        .cart-item { display: flex; gap: 20px; padding: 15px 0; border-bottom: 1px solid #eee; }
        .cart-item img { width: 100px; height: 100px; object-fit: contain; }
        .cart-details { flex: 1; }
        .cart-details h3 { margin: 0; font-size: 18px; }
        .price { color: #b12704; font-weight: bold; }
        .subtotal { font-size: 14px; color: #555; }
        .remove-btn, .update-qty-btn {
            border: none; padding: 6px 14px; border-radius: 5px; cursor: pointer; margin-top: 10px;
        }
        .remove-btn { background: #e53935; color: white; }
        .remove-btn:hover { background: #c62828; }
        .update-qty-btn { background: #f0ad4e; color: white; }
        .update-qty-btn:hover { background: #ec971f; }
        .checkout-btn { background: #ff9900; padding: 12px 25px; color: #111; font-weight: bold; border-radius: 6px; text-decoration: none; display: inline-block; }
        .checkout-btn:hover { background: #e68a00; }
        .empty-msg { text-align: center; padding: 60px 20px; }
    </style>
</head>
<body>
<div class="cart-container">
<?php if (empty($cart)): ?>
    <div class="empty-msg">
        <h1>Your Shopping Cart</h1>
        <img src="../images/cart.jpg.png" alt="Empty Cart" style="max-width:200px;">
        <h2>Your cart is empty</h2>
        <p>Looks like you haven't added anything yet.</p>
        <a href="index.php" class="checkout-btn" style="background:#0073e6; color:white;">Start Shopping</a>
    </div>
<?php else: ?>
    <h1>Your Shopping Cart</h1>
    <?php
    $total = 0;
    foreach ($cart as $productId => $item):
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
    ?>
    <div class="cart-item">
        <img src="../images/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
        <div class="cart-details">
            <h3><?= htmlspecialchars($item['name']) ?></h3>
            <div class="price">Price: $<?= number_format($item['price'], 2) ?></div>
            <div class="subtotal">Quantity: <?= $item['quantity'] ?> | Subtotal: $<?= number_format($subtotal, 2) ?></div>
            <!-- Remove -->
            <form method="POST" style="display:inline;">
                <input type="hidden" name="remove_id" value="<?= $productId ?>">
                <button type="submit" class="remove-btn">🗑 Remove</button>
            </form>
            <!-- Update Quantity -->
            <form method="POST" action="cart.php" style="display:inline;">
                <input type="hidden" name="update_id" value="<?= $productId ?>">
                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" max="99" style="width: 60px; text-align: center;">
                <button type="submit" class="update-qty-btn">🔁 Update</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="total-section" style="text-align:right; font-size:18px; margin-top: 20px;">
        <strong>Total: $<?= number_format($total, 2) ?></strong>
    </div>
    <div style="margin-top: 20px; text-align:right;">
        <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
        <a href="index.php" class="checkout-btn" style="background:#0073e6; color:white;">Back to Home</a>
    </div>
<?php endif; ?>
</div>
</body>
</html>