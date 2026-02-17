<?php
include("../init.php"); // DB + session + Auth

// Handle POST login
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($auth->login($username, $password)) {
        header("Location: ../base.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FVT Login</title>

<link rel="shortcut icon" type="image/jpeg" href="../assets/images/VisitIcon.jpeg">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
<div class="container">

    <!-- LEFT PANEL -->
    <div class="left-panel">
        <img src="../assets/images/Logo.png" alt="Logo">
        <h1>Internal Resources Division (IRD)</h1>
        <h2>Ministry of Finance</h2>
        <h3>Bangladesh Secretariat, Dhaka-1000</h3>
        <p>Welcome to the Login Portal of Foreign Visit Tracker (FVT)</p>
    </div>

    <!-- RIGHT PANEL -->
    <div class="right-panel">
        <div class="login-container">

            <div class="title">
                <h2>Login to FVT</h2>
                <p>Please login to access your account</p>
            </div>

            <!-- FLASH MESSAGE (ONLY ONCE) -->
            <?= $auth->flashMessage(); ?>

            <form method="post">

                <label>Username:</label>
                <input type="text" name="username" class="box"
                       placeholder="Username or Email"
                       value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                       required>

                <label>Password:</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="password"
                           class="box" placeholder="******" required>
                    <span class="eye-icon" onclick="togglePassword()">
                        <i id="eyeIcon" class="fa fa-eye"></i>
                    </span>
                </div>

                <input type="submit" value="Login" class="submit-btn">

                <div class="forgot-password">
                    <a href="forgot_password.php">Forgot Password?</a>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
function togglePassword() {
    const pwd = document.getElementById("password");
    const icon = document.getElementById("eyeIcon");

    if (pwd.type === "password") {
        pwd.type = "text";
        icon.classList.replace("fa-eye","fa-eye-slash");
    } else {
        pwd.type = "password";
        icon.classList.replace("fa-eye-slash","fa-eye");
    }
}

// Auto-hide flash messages
setTimeout(() => {
    document.querySelectorAll('.message').forEach(msg => msg.remove());
}, 5000);
</script>

</body>
</html>
