<?php
session_start();
require_once "../config/db.php";

$user_id = $_SESSION["user_id"];
$subscription_id = $_SESSION["pending_subscription"];

/* ---------- GET PLAN ---------- */
$stmt = $mysqli->prepare(
    "SELECT plan_name, price FROM subscriptions WHERE subscription_id = ?"
);
$stmt->bind_param("i", $subscription_id);
$stmt->execute();
$plan = $stmt->get_result()->fetch_assoc();

/* ---------- SAVE PAYMENT ---------- */
$pay = $mysqli->prepare(
    "INSERT INTO payments (user_id, subscription_id, amount)
     VALUES (?, ?, ?)"
);
$pay->bind_param("iid", $user_id, $subscription_id, $plan['price']);
$pay->execute();

/* ---------- UPDATE USER SUBSCRIPTION ---------- */
$update = $mysqli->prepare(
    "UPDATE users SET subscription_id = ? WHERE user_id = ?"
);
$update->bind_param("ii", $subscription_id, $user_id);
$update->execute();

/* ---------- ASSIGN TRAINER (GOLD ONLY) ---------- */
// GOLD PLAN ONLY
if ($subscription_id == 2) {

    // get available trainer (limit 10 users)
    $getTrainer = $mysqli->prepare(
        "SELECT t.trainer_id
         FROM trainers t
         LEFT JOIN users u ON t.trainer_id = u.assigned_trainer
         GROUP BY t.trainer_id
         HAVING COUNT(u.user_id) < 10
         LIMIT 1"
    );
    $getTrainer->execute();
    $trainer = $getTrainer->get_result()->fetch_assoc();

    if ($trainer) {

        // assign trainer to user
        $assignUser = $mysqli->prepare(
            "UPDATE users SET assigned_trainer = ? WHERE user_id = ?"
        );
        $assignUser->bind_param("ii", $trainer['trainer_id'], $user_id);
        $assignUser->execute();
    }
}


/* ---------- CLEANUP ---------- */
unset($_SESSION["pending_subscription"]);
unset($_SESSION["motivation"]);

header("Location: ../dashboard.php");
exit;
