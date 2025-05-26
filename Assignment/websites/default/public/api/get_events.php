<?php
require_once __DIR__ . '/../Includes/config.php';

header('Content-Type: application/json');

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

try {
    if ($search !== '') {
        $stmt = $pdo->prepare("
            SELECT id, title, description, location, category, event_date, image_path
            FROM events
            WHERE LOWER(title) LIKE LOWER(:search)
               OR LOWER(location) LIKE LOWER(:search)
               OR LOWER(category) LIKE LOWER(:search)
            ORDER BY event_date DESC
        ");
        $stmt->execute(['search' => "%$search%"]);
    } else {
        $stmt = $pdo->query("
            SELECT id, title, description, location, category, event_date, image_path
            FROM events
            ORDER BY event_date DESC
        ");
    }

    $events = $stmt->fetchAll();
    echo json_encode(['status' => 'success', 'data' => $events]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
