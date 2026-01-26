<?php
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}
?>
<header class="admin-header">
    <h1>GymBro Admin Panel</h1>
    <a href="logout.php">Logout</a>
</header>
