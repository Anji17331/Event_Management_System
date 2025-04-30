<?php
include_once '../Includes/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';
$selectedRole = 'user';  // default if no POST yet

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username     = trim($_POST['username']);
    $password     = trim($_POST['password']);
    $selectedRole = trim($_POST['login_role']);  // from hidden input

    // Only fetch users of that role
    $stmt = $pdo->prepare(
        "SELECT * FROM users WHERE username = ? AND role = ?"
    );
    $stmt->execute([$username, $selectedRole]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role']     = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header('Location: ../admin/dashboard.php');
            } else {
                header('Location: ../index.php');
            }
            exit;
        } else {
            $error = 'Invalid password.';
        }
    } else {
        $error = 'Invalid username or role.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/vje.css">
    <style>
        .buttons button {
            padding: .5em 1em;
            margin-right: .5em;
            border: 1px solid #ccc;
            background: #f9f9f9;
            cursor: pointer;
        }

        .buttons button.active {
            background: #007bff;
            color: #fff;
            border-color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <h1>Evoke Limitless Possibilities<br>and New Experience</h1>
        </div>

        <div class="right">
            <div class="card">
                <div class="buttons">
                    <button type="button" id="btnUser">USER</button>
                    <button type="button" id="btnAdmin">ADMIN</button>
                </div>

                <div class="logo">Chronos Revel</div>
                <p><strong>Welcome back</strong></p>
                <p>Enter your details to login</p>

                <form action="" method="POST">
                    <!-- hidden field for selected role -->
                    <input type="hidden" name="login_role" id="login_role" value="<?php echo htmlspecialchars($selectedRole); ?>">

                    <input type="text" placeholder="username" name="username" required>
                    <input type="password" placeholder="password" name="password" required>

                    <?php if (!empty($error)): ?>
                        <div class="error" style="color:red; margin-top:10px;">
                            <?= htmlspecialchars($error) ?>
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
            </div>
        </div>
    </div>

    <script>
        // Grab buttons and hidden field
        const btnUser = document.getElementById('btnUser');
        const btnAdmin = document.getElementById('btnAdmin');
        const roleInput = document.getElementById('login_role');

        function setActive(role) {
            if (role === 'admin') {
                btnAdmin.classList.add('active');
                btnUser.classList.remove('active');
            } else {
                btnUser.classList.add('active');
                btnAdmin.classList.remove('active');
            }
            roleInput.value = role;
        }

        // Initialize on page load
        setActive('<?php echo $selectedRole; ?>');

        btnUser.addEventListener('click', () => setActive('user'));
        btnAdmin.addEventListener('click', () => setActive('admin'));
    </script>
</body>

</html>