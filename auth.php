<?php
session_start();
// The password as you requested
$correct_password = "017647132066600Robin";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $submitted_password = $_POST['password'];

    if ($submitted_password === $correct_password) {
        // Password is correct, set session
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        // Incorrect password
        header("Location: index.php?error=1");
        exit;
    }
} else {
    // If not a POST request, redirect to login
    header("Location: index.php");
    exit;
}
?>