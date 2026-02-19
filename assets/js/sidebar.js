const sidebar = document.getElementById('sidebar');
const hamburger = document.getElementById('hamburger');

// Hamburger toggle (manual)
hamburger.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    const collapsed = sidebar.classList.contains('collapsed');

    document.querySelectorAll('.sidebar-text').forEach(el => {
        el.style.display = collapsed ? 'none' : 'inline';
    });

    if (collapsed) {
        document.querySelectorAll('.submenu').forEach(sm => sm.style.maxHeight = '0');
        document.querySelectorAll('.has-submenu').forEach(hs => hs.classList.remove('open'));
    }
});

// Automatically expand sidebar when clicking anywhere inside it if collapsed
sidebar.addEventListener('click', (e) => {
    if (!sidebar.classList.contains('collapsed')) return;

    // Prevent immediate toggle if hamburger is clicked
    if (e.target.id === 'hamburger') return;

    sidebar.classList.remove('collapsed');
    document.querySelectorAll('.sidebar-text').forEach(el => el.style.display = 'inline');
});

// Submenu toggle
document.querySelectorAll('.has-submenu').forEach(menu => {
    menu.addEventListener('click', (e) => {
        // If sidebar is collapsed, automatically expand it
        if (sidebar.classList.contains('collapsed')) {
            sidebar.classList.remove('collapsed');
            document.querySelectorAll('.sidebar-text').forEach(el => el.style.display = 'inline');
        }

        menu.classList.toggle('open');
        const submenu = menu.nextElementSibling;
        if (submenu) {
            submenu.style.maxHeight = menu.classList.contains('open')
                ? submenu.scrollHeight + 'px'
                : '0';
        }

        // Prevent event from bubbling to sidebar click listener
        e.stopPropagation();
    });
});
