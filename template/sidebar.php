<div class="fvt-sidebar" id="sidebar">
    <div class="fvt-logo">
        <span class="sidebar-text">FVT • <?= htmlspecialchars($role_name); ?></span>
        <span class="hamburger" id="hamburger">☰</span>
    </div>
    <nav class="fvt-menu">
        <!-- Dashboard link -->
        <a href="base.php?page=dashboard">📊 Dashboard</a>

        <!-- Users menu (roles 1) -->
        <?php if (in_array($role_id, [1])): ?>
        <a class="has-submenu">👥 Users</a>
        <div class="submenu">
            <?php if (in_array($role_id, [1])): ?>
            <a href="base.php?page=add_user">Add User</a>
            <a href="base.php?page=users">View Users</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Foreign Visits menu -->
        <?php if (in_array($role_id, [1, 5])): ?>
        <a class="has-submenu">✈ Foreign Visits</a>
        <div class="submenu">
            <?php if (in_array($role_id, [1,5])): ?>
            <a href="base.php?page=NewEntry">Add Visit</a>
            <a href="base.php?page=ViewVisits">View Visits</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Reports -->
        <a class="has-submenu">📑 Reports</a>
        <div class="submenu">
            <?php if (in_array($role_id, [1,2,5])): ?>
            <a href="base.php?page=Report">Time Base Report</a>
            <a href="base.php?page=unrepoted_report">Unreported Cases</a>
            <a href="base.php?page=masimum_visit_report">Maximum Visit</a>
            <?php endif; ?>
        </div>

        <!-- Settings (roles 1,2) -->
        <?php if (in_array($role_id, [1,2,3,4,5])): ?>
        <a class="has-submenu">⚙ Settings</a>
        <div class="submenu">
            <a href="base.php?page=change_profile">👤 My Profile</a>
            <a href="base.php?page=password_change">🔑 Change Password</a>
            <a href="../auth/login.php?logout=1">🚪 Logout</a>
        </div>
        <?php endif; ?>

    </nav>
</div>
