<?php
// db_config.php

$servername = "localhost"; // আপনার সার্ভার হোস্টনেম
$username = "root";        // আপনার ডাটাবেস ইউজারনেম
$password = "";            // আপনার ডাটাবেস পাসওয়ার্ড
$dbname = "glow_grace_db"; // আপনার ডাটাবেসের নাম

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4 to support emojis and special characters
$conn->set_charset("utf8mb4");

session_start(); // Start session on all pages
?>