<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect submitted data
    $fullName = htmlspecialchars($_POST['full_name']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $province = htmlspecialchars($_POST['province']);
    $postalCode = htmlspecialchars($_POST['postal_code']);
    $country = htmlspecialchars($_POST['country']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    // Sample products (should match IDs used in cart)
    $products = [
        ['id' => 1, 'name' => 'RGB Gaming Cabinet', 'price' => 149.99],
        ['id' => 2, 'name' => 'Essential Oils Kit', 'price' => 29.99],
        ['id' => 3, 'name' => 'Electric Toothbrush', 'price' => 49.95],
        ['id' => 4, 'name' => 'Vitamin D3 Supplement', 'price' => 19.49]
    ];
    $productMap = [];
    foreach ($products as $p) {
        $productMap[$p['id']] = $p;
    }

    // Calculate total
    $orderItems = '';
    $total = 0;
    foreach ($cart as $productId => $qty) {
        if (!isset($productMap[$productId])) continue;
        $item = $productMap[$productId];
        $subtotal = $item['price'] * $qty;
        $total += $subtotal;
        $orderItems .= "{$item['name']} x {$qty} - $" . number_format($subtotal, 2) . "\\n";
    }

    // Save order to file (could be a DB later)
    $orderData = "Name: $fullName\\nAddress: $address, $city, $province, $postalCode, $country\\n";
    $orderData .= "Phone: $phone\\nEmail: $email\\n\\nOrder Details:\\n$orderItems\\nTotal: $" . number_format($total, 2) . "\\n";
    $orderData .= "-------------------------\\n";

    file_put_contents('orders.txt', $orderData, FILE_APPEND);

    // Clear cart after successful order
    unset($_SESSION['cart']);
} else {
    header("Location: checkout.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Placed | E-Shop</title>
    <link rel="stylesheet" href="../css/example.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f6f6f6; padding: 40px; }
        .confirmation { max-width: 600px; margin: auto; background: #fff; padding: 30px; border-radius: 8px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .confirmation h2 { color: #28a745; }
        .confirmation p { margin-top: 15px; font-size: 16px; }
        .confirmation a { display: inline-block; margin-top: 25px; text-decoration: none; background-color: #0073e6; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold; }
        .confirmation a:hover { background-color: #005bb5; }
    </style>
</head>
<body>
    <div class="confirmation">
        <h2>✅ Thank you! Your order has been placed.</h2>
        <p>You’ll receive a confirmation email shortly.</p>
        <a href="index.php">← Back to Home</a>
    </div>
</body>
</html>