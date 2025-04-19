<?php 
//Starting the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

//check if user is admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

//Get user id
function getUserId() {
    return $_SESSION['user_id'] ?? null;
}

//Redirect to login if not authenticated
function requireAuth() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

//Redirect to public homepage if not admin
function requireAdmin() {
    if (!isAdmin()) {
        header('Location: index.php');
        exit();
    }
}
