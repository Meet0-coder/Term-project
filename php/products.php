<?php
session_start();
$isLoggedIn = isset($_SESSION["user_name"]);
$userName = $isLoggedIn ? $_SESSION["user_name"] : "";
$firstName = $isLoggedIn ? explode(" ", $userName)[0] : "";
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

$products = [
    ['name' => 'Smartphone', 'price' => 499.00, 'image' => 'iphone.jpg'],
    ['name' => 'Laptop', 'price' => 899.00, 'image' => 'gaming_laptop.jpg'],
    ['name' => 'Camera', 'price' => 349.00, 'image' => 'camera.jpg'],
    ['name' => 'Headphones', 'price' => 79.00, 'image' => 'headphones.jpg'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products - E-Shop</title>
    <link rel="stylesheet" href="../css/example.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <style>
        .products-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            gap: 20px;
        }

        .box-content {
            background-color: #fff;
            padding: 16px;
            border-radius: 8px;
            width: 230px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .box-img {
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .add-to-cart-btn {
            background-color: #007600;
            color: #fff;
            padding: 8px 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .add-to-cart-btn:hover {
            background-color: #005f00;
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <header>
        <div class="navbar">
            <div class="nav-logo border">
                <img src="../images/E-Shop_Logo_Large.png" alt="E-Shop Logo" style="height: 36px;">
            </div>
            <div class="nav-address border">
                <p class="add-first">Deliver to</p>
                <div class="add-icon">
                    <i class="fa-solid fa-location-dot"></i>
                    <p class="add-sec">Canada</p>
                </div>
            </div>
            <div class="nav-search">
                <select class="search-select"><option>All</option></select>
                <input placeholder="Search E-Shop" class="search-input" />
                <div class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
            </div>
            <div class="nav-sr4 border">
                <?php if ($isLoggedIn): ?>
                    <p class="line1">Hello, <?= htmlspecialchars($firstName) ?></p>
                    <p class="line2"><a href="logout.php">Logout</a></p>
                <?php else: ?>
                    <p class="line1"><a href="login.php">Hello, Sign in</a></p>
                    <p class="line2"><a href="signup.php">Sign Up</a></p>
                <?php endif; ?>
            </div>
            <div class="nav-box4 border">
                <p class="one">Returns</p>
                <p class="two">& Orders</p>
            </div>
            <div class="nav-five border">
                <a href="cart.php" style="text-decoration: none; color: inherit;">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Cart (<?= $cartCount ?>)
                </a>
            </div>
        </div>

        <!-- PANEL -->
        <div class="panel">
            <div class="panel-all"><i class="fa-solid fa-bars"></i> All</div>
            <div class="panel-ops">
                <a href="index.php"><p>Home</p></a>
                <a href="deals.php"><p>Today's Deals</p></a>
                <a href="products.php"><p>Products</p></a>
                <a href="contact.php"><p>Customer Feedback</p></a>
                <a href="#"><p>Your Account</p></a>
            </div>
        </div>
    </header>

    <!-- PRODUCTS DISPLAY -->
    <h2 style="text-align: center; margin-top: 20px;">📦 Our Products 📦</h2>
    <div class="products-wrapper">
        <?php foreach ($products as $product): ?>
            <div class="box-content">
                <h3><?= $product['name'] ?></h3>
                <div class="box-img" style="background-image: url('../images/<?= $product['image'] ?>');"></div>
                <p style="color: red;">$<?= number_format($product['price'], 2) ?></p>
                <form method="POST" action="add_to_cart.php">
                    <input type="hidden" name="product" value="<?= $product['name'] ?>">
                    <input type="hidden" name="price" value="<?= $product['price'] ?>">
                    <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="foot-panel1">© 2025 E-Shop. All rights reserved.</div>
    </footer>
</body>
</html>