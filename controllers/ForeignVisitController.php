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
   DETERMINE MODE
========================= */
$update = false;
$isUnreportedMode = false;
$data = [];

$id = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $update = isset($_POST['update']) && $_POST['update'] == 1;
} else {
    if (!empty($_GET['edit']) || !empty($_GET['id']) || !empty($_GET['unreported'])) {
        $update = true;
        $id = !empty($_GET['unreported']) 
            ? (int)$_GET['unreported'] 
            : (int)($_GET['edit'] ?? $_GET['id']);
        $isUnreportedMode = !empty($_GET['unreported']);
    }
}

/* =========================
   FETCH DATA IF EDIT MODE
========================= */
if ($update && $id) {
    $data = $service->getVisitById($id);
    if (!$data) {
        exit("Record not found");
    }

    // If fetched visit has unreported mode
    if (isset($data['UnreportedMode']) && $data['UnreportedMode'] == 1) {
        $isUnreportedMode = true;
    }
}

/* =========================
   DETERMINE FLAGS
========================= */
$goRequired = !$isUnreportedMode;     // GO file required only in New/Edit
$datesRequired = $isUnreportedMode;   // Actual Departure/Arrival required only in Unreported

/* =========================
   HANDLE POST SUBMISSION
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $service->saveVisit($_POST, $_FILES, $update, $id);

    if (isset($result['error'])) {
        $_SESSION['msg'] = "❌ " . $result['error'];
        $_SESSION['msg_type'] = "error";
        // stay on same page
    } else {
        $_SESSION['msg'] = "✅ " . $result['success'];
        $_SESSION['msg_type'] = "success";

        // Redirect depending on type
        switch ($result['type']) {
            case 'insert': 
                header("Location: base.php?page=ForeignVisitEntry");
                break;
            case 'update':
                header("Location: base.php?page=ViewVisits");
                break;
            case 'unreported_update':
                header("Location: base.php?page=UnreportedVisits");
                break;
        }
        exit;
    }
}

/* =========================
   LIST DATA
========================= */
$allVisits = $service->getAllVisits();
$allUnreportedVisits = $service->getAllUnreportedVisits();
?>