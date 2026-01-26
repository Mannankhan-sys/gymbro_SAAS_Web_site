<?php
session_start();
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $password_confirm = $_POST["password_confirm"];

    // Basic validation
    if (
        $username === "" ||
        $full_name === "" ||
        $email === "" ||
        $password === ""
    ) {
        die("All fields are required");
    }

    if ($password !== $password_confirm) {
        die("Passwords do not match");
    }

    if (strlen($password) < 6) {
        die("Password must be at least 6 characters");
    }

    // Check existing user
    $check = $mysqli->prepare(
        "SELECT user_id FROM users WHERE username = ? OR email = ?"
    );
    $check->bind_param("ss", $username, $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        die("Username or email already exists");
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $insert = $mysqli->prepare(
        "INSERT INTO users (username, full_name, email, password)
         VALUES (?, ?, ?, ?)"
    );
    $insert->bind_param(
        "ssss",
        $username,
        $full_name,
        $email,
        $hashed_password
    );

    if ($insert->execute()) {

        // Auto-login after registration
        $_SESSION["user_id"] = $insert->insert_id;
        $_SESSION["username"] = $username;

        header("Location: ../Home_page/index.php");
        exit;
    }

    die("Registration failed");
}
?>