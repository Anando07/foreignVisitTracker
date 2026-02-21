<?php
class ProfileRepository {
    private $db;

    public function __construct( $db) {
        $this->db = $db;
    }

    // Get a user by ID
    public function getUserById(int $id): ?array {
        $stmt = $this->db->prepare("
            SELECT ID, Name, UserName, Email, Role_ID, Designation, Office, Contact, Status
            FROM Admin
            WHERE ID = ? LIMIT 1
        ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: null;
    }

    // Get all roles
    public function getRoles(): array {
        $result = $this->db->query("SELECT SL, Role FROM Role ORDER BY SL ASC");
        $roles = [];
        if($result){
            while($row = $result->fetch_assoc()){
                $roles[(int)$row['SL']] = $row['Role'];
            }
        }
        return $roles;
    }

    // Update user
    // Update user profile in DB
    public function updateUserProfile(int $userId, array $data, bool $updateSensitive = false): bool {
        // Prepare base query
        $sql = "UPDATE Admin SET Name=?, Designation=?, Office=?, Contact=?";
        $params = [$data['Name'], $data['Designation'], $data['Office'], $data['Contact']];
        $types = "ssss";

        // Add sensitive fields if admin
        if ($updateSensitive) {
            $sql .= ", UserName=?, Email=?, Role_ID=?";
            $params = array_merge($params, [$data['UserName'], $data['Email'], (int)$data['Role_ID']]);
            $types .= "ssi";
        }

        $sql .= " WHERE ID=?";
        $params[] = $userId;
        $types .= "i";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) throw new Exception("Prepare failed: " . $this->db->error);

        $stmt->bind_param($types, ...$params);
        return $stmt->execute();
    }

    // Check duplicate username/email
    public function existsUsernameOrEmail(int $userId, string $username, string $email): bool {
        $stmt = $this->db->prepare("
            SELECT ID FROM Admin 
            WHERE (UserName=? OR Email=?) AND ID != ? LIMIT 1
        ");
        if (!$stmt) throw new Exception("Prepare failed: " . $this->db->error);

        $stmt->bind_param("ssi", $username, $email, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

}
?>