/**
 * Sefwi Tax Collection System
 * Global JavaScript Functions
 */

// Global sidebar toggle function
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainBody = document.getElementById('main-body');
    const overlay = document.getElementById('sidebar-overlay');

    if (sidebar.classList.contains('-translate-x-full')) {
        // Open sidebar
        sidebar.classList.remove('-translate-x-full');
        mainBody.classList.add('sidebar-open');
        if (overlay) overlay.classList.remove('hidden');
    } else {
        // Close sidebar
        sidebar.classList.add('-translate-x-full');
        mainBody.classList.remove('sidebar-open');
        if (overlay) overlay.classList.add('hidden');
    }
}

// Initialize sidebar overlay
function initSidebarOverlay() {
    // Create overlay element for mobile sidebar if it doesn't exist
    let overlay = document.getElementById('sidebar-overlay');

    if (!overlay) {
        overlay = document.createElement('div');
        overlay.id = 'sidebar-overlay';
        overlay.className = 'fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden hidden transition-opacity duration-300';
        document.body.appendChild(overlay);

        overlay.addEventListener('click', function () {
            toggleSidebar();
        });
    }

    return overlay;
}

// Initialize application
document.addEventListener('DOMContentLoaded', function () {
    // Initialize sidebar overlay
    initSidebarOverlay();
});
