<div class="fvt-sidebar" id="sidebar">
    <div class="fvt-logo">
        <span class="sidebar-text">FVT • <?= htmlspecialchars($role_name); ?></span>
        <span class="hamburger" id="hamburger">☰</span>
    </div>
    <nav class="fvt-menu">
        <!-- Dashboard link -->
        <a href="base.php?page=dashboard">📊 Dashboard</a>

        <!-- Users menu (roles 1,2,5) -->
        <?php if (in_array($role_id, [1])): ?>
        <a class="has-submenu">👥 Users</a>
        <div class="submenu">
            <?php if (in_array($role_id, [1])): ?>
            <a href="base.php?page=add_user">Add User</a>
            <?php endif; ?>
            <a href="base.php?page=users">View Users</a>
        </div>
        <?php endif; ?>

        <!-- Foreign Visits menu -->
        <?php if ($role_id != 4): ?>
        <a class="has-submenu">✈ Foreign Visits</a>
        <div class="submenu">
            <?php if (in_array($role_id, [1,2,3,4,5])): ?>
            <a href="base.php?page=NewEntry">Add Visit</a>
            <?php endif; ?>
            <a href="base.php?page=view_visits">View Visits</a>
        </div>
        <?php endif; ?>

        <!-- Reports -->
        <a class="has-submenu">📑 Reports</a>
        <div class="submenu">
            <a href="base.php?page=daily_report">Daily Report</a>
            <a href="base.php?page=monthly_report">Monthly Report</a>
            <a href="base.php?page=annual_report">Annual Report</a>
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
