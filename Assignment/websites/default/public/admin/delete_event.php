<?php
require_once __DIR__ . '/../Includes/session.php';
requireAdmin();

require_once __DIR__ . '/../Includes/config.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("No event ID provided.");
}

try {
    $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: dashboard.php?deleted=true");
    exit();
} catch (PDOException $e) {
    die("Deletion failed: " . $e->getMessage());
}
