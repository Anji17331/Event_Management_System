<?php
require_once __DIR__ . '/../Includes/config.php';
header('Content-Type: application/json');

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$filter = isset($_GET['filter']) ? trim($_GET['filter']) : '';
$today = date('Y-m-d');

try {
    $query = "
        SELECT id, title, description, location, category, event_date, image_path
        FROM events
        WHERE 1 = 1
    ";

    $params = [];

    // Optional search filter
    if ($search !== '') {
        $query .= " AND (
            LOWER(title) LIKE LOWER(:search)
            OR LOWER(location) LIKE LOWER(:search)
            OR LOWER(category) LIKE LOWER(:search)
        )";
        $params['search'] = "%$search%";
    }

    // Time filter: past, upcoming, or default (upcoming)
    if ($filter === 'past') {
        $query .= " AND event_date < :today";
    } else { // includes 'upcoming' or no filter
        $query .= " AND event_date >= :today";
    }

    $params['today'] = $today;

    $query .= " ORDER BY event_date ASC";
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);

    $events = $stmt->fetchAll();
    echo json_encode(['status' => 'success', 'data' => $events]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
