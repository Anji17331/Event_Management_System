<?php
// Start a secure session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_secure'   => false, // Set to true for production (HTTPS)
        'use_strict_mode' => true,
        'cookie_samesite' => 'Lax',
    ]);
}

// Check if the user is logged in and is an admin
function isLoggedIn()
{
    return isset($_SESSION['user_id']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}

// Return the currently logged-in admin's ID
function getAdminId()
{
    return $_SESSION['user_id'] ?? null;
}

// Restrict access to admin-only pages
function requireAdmin()
{
    if (!isLoggedIn()) {
        header('Location: ../login.php');
        exit();
    }
}
