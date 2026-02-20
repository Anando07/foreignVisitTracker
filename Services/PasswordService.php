<?php

class PasswordService {

    private $repo;

    public function __construct($db) {
        $this->repo = new PasswordRepository($db);
    }

    /* ==========================
       COMMON PASSWORD RULES
    ========================== */
    private function validate($password, $confirm) {

        if ($password !== $confirm)
            return "Passwords do not match!";

        if (strlen($password) < 8)
            return "Password must be at least 8 characters!";

        if (!preg_match('/[A-Z]/', $password))
            return "Password must include one uppercase letter!";

        if (!preg_match('/[a-z]/', $password))
            return "Password must include one lowercase letter!";

        if (!preg_match('/[0-9]/', $password))
            return "Password must include one number!";

        if (!preg_match('/[@$!%*#?&]/', $password))
            return "Password must include one special character!";

        return true;
    }

    /* ==========================
       SELF PASSWORD CHANGE
    ========================== */
    public function changeWithCurrent($userId, $current, $new, $confirm) {

        $user = $this->repo->getPasswordHash($userId);
        if (!$user)
            return "User not found!";

        if (!password_verify($current, $user['Passcode']))
            return "Current password is incorrect!";

        $valid = $this->validate($new, $confirm);
        if ($valid !== true)
            return $valid;

        if (password_verify($new, $user['Passcode']))
            return "New password must be different from current password!";

        $this->repo->updatePassword($userId, password_hash($new, PASSWORD_DEFAULT));
        session_regenerate_id(true);

        return true;
    }

    /* ==========================
       ADMIN RESET PASSWORD
    ========================== */
    public function resetPassword($userId, $password, $confirm) {

        if ($userId <= 0)
            return ['error' => 'Invalid user'];

        $user = $this->repo->getUserById($userId);
        if (!$user)
            return ['error' => 'User not found'];

        if ($user['Role'] === 'Administrator')
            return ['error' => 'Administrator password cannot be reset'];

        $valid = $this->validate($password, $confirm);
        if ($valid !== true)
            return ['error' => $valid];

        $this->repo->updatePassword($userId, password_hash($password, PASSWORD_DEFAULT));
        return ['success' => 'Password reset successfully'];
    }
}