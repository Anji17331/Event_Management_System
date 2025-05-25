<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_secure'   => false, // Use true in production (HTTPS)
        'use_strict_mode' => true,
        'cookie_samesite' => 'Lax',
    ]);
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}

function getAdminId()
{
    return $_SESSION['user_id'] ?? null;
}

function requireAdmin()
{
    if (!isLoggedIn()) {
        header('Location: ../login.php');
        exit();
    }
}
