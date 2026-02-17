<?php
$service = new PasswordService($db);

$user  = $service->getUserById($userId);
$roles = $service->getRoles();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $result = $service->change(
        $userId,
        $_POST['current_password'] ?? '',
        $_POST['password'] ?? '',
        $_POST['confirm'] ?? ''
    );

    if ($result === true) {
        $_SESSION['msg'] = "✅ Password changed successfully!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['msg'] = "❌ ".$result;
        $_SESSION['msg_type'] = "error";
    }

    header("Location: base.php?page=self_change_password");
    exit;
}
