const sidebar = document.getElementById('sidebar');
const hamburger = document.getElementById('hamburger');

// Sidebar toggle
hamburger.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    const isCollapsed = sidebar.classList.contains('collapsed');

    // Hide/show sidebar text
    document.querySelectorAll('.sidebar-text').forEach(span => {
        span.style.display = isCollapsed ? 'none' : 'inline';
    });

    // Collapse all submenus when sidebar minimized
    if (isCollapsed) {
        document.querySelectorAll('.submenu').forEach(sm => sm.style.maxHeight = '0');
        document.querySelectorAll('.has-submenu').forEach(hs => hs.classList.remove('open'));
    }
});

// Submenu toggle
document.querySelectorAll('.has-submenu').forEach(item => {
    item.addEventListener('click', () => {
        if (!sidebar.classList.contains('collapsed')) { // only if expanded
            item.classList.toggle('open');
            const submenu = item.nextElementSibling;
            if (submenu) {
                submenu.style.maxHeight = item.classList.contains('open') 
                    ? submenu.scrollHeight + "px" 
                    : "0";
            }
        }
    });
});
