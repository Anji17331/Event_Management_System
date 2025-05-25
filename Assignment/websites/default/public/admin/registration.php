<?php
include_once '../Includes/config.php'; // PDO connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate name
    if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        echo "<script>alert('Name can only contain letters and spaces');</script>";
        exit();
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
        exit();
    }

    // Validate password strength
    if (
        strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[0-9]/', $password)
    ) {
        echo "<script>alert('Password must be at least 8 characters long and contain one uppercase letter, one lowercase letter, and one number');</script>";
        exit();
    }

    // Match password
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert into admins table using PDO
    try {
        $stmt = $pdo->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword]);

        echo "<script>alert('Registration successful');</script>";
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="../vje.css">
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
                <form action="" method="POST">
                    <input type="text" name="name" placeholder="Full Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    <button type="submit">Register</button>
                </form>
                <div class="register_section">
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>