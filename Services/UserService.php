<?php
class UserService {
    private $db;
    private $repo;

    public function __construct($db){
        $this->db = $db;
        $this->repo = new UserRepository($db);
    }

    public function getUserById($id){
        return $this->repo->getUserById($id);
    }

    public function getRoles(){
        return $this->repo->getRoles();
    }

    public function getAllUsers(){
        return $this->repo->getAllUsers();
    }

    public function saveUser($data, $isEdit=false, $id=null){
        $name        = mysqli_real_escape_string($this->db, $data['name']);
        $designation = mysqli_real_escape_string($this->db, $data['designation']);
        $office      = mysqli_real_escape_string($this->db, $data['office']);
        $username    = mysqli_real_escape_string($this->db, $data['username']);
        $email       = mysqli_real_escape_string($this->db, $data['email']);
        $contact     = mysqli_real_escape_string($this->db, $data['contact'] ?? '');
        $status      = (int)($data['status']);
        $role_id     = (int)($data['role_id']);

        /* ======================
           UNIQUE USERNAME / EMAIL
        ====================== */
        $allUsers = $this->repo->getAllUsers();
        foreach($allUsers as $u){
            if($isEdit && $u['ID']==$id) continue; // skip current user
            if($u['UserName']==$username || $u['Email']==$email){
                return ['error'=>"Username or Email already exists!"];
            }
        }

        /* ======================
           ADD NEW USER
        ====================== */
        if(!$isEdit){
            $password = $data['password'] ?? '';
            $confirm  = $data['confirm'] ?? '';

            if($password === '' || $confirm === '') return ['error'=>"Password is required!"];
            if($password !== $confirm) return ['error'=>"Passwords do not match!"];
            if(strlen($password)<8) return ['error'=>"Password must be at least 8 characters!"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $this->repo->insertUser(
                $name, $designation, $office, $username, $passwordHash,
                $email, $contact, $status, $role_id
            );
            return ['success'=>'User added successfully!'];

        /* ======================
           EDIT EXISTING USER
        ====================== */
        } else {
            $this->repo->updateUser(
                $id, $name, $designation, $office, $username,
                $email, $contact, $status, $role_id
            );
            return ['success'=>'User updated successfully!'];
        }
    }
}