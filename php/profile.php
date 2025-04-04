<?php
session_start();
require "db.php";
include "header.php";

if (!isset($_SESSION["user_id"])) {
    echo '<div class="container mt-5"><div class="alert alert-warning text-center">
            Please <a href="login.php">log in</a> to edit your profile.
          </div></div>';
    include "footer.php";
    exit;
}

$userId = $_SESSION["user_id"];
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newName = trim($_POST["name"]);
    $newEmail = trim($_POST["email"]);
    $newMobile = trim($_POST["mobile"]);
    $newAddress = trim($_POST["address"]);

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, mobile = ?, address = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $newName, $newEmail, $newMobile, $newAddress, $userId);

    if ($stmt->execute()) {
        $_SESSION["user_name"] = $newName;
        $message = "<div class='alert alert-success'>✅ Profile updated successfully.</div>";
    } else {
        $message = "<div class='alert alert-danger'>❌ Error updating profile: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

// Fetch current user info
$stmt = $conn->prepare("SELECT name, email, mobile, address FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($name, $email, $mobile, $address);
$stmt->fetch();
$stmt->close();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">✏️ Edit Profile</h2>

    <?= $message ?>

    <form method="POST" class="mx-auto" style="max-width: 500px;">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" name="name" required value="<?= htmlspecialchars($name) ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email" required value="<?= htmlspecialchars($email) ?>">
        </div>

        <div class="mb-3">
            <label for="mobile" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" name="mobile" value="<?= htmlspecialchars($mobile) ?>">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" name="address" rows="3"><?= htmlspecialchars($address) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Update Profile</button>
    </form>
</div>

<?php include "footer.php"; ?>