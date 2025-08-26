<?php
session_start();

// Include database connection file
include('./conn.php'); // Adjust the path as needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($username) || empty($password)) {
        header("Location: index.html?error=Please fill in all fields");
        exit();
    }

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Password is correct, start session and set session variables
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id']; // Assuming you have an ID column
            
            // Redirect to dashboard or home page
            header("Location: index.php");
            exit();
        } else {
            header("Location: login.php?error=Incorrect password");
            exit();
        }
    } else {
        header("Location: login.php?error=User not found");
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: login.php?error=Invalid request method");
    exit();
}
?>
