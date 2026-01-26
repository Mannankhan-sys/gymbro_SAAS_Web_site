<?php
session_start();
require_once "../config/db.php";
include "includes/header.php";
include "includes/sidebar.php";

// Total users
$totalUsers = $mysqli->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()["total"];

// Gold users
$goldUsers = $mysqli->query("SELECT COUNT(*) AS total FROM users WHERE subscription_id = 2")->fetch_assoc()["total"];

// Silver users
$silverUsers = $mysqli->query("SELECT COUNT(*) AS total FROM users WHERE subscription_id = 1")->fetch_assoc()["total"];

// Total revenue
$totalRevenue = $mysqli->query("SELECT SUM(amount) AS total FROM payments")->fetch_assoc()["total"];
?>

<div class="dashboard">

<div class="card">Total Members: <?= $totalUsers ?></div>
<div class="card">Gold Members: <?= $goldUsers ?></div>
<div class="card">Silver Members: <?= $silverUsers ?></div>
<div class="card">Total Revenue: PKR <?= $totalRevenue ?></div>

</div>
</body>
</html>