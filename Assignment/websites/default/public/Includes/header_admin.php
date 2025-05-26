<?php
require_once __DIR__ . '/session.php';
requireAdmin();
?>
<link rel="stylesheet" href="/vje.css">

<div class="sticky_header">
    <header>
        <div class="logo">Chronos Admin</div>

        <!-- search-->
        <div class="search_container">
            <input class="search_input" type="text" placeholder="Search" id="global_search_input">
        </div>

        <div class="user_actions">
            <a href="/admin/admin_profile.php" title="Profile">
                <img src="/Icons/account_circle_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Profile">
            </a>
            <a class="login_button" href="/admin/logout.php">Logout</a>
        </div>
    </header>

    <nav>
        <a href="/admin/dashboard.php">Dashboard</a>
        <a href="/admin/history.php">History</a>
        <a href="/admin/add_event.php">Add Event</a>
        <a href="/admin/admin_profile.php">Profile</a>
    </nav>
</div>

<script>
</script>