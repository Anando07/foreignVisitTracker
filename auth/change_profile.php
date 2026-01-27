<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include("../config.php");

/* ==========================
   CHECK LOGIN
========================== */
$loggedUserId   = $_SESSION['login_user_id'] ?? 0;
$loggedUserRole = $_SESSION['role_id'] ?? 0; 

if ($loggedUserId == 0) {
    header("Location: login.php");
    exit;
}

/* ==========================
   FETCH ROLES
========================== */
$roles = [];
$rq = mysqli_query($db, "SELECT SL, Role FROM Role ORDER BY SL ASC");
while ($r = mysqli_fetch_assoc($rq)) {
    $roles[$r['SL']] = $r['Role'];
}

/* ==========================
   FETCH USER DATA
========================== */
$res = mysqli_query($db, "SELECT * FROM Admin WHERE ID=$loggedUserId");
$user = mysqli_fetch_assoc($res);

$name        = $user['Name'];
$designation = $user['Designation'];
$username    = $user['UserName'];
$email       = $user['Email'];
$contact     = $user['Contact'];
$status      = (int)$user['Status'];
$role_id     = (int)$user['Role_ID'];

/* ==========================
   HANDLE FORM SUBMIT
   POST → Redirect → GET
========================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name        = mysqli_real_escape_string($db, $_POST['name']);
    $designation = mysqli_real_escape_string($db, $_POST['designation']);
    $contact     = mysqli_real_escape_string($db, $_POST['contact']);

    $error = "";

    if ($loggedUserRole == 1) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email    = mysqli_real_escape_string($db, $_POST['email']);
        $role_id  = (int)$_POST['role_id'];

        // Check username/email uniqueness
        $check = mysqli_query($db, "SELECT ID FROM Admin WHERE (UserName='$username' OR Email='$email') AND ID!=$loggedUserId");
        if (mysqli_num_rows($check) > 0) {
            $error = "Username or Email already exists!";
        }
    }

    if ($error === "") {
        $updateSql = "UPDATE Admin SET 
            Name='$name',
            Designation='$designation',
            Contact='$contact'";

        if ($loggedUserRole == 1) {
            $updateSql .= ",
                UserName='$username',
                Email='$email',
                Role_ID=$role_id";
        }

        $updateSql .= " WHERE ID=$loggedUserId";
        mysqli_query($db, $updateSql);

        $_SESSION['msg'] = "✅ Profile updated successfully!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['msg'] = "❌ $error";
        $_SESSION['msg_type'] = "error";
    }

    // Redirect to prevent form resubmission and reset input fields
    header("Location: base.php?page=change_profile");
    exit();
}
?>

<style>
.user-card{
    max-width:700px;
    margin:40px auto;
    background:#fff;
    padding:25px;
    border-radius:12px;
    box-shadow:0 12px 30px rgba(0,0,0,.1);
}
.user-card-header{
    font-size:22px;
    font-weight:700;
    margin-bottom:20px;
    text-align:center;
}
.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
}
.form-group{
    display:flex;
    flex-direction:column;
}
.form-group label{
    font-weight:600;
    margin-bottom:6px;
}
.fvt-input{
    width:100%;
    padding:10px;
    border-radius:6px;
    border:1px solid #ccc;
}
.fvt-input:focus{
    border-color:#007bff;
    outline:none;
}
.fvt-input[readonly]{
    background:#e9ecef;
    cursor:not-allowed;
    color:#495057;
}
.actions{
    display:flex;
    justify-content:center;
    gap:10px;
    margin-top:25px;
}
.btn{
    padding:10px 20px;
    border-radius:6px;
    font-weight:600;
    border:none;
    cursor:pointer;
}
.btn-success{
    background:#28a745;
    color:#fff;
}
.alert{
    padding:10px;
    border-radius:6px;
    margin-bottom:20px;
    text-align:center;
}
@media(max-width:768px){
    .form-grid{grid-template-columns:1fr;}
}
</style>

<div class="user-card">

    <div class="user-card-header">👤 Update Profile</div>

    <?php if(isset($_SESSION['msg'])): ?>
    <div class="alert" style="background: <?= $_SESSION['msg_type']=='success'?'#d1fae5':'#fee2e2' ?>; color: <?= $_SESSION['msg_type']=='success'?'#065f46':'#b91c1c' ?>;">
        <?= $_SESSION['msg']; unset($_SESSION['msg'], $_SESSION['msg_type']); ?>
    </div>
    <?php endif; ?>

    <form method="post">
        <div class="form-grid">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required class="fvt-input" value="<?= htmlspecialchars($name) ?>">
            </div>

            <div class="form-group">
                <label>Designation</label>
                <select name="designation" required class="fvt-input">
                    <?php
                    $designations = [
                        'Senior Secretary','Secretary','Additional Secretary','Joint Secretary',
                        'Deputy Secretary','Senior Assistant Secretary','Assistant Secretary',
                        'Senior System Analyst','System Analyst','Programmer',
                        'Assistant Programmer','Assistant Maintenance Engineer','Computer Operator'
                    ];
                    foreach($designations as $d):
                    ?>
                    <option value="<?= $d ?>" <?= $designation==$d?'selected':'' ?>><?= $d ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Contact</label>
                <input type="text" name="contact" class="fvt-input" value="<?= htmlspecialchars($contact) ?>">
            </div>

            <?php if($loggedUserRole==1): ?>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="fvt-input" value="<?= htmlspecialchars($username) ?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="fvt-input" value="<?= htmlspecialchars($email) ?>">
            </div>

            <div class="form-group">
                <label>Role</label>
                <select name="role_id" class="fvt-input">
                    <?php foreach($roles as $sl => $rname): ?>
                    <option value="<?= $sl ?>" <?= $role_id==$sl?'selected':'' ?>><?= $rname ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php else: ?>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="fvt-input" value="<?= htmlspecialchars($username) ?>" readonly>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="fvt-input" value="<?= htmlspecialchars($email) ?>" readonly>
            </div>

            <div class="form-group">
                <label>Role</label>
                <input type="text" class="fvt-input" value="<?= $roles[$role_id]??'' ?>" readonly>
            </div>
            <?php endif; ?>

            <div class="form-group">
                <label>Status</label>
                <input type="text" class="fvt-input" value="<?= $status==1?'Active':'Inactive' ?>" readonly>
            </div>

        </div>

        <div class="actions">
            <button class="btn btn-success">Update Profile</button>
        </div>
    </form>
</div>
