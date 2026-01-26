<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include("../config.php"); // config is one level up

// Handle logout message
$logout_message = "";
$logout_type = "";
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    $logout_message = "You have successfully logged out.";
    $logout_type = "success"; // green
}

// Handle login submission
$error = "";
$error_type = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $loginInput = mysqli_real_escape_string($db, $_POST['username']); 
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);

    // Check if user exists
    $sql_user = "SELECT * FROM Admin WHERE UserName='$loginInput' OR Email='$loginInput'";
    $result_user = mysqli_query($db, $sql_user);

    if ($result_user && mysqli_num_rows($result_user) == 1) {
        $user = mysqli_fetch_assoc($result_user);

        // Validate password
        if ($user['Passcode'] !== $mypassword) {
            $error = "Incorrect password.";
            $error_type = "danger"; // red
        } elseif ($user['Status'] != 1) {
            $error = "Your account is inactive.";
            $error_type = "warning"; // yellow
        } else {
            // Fetch role info
            $sql_role = "SELECT Role AS role_name FROM Role WHERE SL=".$user['Role'];
            $result_role = mysqli_query($db, $sql_role);
            $role = mysqli_fetch_assoc($result_role);

            // Set session
            $_SESSION['login_user'] = $user['UserName'];
            $_SESSION['user_name']  = $user['Name'];
            $_SESSION['user_designation']  = $user['Designation'];
            $_SESSION['role_id']   = $user['Role'];
            $_SESSION['role_name'] = $role['role_name'];

            // Redirect to single dashboard (template folder)
            header("Location: ../template/base.php");
            exit();
        }

    } else {
        $error = "User not found.";
        $error_type = "danger"; // red
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

<style>
/* Reset */
* { box-sizing: border-box; margin: 0; padding: 0; }
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    min-height: 100vh;
    background: #66a6ff;
}

/* Two panel layout */
.container { display: flex; flex:1; width:100%; }

/* Left Panel */
.left-panel {
    flex: 1;
    position: relative;
    background-image: url('../assets/images/backGround.avif'); /* airplane image */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    color: #fff;
    padding: 30px 20px;
}
.left-panel::before {
    content: '';
    position: absolute;
    top:0; left:0; right:0; bottom:0;
    background: rgba(52,73,94,0.6);
    z-index: 0;
}
.left-panel > div, .left-panel footer { position: relative; z-index: 1; text-align: center; }
.left-panel img { width:100px; height:100px; margin-bottom:20px; }
.left-panel h1,h2,h3 { margin:4px 0; text-shadow: 1px 1px 4px rgba(0,0,0,0.7); }

/* Right Panel (Login) */
.right-panel {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    background: #f0f4f8;
}
.login-container {
    width: 100%;
    max-width: 350px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    overflow: hidden;
}

.login-container .title {
    background-image: url('../assets/images/backGround.avif');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    color: #0eee46;
    padding: 15px;
    text-align: center;
    font-weight: bold;
    border-bottom: 2px solid rgba(0,0,0,0.2);
}

.login-container .title h2 { 
    margin: 0; 
    text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
}

.login-container .title p { 
    font-size: 14px; 
    margin-top: 5px; 
    color: #10ee86;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.6);
}

.login-container .content { padding: 20px; }

label { font-weight:bold; display:block; margin-bottom:5px; color:#34495e; }
.box { width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; margin-bottom:15px; font-size:14px; transition:0.3s; }
.box:focus { border-color:#66a6ff; box-shadow:0 0 5px rgba(102,166,255,0.5); outline:none; }
.password-wrapper { position: relative; }
.eye-icon { position:absolute; right:10px; top:10px; cursor:pointer; color:#888; }

.submit-btn {
    width:100%;
    padding:12px;
    font-size:16px;
    font-weight:bold;
    border:none;
    border-radius:8px;
    background: linear-gradient(135deg,#66a6ff,#89f7fe);
    color:#fff;
    cursor:pointer;
    transition:0.3s;
}
.submit-btn:hover { background: linear-gradient(135deg,#89f7fe,#66a6ff); }

.forgot-password { text-align:right; font-size:13px; margin-top:5px; }
.forgot-password a { color:#34495e; text-decoration:underline; }
.forgot-password a:hover { color:#66a6ff; }

.message { font-size: 13px; margin-bottom: 15px; padding: 8px; border-radius: 5px; text-align: center; }
.message.danger { background:#ffcccc; color:#cc0000; }
.message.warning { background:#fff3cd; color:#856404; }
.message.success { background:#d4edda; color:#155724; }

.left-panel footer { font-size:12px; }
.left-panel footer a { color:#fff; text-decoration:none; }
.left-panel footer a:hover { color:#66a6ff; }

@media (max-width:900px) {
    .container { flex-direction: column; }
    .left-panel, .right-panel { flex:none; width:100%; }
    .left-panel { height:250px; }
}
</style>
</head>

<body>
<div class="container">
    <!-- Left Panel -->
    <div class="left-panel">
        <div>
            <img src="../assets/images/Logo.png" alt="Logo">
            <h1>Internal Resources Division (IRD)</h1>
            <h2>Ministry of Finance</h2>
            <h3>Bangladesh Secretariat, Dhaka-1000</h3>
            <h2>Welcome to the Login Portal of Foreign Visit Tracker (FVT)</h2>
        </div>
        <footer>
            <p>
                <b>Developed by: ICT Cell, IRD.</b><br>
                <a href="mailto:info@ird.gov.bd">info@ird.gov.bd</a>, 
                <a href="tel:+8801817102041">+880 1817102041</a>, 
                <a href="http://www.ird.gov.bd" target="_blank">www.ird.gov.bd</a>
            </p>
        </footer>
    </div>

    <!-- Right Panel -->
    <div class="right-panel">
        <div class="login-container">
            <div class="title">
                <h2>Login to FVT</h2>
                <p>Please login to access your account</p>
            </div>

            <div class="content">
                <?php if($logout_message): ?>
                    <div class="message <?php echo $logout_type; ?>">
                        <?php echo $logout_message; ?>
                    </div>
                <?php endif; ?>

                <?php if($error): ?>
                    <div class="message <?php echo $error_type; ?>">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="post">
                    <label>Username:</label>
                    <input type="text" name="username" class="box" placeholder="Username or Email" 
                        value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>

                    <label>Password:</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password" class="box" placeholder="******" required>
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
</div>

<script>
function togglePassword() {
    var pwd = document.getElementById("password");
    var icon = document.getElementById("eyeIcon");
    if(pwd.type === "password") {
        pwd.type = "text";
        icon.classList.replace("fa-eye","fa-eye-slash");
    } else {
        pwd.type = "password";
        icon.classList.replace("fa-eye-slash","fa-eye");
    }
}

setTimeout(function() {
    var messages = document.querySelectorAll('.message');
    messages.forEach(function(msg) { msg.style.display = 'none'; });
}, 5000);
</script>
</body>
</html>
