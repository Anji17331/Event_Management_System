<?php
require_once __DIR__ . '/../Includes/config.php';
header('Content-Type: application/json');

// Get search and filter parameters from the query string
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$filter = isset($_GET['filter']) ? trim($_GET['filter']) : '';
$today = date('Y-m-d');

try {
    // Base query selecting event details
    $query = "
        SELECT id, title, description, location, category, event_date, image_path
        FROM events
        WHERE 1 = 1
    ";

    $params = [];

    // Add search filter if provided (case-insensitive search in title, location, category)
    if ($search !== '') {
        $query .= " AND (
            LOWER(title) LIKE LOWER(:search)
            OR LOWER(location) LIKE LOWER(:search)
            OR LOWER(category) LIKE LOWER(:search)
        )";
        $params['search'] = "%$search%";
    }

    // Filter events by date: past events or upcoming events (default)
    if ($filter === 'past') {
        $query .= " AND event_date < :today";
    } else { // 'upcoming' or no filter defaults to upcoming events
        $query .= " AND event_date >= :today";
    }

    $params['today'] = $today;

    // Sort results by event date ascending
    $query .= " ORDER BY event_date ASC";

    // Prepare and execute the query with parameters
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);

    // Fetch all matching events
    $events = $stmt->fetchAll();

    // Return JSON success response with events data
    echo json_encode(['status' => 'success', 'data' => $events]);
} catch (PDOException $e) {
    // Return JSON error response if query fails
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
