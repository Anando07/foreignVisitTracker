<?php
class ProfileService {
    private $repo;
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->repo = new ProfileRepository($db);
    }

    /* ======================
       GET USER
    ====================== */
    public function getUserById($userId) {
        return $this->repo->getUserById($userId);
    }

    /* ======================
       GET ROLES
    ====================== */
    public function getRoles() {
        return $this->repo->getRoles();
    }

    /* ======================
       UPDATE PROFILE
    ====================== */
    public function update(int $userId, int $currentRole, array $data): array {
        $updateSensitive = $currentRole === 1; // Admin can update sensitive fields

        // Prepare data
        $updateData = [
            'Name'        => $data['name'],
            'Designation' => $data['designation'],
            'Office' => $data['office'],
            'Contact'     => $data['contact']
        ];

        if ($updateSensitive) {
            // Check duplicate username/email
            if ($this->repo->existsUsernameOrEmail($userId, $data['username'], $data['email'])) {
                return ['error' => 'Username or Email already exists!'];
            }

            $updateData['UserName'] = $data['username'];
            $updateData['Email']    = $data['email'];
            $updateData['Role_ID']  = (int)$data['role_id'];
        }

        $success = $this->repo->updateUserProfile($userId, $updateData, $updateSensitive);

        return $success
            ? ['success' => 'Profile updated successfully']
            : ['error' => 'Failed to update profile'];
    }

}
