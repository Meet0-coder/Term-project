
<?php
session_start();
$isLoggedIn = isset($_SESSION["user_name"]);
$userName = $isLoggedIn ? $_SESSION["user_name"] : "";
$firstName = $isLoggedIn ? explode(" ", $userName)[0] : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Deals - E-Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="../css/example.css" />
</head>

<body>
    <!-- NAVBAR -->
    <div class="navbar">
        <div class="nav-logo border">
            <img src="../images/E-Shop_Logo_Large.png" alt="E-Shop Logo">
        </div>
        <div class="nav-address border">
            <p class="add-first">Deliver to</p>
            <div class="add-icon">
                <i class="fa-solid fa-location-dot"></i>
                <p class="add-sec">Canada</p>
            </div>
        </div>
        <div class="nav-search">
            <select class="search-select">
                <option>All</option>
            </select>
            <input placeholder="Search E-shop" class="search-input" />
            <div class="search-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
        <div class="nav-sr4 border">
            <?php if ($isLoggedIn): ?>
                <p class="line1">Hello, <?= htmlspecialchars($firstName) ?></p>
                <p class="line2"><a href="logout.php">Logout</a></p>
            <?php else: ?>
                <p class="line1"><a href="login.php">Hello, sign in</a></p>
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
                Cart
            </a>
        </div>
    </div>

    <!-- PANEL BAR -->
    <div class="panel">
        <div class="panel-all">
            <i class="fa-solid fa-bars"></i>
            All
        </div>
        <div class="panel-ops">
            <a href="index.php"><p>Home</p></a>
            <a href="deals.php"><p>Today's Deals</p></a>
            <a href="products.php"><p>Products</p></a>
            <a href="contact.php"><p>Customer Feedback</p></a>
            <a href="account.php"><p>Your Account</p></a>
        </div>
    </div>

    <!-- DEALS SECTION -->
    <div style="padding: 20px; text-align: center;">
        <h2>🔥 Today's Deals 🔥</h2>
    </div>

    <div class="shop">
        <?php
        $deals = [
            ['title' => 'Gaming Laptop', 'image' => 'gaming_laptop.jpg'],
            ['title' => 'Wireless Earbuds', 'image' => 'earbuds.jpg'],
            ['title' => 'Smart Watch', 'image' => 'smartwatch.jpg'],
            ['title' => 'Speakers', 'image' => 'speaker.jpg'],
            ['title' => 'Phone Cases', 'image' => 'phonecover.jpg'],
            ['title' => 'IPhones', 'image' => 'iphone.jpg'],
            ['title' => 'HDMI Cables', 'image' => 'cable.jpg'],
            ['title' => 'I Pads', 'image' => 'ipads.jpg'],
        ];

        foreach ($deals as $deal): ?>
            <div class="box box1">
                <div class="box-content">
                    <h2><?= $deal['title'] ?></h2>
                    <div class="box-img" style="background-image: url('../images/<?= $deal['image'] ?>');"></div>
                    <p>See more</p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <footer>
        <div class="foot-panel1">Back to top</div>
    </footer>
</body>
</html>