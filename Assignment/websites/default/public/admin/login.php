<?php
include_once '../Includes/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT id, name, password FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['user_id']   = $admin['id'];
        $_SESSION['user_name'] = $admin['name'];
        $_SESSION['is_admin']  = true;

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
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
                <?php if (!empty($error)): ?>
                    <p class="input_feedback invalid"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
                <form action="" method="POST">
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
                <div class="register_section">
                    <p>Don't have an account? <a href="registration.php">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>