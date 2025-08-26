<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not authenticated
    header('Location: login.php');
    exit(); // Ensure no further code is executed
}

// User is authenticated, you can add your page content here
?>
