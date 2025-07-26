<?php
/**
 * Header Component
 * Displays the header section with title and profile dropdown
 * 
 * @param string $title Page title to display
 */

function renderHeader($title = 'Dashboard', $showDateFilter = false) {
?>
<div class="sticky top-0 z-40 flex justify-between items-center bg-white p-4 shadow-sm mb-0">
    <div class="flex items-center">
        <button id="toggle-sidebar" class="mr-4 block md:hidden bg-white p-2 rounded-md shadow">
            <i class="ri-menu-line text-xl"></i>
        </button>
        <h1 class="text-2xl font-bold"><?php echo $title; ?></h1>
    </div>

    <?php if ($showDateFilter): ?>
    <!-- Date Range Filter -->
    <div class="relative mx-4 flex-grow max-w-md">
        <button id="date-filter-button"
            class="flex items-center justify-between w-full md:w-64 px-4 py-2 text-sm bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none">
            <span id="selected-range-text">All Time</span>
            <i class="ri-calendar-line ml-2"></i>
        </button>

        <div id="date-filter-dropdown"
            class="absolute right-0 mt-1 w-64 bg-white rounded-md shadow-lg py-1 z-50 hidden">
            <button data-range="all"
                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active-filter">
                All Time
            </button>
            <button data-range="today" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Today
            </button>
            <button data-range="yesterday"
                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Yesterday
            </button>
            <button data-range="week" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Last 7 Days
            </button>
            <button data-range="month" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                This Month
            </button>
            <button data-range="quarter"
                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                This Quarter
            </button>
            <button data-range="half" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Last 6 Months
            </button>
            <button data-range="year" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                This Year
            </button>
        </div>
    </div>
    <?php endif; ?>

    <div class="flex items-center space-x-4">
        <!-- Profile dropdown -->
        <div class="relative">
            <button id="profile-button"
                class="flex items-center justify-center h-10 w-10 rounded-full bg-blue-100 hover:bg-blue-200 focus:outline-none transition-colors duration-150">
                <i class="ri-user-line text-blue-600"></i>
            </button>
            <div id="profile-dropdown"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden">
                <a href="../profile/index.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="ri-user-settings-line mr-2"></i>Profile
                </a>
                <a href="../settings/index.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="ri-settings-line mr-2"></i>Settings
                </a>
                <div class="border-t border-gray-100 my-1"></div>
                <a href="../../logout.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                    <i class="ri-logout-box-line mr-2"></i>Log Out
                </a>
            </div>
        </div>
    </div>
</div>
<?php
}
?>