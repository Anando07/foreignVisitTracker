<?php
class ProfileService {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /* ======================
       GET USER
    ====================== */
    public function getUserById($userId) {
        $res = mysqli_query($this->db, "SELECT * FROM Admin WHERE ID=".(int)$userId);
        return mysqli_fetch_assoc($res);
    }

    /* ======================
       GET ROLES
    ====================== */
    public function getRoles() {
        $roles = [];
        $res = mysqli_query($this->db, "SELECT SL, Role FROM Role ORDER BY SL ASC");
        while ($r = mysqli_fetch_assoc($res)) {
            $roles[$r['SL']] = $r['Role'];
        }
        return $roles;
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
