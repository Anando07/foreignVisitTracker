<?php
/* =========================
   AUTHORIZATION
========================= */
$auth->checkLogin();

// Only Administrator, Admin, Operator
if (!in_array((int)$_SESSION['login_role_id'], [1,2,5], true)) {
    $auth->setFlash("Unauthorized access.", "error");
    header("Location: base.php?page=home");
    exit;
}

$service = new ForeignVisitService($db);

/* =========================
   DELETE
========================= */
if (isset($_GET['delete'])) {

    if ((int)$_SESSION['login_role_id'] !== 1) {
        $auth->setFlash("Delete allowed only for Administrator.", "error");
        header("Location: base.php?page=ViewVisits");
        exit;
    }

    try {
        $service->delete((int)$_GET['delete']);
        $auth->setFlash(
            "Foreign visit record deleted successfully.",
            "success"
        );
    } catch (Exception $e) {
        $auth->setFlash($e->getMessage(), "error");
    }

    header("Location: base.php?page=ViewVisits");
    exit;
}

/* =========================
   SAVE (INSERT / UPDATE)
========================= */
$_POST['uploader'] = $_SESSION['login_user_id'];
$_POST['editor']   = $_SESSION['login_user_id'];

$update     = isset($_POST['update']) && $_POST['update'] == 1;
$unreported = isset($_POST['unreported_mode']) && $_POST['unreported_mode'] == 1;

$result = $service->save($_POST, $_FILES, $update, $unreported);

/* =========================
   VALIDATION ERRORS (AJAX)
========================= */
if ($result['status'] === 'error') {
    echo json_encode($result);
    exit;
}

/* =========================
   SUCCESS
========================= */
$auth->setFlash($result['message'], "success");
header("Location: base.php?page=" . $result['redirect']);
exit;
