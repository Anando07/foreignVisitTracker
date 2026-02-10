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
            <a href="base.php?page=view_visits">View Visits</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Reports -->
        <a class="has-submenu">📑 Reports</a>
        <div class="submenu">
            <a href="base.php?page=individual_report">Time Base Report (Individual)</a>
            <?php if (in_array($role_id, [1,5])): ?>
            <a href="base.php?page=office_report">Time Base Report (Office)</a>
            <a href="base.php?page=country_report">Time Base Report (Country)</a>
            <a href="base.php?page=fund_report">Time Base Report (Fund)</a>
            <a href="base.php?page=purpose_report">Time Base Report (Purpose)</a>
            <a href="base.php?page=overall_report">Individual Report(Overall)</a>
            <a href="base.php?page=unrepoted_report">Unreported Cases</a>
            <a href="base.php?page=masimum_visit_report">Maximum Visit</a>
            <a href="base.php?page=summary_report">Summary Report</a>
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
