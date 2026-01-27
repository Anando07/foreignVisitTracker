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
<style>
/* Reset */
* { margin:0; padding:0; box-sizing:border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
body, html { height:100%; }

/* Body background */
body {
    display:flex;
    justify-content:center;
    align-items:center;
    background: url('../assets/images/backGround.avif') no-repeat center center fixed;
    background-size: cover;
    position: relative;
}

/* Overlay for readability */
body::before {
    content:'';
    position:absolute;
    top:0; left:0; right:0; bottom:0;
    background: rgba(0,0,0,0.4); /* dark overlay */
    z-index:0;
}

/* Main container */
.container {
    position: relative;
    z-index:1;
    display:flex;
    max-width: 900px;
    width:90%;
    min-height:500px;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,0.3);
}

/* Left Panel */
.left-panel {
    flex:1;
    padding:40px 20px;
    background: rgba(255,255,255,0.15); /* semi-transparent */
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    color:#fff;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
    border-right: 1px solid rgba(255,255,255,0.2);
}
.left-panel img { width:80px; height:80px; margin-bottom:20px; }
.left-panel h1 { font-size:22px; margin-bottom:10px; font-weight:bold; }
.left-panel h2 { font-size:18px; margin-bottom:8px; font-weight:normal; }
.left-panel h3 { font-size:14px; margin-bottom:15px; font-weight:normal; }
.left-panel p { font-size:13px; margin-top:10px; color:#eee; }

/* Right Panel */
.right-panel {
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:30px;
    background: rgba(255,255,255,0.15); /* semi-transparent */
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-left: 1px solid rgba(255,255,255,0.2);
}

/* Login form container */
/* Title section background */
.login-container .title {
    text-align:center;
    margin-bottom:20px;
    padding:20px;
    border-radius:8px 8px 0 0; /* round top corners */
    background: url('../assets/images/backGround.avif') no-repeat center center;
    background-size: cover;
    position: relative;
    color:#fff;
}

/* Overlay for readability */
.login-container .title::after {
    content:'';
    position:absolute;
    top:0; left:0; right:0; bottom:0;
    background: rgba(0,0,0,0.4); /* dark overlay */
    border-radius:8px 8px 0 0;
    z-index:0;
}

.login-container .title h2,
.login-container .title p {
    position: relative; /* put text above overlay */
    z-index:1;
    margin:0;
}

.login-container .title h2 { font-size:22px; }
.login-container .title p { font-size:14px; color:#ddd; margin-top:5px; }


/* Form styles */
label { font-weight:bold; display:block; margin-bottom:5px; color:#fff; }
.box { 
    width:100%; 
    padding:10px; 
    border-radius:6px; 
    border:1px solid rgba(255,255,255,0.4); 
    margin-bottom:15px; 
    background: rgba(255,255,255,0.1); 
    color:#fff; 
    transition:0.3s;
}
.box:focus { 
    border-color:#66a6ff; 
    box-shadow:0 0 5px rgba(102,166,255,0.5); 
    outline:none; 
    background: rgba(255,255,255,0.15); 
}
.password-wrapper { position: relative; }
.eye-icon { position:absolute; right:10px; top:10px; cursor:pointer; color:#fff; }

/* Submit button */
.submit-btn {
    width:100%; 
    padding:12px;
    font-weight:bold; 
    border:none; 
    border-radius:6px;
    background: linear-gradient(135deg, rgba(102,166,255,0.8), rgba(137,247,254,0.8));
    color:#fff;
    cursor:pointer; 
    transition:0.3s;
}
.submit-btn:hover { 
    background: linear-gradient(135deg, rgba(137,247,254,0.9), rgba(102,166,255,0.9)); 
}

/* Forgot password link */
.forgot-password { text-align:right; font-size:13px; margin-top:5px; }
.forgot-password a { color:#fff; text-decoration:underline; }
.forgot-password a:hover { color:#66a6ff; }

/* Messages */
.message { font-size: 13px; margin-bottom: 15px; padding: 8px; border-radius: 5px; text-align:center; }
.message.danger { background:#ffcccc; color:#cc0000; }
.message.warning { background:#fff3cd; color:#856404; }
.message.success { background:#d4edda; color:#155724; }

/* Responsive */
@media(max-width:800px){
    .container { flex-direction:column; min-height:600px; }
    .left-panel, .right-panel { flex:none; width:100%; padding:30px; }
    .left-panel { order:2; }
    .right-panel { order:1; }
}

</style>
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
