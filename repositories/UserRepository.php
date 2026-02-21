<?php
class UserRepository {

    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    /* ======================
       GET USER BY ID
    ====================== */
    public function getUserById($userId){
        $stmt = $this->db->prepare(
            "SELECT * FROM Admin WHERE ID=?"
        );
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /* ======================
       GET ROLES
    ====================== */
    public function getRoles(){
        $roles = [];
        $stmt = $this->db->prepare(
            "SELECT SL, Role FROM Role ORDER BY SL ASC"
        );
        $stmt->execute();
        $res = $stmt->get_result();

        while($r = $res->fetch_assoc()){
            $roles[$r['SL']] = $r['Role'];
        }
        return $roles;
    }

    /* ======================
       GET ALL USERS
    ====================== */
    public function getAllUsers(){
        $users = [];
        $res = $this->db->query("SELECT * FROM Admin ORDER BY ID ASC");
        while($u = $res->fetch_assoc()){
            $users[] = $u;
        }
        return $users;
    }


    /* ======================
       INSERT USER
    ====================== */
    public function insertUser($name, $designation, $office, $username, $pass,
                               $email, $contact, $status, $role_id){
        $stmt = $this->db->prepare("
            INSERT INTO Admin (Name, Designation, Office, UserName, Passcode, Email, Contact, Status, Role_ID)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("sssssssii", $name, $designation, $office, $username, $pass, $email, $contact, $status, $role_id);
        $stmt->execute();
    }

    /* ======================
       UPDATE USER
    ====================== */
    public function updateUser($id, $name, $designation, $office, $username,
                               $email, $contact, $status, $role_id){
        $stmt = $this->db->prepare("
            UPDATE Admin SET
            Name=?, Designation=?, Office=?, UserName=?, Email=?, Contact=?, Status=?, Role_ID=?
            WHERE ID=?
        ");
        $stmt->bind_param("sssssssii", $name, $designation, $office, $username, $email, $contact, $status, $role_id, $id);
        $stmt->execute();
    }

    /* ==========================
    GET PASSWORD HASH
    ========================== */
    public function getPasswordHash($id) {
        $stmt = $this->db->prepare("SELECT Passcode FROM Admin WHERE ID=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /* ==========================
    UPDATE PASSWORD
    ========================== */
    public function updatePassword($id, $hash) {
        $stmt = $this->db->prepare("UPDATE Admin SET Passcode=? WHERE ID=?");
        $stmt->bind_param("si", $hash, $id);
        return $stmt->execute();
    }  

}
