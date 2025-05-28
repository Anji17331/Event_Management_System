<?php
// Ensure user is an admin
require_once __DIR__ . '/../Includes/session.php';
requireAdmin();

// Include DB connection
require_once __DIR__ . '/../Includes/config.php';

// Get event ID from URL
$id = $_GET['id'] ?? null;

// Stop if no ID provided
if (!$id) {
    die("No event ID provided.");
}

try {
    // Delete event by ID
    $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
    $stmt->execute([$id]);

    // Redirect back to dashboard with success flag
    header("Location: dashboard.php?deleted=true");
    exit();
} catch (PDOException $e) {
    // Show error message if deletion fails
    die("Deletion failed: " . $e->getMessage());
}
