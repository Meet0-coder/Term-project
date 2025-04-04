<?php
session_start();
$isLoggedIn = isset($_SESSION["user_name"]);
$userName = $isLoggedIn ? $_SESSION["user_name"] : "";
$firstName = $isLoggedIn ? explode(" ", $userName)[0] : "";

// Accurate cart item count
$cartCount = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity'];
    }
}

// List of categories with internal keys
$allProducts = [
    ['key' => 'health', 'title' => 'Health & Personal Care', 'image' => 'box1.jpg'],
    ['key' => 'home', 'title' => 'Shop for home essentials', 'image' => 'box2.jpg'],
    ['key' => 'gaming', 'title' => 'Get your game on', 'image' => 'box3.jpg'],
    ['key' => 'supplies', 'title' => 'New year, new supplies', 'image' => 'box4.jpg'],
    ['key' => 'shoes', 'title' => 'Watch for shoes', 'image' => 'shoes.jpg'],
    ['key' => 'wears', 'title' => 'Daily Wears', 'image' => 'wears.jpg'],
    ['key' => 'bags', 'title' => 'Bin Bags', 'image' => 'bags.jpg'],
    ['key' => 'jackets', 'title' => 'Winter Jackets', 'image' => 'jackets.jpg'],
];

// Search filtering
$searchQuery = isset($_GET['q']) ? strtolower(trim($_GET['q'])) : '';
$products = [];

if ($searchQuery !== '') {
    foreach ($allProducts as $product) {
        if (str_contains(strtolower($product['title']), $searchQuery)) {
            $products[] = $product;
        }
    }
} else {
    $products = $allProducts;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="../css/example.css" />
</head>
<body>
<header>
    <div class="navbar">
        <div class="nav-logo border">
            <img src="../images/E-Shop_Logo_Large.png" alt="E-Shop Logo" style="height: 48px;">
        </div>
        <div class="nav-address border">
            <p class="add-first">Deliver to</p>
            <div class="add-icon">
                <i class="fa-solid fa-location-dot"></i>
                <p class="add-sec">Canada</p>
            </div>
        </div>
        <form class="nav-search" method="GET" action="index.php">
            <select name="category" class="search-select">
                <option value="all">All</option>
            </select>
            <input type="text" name="q" class="search-input" placeholder="Search E-Shop" value="<?= htmlspecialchars($searchQuery) ?>" />
            <button type="submit" class="search-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
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
    <div class="panel">
        <div class="panel-all dropdown">
            <button class="dropbtn"><i class="fa-solid fa-bars"></i> All</button>
            <div class="dropdown-content">
                <?php foreach ($allProducts as $cat): ?>
                    <a href="category.php?type=<?= urlencode($cat['key']) ?>"><?= $cat['title'] ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="panel-ops">
            <a href="deals.php"><p>Today's Deals</p></a>
            <a href="contact.php"><p>Customer Service</p></a>
            <a href="signup.php"><p>Registry</p></a>
        </div>
    </div>
</header>

<?php if (isset($_GET['message']) && $_GET['message'] == 'logout'): ?>
    <div class="logout-msg">✅ You have successfully logged out.</div>
<?php endif; ?>

<div class="hero-section">
    <div class="hero-msg">
        <h2>Fill your basket with joy</h2>
        <p>You are on E-Shop. We deliver across Canada.</p>
        <a href="#">Explore Canadian deals</a>
    </div>
</div>

<div class="shop">
    <?php if (empty($products)): ?>
        <p style="text-align:center;">No products found for "<?= htmlspecialchars($searchQuery) ?>"</p>
    <?php else: ?>
        <?php foreach ($products as $product): ?>
            <a href="category.php?type=<?= urlencode($product['key']) ?>" style="text-decoration: none; color: inherit;">
                <div class="box">
                    <div class="box-content">
                        <h2><?= $product['title'] ?></h2>
                        <div class="box-img" style="background-image: url('../images/<?= $product['image'] ?>');"></div>
                        <p>See more</p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<footer class="eshop-footer">
    <p>© 2025 <strong>E-Shop</strong>. All rights reserved.</p>
</footer>

<script>
    setTimeout(() => {
        const msg = document.querySelector('.logout-msg');
        if (msg) msg.style.display = 'none';
    }, 3000);
</script>
</body>
</html>