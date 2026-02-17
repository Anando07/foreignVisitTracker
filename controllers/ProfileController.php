<?php
require_once __DIR__ . "/../init.php";
require_once __DIR__ . "/../helpers/ProfileService.php";

$profile = new ProfileService($db);

$userId   = $_SESSION['login_user_id'];
$roleId   = $_SESSION['role_id'];

$user  = $profile->getUserById($userId);
$roles = $profile->getRoles();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $result = $profile->update($userId, $roleId, $_POST);

    if (isset($result['success'])) {
        $_SESSION['msg'] = "✅ ".$result['success'];
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['msg'] = "❌ ".$result['error'];
        $_SESSION['msg_type'] = "error";
    }

    header("Location: base.php?page=profile");
    exit;
}
