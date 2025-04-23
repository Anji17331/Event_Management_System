<?php
include_once '../Includes/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';  // Initialize error message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare and execute the PDO statement
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $user = $result;


        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
           switch ($user['role']) {
                case 'admin':
                    header('Location: ../admin/dashboard.php"');
                    break;
                case 'user':
                    header('Location: ../index.php');
                    break;
                default:
                header('Location: ../index.php');
                }
            exit();
        } else {
            $error = 'Invalid password';  // Store error message
        }
    } else {
        $error = 'Invalid username';  // Store error message
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/vje.css">
</head>

<body>
    <div class="container">
        <div class="left">
            <h1>Evoke Limitless possibilities <br> and new experience</h1>
        </div>

        <div class="right">
            <div class="card">
                <div class="buttons">
                    <button>USER</button>
                    <button>ADMIN</button>
                </div>

                <div class="logo">Chronos Revel</div>
                <p><strong>Welcome back</strong></p>
                <p>Enter your Details to login</p>

                <!-- Display the error message here -->


                <form action="" method="POST">
                    <input type="text" placeholder="username" name="username" required>
                    <input type="password" placeholder="password" name="password" required>
                    
                    <!-- If there's an error, display it below the password input -->
                    <?php if (!empty($error)): ?>
                        <div class="error" style="color:red; margin-top: 10px;">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <div class="forgot_password">
                        <a href="forgot_password.php">Forgot password?</a>
                    </div>
                    <button type="submit">Login</button>
                </form>

                <div class="register_section">
                    <p>Don't have an account? <a href="registration.php">Register</a></p>
                </div>

                <!-- <div class="social_login">
                    <p>Or</p>
                    <p>Signup with</p>
                    <div class="social_buttons">
                        <button><img src="" alt="Google"></button>
                        <button><img src="" alt="Facebook"></button>
                        <button><img src="" alt="Twitter"></button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>
