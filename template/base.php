<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
/* =========================
   PREVENT BROWSER CACHING
   (SESSION SAFE)
========================= */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

require_once("../config.php");

/* =========================
   AUTH CHECK
========================= */
if (!isset($_SESSION['role_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

/* =========================
   FORCE DASHBOARD AFTER LOGIN
========================= */
if (!isset($_GET['page'])) {
    header("Location: base.php?page=dashboard");
    exit;
}

/* =========================
   SESSION DATA
========================= */
$user_id       = $_SESSION['login_user_id'];
$username      = $_SESSION['login_user'];
$user_fullname = $_SESSION['user_name'];
$role_name     = $_SESSION['role_name'];
$role_id       = (int) $_SESSION['role_id'];
$designation   = $_SESSION['user_designation'] ?? 'N/A';

/* =========================
   PAGE ROUTING
========================= */
$page = $_GET['page'] ?? 'dashboard';

/* =========================
   ALLOWED PAGES
========================= */
$allowed_pages = [
    'dashboard'       => '../admin/dashboard.php',
    'home'            => '../user/home.php',
    'add_user'        => '../admin/add_user.php',
    'change_password' => '../admin/change_password.php',
    'password_change' => '../auth/password_change.php',
    'change_profile'  => '../auth/change_profile.php',
    'users'           => '../admin/users.php',
    'NewEntry'        => '../NewEntry.php',
    'ShowDashboard'   => '../ShowDashboard.php',
    'add_visit'       => '../admin/add_visit.php',
    'ViewVisits'      => '../ViewVisits.php',
    'Report'          => '../Report.php',
    'UnreportedVisits' => '../UnreportedVisits.php',
    'MaxMinReport'    => '../MaxMinReport.php',
    'settings'        => '../admin/settings.php'
];

/* =========================
   ADMIN ONLY PAGES
========================= */
$admin_pages = [
    'dashboard',
    'add_user',
    'users',
    'add_visit',
    'ViewVisits',
    'settings'
];

/* =========================
   ROLE VALIDATION
========================= */
// Redirect non-admins trying to access admin pages
if (in_array($page, $admin_pages) && !in_array($role_id, [1])) {
    $page = 'dashboard'; // default dashboard for other roles
}

/* =========================
   FINAL FILE
========================= */
$file_to_include = $allowed_pages[$page] ?? null;
$current_page    = $page;

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>FVT - <?= ucfirst(htmlspecialchars($page)); ?></title>

<link rel="stylesheet" href="../assets/css/style.css?v=<?= filemtime('../assets/css/style.css'); ?>">
<link rel="stylesheet" href="../assets/css/entry-form.css?v=<?= filemtime('../assets/css/entry-form.css'); ?>">
<style>
/* Active sidebar link */
.sidebar a.active {
    background-color: #007bff;
    color: #fff;
    padding: 6px 10px;
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
                include $full_path;
            } else {
                echo "<div class='fvt-card'><h3>Page file not found!</h3></div>";
            }
        } else {
            echo "<div class='fvt-card'><h3>Invalid page request!</h3></div>";
        }
        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../assets/js/sidebar.js?v=<?= filemtime('../assets/js/sidebar.js'); ?>"></script>
<script src="../assets/js/pagination.js?v=<?= filemtime('../assets/js/pagination.js'); ?>"></script>
<script src="../assets/js/designation.js?v=<?= filemtime('../assets/js/designation.js'); ?>"></script>
<script src="../assets/js/verify_password.js?v=<?= filemtime('../assets/js/verify_password.js'); ?>"></script>
<script src="../assets/js/delete_verify_password.js?v=<?= filemtime('../assets/js/delete_verify_password.js'); ?>"></script>
<script src="../assets/js/datalist.js?v=<?= filemtime('../assets/js/datalist.js'); ?>"></script>
</body>
</html>
