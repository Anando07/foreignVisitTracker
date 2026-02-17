<?php
session_start();
require_once "../config.php";

// JSON header
header('Content-Type: application/json');

$userId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$action = isset($_GET['action']) ? $_GET['action'] : 'check';

// Fetch username and full name from Admin table
$stmt = $db->prepare("SELECT UserName, Name FROM Admin WHERE ID = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$result) {
    echo json_encode([
        'canDelete' => false,
        'message' => "User not found.",
        'name' => 'Unknown'
    ]);
    exit;
}

$userName = $result['UserName'];
$fullName = $result['Name'];

// Prevent deleting self
if (!isset($_SESSION['login_user_id']) || $userId == $_SESSION['login_user_id']) {
    echo json_encode([
        'canDelete' => false,
        'message' => "You cannot delete your own account!",
        'name' => $fullName
    ]);
    exit;
}

// Check if user exists in ForeignVisit.Uploader (by ID or username)
$stmt = $db->prepare("SELECT COUNT(*) as cnt FROM ForeignVisit WHERE Uploader = ? OR Uploader = ?");
$stmt->bind_param("is", $userId, $userName);
$stmt->execute();
$resultCheck = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($resultCheck['cnt'] > 0) {
    echo json_encode([
        'canDelete' => false,
        'message' => "Cannot delete user: they are linked to Foreign Visit records.",
        'name' => $fullName
    ]);
    exit;
}

// If action=delete, delete the user
if ($action === 'delete') {
    $stmt = $db->prepare("DELETE FROM Admin WHERE ID = ?");
    $stmt->bind_param("i", $userId);
    $deleted = $stmt->execute();
    $stmt->close();

    if ($deleted) {
        echo json_encode([
            'canDelete' => true,
            'message' => "User deleted successfully.",
            'name' => $fullName
        ]);
    } else {
        echo json_encode([
            'canDelete' => false,
            'message' => "Failed to delete user.",
            'name' => $fullName
        ]);
    }
    exit;
}

// Default: action=check, just return info
echo json_encode([
    'canDelete' => true,
    'message' => "User can be deleted.",
    'name' => $fullName
]);
exit;
?>
