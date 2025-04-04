<?php
session_start();
ob_start(); 

// Sample products (same as in category.php)
$sampleProducts = [
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

// ✅ Step 1: Check if both product_id and category are sent
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['category'])) {
    $productId = $_POST['product_id'];
    $category = $_POST['category'];

    $productFound = null;

    // ✅ Step 2: Match product using category + crc32
    if (isset($sampleProducts[$category])) {
        foreach ($sampleProducts[$category] as $product) {
            $generatedId = crc32($category . $product['name']);
            if ((string)$generatedId === $productId) {
                $productFound = $product;
                break;
            }
        }
    }

    // ✅ Step 3: Add to cart if matched
    if ($productFound) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$productId] = [
                'name' => $productFound['name'],
                'price' => $productFound['price'],
                'image' => $productFound['image'],
                'quantity' => 1
            ];
        }

        $redirectBack = $_POST['redirect'] ?? ($_SERVER['HTTP_REFERER'] ?? 'index.php');
        header("Location: $redirectBack");
        exit();        
    } else {
        header("Location: index.php?error=product_not_found");
        exit();
    }
} else {
    header("Location: index.php?error=invalid_request");
    exit();
}

?>