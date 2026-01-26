<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include("../config.php");

/* ==========================
   GET USER ID
========================== */
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    $_SESSION['msg'] = "❌ Invalid User!";
    $_SESSION['msg_type'] = "error";
    header("Location: base.php?page=users");
    exit;
}

/* ==========================
   FETCH USER DATA
========================== */
$res = mysqli_query($db, "SELECT * FROM Admin WHERE ID=$id");
$user = mysqli_fetch_assoc($res);

if (!$user) {
    $_SESSION['msg'] = "❌ User not found!";
    $_SESSION['msg_type'] = "error";
    header("Location: base.php?page=users");
    exit;
}

/* ==========================
   HANDLE FORM SUBMIT
========================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';
    $error = '';

    // Server-side validation for strong password
    if ($password !== $confirm) {
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
        $error = "Password must include at least one special character (@$!%*#?&)";
    }

    if ($error === '') {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        mysqli_query($db, "UPDATE Admin SET Passcode='$password_hashed' WHERE ID=$id");

        $_SESSION['msg'] = "✅ Password changed successfully!";
        $_SESSION['msg_type'] = "success";
        // header("Location: base.php?page=change_password");
        // exit;
    } else {
        $_SESSION['msg'] = "❌ $error";
        $_SESSION['msg_type'] = "error";
    }
}
?>

<style>
.user-card{max-width:500px;margin:50px auto;background:#fff;padding:25px;border-radius:12px;box-shadow:0 12px 30px rgba(0,0,0,.1);}
.user-card-header{font-size:20px;font-weight:700;margin-bottom:20px;text-align:center;}
.form-group{position:relative;margin-bottom:15px;}
.fvt-input{width:100%;padding:10px 40px 10px 10px;border-radius:6px;border:1px solid #ccc;box-sizing:border-box;}
.fvt-input:focus{border-color:#007bff;outline:none;}
.toggle-password{position:absolute;right:10px;top:50%;transform:translateY(-50%);cursor:pointer;user-select:none;font-size:16px;}
.actions{display:flex;justify-content:center;gap:10px;margin-top:20px;}
.btn{padding:10px 18px;border-radius:6px;font-weight:600;border:none;cursor:pointer;}
.btn-success{background:#28a745;color:#fff;}
.btn-secondary{background:#6c757d;color:#fff;text-decoration:none;}
.alert{padding:10px;border-radius:6px;margin-bottom:15px;}
.badge{padding:3px 8px;border-radius:4px;font-size:12px;}
.badge-weak{background:#f87171;color:#fff;}
.badge-medium{background:#facc15;color:#000;}
.badge-strong{background:#4ade80;color:#000;}
</style>

<div class="user-card">
    <div class="user-card-header">🔑 Change Password for <?= htmlspecialchars($user['Name']) ?></div>

    <?php if(isset($_SESSION['msg'])): ?>
    <div class="alert" style="background: <?= $_SESSION['msg_type']=='success'?'#d1fae5':'#fee2e2' ?>; color: <?= $_SESSION['msg_type']=='success'?'#065f46':'#b91c1c' ?>">
        <?= $_SESSION['msg']; unset($_SESSION['msg'], $_SESSION['msg_type']); ?>
    </div>
    <?php endif; ?>

    <form method="post">
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
            <a href="base.php?page=users" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-success">Change Password</button>
        </div>
    </form>
</div>

<script>
const pwd = document.getElementById('password');
const cp  = document.getElementById('confirm');

// Password strength
pwd.addEventListener('input', () => {
    let v = pwd.value;
    let s = 0;
    if(v.length >= 8) s++;
    if(/[A-Z]/.test(v)) s++;
    if(/[a-z]/.test(v)) s++;
    if(/[0-9]/.test(v)) s++;
    if(/[@$!%*#?&]/.test(v)) s++;

    let text='Weak', cls='badge-weak';
    if(s==3 || s==4) {text='Medium'; cls='badge-medium';}
    if(s>=5) {text='Strong'; cls='badge-strong';}

    document.getElementById('strength').innerHTML = `<span class="badge ${cls}">${text}</span>`;
});

// Password match
cp.addEventListener('input', () => {
    document.getElementById('match').innerHTML =
        pwd.value === cp.value && pwd.value.length > 0
        ? '<span class="badge badge-strong">Matched</span>'
        : '<span class="badge badge-weak">Not Matched</span>';
});

// Toggle show/hide password
document.querySelectorAll('.toggle-password').forEach(el => {
    el.addEventListener('click', () => {
        const input = document.querySelector(el.getAttribute('toggle'));
        if(input.type==='password'){ input.type='text'; el.textContent='🙈'; }
        else { input.type='password'; el.textContent='👁️'; }
    });
});
</script>
