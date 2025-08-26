<?php
include('./conn.php');

// Retrieve form data and sanitize it
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$username = trim($_POST['username']);
$password = $_POST['password'];

// Basic validation
if (empty($name) || empty($email) || empty($username) || empty($password)) {
    die("Please fill in all fields.");
}

// Check if username or email already exists
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // die("Username or email already exists.");
    header("Location: register.php");
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $username, $hashed_password);

if ($stmt->execute()) {
    // echo "New account created successfully. You can now log in.";
    header("Location: login.php");
    exit();
    // Redirect or show success message
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
