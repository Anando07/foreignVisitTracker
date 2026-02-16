<?php
session_start();
require_once "config.php";

/* =========================
   AUTHORIZATION
========================= */
if (!isset($_SESSION['role_id'])) {
    header("Location: auth/login.php");
    exit;
}

if (!in_array((int)$_SESSION['role_id'], [1,2,5], true)) {
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
        
        <img src='SuccessIcon.png' width='120'><br><br>
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
   DELETE RECORD + FILES
========================= */
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    // Get main GO file
    $stmt = $db->prepare("SELECT GO FROM ForeignVisit WHERE ID=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    if (!$res) {
        echo json_encode(['status'=>'error','errors'=>['delete'=>'Record not found.']]);
        exit;
    }

    // Delete main GO file
    if (!empty($res['GO'])) {
        $file = "uploads/" . $res['GO'];
        if (file_exists($file)) unlink($file);
    }

    // Delete Revised GO files
    $stmt = $db->prepare("SELECT RevGO FROM RevisedGO WHERE ID=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $r = $stmt->get_result();
    while ($row = $r->fetch_assoc()) {
        $f = "uploads/" . $row['RevGO'];
        if (file_exists($f)) unlink($f);
    }

    // Delete DB records
    $db->query("DELETE FROM RevisedGO WHERE ID=$id");
    $db->query("DELETE FROM ForeignVisit WHERE ID=$id");

    successBox(
        "Deleted Successfully",
        "Record and all related files were removed.",
        "template/base.php?page=ViewVisits"
    );
    exit;
}

/* =========================
   GET POST DATA
========================= */
$update = isset($_POST['update']) && $_POST['update'] == 1;
$id     = (int)($_POST['id'] ?? 0);

$serviceID   = $_POST['serviceID'] ?? '';
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
$uploader    = $_SESSION['login_user_id'] ?? '';

$errors = [];

/* =========================
   REQUIRED FIELD VALIDATION
========================= */
if ($serviceID === '') {
    $errors['serviceID'] = "Service ID is required.";
} elseif (!ctype_digit($serviceID)) {
    $errors['serviceID'] = "Service ID must be a number.";
} else {
    $serviceID = (int)$serviceID; // safe integer
}

if (empty($cadre)) $errors['cadreName'] = "Cadre is required.";
if (empty($office)) $errors['office'] = "Office is required.";
if (empty($name)) $errors['name'] = "Name is required.";
if (empty($designation)) $errors['designation'] = "Designation is required.";
if (empty($grade)) $errors['grade'] = "Grade is required.";
if (empty($workplace)) $errors['workplace'] = "Workplace is required.";
if (empty($destCountry)) $errors['destination_country'] = "Destination Country is required.";
if (empty($funding)) $errors['fund'] = "Funding Source is required.";
if (empty($purpose)) $errors['purpose'] = "Purpose is required.";
if (empty($startDate)) $errors['from_date'] = "From Date is required.";
if (empty($endDate)) $errors['to_date'] = "To Date is required.";

/* =========================
   DATE VALIDATION
========================= */
if ($startDate && $endDate) {
    $dateS = strtotime($startDate);
    $dateE = strtotime($endDate);
    if ($dateE < $dateS) $errors['to_date'] = "End date cannot be before start date.";
    $days = (int)(($dateE - $dateS) / 86400) + 1;
    if ($days <= 0) $errors['to_date'] = "Invalid date range.";
} else {
    $days = 0;
}

/* =========================
   FILE VALIDATION
========================= */
$fileName = '';
$fileRequired = !$update;

if (!empty($_FILES['go_file']['name'])) {
    $file = $_FILES['go_file'];
    $ext  = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $size = $file['size'];

    if (!in_array($ext, ['pdf','jpg','jpeg'])) $errors['go_file'] = "GO file must be PDF or JPG.";
    if ($size > 512*1024) $errors['go_file'] = "GO file must not exceed 512 KB.";

    if (empty($errors['go_file'])) {
        $fileName = time() . "_" . basename($file['name']);
        if (!move_uploaded_file($file['tmp_name'], "uploads/" . $fileName)) {
            $errors['go_file'] = "Failed to upload file.";
        }
    }
} elseif ($fileRequired) {
    $errors['go_file'] = "GO file is required.";
}

/* =========================
   SHOW ERRORS
========================= */
if (!empty($errors)) {
    // return JSON for frontend to display under each field
    echo json_encode(['status'=>'error','errors'=>$errors]);
    exit;
}

/* =========================
   INSERT OR UPDATE DB
========================= */
if ($update) {
    $stmt = $db->prepare("
        UPDATE ForeignVisit SET
        ServiceID=?, Cadre=?, Office=?, Name=?, Designation=?, Grade=?, Workplace=?,
        DestinationCountry=?, FundingSource=?, Purpose=?, StartDate=?, EndDate=?,
        ActualDeparture=?, ActualArrival=?, Days=?, Uploader=?
        WHERE ID=?
    ");
    $stmt->bind_param(
        "issssssssssssssii",
        $serviceID, $cadre, $office, $name, $designation, $grade, $workplace,
        $destCountry, $funding, $purpose, $startDate, $endDate,
        $actualDep, $actualArr, $days, $uploader, $id
    );

    if ($stmt->execute()) {
        if ($fileName) {
            $stmt2 = $db->prepare("INSERT INTO RevisedGO (ID, RevGO) VALUES (?,?)");
            $stmt2->bind_param("is", $id, $fileName);
            $stmt2->execute();
        }
        successBox(
            "Update Successful",
            "Foreign visit information updated successfully.",
            "template/base.php?page=view_visits"
        );
    } else {
         echo $stmt->error;
    }
} else {
    $stmt = $db->prepare("
        INSERT INTO ForeignVisit
        (ServiceID,Cadre,Office,Name,Designation,Grade,Workplace,
        DestinationCountry,FundingSource,Purpose,StartDate,EndDate,
        ActualDeparture,ActualArrival,Days,GO,Uploader)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    ");
    $stmt->bind_param(
        "issssissssssssisi",
        $serviceID, $cadre, $office, $name, $designation, $grade, $workplace,
        $destCountry, $funding, $purpose, $startDate, $endDate,
        $actualDep, $actualArr, $days, $fileName, $uploader
    );

    if ($stmt->execute()) {
        successBox(
            "Entry Successful",
            "New foreign visit record added successfully.",
            "template/base.php?page=NewEntry"
        );
    } else {
        echo $stmt->error;
    }
}

$db->close();
?>
