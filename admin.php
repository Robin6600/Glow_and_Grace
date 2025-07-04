<?php 
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body class="admin-login-page">
    <div class="login-container">
        <h2>Glow & Grace - Admin Login</h2>
        <form action="auth.php" method="post">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <?php
            if(isset($_GET['error'])){
                echo '<p class="error-message">Invalid password!</p>';
            }
        ?>
    </div>
</body>
</html>