<?php
declare(strict_types=1);
require_once("init.php");
require_once("services/Auth.php");

// Services and Repositories
require_once("repositories/UserRepository.php");
require_once("repositories/ProfileRepository.php");
require_once("repositories/PasswordRepository.php");
require_once("repositories/ForeignVisitReportRepository.php");
require_once("services/UserService.php");
require_once("services/PasswordService.php");
require_once("services/ProfileService.php");
require_once("services/ForeignVisitService.php");
require_once("services/ForeignVisitReportService.php");

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Auth
$auth = new Auth($db);
$auth->requireLogin();

// Routing
$page = $_GET['page'] ?? 'dashboard';

// PAGE -> FILE mapping
$allowed_pages = [
    'dashboard'            => 'dashboard/dashboard.php',
    'self_profile'         => 'profile/self_profile.php',
    'self_change_password' => 'profile/self_change_password.php',
    'change_password'      => 'auth/change_password.php',
    'AddEditUser'          => 'user/AddEditUser.php',
    'Users'                => 'user/Users.php',
    'ForeignVisitEntry'    => 'entries/ForeignVisitEntry.php',
    'ViewVisits'           => 'entries/ViewVisits.php',
    'Report'               => 'reports/Report.php',
    'UnreportedVisits'     => 'reports/UnreportedVisits.php',
    'MaxMinReport'         => 'reports/MaxMinReport.php'
];

// PAGE ACCESS RULES - use Role IDs from DB dynamically 1.Admininstrator, 2.Admin, 3.User, 4.Visitor, 5.Operator
$pageAccess = [
    'dashboard'            => [],
    'self_profile'         => [],
    'self_change_password' => [],
    'AddEditUser'          => [1],
    'Users'                => [1],
    'ForeignVisitEntry'    => [1,5],
    'ViewVisits'           => [1,5],
    'Report'               => [1,2,5],
    'UnreportedVisits'     => [1,2,5],
    'MaxMinReport'         => [1,2,5]
];

// Enforce Access
$allowedRoleIds = $pageAccess[$page] ?? [];
if(!empty($allowedRoleIds)){
    $auth->requireRole($allowedRoleIds);
}

// File to include
$file_to_include = $allowed_pages[$page] ?? null;

// Session Data
$userId       = $auth->userId();
$userFullname = $auth->fullname();
$designation  = $auth->designation() ?? 'N/A';
$username     = $auth->username();
$roleId       = $auth->roleId();
$role         = $auth->role();

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
                <div style="text-align:center; margin-bottom:15px;">
                    <?= $auth->flashMessage(); ?>
                </div>

                <?php
                if($file_to_include){
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
         <script src="assets/js/profile_designation.js?v=<?= filemtime('assets/js/profile_designation.js'); ?>"></script>
        <script src="assets/js/verify_password.js?v=<?= filemtime('assets/js/verify_password.js'); ?>"></script>
        <script src="assets/js/delete_verify_password.js?v=<?= filemtime('assets/js/delete_verify_password.js'); ?>"></script>

    </body>
</html>