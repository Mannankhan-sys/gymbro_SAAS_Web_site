<?php
session_start();
require_once "config/db.php";

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login_page/index.html");
    exit;
}

$user_id = $_SESSION['user_id'];

/* ---------- FETCH USER DATA ---------- */
$stmt = $mysqli->prepare(
    "SELECT 
        u.username, 
        u.full_name, 
        u.email,
        s.plan_name,
        s.price,
        t.name AS trainer_name,
        t.specialization
     FROM users u
     LEFT JOIN subscriptions s ON u.subscription_id = s.subscription_id
     LEFT JOIN trainers t ON u.assigned_trainer = t.trainer_id
     WHERE u.user_id = ?"
); 

$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymBro - Dashboard</title>
    <link rel="stylesheet" href="assets/dashboard.css">
    
</head>
<body>

    <main class="dashboard-wrapper">
        
        <section class="welcome-card">
            <div class="welcome-content">
                <div class="card-icon">🔥</div>
                <h1>Welcome, <span><?= htmlspecialchars($user['username']) ?></span>!</h1>
                <p>Your GymBro command center. Let's hit those goals.</p>
            </div>
            <a href="auth/logout.php" class="logout-btn">Logout Account</a>
        </section>

        <div class="dashboard-grid">
            
            <div class="dash-card">
                <div class="card-icon">👤</div>
                <h2>Profile</h2>
                <hr>
                <div class="data-row">
                    <span class="label">Name:</span>
                    <span class="value"><?= htmlspecialchars($user['full_name']) ?></span>
                </div>
                <div class="data-row">
                    <span class="label">Email:</span>
                    <span class="value"><?= htmlspecialchars($user['email']) ?></span>
                </div>
            </div>

            <div class="dash-card">
                <div class="card-icon">💳</div>
                <h2>Subscription</h2>
                <hr>
                <?php if ($user['plan_name']): ?>
                    <p class="plan-status"><?= htmlspecialchars($user['plan_name']) ?></p>
                    <p class="price-tag">$<?= htmlspecialchars($user['price']) ?> / month</p>
                <?php else: ?>
                    <p class="empty-text">No active plan.</p>
                    <a href="../Plans_page/index.html" class="cta-link">View Plans</a>
                <?php endif; ?>
            </div>

            <div class="dash-card">
                <div class="card-icon">🏋️</div>
                <h2>Trainer</h2>
                <hr>
                <?php if ($user['trainer_name']): ?>
                    <div class="data-row">
                        <span class="label">Assigned:</span>
                        <span class="value"><?= htmlspecialchars($user['trainer_name']) ?></span>
                    </div>
                    <div class="data-row">
                        <span class="label">Expertise:</span>
                        <span class="value"><?= htmlspecialchars($user['specialization']) ?></span>
                    </div>
                <?php else: ?>
                    <p class="empty-text">No trainer assigned.</p>
                    <p class="hint" style="color: #666; font-size: 0.8rem; margin-top: 5px;">Standard for Silver tier.</p>
                <?php endif; ?>
            </div>

        </div>
    </main>

    <footer>
        <p>&copy; 2025 GymBro Fitness. All Rights Reserved.</p>
    </footer>

</body>
</html>