<?php
// Ensure admin session is active
require_once __DIR__ . '/session.php';
requireAdmin();

// Include DB configuration
require_once __DIR__ . '/config.php';

// Get admin ID from session
$admin_id = getAdminId();

// Fetch admin profile details
$stmt = $pdo->prepare("SELECT name, email FROM admins WHERE id = ?");
$stmt->execute([$admin_id]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!-- Admin Header Styles -->
<link rel="stylesheet" href="/vje.css">

<div class="sticky_header">
    <header>
        <!-- Admin Logo -->
        <div class="logo">Chronos Admin</div>

        <!-- Search Bar -->
        <div class="search_container">
            <input class="search_input" type="text" placeholder="Search" id="global_search_input">
        </div>

        <!-- Profile Section -->
        <div class="user_actions">
            <div class="profile_wrapper">
                <img src="/Icons/account_circle_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg"
                    alt="Profile Icon"
                    class="profile_icon"
                    id="profileToggle"
                    title="Profile" />
                <span class="profile_label">Profile</span>

                <!-- Dropdown Profile Card -->
                <div class="profile_card" id="profileCard">
                    <form id="profileForm" method="POST" action="/admin/update_profile.php">
                        <h3>Admin Profile</h3>

                        <label for="nameInput">Name</label>
                        <input id="nameInput" type="text" name="name"
                            value="<?= htmlspecialchars($admin['name'] ?? '') ?>" required>

                        <label for="emailInput">Email</label>
                        <input id="emailInput" type="email" name="email"
                            value="<?= htmlspecialchars($admin['email'] ?? '') ?>" required>

                        <div class="profile_buttons">
                            <button type="submit" class="profile_btn profile_btn--save">Save</button>
                            <a href="/admin/logout.php" class="profile_btn profile_btn--logout">Logout</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Admin Navigation -->
    <nav>
        <a href="/admin/dashboard.php">Dashboard</a>
        <a href="/admin/history.php">History</a>
        <a href="/admin/add_event.php">Add Event</a>
    </nav>
</div>

<!-- Profile toggle and search script -->
<script src="../js/dashboard.js"></script>