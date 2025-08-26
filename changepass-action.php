<?php
session_start();
include("./conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Validate form data
    if (empty($currentPassword) || empty($newPassword) || empty($confirmNewPassword)) {
        die("All fields are required.");
    }

    if ($newPassword !== $confirmNewPassword) {
        die("New passwords do not match.");
    }

    // Fetch the user's current hashed password from the database
    $userId = $_SESSION['user_id']; // Assuming the user ID is stored in the session
    $sql = "SELECT password FROM users WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $hashedPassword);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        // Verify the current password
        if (!password_verify($currentPassword, $hashedPassword)) {
            die("Current password is incorrect.");
        }

        // Hash the new password
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // Update the password in the database
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, 'si', $newHashedPassword, $userId);
            if (mysqli_stmt_execute($stmt)) {
                // echo "Password changed successfully.";
                header('Location: index.php');
            } else {
                echo "Error updating password: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement.";
        }
    } else {
        echo "Error preparing statement.";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request method.";
}
?>
