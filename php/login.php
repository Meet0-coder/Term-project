<?php
session_start();
require 'db.php';

$errorMsg = "";
$successMsg = "";

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows === 1) {
    $stmt->bind_result($id, $name, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
      // Login success
      $_SESSION["user_id"] = $id;
      $_SESSION["user_name"] = $name;
      $successMsg = "✅ Login successful! Redirecting...";
      header("refresh:2;url=index.php"); // Redirect after 2 sec
    } else {
      $errorMsg = "❌ Incorrect email  or password .";
    }
  } else {
    $errorMsg = "❌ No user found with this email.";
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - E-Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <h3 class="text-center mb-4">Login to E-Shop</h3>

        <?php if (!empty($successMsg)): ?>
          <div class="alert alert-success"><?= $successMsg ?></div>
        <?php elseif (!empty($errorMsg)): ?>
          <div class="alert alert-danger"><?= $errorMsg ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
          <p class="text-center mt-3">Don't have an account? <a href="signup.php">Sign up</a></p>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
