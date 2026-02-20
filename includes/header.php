<header class="fvt-topbar">
    <div></div>

    <?php if (in_array($role, ['Administrator','Admin','User','Visitor','Operator'])): ?>
    <div class="user-dropdown">
        <span class="user-name">
            <?= htmlspecialchars($userFullname); ?>
        </span>

        <div class="user-menu">
            <a href="base.php?page=self_profile">👤 My Profile</a>
            <a href="base.php?page=self_change_password">🔑 Change Password</a>
            <a href="auth/logout.php" class="logout">🚪 Logout</a>
        </div>
    </div>
    <?php endif; ?>
</header>