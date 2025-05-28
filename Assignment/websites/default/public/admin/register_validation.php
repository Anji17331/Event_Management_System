<?php
// public/admin/register_validation.php
header('Content-Type: application/json; charset=UTF-8');
require_once __DIR__ . '/db.php';  // mysqli $conn

$field = $_POST['field'] ?? '';
$value = trim($_POST['value'] ?? '');

// Only allow username checks
if ($field !== 'username' || $value === '') {
    echo json_encode(['exists' => false]);
    exit;
}

$sql = "SELECT id FROM admins WHERE username = ? LIMIT 1";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('s', $value);
    $stmt->execute();
    $stmt->store_result();
    echo json_encode(['exists' => ($stmt->num_rows > 0)]);
    $stmt->close();
} else {
    echo json_encode(['exists' => false]);
}
