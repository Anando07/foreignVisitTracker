<?php
class PasswordController {
    private $service;
    private $userId;
    private $role;

    public function __construct($db, $userId, $role) {
        $this->service = new PasswordService($db);
        $this->userId  = $userId;
        $this->role    = $role;
    }

    /* ==========================
       SELF PASSWORD CHANGE
       (ALL USERS)
    ========================== */
    public function selfChange() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $result = $this->service->changeWithCurrent(
                $this->userId,
                $_POST['current_password'] ?? '',
                $_POST['password'] ?? '',
                $_POST['confirm'] ?? ''
            );

            if ($result === true) {
                $_SESSION['msg'] = "✅ Password changed successfully!";
                $_SESSION['msg_type'] = "success";
            } else {
                $_SESSION['msg'] = "❌ " . $result;
                $_SESSION['msg_type'] = "error";
            }

            header("Location: base.php?page=self_change_password");
            exit;
        }
    }

    /* ==========================
       ADMIN RESET PASSWORD
       (ADMINISTRATOR ONLY)
    ========================== */
    public function adminReset($targetUserId) {

        if ($this->role !== 'Administrator') {
            $_SESSION['msg'] = "❌ Unauthorized access!";
            $_SESSION['msg_type'] = "error";
            header("Location: base.php?page=dashboard");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $result = $this->service->resetPassword(
                $targetUserId,
                $_POST['password'] ?? '',
                $_POST['confirm'] ?? ''
            );

            if (isset($result['error'])) {
                $_SESSION['msg'] = "❌ " . $result['error'];
                $_SESSION['msg_type'] = "error";
            } else {
                $_SESSION['msg'] = "✅ " . $result['success'];
                $_SESSION['msg_type'] = "success";
            }

            header("Location: base.php?page=change_password&id=$targetUserId");
            exit;
        }
    }
}