<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
include("../config.php");

/* ==========================
   CHECK LOGIN
========================== */
$id = $_SESSION['login_user_id'] ?? 0;
if ($id <= 0) {
    $_SESSION['msg'] = "❌ Please login first!";
    $_SESSION['msg_type'] = "error";
    header("Location: ../auth/login.php");
    exit;
}

/* ==========================
   FETCH USER DATA (SAFE)
========================== */
$stmt = mysqli_prepare($db, "SELECT ID, Passcode FROM Admin WHERE ID = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    session_destroy();
    header("Location: ../auth/login.php");
    exit;
}

/* ==========================
   HANDLE FORM SUBMIT
========================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $current  = $_POST['current_password'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';
    $error = '';

    if (!password_verify($current, $user['Passcode'])) {
        $error = "Current password is incorrect!";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match!";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters!";
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $error = "Password must include at least one uppercase letter!";
    } elseif (!preg_match('/[a-z]/', $password)) {
        $error = "Password must include at least one lowercase letter!";
    } elseif (!preg_match('/[0-9]/', $password)) {
        $error = "Password must include at least one number!";
    } elseif (!preg_match('/[@$!%*#?&]/', $password)) {
        $error = "Password must include at least one special character!";
    } elseif (password_verify($password, $user['Passcode'])) {
        $error = "New password must be different from current password!";
    }

    if ($error === '') {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $update = mysqli_prepare($db, "UPDATE Admin SET Passcode=? WHERE ID=?");
        mysqli_stmt_bind_param($update, "si", $hash, $id);
        mysqli_stmt_execute($update);

        session_regenerate_id(true);

        $_SESSION['msg'] = "✅ Password changed successfully!";
        $_SESSION['msg_type'] = "success";

    } else {
        $_SESSION['msg'] = "❌ $error";
        $_SESSION['msg_type'] = "error";
    }

    // ✅ Redirect to password_change page to prevent form resubmission
    header("Location: base.php?page=password_change");
    exit();

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Change Password</title>
<style>
.user-card{max-width:500px;margin:50px auto;background:#fff;padding:25px;border-radius:12px;box-shadow:0 12px 30px rgba(0,0,0,.1);}
.user-card-header{font-size:20px;font-weight:700;margin-bottom:20px;text-align:center;}
.form-group{position:relative;margin-bottom:15px;}
.fvt-input{width:100%;padding:10px 40px 10px 10px;border-radius:6px;border:1px solid #ccc;}
.toggle-password{position:absolute;right:10px;top:50%;transform:translateY(-50%);cursor:pointer;}
.actions{display:flex;justify-content:center;gap:10px;margin-top:20px;}
.btn{padding:10px 18px;border-radius:6px;font-weight:600;border:none;cursor:pointer;}
.btn-success{background:#28a745;color:#fff;}
.btn-reset{background:#6c757d;color:#fff;}
.alert{padding:10px;border-radius:6px;margin-bottom:15px;text-align:center;}
.badge{padding:3px 8px;border-radius:4px;font-size:12px;}
.badge-weak{background:#f87171;color:#fff;}
.badge-medium{background:#facc15;color:#000;}
.badge-strong{background:#4ade80;color:#000;}
</style>
</head>
<body>

<div class="user-card">
    <div class="user-card-header">🔑 Change Password</div>

    <?php if(isset($_SESSION['msg'])): ?>
    <div class="alert" style="background: <?= $_SESSION['msg_type']=='success'?'#d1fae5':'#fee2e2' ?>;">
        <?= htmlspecialchars($_SESSION['msg']); unset($_SESSION['msg'], $_SESSION['msg_type']); ?>
    </div>
    <?php endif; ?>

    <form method="post" autocomplete="off">

        <div class="form-group">
            <label>Current Password</label>
            <input type="password" name="current_password" id="current_password" class="fvt-input" required>
            <span class="toggle-password" toggle="#current_password">👁️</span>
        </div>

        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="password" id="password" class="fvt-input" required>
            <span class="toggle-password" toggle="#password">👁️</span>
            <small id="strength"></small>
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm" id="confirm" class="fvt-input" required>
            <span class="toggle-password" toggle="#confirm">👁️</span>
            <small id="match"></small>
        </div>

        <div class="actions">
            <button type="reset" class="btn btn-reset">Reset</button>
            <button type="submit" class="btn btn-success">Change Password</button>
        </div>

    </form>
</div>

<script>
// Password strength meter
const pwd = document.getElementById('password');
const cp  = document.getElementById('confirm');

pwd.addEventListener('input', () => {
    let s=0,v=pwd.value;
    if(v.length>=8)s++;
    if(/[A-Z]/.test(v))s++;
    if(/[a-z]/.test(v))s++;
    if(/[0-9]/.test(v))s++;
    if(/[@$!%*#?&]/.test(v))s++;

    let t='Weak',c='badge-weak';
    if(s>=3){t='Medium';c='badge-medium';}
    if(s>=5){t='Strong';c='badge-strong';}
    document.getElementById('strength').innerHTML=`<span class="badge ${c}">${t}</span>`;
});

// Match check
cp.addEventListener('input',()=> {
    document.getElementById('match').innerHTML =
    pwd.value && pwd.value === cp.value
    ? '<span class="badge badge-strong">Matched</span>'
    : '<span class="badge badge-weak">Not Matched</span>';
});

// Toggle show/hide password
document.querySelectorAll('.toggle-password').forEach(el=>{
    el.onclick=()=>{
        const i=document.querySelector(el.getAttribute('toggle'));
        i.type=i.type==='password'?'text':'password';
        el.textContent=i.type==='password'?'👁️':'🙈';
    }
});

// Auto-hide message after 5s
setTimeout(() => {
    document.querySelectorAll('.alert').forEach(el => el.remove());
}, 5000);
</script>

</body>
</html>
