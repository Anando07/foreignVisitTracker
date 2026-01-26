<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include("../config.php");

/* ==========================
   FETCH ROLES
========================== */
$roles = [];
$rq = mysqli_query($db, "SELECT SL, Role FROM Role ORDER BY SL ASC");
while ($r = mysqli_fetch_assoc($rq)) {
    $roles[] = $r;
}

/* ==========================
   CHECK EDIT MODE
========================== */
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$isEdit = false;

$name = $designation = $username = $email = $contact = "";
$status = 1;
$role_id = "";

if ($id > 0) {
    $isEdit = true;
    $res = mysqli_query($db, "SELECT * FROM Admin WHERE ID=$id");
    $user = mysqli_fetch_assoc($res);

    if ($user) {
        $name        = $user['Name'];
        $designation = $user['Designation'];
        $username    = $user['UserName'];
        $email       = $user['Email'];
        $contact     = $user['Contact'];
        $status      = (int)$user['Status'];
        $role_id     = (int)$user['Role_ID'];
    }
}

/* ==========================
   FORM SUBMIT
========================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name        = mysqli_real_escape_string($db, $_POST['name']);
    $designation = mysqli_real_escape_string($db, $_POST['designation']);
    $username    = mysqli_real_escape_string($db, $_POST['username']);
    $email       = mysqli_real_escape_string($db, $_POST['email']);
    $contact     = mysqli_real_escape_string($db, $_POST['contact']);
    $status      = (int)$_POST['status'];
    $role_id     = (int)$_POST['role_id'];

    $error = "";

    // ==========================
    // CHECK UNIQUE USERNAME / EMAIL
    // ==========================
    if ($isEdit) {
        $check = mysqli_query($db, "SELECT ID FROM Admin WHERE (UserName='$username' OR Email='$email') AND ID!=$id");
    } else {
        $check = mysqli_query($db, "SELECT ID FROM Admin WHERE UserName='$username' OR Email='$email'");
    }

    if (mysqli_num_rows($check) > 0) {
        $error = "Username or Email already exists!";
    }

    // ==========================
    // PASSWORD VALIDATION (only for new user)
    // ==========================
    if (!$isEdit) {
        $password = $_POST['password'] ?? '';
        $confirm  = $_POST['confirm'] ?? '';

        if ($password !== $confirm) {
            $error = "Passwords do not match!";
        } elseif (strlen($password) < 8) {
            $error = "Password must be at least 8 characters!";
        }
    }

    // ==========================
    // IF NO ERROR, INSERT / UPDATE
    // ==========================
    if ($error === "") {

        if ($isEdit) {

            mysqli_query($db, "
                UPDATE Admin SET
                    Name='$name',
                    Designation='$designation',
                    UserName='$username',
                    Email='$email',
                    Contact='$contact',
                    Status=$status,
                    Role_ID=$role_id
                WHERE ID=$id
            ");

            $_SESSION['msg'] = "✅ User updated successfully!";
            $_SESSION['msg_type'] = "success";

        } else {

            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            mysqli_query($db, "
                INSERT INTO Admin
                (Name, Designation, UserName, Passcode, Email, Contact, Status, Role_ID)
                VALUES
                ('$name','$designation','$username','$password_hashed','$email','$contact',$status,$role_id)
            ");

            $_SESSION['msg'] = "✅ User added successfully!";
            $_SESSION['msg_type'] = "success";
        }

        header("Location: base.php?page=add_user");
        exit;

    } else {
        $_SESSION['msg'] = "❌ $error";
        $_SESSION['msg_type'] = "error";
    }
}
?>

<style>
.user-card{
    max-width:900px;
    margin:30px auto;
    background:#fff;
    padding:25px;
    border-radius:12px;
    box-shadow:0 12px 30px rgba(0,0,0,.1);
}
.user-card-header{
    font-size:20px;
    font-weight:700;
    margin-bottom:15px;
}
.form-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:15px;
}
.form-group{
    display:flex;
    flex-direction:column;
    position:relative;
}
.form-group label{
    font-weight:600;
    margin-bottom:6px;
}
.fvt-input{
    width: 100%;
    padding:11px;
    border-radius:6px;
    border:1px solid #ccc;
}
.fvt-input:focus{
    border-color:#007bff;
    outline:none;
}
.actions{
    display:flex;
    justify-content:center; /* Center buttons */
    gap:10px;
    margin-top:20px;
}
.btn{
    padding:10px 18px;
    border-radius:6px;
    font-weight:600;
    border:none;
    cursor:pointer;
}
.btn-success{
    background:#28a745;
    color:#fff;
}
.btn-secondary{
    background:#6c757d;
    color:#fff;
    text-decoration:none;
}
.alert{
    background:#e6fffa;
    color:#065f46;
    padding:10px;
    border-radius:6px;
    margin-bottom:15px;
}
.badge{
    padding:3px 8px;
    border-radius:4px;
    font-size:12px;
}
.badge-weak{
    background:#f87171;
    color:#fff;
}
.badge-medium{
    background:#facc15;
    color:#000;
}
.badge-strong{
    background:#4ade80;
    color:#000;
}
/* Password eye icon inside input */
.password-wrapper {
    position: relative;
}

.password-wrapper input {
    width: 100%;
    padding-right: 40px; /* space for the eye icon inside */
    box-sizing: border-box;
}

.password-wrapper .toggle-password {
    position: absolute;
    right: 10px;          /* distance from the input's right inner edge */
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    user-select: none;
    font-size: 16px;
    z-index: 2;
}

@media(max-width:768px){
    .form-grid{
        grid-template-columns:1fr;
    }
}
</style>

<div class="user-card">

    <div class="user-card-header">
    <?= $isEdit ? "✏️ Edit User" : "➕ Add New User" ?>
    </div>

    <?php if(isset($_SESSION['msg'])): ?>
    <div class="alert" style="background: <?= $_SESSION['msg_type']=='success'?'#d1fae5':'#fee2e2' ?>; color: <?= $_SESSION['msg_type']=='success'?'#065f46':'#b91c1c' ?>;">
        <?= $_SESSION['msg']; unset($_SESSION['msg'], $_SESSION['msg_type']); ?>
    </div>
    <?php endif; ?>

    <form method="post">
        <div class="form-grid">

            <!-- Full Name -->
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required class="fvt-input" value="<?= htmlspecialchars($name) ?>">
            </div>

            <!-- Designation -->
            <div class="form-group">
                <label>Designation</label>
                <select name="designation" required class="fvt-input">
                    <option value="">Select Designation</option>
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

            <!-- Username -->
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required class="fvt-input" value="<?= htmlspecialchars($username) ?>">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required class="fvt-input" value="<?= htmlspecialchars($email) ?>">
            </div>

            <!-- Contact -->
            <div class="form-group">
                <label>Contact</label>
                <input type="text" name="contact" class="fvt-input" value="<?= htmlspecialchars($contact) ?>">
            </div>

            <!-- Role -->
            <div class="form-group">
                <label>Role</label>
                <select name="role_id" required class="fvt-input">
                    <option value="">Select Role</option>
                    <?php foreach($roles as $r): ?>
                    <option value="<?= $r['SL'] ?>" <?= $role_id==$r['SL']?'selected':'' ?>>
                    <?= $r['Role'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="fvt-input">
                    <option value="1" <?= $status==1?'selected':'' ?>>Active</option>
                    <option value="0" <?= $status==0?'selected':'' ?>>Inactive</option>
                </select>
            </div>
            <?php if(!$isEdit): ?>
            <!-- Password -->
            <div class="form-group password-wrapper">
                <label>Password</label>
                <input type="password" name="password" id="password" required class="fvt-input">
                <span toggle="#password" class="toggle-password">👁️</span>
                <small id="strength"></small>
            </div>

            <!-- Confirm Password -->
            <div class="form-group password-wrapper">
                <label>Confirm Password</label>
                <input type="password" name="confirm" id="confirm" required class="fvt-input">
                <span toggle="#confirm" class="toggle-password">👁️</span>
                <small id="match"></small>
            </div>
            <?php endif; ?>


        </div>

        <!-- Buttons Centered -->
        <div class="actions">
            <a href="base.php?page=users" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-success"><?= $isEdit?'Update User':'Save User' ?></button>
        </div>

    </form>
</div>

<script>
// Password strength
const pwd = document.getElementById('password');
const cp  = document.getElementById('confirm');

pwd?.addEventListener('input', () => {
    let s = 0, v = pwd.value;
    if(v.length>=8) s++;
    if(/[A-Z]/.test(v)) s++;
    if(/[0-9]/.test(v)) s++;
    if(/[@$!%*#?&]/.test(v)) s++;

    let text='Weak', cls='badge-weak';
    if(s==2){text='Medium'; cls='badge-medium'}
    if(s>=3){text='Strong'; cls='badge-strong'}

    document.getElementById('strength').innerHTML = `<span class="badge ${cls}">${text}</span>`;
});

// Password match
cp?.addEventListener('input', () => {
    document.getElementById('match').innerHTML =
        pwd.value === cp.value
        ? '<span class="badge badge-strong">Matched</span>'
        : '<span class="badge badge-weak">Not Matched</span>';
});

// Toggle password
document.querySelectorAll('.toggle-password').forEach(el => {
    el.addEventListener('click', () => {
        const input = document.querySelector(el.getAttribute('toggle'));
        if(input.type==='password'){ 
            input.type='text'; 
            el.textContent='🙈'; 
        } else { 
            input.type='password'; 
            el.textContent='👁️'; 
        }
    });
});
</script>
