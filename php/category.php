<?php
session_start();

$categoryKey = isset($_GET['type']) ? $_GET['type'] : '';

$categoryTitles = [
    'health' => 'Health & Personal Care',
    'home' => 'Shop for home essentials',
    'gaming' => 'Get your game on',
    'supplies' => 'New year, new supplies',
    'shoes' => 'Watch for shoes',
    'wears' => 'Daily Wears',
    'bags' => 'Bin Bags',
    'jackets' => 'Winter Jackets',
];

$category = $categoryTitles[$categoryKey] ?? 'Unknown';

// Start product ID counter
$id = 1;

$sampleProducts = [
    'Health & Personal Care' => [
        ['id' => $id++, 'name' => 'RGB Gaming Cabinet', 'price' => 149.99, 'image' => 'gaming cabinet.jpg'],
        ['id' => $id++, 'name' => 'Essential Oils Kit', 'price' => 29.99, 'image' => 'oils.jpg'],
        ['id' => $id++, 'name' => 'Electric Toothbrush', 'price' => 49.95, 'image' => 'toothbrush.jpg'],
        ['id' => $id++, 'name' => 'Vitamin D3 Supplement', 'price' => 19.49, 'image' => 'vitamin.jpg'],
        ['id' => $id++, 'name' => 'Hair Dryer', 'price' => 24.99, 'image' => 'hairdryer.jpg'],
        ['id' => $id++, 'name' => 'First Aid Kit', 'price' => 15.99, 'image' => 'firstaid.jpg'],
    ],
    'Shop for home essentials' => [
        ['id' => $id++, 'name' => 'Cleaning Set', 'price' => 19.99, 'image' => 'cleaningset.jpg'],
        ['id' => $id++, 'name' => 'Kitchen Starter Pack', 'price' => 34.99, 'image' => 'kitchen.jpg'],
        ['id' => $id++, 'name' => 'LED Bulbs (4pcs)', 'price' => 22.95, 'image' => 'bulbs.jpg'],
        ['id' => $id++, 'name' => 'Laundry Basket', 'price' => 18.75, 'image' => 'laundary.jpg'],
        ['id' => $id++, 'name' => 'Sponge Mop Set', 'price' => 20.00, 'image' => 'mop.jpg'],
        ['id' => $id++, 'name' => 'Water Filter Pitcher', 'price' => 27.49, 'image' => 'filter.jpg'],
    ],
    'Get your game on' => [
        ['id' => $id++, 'name' => 'Game Controller', 'price' => 59.99, 'image' => 'controller.jpg'],
        ['id' => $id++, 'name' => 'Gaming Monitor', 'price' => 199.99, 'image' => 'monitor.jpg'],
        ['id' => $id++, 'name' => 'RGB Mousepad', 'price' => 24.99, 'image' => 'mousepad.jpg'],
        ['id' => $id++, 'name' => 'Headset with Mic', 'price' => 89.49, 'image' => 'headset.jpg'],
        ['id' => $id++, 'name' => 'Gaming Chair', 'price' => 129.99, 'image' => 'chair.jpg'],
        ['id' => $id++, 'name' => 'Gaming Desk', 'price' => 179.99, 'image' => 'desk.jpg'],
    ],
    'New year, new supplies' => [
        ['id' => $id++, 'name' => 'Stationery Combo', 'price' => 14.99, 'image' => 'stationery.jpg'],
        ['id' => $id++, 'name' => 'Work Kit', 'price' => 49.99, 'image' => 'kit.jpg'],
        ['id' => $id++, 'name' => 'Notebook Set', 'price' => 9.95, 'image' => 'notebook.jpg'],
        ['id' => $id++, 'name' => 'Mouse + Keyboard', 'price' => 39.95, 'image' => 'combo.jpg'],
        ['id' => $id++, 'name' => 'Office Lamp', 'price' => 25.99, 'image' => 'lamp.jpg'],
        ['id' => $id++, 'name' => 'Calendar & Planner', 'price' => 12.50, 'image' => 'planner.jpg'],
    ],
    'Watch for shoes' => [
        ['id' => $id++, 'name' => 'Air Jordan 1', 'price' => 169.99, 'image' => 'jordan1.jpg'],
        ['id' => $id++, 'name' => 'Nike Running Shoes', 'price' => 89.99, 'image' => 'nike.jpg'],
        ['id' => $id++, 'name' => 'Adidas Ultraboost', 'price' => 129.99, 'image' => 'adidas.jpg'],
        ['id' => $id++, 'name' => 'Puma Slip-ons', 'price' => 59.49, 'image' => 'puma.jpg'],
        ['id' => $id++, 'name' => 'New Balance 327', 'price' => 99.99, 'image' => 'nbalance.jpg'],
        ['id' => $id++, 'name' => 'Reebok Trainers', 'price' => 74.99, 'image' => 'reebok.jpg'],
    ],
    'Daily Wears' => [
    ['id' => $id++, 'name' => 'Formal Shirts (3)', 'price' => 59.99, 'image' => 'shirts.jpg'],
    ['id' => $id++, 'name' => 'Women’s Office Set', 'price' => 74.99, 'image' => 'womens.jpg'],
    ['id' => $id++, 'name' => 'Cotton Tees (3)', 'price' => 25.99, 'image' => 'tees.jpg'],
    ['id' => $id++, 'name' => 'Casual Pants', 'price' => 34.95, 'image' => 'pants.jpg'],
    ['id' => $id++, 'name' => 'Hoodie & Jogger Combo', 'price' => 49.99, 'image' => 'hoodie.jpg'],
    ['id' => $id++, 'name' => 'Classic Jeans', 'price' => 44.99, 'image' => 'jeans.jpg'],
],
'Bin Bags' => [
    ['id' => $id++, 'name' => 'Garbage Bags (50)', 'price' => 12.99, 'image' => 'garbage.jpg'],
    ['id' => $id++, 'name' => 'Bio Bin Liners', 'price' => 15.99, 'image' => 'bio.jpg'],
    ['id' => $id++, 'name' => 'Heavy Duty Bags', 'price' => 18.50, 'image' => 'heavy.jpg'],
    ['id' => $id++, 'name' => 'Scented Bags', 'price' => 10.25, 'image' => 'scented.jpg'],
    ['id' => $id++, 'name' => 'Small Waste Bags', 'price' => 6.99, 'image' => 'smallbags.jpg'],
    ['id' => $id++, 'name' => 'Kitchen Bin Rolls', 'price' => 8.75, 'image' => 'kitchenbin.jpg'],
    ['id' => $id++, 'name' => 'Office Bags', 'price' => 80.90, 'image' => 'officebags.jpg'],
],
'Winter Jackets' => [
    ['id' => $id++, 'name' => 'Men’s Parka', 'price' => 89.99, 'image' => 'parka.jpg'],
    ['id' => $id++, 'name' => 'Women’s Fleece', 'price' => 79.99, 'image' => 'fleece.jpg'],
    ['id' => $id++, 'name' => 'Unisex Puffer', 'price' => 99.95, 'image' => 'puffer.jpg'],
    ['id' => $id++, 'name' => 'Down Jacket', 'price' => 109.50, 'image' => 'downjacket.jpg'],
    ['id' => $id++, 'name' => 'Bomber Jacket', 'price' => 84.95, 'image' => 'bomber.jpg'],
    ['id' => $id++, 'name' => 'Hooded Coat', 'price' => 94.99, 'image' => 'hooded.jpg'],
],
];

$products = $sampleProducts[$category] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($category) ?> | E-Shop</title>
    <link rel="stylesheet" href="../css/example.css">
    <style>
        .category-header {
            text-align: center;
            padding: 30px 20px 10px;
        }
        .category-header h1 {
            font-size: 2rem;
            color: #111;
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }
        .product-card {
            background: white;
            width: 220px;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.2s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 8px;
        }
        .product-card h3 {
            font-size: 1.1rem;
            margin: 10px 0;
        }
        .product-card .price {
            color: #B12704;
            font-weight: bold;
            margin: 10px 0;
        }
        .product-card button {
            background-color: #3C9F40;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .product-card button:hover {
            background-color: #2d7f32;
        }
        .back-to-home {
            text-align: center;
            margin: 50px 0 30px;
        }
        .back-to-home a {
            display: inline-block;
            background-color: #232f3e;
            color: #fff;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }
        .back-to-home a:hover {
            background-color: #37475a;
            color: #ff9900;
            transform: scale(1.05);
        }
        footer {
            text-align: center;
            padding: 40px 20px;
        }
    </style>
</head>
<body>
    <div class="category-header">
        <h1><?= htmlspecialchars($category) ?></h1>
    </div>

    <?php if (empty($products)): ?>
        <p style="text-align:center;">No products found in this category.</p>
    <?php else: ?>
        <div class="product-grid">
    <?php foreach ($products as $index => $product): ?>
        <?php $productId = crc32($category . $product['name']); ?>
        <div class="product-card">
            <img src="../images/<?= rawurlencode($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
            <h3><?= htmlspecialchars($product['name']) ?></h3>
            <p class="price">$<?= number_format($product['price'], 2) ?></p>
            <form method="post" action="add_to_cart.php">
                <input type="hidden" name="product_id" value="<?= $productId ?>">
                <input type="hidden" name="category" value="<?= $category ?>">
                <input type="hidden" name="redirect" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>
    <?php endif; ?>

    <div class="back-to-home">
        <a href="index.php">← Back to Home</a>
    </div>
</body>
</html>