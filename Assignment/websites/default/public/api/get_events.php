<?php
require_once __DIR__ . '/../Includes/config.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT id, title, description, location, category, event_date, image_path FROM events ORDER BY event_date DESC");
    $events = $stmt->fetchAll();
    echo json_encode(['status' => 'success', 'data' => $events]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
