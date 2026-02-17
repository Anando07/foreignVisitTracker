<?php require_once __DIR__."/../controllers/UserController.php"; ?>
  
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
                    <?php foreach($roles as $sl => $roleName): ?>
                        <option value="<?= $sl ?>" <?= $role_id==$sl ? 'selected' : '' ?>>
                            <?= $roleName ?>
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
            <a href="base.php?page=Users" class="btn btn-secondary">Cancel</a>
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
