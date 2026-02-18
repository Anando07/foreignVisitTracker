<?php
class ProfileService {
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
       UPDATE PROFILE
    ====================== */
    public function update($userId, $currentRole, $data) {

        $name        = mysqli_real_escape_string($this->db, $data['name']);
        $designation = mysqli_real_escape_string($this->db, $data['designation']);
        $contact     = mysqli_real_escape_string($this->db, $data['contact']);

        if ($currentRole == 1) {
            $username = mysqli_real_escape_string($this->db, $data['username']);
            $email    = mysqli_real_escape_string($this->db, $data['email']);
            $role_id  = (int)$data['role_id'];

            $check = mysqli_query($this->db,
                "SELECT ID FROM Admin 
                 WHERE (UserName='$username' OR Email='$email') 
                 AND ID!=$userId"
            );

            if (mysqli_num_rows($check) > 0) {
                return ['error' => 'Username or Email already exists!'];
            }
        }

        $sql = "UPDATE Admin SET 
                Name='$name',
                Designation='$designation',
                Contact='$contact'";

        if ($currentRole == 1) {
            $sql .= ",
                UserName='$username',
                Email='$email',
                Role_ID=$role_id";
        }

        $sql .= " WHERE ID=$userId";
        mysqli_query($this->db, $sql);

        return ['success' => 'Profile updated successfully'];
    }
}
