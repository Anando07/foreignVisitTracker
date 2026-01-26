// Sidebar toggle
const sidebar = document.getElementById('sidebar');
const hamburger = document.getElementById('hamburger');

hamburger.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');

    const isCollapsed = sidebar.classList.contains('collapsed');

    // Hide/show logo text
    document.querySelectorAll('.sidebar-text').forEach(span => {
        span.style.display = isCollapsed ? 'none' : 'inline';
    });

    // Reset all submenus and arrows when collapsed
    if(isCollapsed){
        document.querySelectorAll('.submenu').forEach(sm => sm.style.display = 'none');
        document.querySelectorAll('.has-submenu').forEach(hs => hs.classList.remove('open'));
    }
});

// Submenu toggle
document.querySelectorAll('.has-submenu').forEach(item => {
    item.addEventListener('click', () => {
        if(!sidebar.classList.contains('collapsed')){ // only if expanded
            item.classList.toggle('open');
            const submenu = item.nextElementSibling;
            submenu.style.display = (submenu.style.display === "flex") ? "none" : "flex";
        }
    });
});