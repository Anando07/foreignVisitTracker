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
        $usernameOrEmail = $this->db->real_escape_string($usernameOrEmail);

        $sql = "SELECT * FROM Admin WHERE UserName='$usernameOrEmail' OR Email='$usernameOrEmail'";
        $result = $this->db->query($sql);

        if($result && $result->num_rows === 1){
            $user = $result->fetch_assoc();

            if(!password_verify($password, $user['Passcode'])){
                $this->setMessage("Incorrect password!.", "danger");
                return false;
            } elseif($user['Status'] != 1){
                $this->setMessage("Your account is inactive!.", "warning");
                return false;
            } else {
                // Get role name
                $roleRes = $this->db->query("SELECT Role AS role_name FROM Role WHERE SL=".$user['Role_ID']);
                $role = $roleRes->fetch_assoc();

                $_SESSION['login_user_id']    = $user['ID'];
                $_SESSION['login_user']       = $user['UserName'];
                $_SESSION['user_name']        = $user['Name'];
                $_SESSION['user_designation'] = $user['Designation'];
                $_SESSION['role_id']          = $user['Role_ID'];
                $_SESSION['role_name']        = $role['role_name'] ?? '';

                return true;
            }
        } else {
            $this->setMessage("User not found!.", "danger");
            return false;
        }
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
    public function checkRole(array $allowedRoles) {
        if(!isset($_SESSION['role_id']) || !in_array($_SESSION['role_id'], $allowedRoles)){
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
