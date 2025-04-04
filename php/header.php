<?php
session_start();
$isLoggedIn = isset($_SESSION["user_name"]);
$userName = $isLoggedIn ? $_SESSION["user_name"] : "";
$firstName = $isLoggedIn ? explode(" ", $userName)[0] : "";
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="../css/example.css">

<header>
    <!-- NAVBAR -->
    <div class="navbar">
        <!-- Logo -->
        <div class="nav-logo border">
            <img src="../images/E-Shop_Logo_Large.png" alt="E-Shop Logo" style="height: 36px;">
        </div>

        <!-- Location -->
        <div class="nav-address border">
            <p class="add-first">Deliver to</p>
            <div class="add-icon">
                <i class="fa-solid fa-location-dot"></i>
                <p class="add-sec">Canada</p>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="nav-search">
            <select class="search-select"><option>All</option></select>
            <input placeholder="Search E-Shop" class="search-input" />
            <div class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
        </div>

        <!-- Login / Logout -->
        <div class="nav-sr4 border">
            <?php if ($isLoggedIn): ?>
                <p class="line1">Hello, <?= htmlspecialchars($firstName) ?></p>
                <p class="line2"><a href="logout.php">Logout</a></p>
            <?php else: ?>
                <p class="line1"><a href="login.php">Hello, Sign in</a></p>
                <p class="line2"><a href="signup.php">Sign Up</a></p>
            <?php endif; ?>
        </div>

        <!-- Orders -->
        <div class="nav-box4 border">
            <p class="one">Returns</p>
            <p class="two">& Orders</p>
        </div>

        <!-- Cart -->
        <div class="nav-five border">
            <a href="cart.php" style="text-decoration: none; color: inherit;">
                <i class="fa-solid fa-cart-shopping"></i>
                Cart (<?= $cartCount ?>)
            </a>
        </div>
    </div>

    <!-- PANEL MENU -->
    <div class="panel">
        <div class="panel-all"><i class="fa-solid fa-bars"></i> All</div>
        <div class="panel-ops">
            <a href="index.php"><p>Home</p></a>
            <a href="deals.php"><p>Today's Deals</p></a>
            <a href="products.php"><p>Products</p></a>
            <a href="contact.php"><p>Customer Feedback</p></a>
            <a href="account.php"><p>Your Account</p></a>
        </div>
    </div>
</header>