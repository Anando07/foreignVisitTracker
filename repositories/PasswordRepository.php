<?php
class PasswordRepository {

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

    /* ==========================
    GET PASSWORD HASH
    ========================== */
    public function getCurrentHashPassword($id) {
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
