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

    public function canDeleteUser($userId, $currentUserId){
        $user = $this->getUserById($userId);
        if(!$user) return ['canDelete'=>false,'message'=>"User not found.", 'name'=>'Unknown'];
        if($userId==$currentUserId) return ['canDelete'=>false,'message'=>"You cannot delete your own account!", 'name'=>$user['Name']];

        $stmt = $this->db->prepare("SELECT COUNT(*) as cnt FROM ForeignVisit WHERE Uploader=? OR Uploader=?");
        $stmt->bind_param("is", $userId, $user['UserName']);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if($res['cnt']>0) return ['canDelete'=>false,'message'=>"Cannot delete user: linked to Foreign Visit records.", 'name'=>$user['Name']];

        return ['canDelete'=>true,'message'=>"User can be deleted.", 'name'=>$user['Name']];
    }

    public function deleteUserWithCheck($userId, $currentUserId){
        $check = $this->canDeleteUser($userId, $currentUserId);
        if(!$check['canDelete']) return $check;
        return $this->repo->deleteUser($userId) ? ['canDelete'=>true,'message'=>"User deleted successfully.",'name'=>$check['name']] : ['canDelete'=>false,'message'=>"Failed to delete user.",'name'=>$check['name']];
    }
}
