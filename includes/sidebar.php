<div class="fvt-sidebar" id="sidebar">
    <div class="fvt-logo">
        <span class="sidebar-text">FVT • <?= htmlspecialchars($roleName); ?></span>
        <span class="hamburger" id="hamburger">☰</span>
    </div>
    <nav class="fvt-menu">
        <!-- Dashboard link -->
        <a href="base.php?page=dashboard">📊 Dashboard</a>

        <!-- Users menu (roles 1) -->
        <?php if (in_array($roleId, [1])): ?>
        <a class="has-submenu">👥 Users</a>
        <div class="submenu">
            <?php if (in_array($roleId, [1])): ?>
            <a href="base.php?page=AddEditUser">Add User</a>
            <a href="base.php?page=Users">View Users</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Foreign Visits menu -->
        <?php if (in_array($roleId, [1, 5])): ?>
        <a class="has-submenu">✈ Foreign Visits</a>
        <div class="submenu">
            <?php if (in_array($roleId, [1,5])): ?>
            <a href="base.php?page=NewEntry">Add Visit</a>
            <a href="base.php?page=ViewVisits">View Visits</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Reports -->
        <a class="has-submenu">📑 Reports</a>
        <div class="submenu">
            <?php if (in_array($roleId, [1,2,5])): ?>
            <a href="base.php?page=Report">Time Base Visit</a>
            <a href="base.php?page=UnreportedVisits">Unreported Visit</a>
            <a href="base.php?page=MaxMinReport">Maximum Visit</a>
            <?php endif; ?>
        </div>

        <!-- Settings (roles 1,2) -->
        <?php if (in_array($roleId, [1,2,3,4,5])): ?>
        <a class="has-submenu">⚙ Settings</a>
        <div class="submenu">
            <a href="base.php?page=profile">👤 My Profile</a>
            <a href="base.php?page=self_change_password">🔑 Change Password</a>
            <a href="auth/logout.php">🚪 Logout</a>
        </div>
        <?php endif; ?>

    </nav>
</div>