<?php
session_start();
require_once "config.php";

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

/* =========================
   SUCCESS MESSAGE FUNCTION
========================= */
function successBox($title, $message, $link) {
    echo "
    <div style='
        max-width:520px;
        margin:70px auto;
        padding:35px;
        text-align:center;
        border-radius:8px;
        background:#f4fff6;
        border:1px solid #28a745;
        font-family:Arial'>
        
        <img src='assets/images/SuccessIcon.png' width='120'><br><br>
        <h3 style='color:#28a745;'>$title</h3>
        <p>$message</p><br>
        <a href='$link' style='
            padding:10px 25px;
            background:#28a745;
            color:#fff;
            text-decoration:none;
            border-radius:5px;'>Go Back</a>
    </div>";
}

/* =========================
   DELETE RECORD
========================= */
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    $stmt = $db->prepare("SELECT GO FROM ForeignVisit WHERE ID=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    if (!empty($res['GO'])) {
        $file = "uploads/" . $res['GO'];
        if (file_exists($file)) unlink($file);
    }

    $r = $db->query("SELECT RevGO FROM RevisedGO WHERE ID=$id");
    while ($row = $r->fetch_assoc()) {
        $f = "uploads/" . $row['RevGO'];
        if (file_exists($f)) unlink($f);
    }

    $db->query("DELETE FROM RevisedGO WHERE ID=$id");
    $db->query("DELETE FROM ForeignVisit WHERE ID=$id");

    successBox(
        "Deleted Successfully",
        "Foreign visit record and all related files were removed.",
        "base.php?page=ViewVisits"
    );
    exit;
}

/* =========================
   INPUT DATA
========================= */
$update     = isset($_POST['update']) && $_POST['update'] == 1;
$id         = (int)($_POST['id'] ?? 0);
$unreported = isset($_POST['unreported_mode']) && $_POST['unreported_mode'] == 1;

$serviceID   = trim($_POST['serviceID'] ?? '');
$cadre       = trim($_POST['cadreName'] ?? '');
$office      = trim($_POST['office'] ?? '');
$name        = trim($_POST['name'] ?? '');
$designation = trim($_POST['designation'] ?? '');
$grade       = trim($_POST['grade'] ?? '');
$workplace   = trim($_POST['workplace'] ?? '');
$destCountry = trim($_POST['destination_country'] ?? '');
$funding     = trim($_POST['fund'] ?? '');
$purpose     = trim($_POST['purpose'] ?? '');
$startDate   = trim($_POST['from_date'] ?? '');
$endDate     = trim($_POST['to_date'] ?? '');
$actualDep   = trim($_POST['actual_departure'] ?? '');
$actualArr   = trim($_POST['actual_arrival'] ?? '');
$passport    = trim($_POST['passport'] ?? '');
$nid         = trim($_POST['nid'] ?? '');

$passport = $passport === '' ? null : $passport;
$nid      = $nid === '' ? null : $nid;

$uploader = $_SESSION['login_user_id']; 
$editor   = $_SESSION['login_user_id'];

$errors = [];

/* =========================
   MODE BASED VALIDATION
========================= */

// NORMAL MODE
if (!$unreported) {
    if ($serviceID === '' || !ctype_digit($serviceID)) $errors['serviceID'] = "Valid Service ID required.";
    if ($cadre === '') $errors['cadreName'] = "Cadre is required.";
    if ($office === '') $errors['office'] = "Office is required.";
    if ($name === '') $errors['name'] = "Name is required.";
    if ($designation === '') $errors['designation'] = "Designation is required.";
    if ($grade === '') $errors['grade'] = "Grade is required.";
    if ($workplace === '') $errors['workplace'] = "Workplace is required.";
    if ($destCountry === '') $errors['destination_country'] = "Destination country required.";
    if ($funding === '') $errors['fund'] = "Funding source required.";
    if ($purpose === '') $errors['purpose'] = "Purpose is required.";
    if ($startDate === '') $errors['from_date'] = "From date required.";
    if ($endDate === '') $errors['to_date'] = "To date required.";
    $actualDep = null;
    $actualArr = null;

    if (!$update && empty($_FILES['go_file']['name'])) {
        $errors['go_file'] = "GO file is required for normal entry.";
    }
}

// UNREPORTED MODE
if ($unreported) {
    if ($actualDep === '') $errors['actual_departure'] = "Actual Departure is required.";
    if ($actualArr === '') $errors['actual_arrival'] = "Actual Arrival is required.";
}

/* =========================
   DATE CALCULATION
========================= */
$days = 0;
if ($startDate && $endDate) {
    $s = strtotime($startDate);
    $e = strtotime($endDate);
    if ($e < $s) {
        $errors['to_date'] = "End date cannot be before start date.";
    } else {
        $days = (int)(($e - $s) / 86400) + 1;
    }
}

/* =========================
   FILE VALIDATION
========================= */
$fileName = '';

if (!empty($_FILES['go_file']['name'])) {
    $file = $_FILES['go_file'];
    $ext  = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $size = $file['size'];

    if (!in_array($ext, ['pdf','jpg','jpeg'])) {
        $errors['go_file'] = "GO file must be PDF or JPG.";
    }

    if ($size > 512 * 1024) {
        $errors['go_file'] = "GO file must not exceed 512KB.";
    }

    if (empty($errors['go_file'])) {
        $fileName = time() . "_" . basename($file['name']);
        move_uploaded_file($file['tmp_name'], "uploads/" . $fileName);
    }
}


/* =========================
   RETURN ERRORS
========================= */
if (!empty($errors)) {
    echo json_encode(['status'=>'error','errors'=>$errors]);
    exit;
}

/* =========================
   UPDATE / INSERT
========================= */
if ($update || $unreported) {
    // UPDATE NORMAL OR UNREPORTED
    if ($unreported) {
        // Only Actual Dates
        $stmt = $db->prepare("
            UPDATE ForeignVisit SET
            ActualDeparture=?, ActualArrival=?, Editor=?
            WHERE ID=?
        ");
        $stmt->bind_param("ssii", $actualDep, $actualArr, $editor, $id);
    } else {
        // Normal update full record
        $stmt = $db->prepare("
            UPDATE ForeignVisit SET
            ServiceID=?, Cadre=?, Office=?, Name=?, Designation=?, Grade=?, Workplace=?,
            DestinationCountry=?, FundingSource=?, Purpose=?, StartDate=?, EndDate=?,
            Days=?, Passport=?, NID=?, Editor=?
            WHERE ID=?
        ");
        $stmt->bind_param(
            "isssssssssssissii",
            $serviceID, $cadre, $office, $name, $designation, $grade, $workplace,
            $destCountry, $funding, $purpose, $startDate, $endDate,
            $days, $passport, $nid, $editor, $id
        );
    }

    $stmt->execute();

    if ($fileName) {
        $db->query("INSERT INTO RevisedGO (ID, RevGO) VALUES ($id, '$fileName')");
    }

    $redirectPage = $unreported ? "template/base.php?page=UnreportedVisits" : "template/base.php?page=ViewVisits";

    successBox(
        "Update Successful",
        $unreported
            ? "Unreported foreign visit updated successfully."
            : "Foreign visit information updated successfully.",
        $redirectPage
    );
} 
else {
    // INSERT NEW RECORD
    $stmt = $db->prepare("
        INSERT INTO ForeignVisit
        (
            ServiceID, Cadre, Office, Name, Designation, Grade, Workplace,
            DestinationCountry, FundingSource, Purpose,
            StartDate, EndDate, Days, GO, Passport, NID, Uploader
        )
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    ");

    $stmt->bind_param(
        "issssissssssissss",
        $serviceID, $cadre, $office, $name, $designation, $grade, $workplace,
        $destCountry, $funding, $purpose, $startDate, $endDate, $days,
        $fileName, $passport, $nid, $uploader
    );

    $stmt->execute();

    successBox(
        "Entry Successful",
        $unreported
            ? "Unreported foreign visit saved successfully."
            : "Foreign visit entry added successfully.",
        "template/base.php?page=NewEntry"
    );
}

$db->close();
?>
