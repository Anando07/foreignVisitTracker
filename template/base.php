<?php
session_start();
if (!isset($_SESSION['role_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$username       = $_SESSION['login_user'];
$user_fullname  = $_SESSION['user_name'];
$role_name      = $_SESSION['role_name'];
$role_id        = $_SESSION['role_id'];
$designation    = $_SESSION['user_designation'] ?? 'N/A';

// Determine page
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Allowed pages
$allowed_pages = [
    'dashboard', 'home', 'add_user', 'view_users', 'add_visit', 'view_visits',
    'daily_report', 'monthly_report', 'annual_report', 'settings'
];

// If non-admin, default dashboard to home
if (!in_array($role_id, [1,2]) && $page === 'dashboard') {
    $page = 'home';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>FVT - <?= ucfirst($page); ?></title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include("sidebar.php"); ?>
<div class="fvt-main">
    <?php include("header.php"); ?>

    <div class="fvt-content">
        <?php
        // Load dynamic content
        if (in_array($page, $allowed_pages)) {
            $file = $page . ".php";
            if (file_exists($file)) {
                include($file);
            } else {
                echo "<div class='fvt-card'><h3>Page '$page' not found!</h3></div>";
            }
        } else {
            echo "<div class='fvt-card'><h3>Invalid page requested!</h3></div>";
        }
        ?>
    </div>
</div>

<script src="../assets/js/sidebar.js"></script>
</body>
</html>
