<?php
/**
 * Sidebar Component
 * Displays the sidebar navigation for the finance portal
 * 
 * @param string $activeItem The currently active menu item
 * @param bool $isOpen Whether the sidebar is open by default on mobile
 */

function renderSidebar($activeItem = 'dashboard', $isOpen = true) {
?>
<div id="sidebar"
    class="sidebar fixed w-64 flex flex-col h-screen top-0 left-0 py-6 px-4 bg-blue-50 transition-transform duration-300 transform z-30 overflow-y-auto <?php echo (!$isOpen) ? '-translate-x-full' : ''; ?> md:translate-x-0">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-xl font-semibold">Finance Portal</h1> <button id="close-sidebar"
            class="md:hidden text-gray-500 hover:text-gray-800">
            <i class="ri-close-line text-xl"></i>
        </button>
    </div>

    <div class="space-y-2">
        <h2 class="text-sm uppercase tracking-wider text-gray-500 font-semibold mb-2">Management</h2>

        <a href="../dashboard/"
            class="sidebar-item flex items-center py-2 px-3 rounded-md <?php echo ($activeItem == 'dashboard') ? 'bg-blue-600 text-white font-medium shadow-md' : 'text-gray-700 hover:bg-blue-100'; ?>">
            <i class="ri-bar-chart-line mr-2"></i>
            <span>Revenue Overview</span>
        </a>

        <!-- <a href="../taxes/index.php"
            class="sidebar-item flex items-center py-2 px-3 rounded-md <?php echo ($activeItem == 'taxes') ? 'bg-blue-600 text-white font-medium shadow-md' : 'text-gray-700 hover:bg-blue-100'; ?>">
            <i class="ri-settings-3-line mr-2"></i>
            <span>Tax Configuration</span>
        </a> -->

        <a href="../businesses/index.php"
            class="sidebar-item flex items-center py-2 px-3 rounded-md <?php echo ($activeItem == 'businesses') ? 'bg-blue-600 text-white font-medium shadow-md' : 'text-gray-700 hover:bg-blue-100'; ?>">
            <i class="ri-building-line mr-2"></i>
            <span>Business Registry</span>
        </a> <a href="../notifications/index.php"
            class="sidebar-item flex items-center py-2 px-3 rounded-md <?php echo ($activeItem == 'notifications') ? 'bg-blue-600 text-white font-medium shadow-md' : 'text-gray-700 hover:bg-blue-100'; ?>">
            <i class="ri-notification-3-line mr-2"></i>
            <span>Notification Center</span>
        </a>

        <a href="../payments/index.php"
            class="sidebar-item flex items-center py-2 px-3 rounded-md <?php echo ($activeItem == 'payments') ? 'bg-blue-600 text-white font-medium shadow-md' : 'text-gray-700 hover:bg-blue-100'; ?>">
            <i class="ri-money-dollar-circle-line mr-2"></i>
            <span>Payments</span>
        </a>

        <a href="../collectors/index.php"
            class="sidebar-item flex items-center py-2 px-3 rounded-md <?php echo ($activeItem == 'collectors') ? 'bg-blue-600 text-white font-medium shadow-md' : 'text-gray-700 hover:bg-blue-100'; ?>">
            <i class="ri-user-star-line mr-2"></i>
            <span>Tax Collectors</span>
        </a>

        <a href="../reports/index.php"
            class="sidebar-item flex items-center py-2 px-3 rounded-md <?php echo ($activeItem == 'reports') ? 'bg-blue-600 text-white font-medium shadow-md' : 'text-gray-700 hover:bg-blue-100'; ?>">
            <i class="ri-file-chart-line mr-2"></i>
            <span>Reports</span>
        </a>

        <a href="../settings/index.php"
            class="sidebar-item flex items-center py-2 px-3 rounded-md <?php echo ($activeItem == 'settings') ? 'bg-blue-600 text-white font-medium shadow-md' : 'text-gray-700 hover:bg-blue-100'; ?>">
            <i class="ri-settings-4-line mr-2"></i>
            <span>Settings</span>
        </a>
    </div>

    <!-- Developer Credit - Added to bottom of sidebar -->
    <div class="mt-auto pt-4 border-t border-gray-200 mt-6">
        <div class="text-center py-2 text-xs text-gray-500">
            <span>Developed by</span>
            <a href="tel:+233541436414" class="mx-1 font-medium inline-flex items-center group">
                <span class="text-blue-600 group-hover:text-blue-700 transition-colors">Gilbert Elikplim Kukah</span>
                <i class="ri-arrow-right-up-line ml-0.5 opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>
            <span class="px-1 text-gray-300">|</span>
            <a href="tel:+233541436414" class="hover:text-blue-600 transition-colors">0541436414</a>
        </div>
    </div>
</div>
<?php
}
?>

<script>
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
        overlay.className =
            'fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden hidden transition-opacity duration-300';
        document.body.appendChild(overlay);

        overlay.addEventListener('click', function() {
            toggleSidebar();
        });
    }

    return overlay;
}

// Initialize application
document.addEventListener('DOMContentLoaded', function() {
    // Initialize sidebar overlay
    initSidebarOverlay();
});
</script>
<script>
// Sidebar toggle functionality

document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const mainBody = document.getElementById('main-body');
    const toggleBtn = document.getElementById('toggle-sidebar');
    const closeBtn = document.getElementById('close-sidebar');
    const profileBtn = document.getElementById('profile-button');
    const profileDropdown = document.getElementById('profile-dropdown');

    // Initialize overlay
    const overlay = initSidebarOverlay();

    // Sidebar toggle button event
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            toggleSidebar();
        });
    }

    // Close button event
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            toggleSidebar();
        });
    }

    // Profile dropdown functionality
    if (profileBtn && profileDropdown) {
        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            profileDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!profileDropdown.contains(e.target) && e.target !== profileBtn) {
                profileDropdown.classList.add('hidden');
            }
        });
    } // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth < 768) { // Only on mobile
            const overlay = document.getElementById('sidebar-overlay');
            if (!sidebar.contains(e.target) && e.target !== toggleBtn && !toggleBtn.contains(e
                    .target)) {
                if (!sidebar.classList.contains('-translate-x-full')) {
                    toggleSidebar();
                    overlay.classList.add('hidden');
                }
            }
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        const overlay = document.getElementById('sidebar-overlay');
        if (window.innerWidth >= 768) {
            mainBody.classList.remove('sidebar-open');
            overlay.classList.add('hidden');
        }
    });
});
</script>