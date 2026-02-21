<?php
// includes/Auth.php
class Auth {
    private $db;

    public function __construct($db) {
        $this->db = $db;
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Login method
    public function login($usernameOrEmail, $password) {

        $stmt = $this->db->prepare("
            SELECT 
                A.ID,
                A.Name,
                A.Designation,
                A.Email,
                A.Contact,
                A.UserName,
                A.Passcode,
                A.Role_ID,
                A.Status,
                R.Role
            FROM Admin A
            LEFT JOIN Role R ON A.Role_ID = R.SL
            WHERE A.UserName = ? OR A.Email = ?
            LIMIT 1
        ");

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

        // Prevent session fixation
        session_regenerate_id(true);

        // Set session
        $_SESSION['login_user_id']          = $user['ID'];
        $_SESSION['login_user_name']        = $user['Name'];
        $_SESSION['login_user_email']       = $user['Email'];
        $_SESSION['login_user_designation'] = $user['Designation'];
        $_SESSION['login_username']         = $user['UserName'];
        $_SESSION['login_role_id']          = (int)$user['Role_ID'];
        $_SESSION['login_role']             = $user['Role'] ?? '';

        return true;
    }

    // Logout
    public function logout() {
        session_unset();
        session_destroy();
    }

    // Check if user is logged in
    public function checkLogin() {
        if(!isset($_SESSION['login_user_id'])){
            $this->setMessage("Please login to access this page.", "warning");
            header("Location: auth/login.php");
            exit();
        }
    }

    // Role access check
    public function checkRole(array $allowedRoles = []) {
        $userRole = $_SESSION['login_role'] ?? null;

        // If no roles specified, allow all logged-in users
        if (empty($allowedRoles)) return;

        if (!$userRole || !in_array($userRole, $allowedRoles)) {
            die("<center><h3>Access Denied: You do not have permission to view this page.</h3></center>");
        }
    }

    // Flash message setter
    private function setMessage($msg, $type = "info"){
        $_SESSION['msg'] = $msg;
        $_SESSION['msg_type'] = $type;
    }

    // Flash message getter
    public function flashMessage(){
        if(isset($_SESSION['msg'])){
            $msg = $_SESSION['msg'];
            $type = $_SESSION['msg_type'] ?? 'info';
            unset($_SESSION['msg'], $_SESSION['msg_type']);
            return "<div class='message {$type}'>{$msg}</div>";
        }
        return '';
    }
}
?>
