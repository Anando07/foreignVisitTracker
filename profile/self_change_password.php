<?php 
require_once __DIR__."/../controllers/PasswordController.php";
$controller = new PasswordController($db, $userId, $role);
$controller->selfResetPassword();
?>
<div class="fvt-card">
    <div class="fvt-page-header">🔑 Change Password</div>

    <form id="passwordForm" method="post" autocomplete="off">
        <div class="fvt-grid">

            <!-- Current Password -->
            <div class="fvt-group password-wrapper">
                <label>Current Password <span class="required">*</span></label>
                <input type="password" name="current_password" id="current_password" class="fvt-input" required>
                <span toggle="#current_password" class="toggle-password">👁️</span>
                <div class="error-msg"></div>
            </div>

            <!-- New Password -->
            <div class="fvt-group password-wrapper">
                <label>New Password <span class="required">*</span></label>
                <input type="password" name="password" id="password" class="fvt-input" required>
                <span toggle="#password" class="toggle-password">👁️</span>
                <small id="strength"></small>
                <div class="error-msg"></div>
            </div>

            <!-- Confirm Password -->
            <div class="fvt-group password-wrapper">
                <label>Confirm Password <span class="required">*</span></label>
                <input type="password" name="confirm" id="confirm" class="fvt-input" required>
                <span toggle="#confirm" class="toggle-password">👁️</span>
                <small id="match"></small>
                <div class="error-msg"></div>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="fvt-actions" style="text-align:center; margin-top:16px;">
            <button type="reset" class="btn btn-secondary fvt-action-btn">Reset</button>
            <button type="submit" class="btn btn-success fvt-action-btn">Change Password</button>
        </div>
    </form>
</div>

<script>
// Password strength
const pwd = document.getElementById('password');
const cp  = document.getElementById('confirm');

pwd?.addEventListener('input', () => {
    let s=0, v=pwd.value;
    if(v.length>=8) s++;
    if(/[A-Z]/.test(v)) s++;
    if(/[a-z]/.test(v)) s++;
    if(/[0-9]/.test(v)) s++;
    if(/[@$!%*#?&]/.test(v)) s++;

    let t='Weak', c='badge-weak';
    if(s>=3){ t='Medium'; c='badge-medium'; }
    if(s>=5){ t='Strong'; c='badge-strong'; }

    document.getElementById('strength').innerHTML=`<span class="badge ${c}">${t}</span>`;
});

// Password match check
cp?.addEventListener('input', () => {
    document.getElementById('match').innerHTML =
        pwd.value && pwd.value === cp.value
        ? '<span class="badge badge-strong">Matched</span>'
        : '<span class="badge badge-weak">Not Matched</span>';
});

// Toggle password visibility
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

// Form validation
document.getElementById("passwordForm").addEventListener("submit", function(e){
    let ok=true;
    document.querySelectorAll(".error-msg").forEach(x=>x.innerText="");
    document.querySelectorAll(".fvt-input").forEach(x=>x.classList.remove("error"));

    function err(el,msg){
        el.classList.add("error");
        el.nextElementSibling.innerText=msg;
        ok=false;
    }

    document.querySelectorAll(".fvt-input[required]").forEach(el=>{
        if(!el.value) err(el,"Required");
    });

    if(pwd && cp && pwd.value !== cp.value) err(cp,"Passwords do not match");

    if(!ok) e.preventDefault();
});
</script>