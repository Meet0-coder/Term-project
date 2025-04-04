<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$orderPlaced = false;

// Sample product data
$allCategories = [
    'Health & Personal Care' => [
        ['name' => 'RGB Gaming Cabinet', 'price' => 149.99, 'image' => 'gaming cabinet.jpg'],
        ['name' => 'Essential Oils Kit', 'price' => 29.99, 'image' => 'oils.jpg'],
        ['name' => 'Electric Toothbrush', 'price' => 49.95, 'image' => 'toothbrush.jpg'],
        ['name' => 'Vitamin D3 Supplement', 'price' => 19.49, 'image' => 'vitamin.jpg'],
        ['name' => 'Hair Dryer', 'price' => 24.99, 'image' => 'hairdryer.jpg'],
        ['name' => 'First Aid Kit', 'price' => 15.99, 'image' => 'firstaid.jpg'],
    ],
    'Shop for home essentials' => [
        ['name' => 'Cleaning Set', 'price' => 19.99, 'image' => 'cleaningset.jpg'],
        ['name' => 'Kitchen Starter Pack', 'price' => 34.99, 'image' => 'kitchen.jpg'],
        ['name' => 'LED Bulbs (4pcs)', 'price' => 22.95, 'image' => 'bulbs.jpg'],
        ['name' => 'Laundry Basket', 'price' => 18.75, 'image' => 'laundary.jpg'],
        ['name' => 'Sponge Mop Set', 'price' => 20.00, 'image' => 'mop.jpg'],
        ['name' => 'Water Filter Pitcher', 'price' => 27.49, 'image' => 'filter.jpg'],
    ],
    'Get your game on' => [
        ['name' => 'Game Controller', 'price' => 59.99, 'image' => 'controller.jpg'],
        ['name' => 'Gaming Monitor', 'price' => 199.99, 'image' => 'monitor.jpg'],
        ['name' => 'RGB Mousepad', 'price' => 24.99, 'image' => 'mousepad.jpg'],
        ['name' => 'Headset with Mic', 'price' => 89.49, 'image' => 'headset.jpg'],
        ['name' => 'Gaming Chair', 'price' => 129.99, 'image' => 'chair.jpg'],
        ['name' => 'Gaming Desk', 'price' => 179.99, 'image' => 'desk.jpg'],
    ],
    'New year, new supplies' => [
        ['name' => 'Stationery Combo', 'price' => 14.99, 'image' => 'stationery.jpg'],
        ['name' => 'Work Kit', 'price' => 49.99, 'image' => 'kit.jpg'],
        ['name' => 'Notebook Set', 'price' => 9.95, 'image' => 'notebook.jpg'],
        ['name' => 'Mouse + Keyboard', 'price' => 39.95, 'image' => 'combo.jpg'],
        ['name' => 'Office Lamp', 'price' => 25.99, 'image' => 'lamp.jpg'],
        ['name' => 'Calendar & Planner', 'price' => 12.50, 'image' => 'planner.jpg'],
    ],
    'Watch for shoes' => [
        ['name' => 'Air Jordan 1', 'price' => 169.99, 'image' => 'jordan1.jpg'],
        ['name' => 'Nike Running Shoes', 'price' => 89.99, 'image' => 'nike.jpg'],
        ['name' => 'Adidas Ultraboost', 'price' => 129.99, 'image' => 'adidas.jpg'],
        ['name' => 'Puma Slip-ons', 'price' => 59.49, 'image' => 'puma.jpg'],
        ['name' => 'New Balance 327', 'price' => 99.99, 'image' => 'nbalance.jpg'],
        ['name' => 'Reebok Trainers', 'price' => 74.99, 'image' => 'reebok.jpg'],
    ],
    'Daily Wears' => [
        ['name' => 'Formal Shirts (3)', 'price' => 59.99, 'image' => 'shirts.jpg'],
        ['name' => 'Women’s Office Set', 'price' => 74.99, 'image' => 'womens.jpg'],
        ['name' => 'Cotton Tees (3)', 'price' => 25.99, 'image' => 'tees.jpg'],
        ['name' => 'Casual Pants', 'price' => 34.95, 'image' => 'pants.jpg'],
        ['name' => 'Hoodie & Jogger Combo', 'price' => 49.99, 'image' => 'hoodie.jpg'],
        ['name' => 'Classic Jeans', 'price' => 44.99, 'image' => 'jeans.jpg'],
    ],
    'Bin Bags' => [
        ['name' => 'Garbage Bags (50)', 'price' => 12.99, 'image' => 'garbage.jpg'],
        ['name' => 'Bio Bin Liners', 'price' => 15.99, 'image' => 'bio.jpg'],
        ['name' => 'Heavy Duty Bags', 'price' => 18.50, 'image' => 'heavy.jpg'],
        ['name' => 'Scented Bags', 'price' => 10.25, 'image' => 'scented.jpg'],
        ['name' => 'Small Waste Bags', 'price' => 6.99, 'image' => 'smallbags.jpg'],
        ['name' => 'Kitchen Bin Rolls', 'price' => 8.75, 'image' => 'kitchenbin.jpg'],
        ['name' => 'Offic Bags', 'price' => 80.90, 'image' => 'officebags.jpg'],
    ],
    'Winter Jackets' => [
        ['name' => 'Men’s Parka', 'price' => 89.99, 'image' => 'parka.jpg'],
        ['name' => 'Women’s Fleece', 'price' => 79.99, 'image' => 'fleece.jpg'],
        ['name' => 'Unisex Puffer', 'price' => 99.95, 'image' => 'puffer.jpg'],
        ['name' => 'Down Jacket', 'price' => 109.50, 'image' => 'downjacket.jpg'],
        ['name' => 'Bomber Jacket', 'price' => 84.95, 'image' => 'bomber.jpg'],
        ['name' => 'Hooded Coat', 'price' => 94.99, 'image' => 'hooded.jpg'],
    ],  
];

$productList = [];
foreach ($allCategories as $category => $items) {
    foreach ($items as $item) {
        $id = crc32($category . $item['name']);
        $productList[$id] = $item;
    }
}

// Get cart
$cart = $_SESSION['cart'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'vrajgheewala771@gmail.com';        // Your Gmail address
        $mail->Password   = 'lcyh crga hdzd sagy';           // Your Gmail app password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('vrajgheewala771@gmail.com', 'E-Shop');
        $mail->addAddress($_POST['email'], $_POST['full_name']); // Send to customer's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your Order Confirmation';
        $mail->Body    = "
            <h2>Thank you for your order, {$_POST['full_name']}!</h2>
            <p>Your items will be shipped to:</p>
            <p>{$_POST['address']}, {$_POST['province']}, {$_POST['postal_code']}</p>
            <p>We’ll contact you at {$_POST['phone']} if needed.</p>
            <p>Expect delivery soon. 🚚</p>
        ";

        $mail->send();

        // Clear cart after email sent
        $_SESSION['cart'] = [];
        $orderPlaced = true;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout | E-Shop</title>
    <link rel="stylesheet" href="../css/checkout.css">
</head>
<body>
    <div class="container">
        <?php if ($orderPlaced): ?>
            <div class="success-msg">
                <h2>✅ Order Placed Successfully!</h2>
                <p>Thank you for shopping with E-Shop. Your order will be processed shortly.</p>
                <a href="index.php">Return to Home</a>
            </div>
        <?php elseif (empty($cart)): ?>
            <div class="empty-msg">
                <h2>Your cart is empty</h2>
                <p>Please add some items before you checkout.</p>
                <a href="index.php">← Continue Shopping</a>
            </div>
        <?php else: ?>
            <h1>Shipping Information</h1>
            <form method="post" class="checkout-form">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" id="full_name" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label for="address">Shipping Address</label>
                    <textarea name="address" id="address" placeholder="Street, City" required></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group" style="flex:1;">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" name="postal_code" id="postal_code" placeholder="E.g. A1A 1A1" required>
                    </div>

                    <div class="form-group" style="flex:1;">
                        <label for="province">Province</label>
                        <select id="province" name="province" required>
                            <option value="">Select Province</option>
                            <option value="AB">Alberta</option>
                            <option value="BC">British Columbia</option>
                            <option value="MB">Manitoba</option>
                            <option value="NB">New Brunswick</option>
                            <option value="NL">Newfoundland and Labrador</option>
                            <option value="NS">Nova Scotia</option>
                            <option value="NT">Northwest Territories</option>
                            <option value="NU">Nunavut</option>
                            <option value="ON">Ontario</option>
                            <option value="PE">Prince Edward Island</option>
                            <option value="QC">Quebec</option>
                            <option value="SK">Saskatchewan</option>
                            <option value="YT">Yukon</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group" style="flex:1;">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="you@example.com" required>
                    </div>

                    <div class="form-group" style="flex:1;">
                        <label for="phone">Phone Number</label>
                        <input type="tel" name="phone" id="phone" placeholder="123-456-7890" required>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="form-group">
                    <label for="payment_method">Payment Method</label>
                    <select id="payment_method" name="payment_method" required>
                        <option value="">Select Payment Method</option>
                        <option value="card">Credit/Debit Card</option>
                        <option value="cod">Cash on Delivery</option>
                    </select>
                </div>

                <!-- Card Details Section -->
                <div id="card-details" style="display: none;">
                    <div class="form-group">
                        <label for="card_number">Card Number</label>
                        <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456">
                    </div>
                    <div class="form-row">
                        <div class="form-group" style="flex: 1;">
                            <label for="expiry">Expiry Date</label>
                            <input type="text" id="expiry" name="expiry" placeholder="MM/YY">
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="123">
                        </div>
                    </div>
                </div>

                <button type="submit" name="place_order" class="checkout-btn">Place Your Order</button>
            </form>

            <!-- JavaScript to Show/Hide Card Fields -->
            <script>
                document.getElementById('payment_method').addEventListener('change', function () {
                    const cardDetails = document.getElementById('card-details');
                    cardDetails.style.display = this.value === 'card' ? 'block' : 'none';
                });
            </script>
        <?php endif; ?>
    </div>
</body>
</html>