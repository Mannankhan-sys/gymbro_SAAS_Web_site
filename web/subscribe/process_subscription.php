<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login_page/index.html");
    exit;
}

if (!isset($_POST["subscription_id"])) {
    die("Subscription not selected");
}

$_SESSION["pending_subscription"] = $_POST["subscription_id"];
$_SESSION["motivation"] = $_POST["motivation"];

header("Location: ../payment/payment.php");
exit;
?>