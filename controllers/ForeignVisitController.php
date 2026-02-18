<?php
/* =========================
   AUTHORIZATION
========================= */
if (!isset($_SESSION['login_role_id'])) {
    header("Location: auth/login.php");
    exit;
}

if (!in_array((int)$_SESSION['login_role_id'], [1,2,5], true)) {
    die("Unauthorized access.");
}

$service = new ForeignVisitService($db);

/* =========================
   DETERMINE MODE (GET / POST)
========================= */
$id = 0;
$isEdit = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id     = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $isEdit = isset($_POST['update']) && $_POST['update'] == 1;
} else {
    if (!empty($_GET['edit']) || !empty($_GET['id']) || !empty($_GET['unreported'])) {
        $id = !empty($_GET['unreported'])
            ? (int)$_GET['unreported']
            : (int)($_GET['edit'] ?? $_GET['id']);
        $isEdit = true;
    }
}

/* =========================
   FETCH VISIT (EDIT MODE)
========================= */
$visit = $isEdit ? $service->getVisitById($id) : null;

$isUnreportedMode = $visit['UnreportedMode'] ?? 0;

/* =========================
   HANDLE POST
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $result = $service->saveVisit($_POST, $_FILES, $isEdit, $id);

    if (isset($result['error'])) {
        $_SESSION['msg'] = "❌ " . $result['error'];
        $_SESSION['msg_type'] = "error";
    } else {
        $_SESSION['msg'] = "✅ " . $result['success'];
        $_SESSION['msg_type'] = "success";
        header("Location: base.php?page=ForeignVisitEntry");
        exit;
    }
}

/* =========================
   LIST DATA
========================= */
$allVisits = $service->getAllVisits();
$allUnreportedVisits = $service->getAllUnreportedVisits();
?>