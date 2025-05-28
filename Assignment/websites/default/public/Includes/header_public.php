<?php
// Start or resume session so we can detect user login state if needed
require_once __DIR__ . '/session.php';
?>

<!-- Link to global stylesheet for shared site styling -->
<link rel="stylesheet" href="/vje.css">

<!-- Sticky header wrapper: stays at top during scroll -->
<div class="sticky_header">
    <header>
        <!-- Site logo/title, links back to home or branding -->
        <div class="logo">Chronos Revel</div>

        <!-- Central search box for event lookup -->
        <div class="search_container">
            <input
                class="search_input"
                type="text"
                placeholder="Search"
                id="global_search_input">
        </div>

        <!-- User actions: login link when not authenticated -->
        <div class="user_actions">
            <a href="#" class="profile_btn">Login</a>
        </div>
    </header>

    <!-- Main site navigation -->
    <nav>
        <a href="/index.php">Home</a>
        <a href="/event_listing.php?filter=past">History</a>
        <a href="/event_listing.php?filter=upcoming">Upcoming</a>
        <a href="/about_us.php">About Us</a>
    </nav>
</div>