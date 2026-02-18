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

}
