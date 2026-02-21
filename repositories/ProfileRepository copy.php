<?php
class ProfileRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Get a single user by ID
    public function getUserById(int $id): ?array {
        $stmt = $this->db->prepare("
            SELECT ID, Name, UserName, Email, Role_ID, Designation, Contact, Status
            FROM Admin
            WHERE ID = ? LIMIT 1
        ");
        if (!$stmt) throw new Exception("Prepare failed: " . $this->db->error);

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: null;
    }

    // Get all roles (fixed)
    public function getRoles(): array {
        $roles = [];

        // Use prepare + execute instead of query
        $stmt = $this->db->prepare("SELECT SL, Role FROM Role ORDER BY SL ASC");
        if (!$stmt) throw new Exception("Prepare failed: " . $this->db->error);

        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $roles[(int)$row['SL']] = $row['Role'];
        }

        return $roles;
    }

    // Update user data
    public function updateUser(int $id, array $data, bool $updateSensitive = false): bool {
        $sql = "UPDATE Admin SET Name=?, Designation=?, Contact=?";
        $params = [$data['Name'], $data['Designation'], $data['Contact']];
        $types = "sss";

        if ($updateSensitive) {
            $sql .= ", UserName=?, Email=?, Role_ID=?";
            $types .= "ssi";
            $params = array_merge($params, [$data['UserName'], $data['Email'], $data['Role_ID']]);
        }

        $sql .= " WHERE ID=?";
        $types .= "i";
        $params[] = $id;

        $stmt = $this->db->prepare($sql);
        if (!$stmt) throw new Exception("Prepare failed: " . $this->db->error);

        $stmt->bind_param($types, ...$params);
        return $stmt->execute();
    }

    // Check duplicate username or email
    public function existsUsernameOrEmail(int $id, string $username, string $email): bool {
        $stmt = $this->db->prepare("
            SELECT ID FROM Admin 
            WHERE (UserName=? OR Email=?) AND ID != ? LIMIT 1
        ");
        if (!$stmt) throw new Exception("Prepare failed: " . $this->db->error);

        $stmt->bind_param("ssi", $username, $email, $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}
?>