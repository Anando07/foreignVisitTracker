const sidebar = document.getElementById('sidebar');
const hamburger = document.getElementById('hamburger');

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

document.querySelectorAll('.has-submenu').forEach(menu => {
    menu.addEventListener('click', () => {
        if (sidebar.classList.contains('collapsed')) return;
        menu.classList.toggle('open');
        const submenu = menu.nextElementSibling;
        if (submenu) {
            submenu.style.maxHeight = menu.classList.contains('open')
                ? submenu.scrollHeight + 'px'
                : '0';
        }
    });
});
