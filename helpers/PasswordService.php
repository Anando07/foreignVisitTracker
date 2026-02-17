<?php

class PasswordService {
    
    private $userRepo;
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->userRepo = new UserRepository($db);
    }

    /* ======================
       GET USER
    ====================== */
    public function getUserById($userId) {
        return $this->userRepo->getUserById($userId);
    }

    /* ======================
       GET ROLES
    ====================== */
    public function getRoles() {
        return $this->userRepo->getRoles();
    }

    /* ======================
       GET HASH
    ====================== */
    public function getUserPassword($id) {
        $stmt = mysqli_prepare($this->db,
            "SELECT Passcode FROM Admin WHERE ID=?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    }

    /* ======================
       CHANGE PASSWORD
    ====================== */
    public function change($id, $current, $new, $confirm) {

        $user = $this->getUserPassword($id);
        if (!$user) return "User not found!";

        if (!password_verify($current, $user['Passcode']))
            return "Current password is incorrect!";

        if ($new !== $confirm)
            return "Passwords do not match!";

        if (strlen($new) < 8)
            return "Password must be at least 8 characters!";

        if (!preg_match('/[A-Z]/', $new))
            return "Password must include one uppercase letter!";

        if (!preg_match('/[a-z]/', $new))
            return "Password must include one lowercase letter!";

        if (!preg_match('/[0-9]/', $new))
            return "Password must include one number!";

        if (!preg_match('/[@$!%*#?&]/', $new))
            return "Password must include one special character!";

        if (password_verify($new, $user['Passcode']))
            return "New password must be different from current password!";

        $hash = password_hash($new, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($this->db,
            "UPDATE Admin SET Passcode=? WHERE ID=?");
        mysqli_stmt_bind_param($stmt, "si", $hash, $id);
        mysqli_stmt_execute($stmt);

        session_regenerate_id(true);
        return true;
    }
}
