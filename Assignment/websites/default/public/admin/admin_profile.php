<?php
// Secure admin session check
require_once '../Includes/session.php';
requireAdmin();

// Include DB connection
require_once '../Includes/config.php';

// Fetch admin details using PDO
$admin_id = getAdminId(); // From session helper
$stmt = $pdo->prepare("SELECT * FROM admins WHERE id = ?");
$stmt->execute([$admin_id]);
$admin = $stmt->fetch();

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
    <link rel="stylesheet" href="../style.css"> <!-- Update this if needed -->
</head>

<body>
    <div class="container">
        <h1>Admin Profile</h1>
        <div class="profile-details">
            <p><strong>Name:</strong> <?= htmlspecialchars($admin['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($admin['email']) ?></p>
        </div>
        <a href="edit_profile.php" class="btn">Edit Profile</a>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>

</html>