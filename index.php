<?php
session_start();

// If user is not logged in, redirect to login.php
if (!isset($_SESSION['user_id'])) {  // Assuming you set $_SESSION['user_id'] on login
    header("Location: login.php");
    exit;
}
?>

