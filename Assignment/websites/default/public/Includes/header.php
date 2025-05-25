<?php
require_once __DIR__ . '/session.php';
?>
<link rel="stylesheet" href="../vje.css">
<!-- Sticky Header -->
<div class="sticky_header">
    <header>
        <div class="logo">Chronos Revel</div>

        <!-- Search Box -->
        <div class="search_container">
            <input type="text" placeholder="Search">
        </div>

        <!-- Action Icons -->
        <div class="user_actions">
            <!-- <a href="/wishlist.php" title="Wishlist">
                <img src="/Icons/favorite_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Wishlist">
            </a> -->
            <!-- <a href="/cart.php" title="Cart">
                <img src="/Icons/shopping_cart_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Cart">
            </a> -->
            <a href="/admin/admin_profile.php" title="Account">
                <img src="/Icons/account_circle_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Profile">
            </a>

            <?php if (isLoggedIn()): ?>
                <a class="login_button" href="/admin/logout.php">Logout</a>
            <?php else: ?>
                <a class="login_button" href="/admin/login.php">Login</a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Navigation -->
    <?php if (!isLoggedIn() || $_SESSION['is_admin'] !== true): ?>
        <nav>
            <a href="/index.php">Home</a>
            <a href="/event_listing.php?filter=past">History</a>
            <a href="/event_listing.php?filter=upcoming">Upcoming</a>
            <a href="#">About us</a>
        </nav>
    <?php endif; ?>
</div>

<!-- Sticky Scroll Shadow -->
<script>
    window.addEventListener("scroll", function() {
        const header = document.querySelector(".sticky_header");
        header.style.boxShadow = window.scrollY > 10 ?
            "0 4px 12px rgba(0,0,0,0.1)" :
            "none";
    });
</script>