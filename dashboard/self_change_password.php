<?php require_once __DIR__."/../controllers/PasswordController.php"; ?>

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

<div class="user-card">
    <div class="user-card-header">🔑 Change Password</div>
    <form method="post" autocomplete="off">

        <div class="form-group">
            <label>Current Password</label>
            <input type="password" name="current_password" id="current_password" class="fvt-input" required>
            <span class="toggle-password" data-target="current_password">👁️</span>
        </div>

        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="password" id="password" class="fvt-input" required>
            <span class="toggle-password" data-target="password">👁️</span>
            <small id="strength"></small>
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm" id="confirm" class="fvt-input" required>
            <span class="toggle-password" data-target="confirm">👁️</span>
            <small id="match"></small>
        </div>

        <div class="actions">
            <button type="reset" class="btn btn-reset">Reset</button>
            <button type="submit" class="btn btn-success">Change</button>
        </div>

    </form>
</div>

<script>
// Password strength
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

// 👁️ Toggle visibility
document.querySelectorAll('.toggle-password').forEach(icon=>{
    icon.onclick = () => {
        const input = document.getElementById(icon.dataset.target);
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.textContent = input.type === 'password' ? '👁️' : '🙈';
    };
});
</script>
