<?php

include_once '../Includes/config.php'; // Database connection file

// Handle Registration form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // User Information
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validations
    if (!preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
        echo "<script>alert('Full name can only contain letters and spaces');</script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
        exit();
    }

    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        echo "<script>alert('Username can only contain letters, numbers, and underscores');</script>";
        exit();
    }

    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        echo "<script>alert('Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number');</script>";
        exit();
    }

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into the database using PDO safely
    try {
        $stmt = $pdo->prepare("INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$fullname, $email, $username, $hashed_password]);

        echo "<script>alert('Registration successful'); window.location.href = 'login.php';</script>";
        exit();
    } catch (PDOException $e) {
        // You can show a general error or a more specific one
        echo "<script>alert('Error during registration: " . $e->getMessage() . "');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/vje.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="left">
            <h1>Evoke limitless possibilities <br> and new experience</h1>
        </div>
        <div class="right">
            <div class="card">
                <div class="logo">Chronos Revel</div>
                <p><strong>Create an account</strong></p>
                <p>Enter your details to register</p>
                <form action="" method="POST">
                    <input type="text" placeholder="Full Name" name="fullname" required>

                    <input type="email" placeholder="Email" name="email" required oninput="validation('email')">
                    <span class="input_feedback" id="email_availability"></span>

                    <input type="text" placeholder="Username" name="username" required oninput="validation('username')">
                    <span class="input_feedback" id="username_availability"></span>

                    <input type="password" placeholder="Password" name="password" required>
                    <span class="password_strength" id="password_strength"></span>

                    <input type="password" placeholder="Confirm Password" name="confirm_password" required>
                    <button type="submit">Register</button>
                </form>
                <div class="availability_message" id="availability_message"></div>
                <div class="login_section">
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
            </div>


            <!-- Javascript for AJAX and form validation -->
            <script src="../Js/registration.js"></script>
</body>

</html>