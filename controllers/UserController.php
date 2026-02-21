<?php

$service = new UserService($db);
// ======================
// ADD / EDIT USER
// ======================
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$isEdit = $id > 0;
$user = $isEdit ? $service->getUserById($id) : null;

$name = $designation = $office = $username = $email = $contact = "";
$status = 1;
$role_id = "";

if ($user){
    $name = $user['Name'];
    $designation = $user['Designation'];
    $office = $user['Office'];
    $username = $user['UserName'];
    $email = $user['Email'];
    $contact = $user['Contact'];
    $status = (int)$user['Status'];
    $role_id = (int)$user['Role_ID'];
}

$roles = $service->getRoles();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $result = $service->saveUser($_POST, $isEdit, $id);

    if (isset($result['error'])){
        $_SESSION['msg'] = "❌ ".$result['error'];
        $_SESSION['msg_type'] = "error";
        header("Location: base.php?page=AddEditUser");
    } else {
        $_SESSION['msg'] = "✅ ".$result['success'];
        $_SESSION['msg_type'] = "success";
        header("Location: base.php?page=AddEditUser");
        exit;
    }

    // Fill back submitted values
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $office = $_POST['office'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $status = (int)$_POST['status'];
    $role_id = (int)$_POST['role_id'];
}
$allUsers = $service->getAllUsers();
?>
