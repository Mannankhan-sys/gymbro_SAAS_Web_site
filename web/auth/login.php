<?php
session_start();
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $mysqli->prepare(
        "SELECT user_id, password FROM users WHERE username = ?"
    );
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $username;

            // redirect after login
            if (isset($_SESSION["redirect_after_login"])) {
                $go = $_SESSION["redirect_after_login"];
                unset($_SESSION["redirect_after_login"]);
                header("Location: $go");
            } else {
                header("Location: ../Home_page/index.php");
            }
            exit;
        }
    }

    $_SESSION["error"] = "Invalid username or password";
   header("Location: ../login_page/index.html");
exit;

    
}
?>