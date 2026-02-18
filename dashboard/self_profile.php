<?php require_once __DIR__."/../controllers/ProfileController.php"; ?>

<div class="user-card">
    <div class="user-card-header">👤 Update Profile</div>
    <form method="post">
        <div class="form-grid">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" class="fvt-input"
                       value="<?= htmlspecialchars($user['Name']) ?>" required>
            </div>

            <div class="form-group">
                <label>Designation</label>
                <input type="text" name="designation" class="fvt-input"
                       value="<?= htmlspecialchars($user['Designation']) ?>" required>
            </div>

            <div class="form-group">
                <label>Contact</label>
                <input type="text" name="contact" class="fvt-input"
                       value="<?= htmlspecialchars($user['Contact']) ?>">
            </div>

            
            <?php if ($role === 'Administrator'): ?>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="fvt-input"
                           value="<?= htmlspecialchars($user['UserName']) ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="fvt-input"
                           value="<?= htmlspecialchars($user['Email']) ?>">
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role_id" class="fvt-input">
                        <?php foreach($roles as $id=>$r): ?>
                            <option value="<?= $id ?>" <?= $user['Role_ID']==$id?'selected':'' ?>>
                                <?= $r ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label>Status</label>
                <input type="text" class="fvt-input"
                       value="<?= $user['Status']==1?'Active':'Inactive' ?>" readonly>
            </div>

        </div>
        <div class="actions">
            <button class="btn btn-success">Update</button>
        </div>
    </form>
</div>
