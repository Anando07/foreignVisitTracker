<?php
session_start();
require_once("../config.php");

header('Content-Type: application/json');

if (!isset($_SESSION['login_user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Unauthorized access'
    ]);
    exit;
}

$password = $_POST['password'] ?? '';
$userId   = $_SESSION['login_user_id'];

if (empty($password)) {
    echo json_encode([
        'success' => false,
        'message' => 'Password required'
    ]);
    exit;
}

/* Fetch logged-in user's hashed password */
$stmt = $db->prepare("SELECT Passcode FROM admin WHERE ID = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        'success' => false,
        'message' => 'User not found'
    ]);
    exit;
}

$user = $result->fetch_assoc();

/* Verify password */
if (password_verify($password, $user['Passcode'])) {
    echo json_encode([
        'success' => true
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Incorrect password'
    ]);
}
