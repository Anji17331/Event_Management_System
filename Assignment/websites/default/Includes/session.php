<?php
// Secure session settings
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,      // JS can’t access the session cookie
        'cookie_secure'   => true,      // only over HTTPS
        'use_strict_mode' => true,      // reject uninitialized session IDs
        'cookie_samesite' => 'Lax',     // mitigate CSRF
    ]);
}

// Check if user is logged in
function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

// Check if user is admin
function isAdmin()
{
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Get user id
function getUserId()
{
    return $_SESSION['user_id'] ?? null;
}

// Redirect to login if not authenticated
function requireAuth()
{
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

// Redirect to public homepage if not admin
function requireAdmin()
{
    if (!isAdmin()) {
        header('Location: index.php');
        exit();
    }
}
