<?php
// admin_profile.php

session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Include database connection
require_once '../../config/db_connection.php';

// Fetch admin details
$admin_id = $_SESSION['admin_id'];
$query = "SELECT * FROM admins WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

if (!$admin) {
    echo "Admin not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Admin Profile</h1>
        <div class="profile-details">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($admin['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['email']); ?></p>
            <p><strong>Role:</strong> <?php echo htmlspecialchars($admin['role']); ?></p>
        </div>
        <a href="edit_profile.php" class="btn">Edit Profile</a>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>
</html>