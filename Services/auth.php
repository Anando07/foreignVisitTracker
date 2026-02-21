<?php
// includes/Auth.php

class Auth {
    private $db;
    private $roles = [];

    public function __construct($db) {
        $this->db = $db;

        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->loadRoles();
    }

    /* =========================
       Load all roles from DB
    ========================= */
    private function loadRoles() {
        $result = $this->db->query("SELECT SL, Role FROM Role");
        if($result) {
            while ($row = $result->fetch_assoc()) {
                $this->roles[(int)$row['SL']] = $row['Role'];
            }
        }
    }

    public function roleName($roleId) {
        return $this->roles[$roleId] ?? null;
    }

    /* =========================
       LOGIN
    ========================= */
    public function login($usernameOrEmail, $password) {
        $stmt = $this->db->prepare("
            SELECT 
                ID, Name, Designation, Email, Contact,
                UserName, Passcode, Role_ID, Status
            FROM Admin
            WHERE UserName = ? OR Email = ? LIMIT 1
        ");

        if(!$stmt) {
            die("Prepare failed: " . $this->db->error);
        }

        $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows !== 1) {
            $this->setMessage("User not found!", "danger");
            return false;
        }

        $user = $result->fetch_assoc();

        if (!password_verify($password, $user['Passcode'])) {
            $this->setMessage("Incorrect password!", "danger");
            return false;
        }

        if ((int)$user['Status'] !== 1) {
            $this->setMessage("Your account is inactive!", "warning");
            return false;
        }

        session_regenerate_id(true);

        $_SESSION['login_user_id']          = (int)$user['ID'];
        $_SESSION['login_user_name']        = $user['Name'];
        $_SESSION['login_user_email']       = $user['Email'];
        $_SESSION['login_user_designation'] = $user['Designation'];
        $_SESSION['login_username']         = $user['UserName'];
        $_SESSION['login_role_id']          = (int)$user['Role_ID'];
        $_SESSION['login_role']             = $this->roleName((int)$user['Role_ID']);

        return true;
    }

    public function logout() {
        session_unset();
        session_destroy();
    }

    public function requireLogin() {
        if(!isset($_SESSION['login_user_id'])){
            $this->setMessage("Please login to access this page.", "warning");
            header("Location: auth/login.php");
            exit();
        }
    }

    public function requireRole($allowedRoleIds = []) {
        $roleId = $_SESSION['login_role_id'] ?? null;

        if(empty($allowedRoleIds)) return;

        if(!$roleId || !in_array($roleId, $allowedRoleIds)) {
            http_response_code(403);
            die("<center><h3>🚫 Access Denied: You do not have permission to view this page.</h3></center>");
        }
    }

    private function setMessage($msg, $type="info") {
        $_SESSION['msg'] = $msg;
        $_SESSION['msg_type'] = $type;
    }

    public function flashMessage() {
        if(isset($_SESSION['msg'])){
            $msg = $_SESSION['msg'];
            $type = $_SESSION['msg_type'] ?? 'info';
            unset($_SESSION['msg'], $_SESSION['msg_type']);
            return "<div class='message {$type}'>{$msg}</div>";
        }
        return '';
    }

    /* =========================
       SESSION GETTERS
    ========================= */
    public function userId(): ?int {
        return $_SESSION['login_user_id'] ?? null;
    }

    public function username(): ?string {
        return $_SESSION['login_username'] ?? null;
    }

    public function role(): ?string {
        return $_SESSION['login_role'] ?? null;
    }

    public function roleId(): ?int {
        return $_SESSION['login_role_id'] ?? null;
    }

    public function fullname(): ?string {
        return $_SESSION['login_user_name'] ?? null;
    }

    public function designation(): ?string {
        return $_SESSION['login_user_designation'] ?? null;
    }

    public function roles(): array {
        return $this->roles;
    }
}