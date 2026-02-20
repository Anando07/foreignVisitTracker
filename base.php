<?php
require_once("init.php");
require_once ("repositories/UserRepository.php");
require_once ("repositories/PasswordRepository.php");
require_once ("repositories/ForeignVisitReportRepository.php");
require_once ("services/UserService.php");
require_once ("services/ProfileService.php");
require_once ("services/PasswordService.php");
require_once ("services/ForeignVisitService.php");
require_once ("services/ForeignVisitReportService.php");
/* =========================
   PREVENT BROWSER CACHING
========================= */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

/* =========================
   LOGIN CHECK
========================= */
$auth->checkLogin(); // redirects if not logged in
$auth->checkRole(['Administrator', 'Admin', 'User', 'Visitor', 'Operator']);
/* =========================
   FORCE DASHBOARD AFTER LOGIN
========================= */
$page = $_GET['page'] ?? 'dashboard';
if (!isset($_GET['page'])) {
    header("Location: base.php?page=dashboard");
    exit;
}

/* =========================
   SESSION DATA
========================= */
$userId       = $_SESSION['login_user_id'];
$userFullname = $_SESSION['login_user_name'];
$designation  = $_SESSION['login_user_designation'] ?? 'N/A';
$username     = $_SESSION['login_user'];
$roleId       = (int) $_SESSION['login_role_id'];
$role         = $_SESSION['login_role'];


/* =========================
   PAGE ROUTING
========================= */
$allowed_pages = [
    'dashboard'       => 'dashboard/dashboard.php',
    'self_profile'  => 'dashboard/self_profile.php',
    'self_change_password' => 'dashboard/self_change_password.php',
    'change_password' => 'auth/change_password.php',
    'home'            => 'user/home.php',
    'AddEditUser'     => 'user/AddEditUser.php',
    'Users'           => 'user/Users.php',
    'ForeignVisitEntry'        => 'entries/ForeignVisitEntry.php',
    'ViewVisits'      => 'entries/ViewVisits.php',
    'Report'          => 'reports/Report.php',
    'UnreportedVisits'=> 'reports/UnreportedVisits.php',
    'MaxMinReport'    => 'reports/MaxMinReport.php'
];

$admin_pages = [
    'AddEditUser',
    'Users',
    'ForeignVisitEntry',
    'ViewVisits',
    'Report',
    'UnreportedVisits',
    'MaxMinReport'
];

// Redirect non-admins from admin pages
if(in_array($page, $admin_pages) && $roleId !== 1){
    $page = 'dashboard';
}

$file_to_include = $allowed_pages[$page] ?? null;
$current_page = $page;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>FVT - <?= ucfirst(htmlspecialchars($page)); ?></title>

<link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime('assets/css/style.css'); ?>">
<link rel="stylesheet" href="assets/css/dashboard.css?v=<?= filemtime('assets/css/dashboard.css'); ?>">
<link rel="stylesheet" href="assets/css/user.css?v=<?= filemtime('assets/css/user.css'); ?>">
<link rel="stylesheet" href="assets/css/entry-form.css?v=<?= filemtime('assets/css/entry-form.css'); ?>">
<link rel="stylesheet" href="assets/css/report.css?v=<?= filemtime('assets/css/report.css'); ?>">
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

<?php include("includes/sidebar.php"); ?>

<div class="fvt-main">
    <?php include("includes/header.php"); ?>

    <div class="fvt-content">
        <!-- FLASH MESSAGE -->
        <div style="text-align:center; margin-bottom:15px;">
            <?= $auth->flashMessage(); ?>
        </div>
        <?php
        if ($file_to_include) {
            $full_path = __DIR__ . '/' . $file_to_include;
            if(file_exists($full_path)){
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
<script src="assets/js/sidebar.js?v=<?= filemtime('assets/js/sidebar.js'); ?>"></script>
<script src="assets/js/pagination.js?v=<?= filemtime('assets/js/pagination.js'); ?>"></script>
<script src="assets/js/designation.js?v=<?= filemtime('assets/js/designation.js'); ?>"></script>
<script src="assets/js/verify_password.js?v=<?= filemtime('assets/js/verify_password.js'); ?>"></script>
<script src="assets/js/delete_verify_password.js?v=<?= filemtime('assets/js/delete_verify_password.js'); ?>"></script>

</body>
</html>
