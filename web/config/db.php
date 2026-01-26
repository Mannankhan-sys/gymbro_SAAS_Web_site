<?php
$host = "localhost";
$user = "root";
$pass = "mysql";
$db   = "gymbro_db";

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}
?>
