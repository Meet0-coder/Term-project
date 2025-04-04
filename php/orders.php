<?php
session_start();
include "header.php";

$isLoggedIn = isset($_SESSION["user_name"]);

if (!$isLoggedIn) {
    echo '<div class="container mt-5">
            <div class="alert alert-warning text-center">
                Please <a href="login.php">log in</a> to view your orders.
            </div>
          </div>';
    include "footer.php";
    exit;
}
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">📦 My Orders</h2>

    <?php
    // Sample orders (replace this with real DB queries in future)
    $orders = [
        ["date" => "2025-03-20", "product" => "Smartphone", "price" => 499, "status" => "Shipped"],
        ["date" => "2025-03-18", "product" => "Headphones", "price" => 79, "status" => "Delivered"],
        ["date" => "2025-03-15", "product" => "Camera", "price" => 349, "status" => "Cancelled"]
    ];
    ?>

    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Product</th>
                <th>Total Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order["date"] ?></td>
                <td><?= $order["product"] ?></td>
                <td>$<?= number_format($order["price"], 2) ?></td>
                <td><?= $order["status"] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "footer.php"; ?>