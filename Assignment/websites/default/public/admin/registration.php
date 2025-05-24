<?php

include_once '../Includes/config.php'; //Database connection file and session start

// Handle Registration form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //User Information
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Check if the fullname is valid
    if (!preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
        echo "<script>alert('Full name can only contain letters and spaces');</script>";
        exit();
    }

    // Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
        exit();
    }

    // Check if the username is valid
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        echo "<script>alert('Username can only contain letters, numbers, and underscores');</script>";
        exit();
    }

    // Check if the password is strong
    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        echo "<script>alert('Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number');</script>";
        exit();
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
    }

    // Hash the password
    $password = password_hash($password, PASSWORD_BCRYPT);



    // Insert user into the database
    $sql = "INSERT INTO users (fullname, email, username, password) VALUES ('$fullname', '$email', '$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful');</script>";
        header("Location: login.php");
        exit();
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
    //close statement
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../vje.css">
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