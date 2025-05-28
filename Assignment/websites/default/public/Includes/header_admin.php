<?php
// Start session and ensure user is an admin before proceeding
require_once __DIR__ . '/session.php';
requireAdmin();

// Include database configuration (PDO) for data queries
require_once __DIR__ . '/config.php';

// Fetch current admin's ID from session
$admin_id = getAdminId();

// Prepare and execute a secure query to retrieve admin name & email
$stmt = $pdo->prepare("SELECT name, email FROM admins WHERE id = ?");
$stmt->execute([$admin_id]);
// Fetch associative array of admin details
$admin = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!-- Link to global stylesheet for consistent styling -->
<link rel="stylesheet" href="/vje.css">

<!-- Sticky header wrapper holds navigation & profile controls -->
<div class="sticky_header">
    <header>
        <!-- Brand logo/title on the left -->
        <div class="logo">Chronos Admin</div>

        <!-- Centered global search box for quick lookups -->
        <div class="search_container">
            <input
                class="search_input"
                type="text"
                placeholder="Search"
                id="global_search_input">
        </div>

        <!-- Profile dropdown trigger and menu -->
        <div class="user_actions">
            <div class="profile_wrapper">
                <!-- Profile icon that toggles the dropdown -->
                <img
                    src="/Icons/account_circle_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg"
                    alt="Profile Icon"
                    class="profile_icon"
                    id="profileToggle"
                    title="Profile" />
                <!-- Decorative label next to the icon -->
                <span class="profile_label">Profile</span>

                <!-- Hidden card that appears when icon is clicked -->
                <div class="profile_card" id="profileCard">
                    <!-- Form to update admin's own profile details -->
                    <form id="profileForm" method="POST" action="/admin/update_profile.php">
                        <h3>Admin Profile</h3>

                        <!-- Admin name input, prefilled with current value -->
                        <label for="nameInput">Name</label>
                        <input
                            id="nameInput"
                            type="text"
                            name="name"
                            value="<?= htmlspecialchars($admin['name'] ?? '') ?>"
                            required>

                        <!-- Admin email input, prefilled with current value -->
                        <label for="emailInput">Email</label>
                        <input
                            id="emailInput"
                            type="email"
                            name="email"
                            value="<?= htmlspecialchars($admin['email'] ?? '') ?>"
                            required>

                        <!-- Save and Logout actions side by side -->
                        <div class="profile_buttons">
                            <!-- Submit form to save changes -->
                            <button type="submit" class="profile_btn profile_btn--save">
                                Save
                            </button>
                            <!-- Logout link to end admin session -->
                            <a href="/admin/logout.php" class="profile_btn profile_btn--logout">
                                Logout
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main admin navigation links -->
    <nav>
        <a href="/admin/dashboard.php">Dashboard</a>
        <a href="/admin/history.php">History</a>
        <a href="/admin/add_event.php">Add Event</a>
    </nav>
</div>

<!-- JavaScript to handle profile dropdown toggle and search behaviors -->
<script src="../js/dashboard.js"></script>