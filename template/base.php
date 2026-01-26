<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['role_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

// User info from session
$username       = $_SESSION['login_user'];
$user_fullname  = $_SESSION['user_name'];
$role_name      = $_SESSION['role_name'];
$role_id        = $_SESSION['role_id'];
$designation    = $_SESSION['user_designation'] ?? 'N/A';

// Determine requested page
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Map pages to actual file paths (relative to template/)
$allowed_pages = [
    'dashboard'      => '../admin/dashboard.php',
    'home'           => '../home.php',
    'add_user'       => '../admin/add_user.php',
    'users'     => '../admin/users.php',
    'add_visit'      => '../admin/add_visit.php',
    'view_visits'    => '../admin/view_visits.php',
    'daily_report'   => '../admin/daily_report.php',
    'monthly_report' => '../admin/monthly_report.php',
    'annual_report'  => '../admin/annual_report.php',
    'settings'       => '../admin/settings.php'
];

// Admin-only pages
$admin_pages = ['dashboard','add_user','users','add_visit','view_visits','daily_report','monthly_report','annual_report','settings'];

// Redirect non-admins trying to access admin pages
if (!in_array($role_id, [1,2]) && in_array($page, $admin_pages)) {
    $page = 'home';
}

// Get the actual file to include
$file_to_include = $allowed_pages[$page] ?? null;

// Current page for sidebar highlighting
$current_page = $page;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>FVT - <?= ucfirst($page); ?></title>
<link rel="stylesheet" href="../assets/css/style.css">


<style>
    /* Example sidebar active link style */
    .sidebar a.active {
        background-color: #007bff;
        color: #fff;
        padding: 5px 10px;
        border-radius: 4px;
    }
</style>
</head>
<body>

<?php include("sidebar.php"); ?>
<div class="fvt-main">
    <?php include("header.php"); ?>

    <div class="fvt-content">
        <?php
        if ($file_to_include) {
            $full_path = __DIR__ . '/' . $file_to_include;
            if (file_exists($full_path)) {
                include($full_path);
            } else {
                echo "<div class='fvt-card'><h3>File '{$file_to_include}' not found!</h3></div>";
            }
        } else {
            echo "<div class='fvt-card'><h3>Invalid page requested!</h3></div>";
        }
        ?>
    </div>
</div>

<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/pagination.js"></script>
</body>
</html>
