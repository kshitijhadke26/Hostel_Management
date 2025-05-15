<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "cee_db";

/** @var PDO|null $conn */
$conn = null;

try {
    $conn = new PDO("mysql:host={$host};dbname={$db};charset=utf8mb4", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
