<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION["user_id"])) {
    $_SESSION["redirect_after_login"] = $_SERVER["REQUEST_URI"];
    header("Location:../login_page/index.html");
    exit;
}

$selected_plan = $_GET["plan"] ?? "";
$plans = $mysqli->query("SELECT * FROM subscriptions");

$stmt = $mysqli->prepare("SELECT username, full_name, email FROM users WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GymBro - Confirm Subscription</title>
  <link rel="stylesheet" href="../assets/Subscription.css">
  
</head>
<body>

  <header>
    <nav class="navbar">
      <h2 class="logo">Gym<span>Bro</span></h2>
      <ul class="nav-links">
        <li><a href="../Home_page/index.html">Home</a></li>
        <li><a href="../auth/logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main class="subscription-page">
    <h1>Confirm Subscription</h1>
    <p>Complete your details to start your journey with GymBro.</p>

    <div class="form-container">
      <form action="process_subscription.php" method="POST" class="subscription-form">
        
        <div class="info-section">
          <h3>Your Account</h3>
          <p><strong>Name:</strong> <?= htmlspecialchars($user["full_name"]) ?></p>
          <p><strong>Email:</strong> <?= htmlspecialchars($user["email"]) ?></p>
        </div>

        <hr class="divider">

        <h3>Select Your Plan</h3>
        <div class="plan-options">
          <?php while ($plan = $plans->fetch_assoc()): ?>
          <label class="plan-card">
            <input type="radio" 
                   name="subscription_id" 
                   value="<?= $plan['subscription_id'] ?>" 
                   <?= strtolower($plan['plan_name']) === $selected_plan ? 'checked' : '' ?> 
                   required>
            <div class="plan-content">
              <span class="plan-name"><?= $plan['plan_name'] ?></span>
              <span class="plan-price">Rs <?= $plan['price'] ?></span>
              <p class="plan-features"><?= $plan['features'] ?></p>
            </div>
          </label>
          <?php endwhile; ?>
        </div>

        <div class="input-group">
          <textarea name="motivation" required placeholder="Why do you want to join GymBro?"></textarea>
        </div>

        <label class="checkbox-container">
          <input type="checkbox" name="agree" required>
          <span class="checkmark"></span>
          I agree to the GymBro rules and terms.
        </label>

        <button type="submit" class="submit-btn">Continue to Payment</button>
      </form>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 GymBro. All Rights Reserved.</p>
  </footer>

</body>
</html>