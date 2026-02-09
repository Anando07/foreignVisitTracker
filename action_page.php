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

    if (!$res) die("Record not found.");

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
        "template/base.php?page=view_visits"
    );
    exit;
}

/* =========================
   GET POST DATA
========================= */
$update = isset($_POST['update']) && $_POST['update'] == 1;
$id     = (int)($_POST['id'] ?? 0);

$serviceID   = (int)($_POST['serviceID'] ?? 0);
$cadre       = $_POST['cadreName'] ?? '';
$office      = $_POST['office'] ?? '';
$name        = $_POST['name'] ?? '';
$designation = $_POST['designation'] ?? '';
$grade       = $_POST['grade'] ?? '';
$workplace   = $_POST['workplace'] ?? '';
$destCountry = $_POST['destination_country'] ?? '';
$funding     = $_POST['fund'] ?? '';
$purpose     = $_POST['purpose'] ?? '';
$startDate   = $_POST['from_date'] ?? '';
$endDate     = $_POST['to_date'] ?? '';
$actualDep   = $_POST['actual_departure'] ?? '';
$actualArr   = $_POST['actual_arrival'] ?? '';
$uploader    = $_SESSION['login_user'] ?? '';

/* =========================
   BASIC VALIDATION
========================= */
if ($serviceID <= 0 || empty($name) || empty($designation) || empty($startDate) || empty($endDate)) {
    die("Required fields missing.");
}

$dateS = strtotime($startDate);
$dateE = strtotime($endDate);
$days  = (int)(($dateE - $dateS) / 86400) + 1;
if ($days <= 0) die("Invalid date range.");

/* =========================
   FILE UPLOAD
========================= */
$fileName = '';
if (!empty($_FILES['go_file']['name'])) {
    $fileName = time() . "_" . basename($_FILES['go_file']['name']);
    if (!move_uploaded_file($_FILES['go_file']['tmp_name'], "uploads/" . $fileName)) {
        die("File upload failed.");
    }
}

/* =========================
   UPDATE
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
        "isssssssssssssssi",
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

/* =========================
   INSERT
========================= */
} else {

    $stmt = $db->prepare("
        INSERT INTO ForeignVisit
        (ServiceID, Cadre, Office, Name, Designation, Grade, Workplace,
        DestinationCountry, FundingSource, Purpose, StartDate, EndDate,
        ActualDeparture, ActualArrival, Days, GO, Uploader)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    ");

    $stmt->bind_param(
        "issssissssssssiss",
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
