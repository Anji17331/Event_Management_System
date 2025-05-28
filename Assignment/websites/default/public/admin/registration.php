<?php
// public/admin/registration.php

session_start();
require_once __DIR__ . '/../Includes/config.php'; // Include database connection (PDO)

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and trim POST input values
    $name             = trim($_POST['name'] ?? '');
    $email            = trim($_POST['email'] ?? '');
    $password         = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    // 1) Validate name - only letters and spaces allowed
    if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        $error = 'Name can only contain letters and spaces.';
    }
    // 2) Validate email format
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    }
    // 3) Check password strength:
    //    - At least 8 characters
    //    - Contains uppercase, lowercase, and number
    elseif (
        strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[0-9]/', $password)
    ) {
        $error = 'Password must be at least 8 characters with uppercase, lowercase, and a number.';
    }
    // 4) Confirm that password and confirmation match
    elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    }

    // If no validation errors, proceed to save user
    if (!$error) {
        // Hash password securely with bcrypt
        $hashed = password_hash($password, PASSWORD_BCRYPT);

        try {
            // Prepare and execute SQL insert statement using PDO prepared statements
            $stmt = $pdo->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $hashed]);

            // Set a flash message to show on login page after redirect
            $_SESSION['flash'] = 'Registration successful! Please log in.';
            header("Location: login.php"); // Redirect to login page
            exit;
        } catch (PDOException $e) {
            // Handle duplicate email error (SQLSTATE 23000 = integrity constraint violation)
            if ($e->getCode() === '23000') {
                $error = 'An account with that email already exists.';
            } else {
                // Generic error with safe output
                $error = 'Unexpected error: ' . htmlspecialchars($e->getMessage());
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Registration · ChronosRevel</title>
    <link rel="stylesheet" href="../vje.css"> <!-- Stylesheet link -->
</head>

<body>
    <div class="container">
        <div class="left">
            <h1>Evoke limitless possibilities<br>and new experience</h1>
        </div>
        <div class="right">
            <div class="card">
                <div class="logo">Chronos Revel</div>
                <p><strong>Create an Admin Account</strong></p>

                <!-- Display error messages if any -->
                <?php if ($error): ?>
                    <div class="input_feedback invalid"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <!-- Registration form -->
                <form method="POST" novalidate>
                    <div class="form_group">
                        <input type="text" name="name" placeholder="Full Name" required>
                    </div>
                    <div class="form_group">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form_group">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form_group">
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <div class="form_group">
                        <button type="submit">Register</button>
                    </div>
                </form>

                <!-- Link to login page if user already has an account -->
                <div class="register_section">
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>