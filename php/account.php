<?php
session_start();
require_once "db_connection.php"; 
include "header.php";

$isLoggedIn = isset($_SESSION["user_id"]);
$userName = $isLoggedIn ? $_SESSION["user_name"] : "";
$firstName = $isLoggedIn ? explode(" ", $userName)[0] : "";
$userId = $isLoggedIn ? $_SESSION["user_id"] : 0;
?>

<div class="container my-5">
    <?php if ($isLoggedIn): ?>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="text-center">
                    <h2 class="mb-3">Welcome, <?= htmlspecialchars($firstName) ?> 👋</h2>
                    <p class="text-muted">Here’s your account dashboard:</p>
                </div>

                <div class="list-group shadow-sm">
                    <a href="orders.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span><i class="fa fa-box"></i> View Orders</span>
                        <i class="fa fa-chevron-right text-muted"></i>
                    </a>
                    <a href="profile.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span><i class="fa fa-user-edit"></i> Edit Profile</span>
                        <i class="fa fa-chevron-right text-muted"></i>
                    </a>
                    <a href="logout.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-danger">
                        <span><i class="fa fa-sign-out-alt"></i> Logout</span>
                        <i class="fa fa-chevron-right text-danger"></i>
                    </a>
                </div>

                <!-- Display recent orders -->
                <div class="mt-4">
                    <h5 class="text-center">📦 Recent Orders</h5>
                    <ul class="list-group">
                        <?php
                        $conn = new mysqli("localhost", "root", "", "eshop");

                        if ($conn->connect_error) {
                            echo "<li class='list-group-item text-danger'>Database error: " . $conn->connect_error . "</li>";
                        } else {
                            $stmt = $conn->prepare("SELECT id, total, created_at FROM orders WHERE user_id = ? ORDER BY created_at DESC LIMIT 3");
                            $stmt->bind_param("i", $userId);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                                    echo "Order #{$row['id']} <small class='text-muted'>{$row['created_at']}</small>";
                                    echo "<span class='badge bg-success'>₹" . number_format($row['total'], 2) . "</span>";
                                    echo "</li>";
                                }
                            } else {
                                echo "<li class='list-group-item'>No recent orders.</li>";
                            }

                            $stmt->close();
                            $conn->close();
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">
            <h4>Please log in to access your account</h4>
            <a href="login.php" class="btn btn-primary m-2">Login</a>
            <a href="signup.php" class="btn btn-outline-secondary">Sign Up</a>
        </div>
    <?php endif; ?>
</div>

<?php include "footer.php"; ?>
