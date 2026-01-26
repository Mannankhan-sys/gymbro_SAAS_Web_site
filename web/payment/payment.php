<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION["pending_subscription"])) {
    header("Location: ../home/index.html");
    exit;
}

$sub_id = $_SESSION["pending_subscription"];

$stmt = $mysqli->prepare(
    "SELECT plan_name, price FROM subscriptions WHERE subscription_id = ?"
);
$stmt->bind_param("i", $sub_id);
$stmt->execute();
$plan = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GymBro - Payment</title>
  <link rel="stylesheet" href="../assets/Payment.css">
</head>
<body>

  <header>
    
  </header>

  <main class="payment-page">
    <div class="payment-card">
        <h1>Secure Payment</h1>
        <p class="subtitle">Complete your transaction to activate your plan.</p>
        
        <div class="receipt-box">
            <div class="receipt-row">
                <span>Selected Plan:</span>
                <span class="highlight"><?= htmlspecialchars($plan["plan_name"]) ?></span>
            </div>
            <div class="receipt-row">
                <span>Total Amount:</span>
                <span class="price">Rs <?= number_format($plan["price"], 2) ?></span>
            </div>
        </div>

        <form action="../payment/process_payment.php" method="POST">
            <button type="submit" class="pay-btn">Confirm & Pay Now</button>
        </form>
        
        <p class="secure-text">🔒 Encrypted & Secure Checkout</p>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 GymBro. All Rights Reserved.</p>
  </footer>

</body>
</html>