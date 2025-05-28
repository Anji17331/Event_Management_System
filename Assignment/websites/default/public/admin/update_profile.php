<?php
require_once '../Includes/session.php';
requireAdmin();
require_once '../Includes/config.php';

$admin_id = getAdminId();
$name = trim($_POST['name']);
$email = trim($_POST['email']);

if ($name && $email) {
    $stmt = $pdo->prepare("UPDATE admins SET name = ?, email = ? WHERE id = ?");
    $stmt->execute([$name, $email, $admin_id]);
}

header("Location: dashboard.php");
exit;
