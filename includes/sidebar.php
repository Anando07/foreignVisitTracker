<div class="fvt-sidebar" id="sidebar">
    <div class="fvt-logo">
        <span class="sidebar-text">FVT • <?= htmlspecialchars($role); ?></span>
        <span class="hamburger" id="hamburger">☰</span>
    </div>
    <nav class="fvt-menu">
        <!-- Dashboard link -->
        <?php if (in_array($role, ['Administrator', 'Admin', 'User', 'Visitor', 'Operator'])): ?>
        <a href="base.php?page=dashboard" class="menu-item">
            <span class="icon">📊</span> Dashboard
        </a>
        <?php endif; ?>

        <!-- Users menu (Administrator only) -->
        <?php if ($role === 'Administrator'): ?>
        <a class="has-submenu menu-item">👥 Users <span class="submenu-arrow"></span></a>
        <div class="submenu">
            <a href="base.php?page=AddEditUser"><span class="icon">➕</span> Add User</a>
            <a href="base.php?page=Users"><span class="icon">👤</span> View Users</a>
        </div>
        <?php endif; ?>

        <!-- Foreign Visits menu (Administrator + Operator) -->
        <?php if (in_array($role, ['Administrator', 'Operator'])): ?>
        <a class="has-submenu menu-item">✈ Foreign Visits <span class="submenu-arrow"></span></a>
        <div class="submenu">
            <a href="base.php?page=NewEntry"><span class="icon">➕</span> Add Visit</a>
            <a href="base.php?page=ViewVisits"><span class="icon">📋</span> View Visits</a>
            <a href="base.php?page=UnreportedVisits"><span class="icon">⚠️</span> Unreported Visit</a>
        </div>
        <?php endif; ?>

        <!-- Reports menu (Administrator + Admin + Operator) -->
        <?php if (in_array($role, ['Administrator', 'Admin', 'Operator'])): ?>
        <a class="has-submenu menu-item">📑 Reports <span class="submenu-arrow"></span></a>
        <div class="submenu">
            <a href="base.php?page=Report"><span class="icon">⏱️</span> Time Base Visit</a>
            <a href="base.php?page=UnreportedVisits"><span class="icon">⚠️</span> Unreported Visit</a>
            <a href="base.php?page=MaxMinReport"><span class="icon">📈</span> Maximum Visit</a>
        </div>
        <?php endif; ?>

        <!-- Settings menu (all roles) -->
        <?php if (in_array($role, ['Administrator', 'Admin', 'User', 'Visitor', 'Operator'])): ?>
        <a class="has-submenu menu-item">⚙ Settings <span class="submenu-arrow"></span></a>
        <div class="submenu">
            <a href="base.php?page=self_profile"><span class="icon">👤</span> My Profile</a>
            <a href="base.php?page=self_change_password"><span class="icon">🔑</span> Change Password</a>
            <a href="auth/logout.php"><span class="icon">🚪</span> Logout</a>
        </div>
        <?php endif; ?>
    </nav>
</div>

