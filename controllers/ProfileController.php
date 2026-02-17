<?php
$profile = new ProfileService($db);

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
