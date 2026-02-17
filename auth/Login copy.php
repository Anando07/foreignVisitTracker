<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include("../config.php");

// Initialize variables
$message = '';
$message_type = '';

// If logout requested, store it in session
if(isset($_GET['logout']) && $_GET['logout'] == 1){
    $_SESSION['msg'] = "You have successfully logged out.";
    $_SESSION['msg_type'] = "success";

    // Redirect to remove ?logout=1 from URL
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Capture session message (login errors, warnings, logout)
if(isset($_SESSION['msg'])){
    $message = $_SESSION['msg'];
    $message_type = $_SESSION['msg_type'];
    unset($_SESSION['msg'], $_SESSION['msg_type']); // clear immediately
}

// Handle login submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $loginInput = mysqli_real_escape_string($db, $_POST['username']); 
    $mypassword = $_POST['password'];

    $sql_user = "SELECT * FROM Admin WHERE UserName='$loginInput' OR Email='$loginInput'";
    $result_user = mysqli_query($db, $sql_user);

    if ($result_user && mysqli_num_rows($result_user) == 1) {
        $user = mysqli_fetch_assoc($result_user);

        if (!password_verify($mypassword, $user['Passcode'])) {
            $_SESSION['msg'] = "Incorrect password.";
            $_SESSION['msg_type'] = "danger";
        } elseif ($user['Status'] != 1) {
            $_SESSION['msg'] = "Your account is inactive.";
            $_SESSION['msg_type'] = "warning";
        } else {
            $sql_role = "SELECT Role AS role_name FROM Role WHERE SL=".$user['Role_ID'];
            $result_role = mysqli_query($db, $sql_role);
            $role = mysqli_fetch_assoc($result_role);

            $_SESSION['login_user_id']   = $user['ID'];
            $_SESSION['login_user']      = $user['UserName'];
            $_SESSION['user_name']       = $user['Name'];
            $_SESSION['user_designation']= $user['Designation'];
            $_SESSION['role_id']         = $user['Role_ID'];
            $_SESSION['role_name']       = $role['role_name'];

            header("Location: ../template/base.php");
            exit();
        }

        // Redirect after POST to avoid resubmission
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        $_SESSION['msg'] = "User not found.";
        $_SESSION['msg_type'] = "danger";
        header("Location: ".$_SERVER['PHP_SELF']);
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
    <!-- Left Panel -->
    <div class="left-panel">
        <img src="../assets/images/Logo.png" alt="Logo">
        <h1>Internal Resources Division (IRD)</h1>
        <h2>Ministry of Finance</h2>
        <h3>Bangladesh Secretariat, Dhaka-1000</h3>
        <p>Welcome to the Login Portal of Foreign Visit Tracker (FVT)</p>
    </div>

    <!-- Right Panel -->
    <div class="right-panel">
        <div class="login-container">
            <div class="title">
                <h2>Login to FVT</h2>
                <p>Please login to access your account</p>
            </div>
            <?php if($message): ?>
                <div class="message <?php echo $message_type; ?>">
                    <?php echo $message; ?>
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

// Auto-hide messages after 5s
setTimeout(function(){
    document.querySelectorAll('.message').forEach(function(msg){
        msg.remove();
    });
}, 5000);

</script>
</body>
</html>
