<?php
require 'db.php'; // connect to database

$successMsg = "";
$errorMsg = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "❌ Invalid email format.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            $successMsg = "✅ Registration successful! <a href='login.html'>Login here</a>";
        } else {
            if ($conn->errno === 1062) {
                $errorMsg = "❌ This email is already registered.";
            } else {
                $errorMsg = "❌ Error: " . $stmt->error;
            }
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up - E-Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="text-center mb-4">Create an Account</h2>

    <?php if (!empty($successMsg)): ?>
      <div class="alert alert-success"><?= $successMsg ?></div>
    <?php elseif (!empty($errorMsg)): ?>
      <div class="alert alert-danger"><?= $errorMsg ?></div>
    <?php endif; ?>

    <form action="signup.php" method="POST" class="shadow p-4 bg-white rounded">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" class="form-control" name="name" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required />
      </div>

      <button type="submit" class="btn btn-success w-100">Sign Up</button>
      <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
    </form>
  </div>
</body>
</html>
