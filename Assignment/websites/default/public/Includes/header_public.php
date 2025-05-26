<?php
require_once __DIR__ . '/session.php';
?>
<link rel="stylesheet" href="/vje.css">

<div class="sticky_header">
    <header>
        <div class="logo">Chronos Revel</div>

        <!-- Search Box -->
        <div class="search_container">
            <input class="search_input" type="text" placeholder="Search" id="global_search_input">
        </div>

        <div class="user_actions">
            <a href="/login.php" class="login_button">Login</a>
        </div>
    </header>

    <nav>
        <a href="/index.php">Home</a>
        <a href="/event_listing.php?filter=past">History</a>
        <a href="/event_listing.php?filter=upcoming">Upcoming</a>
        <a href="/about_us.php">About Us</a>
    </nav>
</div>

<script>
</script>