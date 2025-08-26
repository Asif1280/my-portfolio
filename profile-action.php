<?php
// Start the session
session_start();

// Include database connection
include("./conn.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit();
}

// Get the username from the session
$username = $_SESSION['username'];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // die("Invalid email format.");
        header("Location: profile.php");
    }

    // Validate phone number (optional)
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        // die("Invalid phone number.");
        header("Location: profile.php");
    }

    // Prepare the SQL query
    $sql = "UPDATE users SET address = ?, phone = ?, email = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);

    // Check if statement preparation was successful
    if ($stmt) {
        $stmt->bind_param("ssss", $address, $phone, $email, $username);

        // Execute the statement
        if ($stmt->execute()) {
            // echo "Profile updated successfully.";
            header("Location: profile.php");

        } else {
            echo "Error updating profile: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        die("Error preparing statement: " . $conn->error);
    }
} else {
    die("Invalid request method.");
}

// Close the database connection
$conn->close();
