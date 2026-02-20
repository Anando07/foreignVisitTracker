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

    public function getAllUsers(){
        return $this->repo->getAllUsers();
    }

    public function getRoles(){
        return $this->repo->getRoles();
    }

    public function saveUser($data, $isEdit=false, $id=null){
        $name        = mysqli_real_escape_string($this->db, $data['name']);
        $designation = mysqli_real_escape_string($this->db, $data['designation']);
        $username    = mysqli_real_escape_string($this->db, $data['username']);
        $email       = mysqli_real_escape_string($this->db, $data['email']);
        $contact     = mysqli_real_escape_string($this->db, $data['contact']);
        $status      = (int)$data['status'];
        $role_id     = (int)$data['role_id'];

        $allUsers = $this->repo->getAllUsers();
        foreach($allUsers as $u){
            if($isEdit && $u['ID']==$id) continue;
            if($u['UserName']==$username || $u['Email']==$email){
                return ['error'=>"Username or Email already exists!"];
            }
        }

        if(!$isEdit){
            $password = $data['password'] ?? '';
            $confirm  = $data['confirm'] ?? '';
            if($password !== $confirm) return ['error'=>"Passwords do not match!"];
            if(strlen($password)<8) return ['error'=>"Password must be at least 8 characters!"];
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        }

        if($isEdit){
            $stmt = $this->db->prepare("
                UPDATE Admin SET Name=?, Designation=?, UserName=?, Email=?, Contact=?, Status=?, Role_ID=? WHERE ID=?
            ");
            $stmt->bind_param("ssssssii", $name, $designation, $username, $email, $contact, $status, $role_id, $id);
            $stmt->execute();
            return ['success'=>"User updated successfully!"];
        } else {
            $stmt = $this->db->prepare("
                INSERT INTO Admin (Name, Designation, UserName, Passcode, Email, Contact, Status, Role_ID)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->bind_param("ssssssii", $name, $designation, $username, $password_hashed, $email, $contact, $status, $role_id);
            $stmt->execute();
            return ['success'=>"User added successfully!"];
        }
    }
    
}
