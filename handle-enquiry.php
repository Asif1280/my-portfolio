<?php

ob_start(); // Start output buffering

include('./conn.php');
include('./includes/header.php');
include('./includes/sidebar.php');

// Initialize the page variable
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Handle search functionality
$searchQuery = '';
if (isset($_POST['search'])) {
    $searchQuery = $_POST['search'];
}

// Handle delete functionality
if (isset($_GET['delete'])) {
    $deleteId = (int)$_GET['delete'];
    $deleteQuery = "DELETE FROM contacts WHERE id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param("i", $deleteId);
    $deleteStmt->execute();
    
    // Redirect to view-enquiries.php
    header("Location: view-enquiries.php?page=$page&search=" . urlencode($searchQuery));
    exit; // Prevent further output
}

// Prepare the SQL statement with pagination
$limit = 10; // Number of records per page
$offset = ($page - 1) * $limit;

// Count total bookings
$totalQuery = "SELECT COUNT(*) as total FROM contacts WHERE name LIKE ?";
$totalStmt = $conn->prepare($totalQuery);
$likeQuery = "%$searchQuery%";
$totalStmt->bind_param("s", $likeQuery);
$totalStmt->execute();
$totalResult = $totalStmt->get_result();
$totalRow = $totalResult->fetch_assoc();
$totalBookings = $totalRow['total'];
$totalPages = ceil($totalBookings / $limit);

// Fetch bookings with search filter
$sql = "SELECT * FROM contacts WHERE name LIKE ? ORDER BY created_at DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $likeQuery, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>
