<?php
require_once __DIR__ . '/session.php';
requireAdmin();

require_once __DIR__ . '/config.php'; // Correct path if this file is in Includes/
$admin_id = getAdminId();
$stmt = $pdo->prepare("SELECT name, email FROM admins WHERE id = ?");
$stmt->execute([$admin_id]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="/vje.css">

<div class="sticky_header">
    <header>
        <div class="logo">Chronos Admin</div>

        <!-- Search Box -->
        <div class="search_container">
            <input class="search_input" type="text" placeholder="Search" id="global_search_input">
        </div>

        <!-- Profile Dropdown -->
        <div class="user_actions">
            <div class="profile_wrapper">
                <span class="profile_label">Profile</span>
                <img
                    src="/Icons/account_circle_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg"
                    alt="Profile"
                    class="profile_icon"
                    id="profileToggle"
                    title="Profile" />

                <div class="profile_card" id="profileCard">
                    <form id="profileForm" method="POST" action="/admin/update_profile.php">
                        <h3>Admin Profile</h3>

                        <label>Name</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($admin['name'] ?? '') ?>" required>

                        <label>Email</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($admin['email'] ?? '') ?>" required>

                        <div class="profile_buttons">
                            <button class="login_button" type="submit">Save</button>
                            <a href="/admin/logout.php" class="login_button">Logout</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <nav>
        <a href="/admin/dashboard.php">Dashboard</a>
        <a href="/admin/history.php">History</a>
        <a href="/admin/add_event.php">Add Event</a>
    </nav>
</div>

<script src="../js/dashboard.js">
</script>