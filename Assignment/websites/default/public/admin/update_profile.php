<?php
// Include session management and ensure the user is an authenticated admin
require_once '../Includes/session.php';
requireAdmin();

// Include database connection (PDO)
require_once '../Includes/config.php';

// Get the current admin's ID
$admin_id = getAdminId();

// Retrieve and trim submitted name and email from POST data
$name = trim($_POST['name']);
$email = trim($_POST['email']);

// If both name and email are provided, update the admin record
if ($name && $email) {
    $stmt = $pdo->prepare("UPDATE admins SET name = ?, email = ? WHERE id = ?");
    $stmt->execute([$name, $email, $admin_id]);
}

// Redirect to dashboard after update
header("Location: dashboard.php");
exit;
