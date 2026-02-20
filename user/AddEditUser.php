<?php require_once __DIR__."/../controllers/UserController.php"; ?>

<div class="fvt-card">
    <div class="fvt-page-header">
        <?= $isEdit ? "✏️ Edit User" : "➕ Add New User" ?>
    </div>

    <form id="userForm" method="post">
        <div class="fvt-grid">

            <!-- Full Name -->
            <div class="fvt-group">
                <label>Full Name <span class="required">*</span></label>
                <input type="text" name="name" required class="fvt-input" value="<?= htmlspecialchars($name) ?>">
                <div class="error-msg"></div>
            </div>

            <!-- Designation -->
            <div class="fvt-group">
                <label>Designation <span class="required">*</span></label>
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
                <div class="error-msg"></div>
            </div>

            <!-- Username -->
            <div class="fvt-group">
                <label>Username <span class="required">*</span></label>
                <input type="text" name="username" required class="fvt-input" value="<?= htmlspecialchars($username) ?>">
                <div class="error-msg"></div>
            </div>

            <!-- Email -->
            <div class="fvt-group">
                <label>Email <span class="required">*</span></label>
                <input type="email" name="email" required class="fvt-input" value="<?= htmlspecialchars($email) ?>">
                <div class="error-msg"></div>
            </div>

            <!-- Contact -->
            <div class="fvt-group">
                <label>Contact</label>
                <input type="text" name="contact" class="fvt-input" value="<?= htmlspecialchars($contact) ?>">
                <div class="error-msg"></div>
            </div>

            <!-- Role -->
            <div class="fvt-group">
                <label>Role <span class="required">*</span></label>
                <select name="role_id" required class="fvt-input">
                    <option value="">Select Role</option>
                    <?php foreach($roles as $sl => $roleName): ?>
                        <option value="<?= $sl ?>" <?= $role_id==$sl ? 'selected' : '' ?>><?= $roleName ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="error-msg"></div>
            </div>

            <!-- Status -->
            <div class="fvt-group">
                <label>Status</label>
                <select name="status" class="fvt-input">
                    <option value="1" <?= $status==1?'selected':'' ?>>Active</option>
                    <option value="0" <?= $status==0?'selected':'' ?>>Inactive</option>
                </select>
            </div>

            <?php if(!$isEdit): ?>
            <!-- Password -->
            <div class="fvt-group password-wrapper">
                <label>Password <span class="required">*</span></label>
                <input type="password" name="password" id="password" required class="fvt-input">
                <span toggle="#password" class="toggle-password">👁️</span>
                <small id="strength"></small>
                <div class="error-msg"></div>
            </div>

            <!-- Confirm Password -->
            <div class="fvt-group password-wrapper">
                <label>Confirm Password <span class="required">*</span></label>
                <input type="password" name="confirm" id="confirm" required class="fvt-input">
                <span toggle="#confirm" class="toggle-password">👁️</span>
                <small id="match"></small>
                <div class="error-msg"></div>
            </div>
            <?php endif; ?>

        </div>

        <div class="fvt-actions" style="text-align:center; margin-top:16px;">
            <a href="base.php?page=Users" class="btn btn-secondary fvt-action-btn">Cancel</a>
            <button class="btn btn-success fvt-action-btn"><?= $isEdit?'Update User':'Save User' ?></button>
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

// Simple form validation
document.getElementById("userForm").addEventListener("submit", function(e){
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