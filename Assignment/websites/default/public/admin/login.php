<?php
// admin/login.php

// Start the session
session_start();

// Connect to the database using PDO
require_once __DIR__ . '/../Includes/config.php';

// Handle flash message (after registration)
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Initialize error message
$error = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize user input
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Basic server-side validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (empty($password)) {
        $error = 'Please enter your password.';
    } else {
        // Check if admin exists in database
        $stmt = $pdo->prepare("SELECT id, name, password FROM admins WHERE email = ?");
        $stmt->execute([$email]);
        $admin = $stmt->fetch();

        // Verify password and log in
        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['user_id']   = $admin['id'];
            $_SESSION['user_name'] = $admin['name'];
            $_SESSION['is_admin']  = true;
            header("Location: dashboard.php");
            exit();
        }

        // Invalid credentials
        $error = 'Invalid email or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login &middot; ChronosRevel</title>
    <link rel="stylesheet" href="../vje.css">
</head>

<body>
    <div class="container">
        <div class="left">
            <h1>Welcome back, Admin</h1>
        </div>
        <div class="right">
            <div class="card">
                <div class="logo">Chronos Revel</div>
                <p><strong>Admin Login</strong></p>

                <!-- Show flash message if redirected from registration -->
                <?php if ($flash): ?>
                    <div class="input_feedback valid"><?= htmlspecialchars($flash) ?></div>
                <?php endif; ?>

                <!-- Show error message if login fails -->
                <?php if ($error): ?>
                    <div class="input_feedback invalid"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <!-- Login form -->
                <form action="" method="POST" novalidate>
                    <div class="form_group">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form_group">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form_group">
                        <button type="submit">Login</button>
                    </div>
                </form>

                <!-- Link to registration page -->
                <div class="register_section">
                    <p>Don't have an account? <a href="registration.php">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>