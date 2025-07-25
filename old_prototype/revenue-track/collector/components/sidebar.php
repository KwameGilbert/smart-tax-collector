<!-- Mobile menu backdrop -->
<div id="backdrop"
    class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 hidden md:hidden transition-opacity duration-300"></div>

<!-- Mobile Menu Sidebar -->
<div id="mobile-menu"
    class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg z-30 transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden">
    <div class="p-4 border-b flex items-center justify-between">
        <div class="flex items-center">
            <div class="h-8 w-8 rounded-full bg-primary-600 flex items-center justify-center text-white">
                <i class="ri-government-line text-lg"></i>
            </div>
            <h2 class="ml-3 text-lg font-semibold text-gray-800">Sefwi Collection</h2>
        </div>
        <button id="close-menu" class="text-gray-500 hover:text-gray-700">
            <i class="ri-close-line text-2xl"></i>
        </button>
    </div>

    <!-- Mobile menu content -->
    <div class="p-4 flex flex-col h-[calc(100%-64px)]">
        <div class="mb-4">
            <div class="flex items-center mb-3">
                <img src="<?php echo $collector['avatar']; ?>" alt="<?php echo $collector['name']; ?>"
                    class="h-10 w-10 rounded-full object-cover">
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-800"><?php echo $collector['name']; ?></p>
                    <p class="text-xs text-gray-500"><?php echo $collector['role']; ?></p>
                </div>
            </div>
        </div>

        <nav class="space-y-1 mb-6">
            <a href="#" class="flex items-center px-4 py-2.5 text-primary-600 bg-primary-50 rounded-md font-medium">
                <i class="ri-dashboard-line mr-3 text-lg"></i>
                Dashboard
            </a>
            <a href="../search/index.php"
                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-md">
                <i class="ri-search-line mr-3 text-lg"></i>
                Search Business
            </a>
            <a href="../collections/index.php"
                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-md">
                <i class="ri-money-dollar-circle-line mr-3 text-lg"></i>
                My Collections
            </a>
            <a href="../performance/index.php"
                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-md">
                <i class="ri-bar-chart-line mr-3 text-lg"></i>
                Performance
            </a>
            <a href="../settings/index.php"
                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-md">
                <i class="ri-settings-3-line mr-3 text-lg"></i>
                Settings
            </a>
        </nav>

        <div class="border-t pt-4 mt-auto">
            <a href="../login/logout.php" class="flex items-center px-4 py-2.5 text-red-600 hover:bg-red-50 rounded-md">
                <i class="ri-logout-box-r-line mr-3 text-lg"></i>
                Sign Out
            </a>

            <!-- Developer Credit - Mobile -->
            <div class="text-center py-2 mt-4 text-xs text-gray-500">
                <span>Developed by</span>
                <a href="tel:+233541436414" class="mx-1 font-medium inline-flex items-center group">
                    <span class="text-primary-600 group-hover:text-primary-700 transition-colors">Gilbert Elikplim
                        Kukah</span>
                    <i class="ri-arrow-right-up-line ml-0.5 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </a>
                <span class="px-1 text-gray-300">|</span>
                <a href="tel:+233541436414" class="hover:text-primary-600 transition-colors">0541436414</a>
            </div>
        </div>
    </div>
</div>

<!-- Desktop Sidebar -->
<aside class="fixed inset-y-0 left-0 hidden md:flex md:flex-col w-64 border-r border-gray-200 bg-white z-10">
    <div class="p-4 border-b flex items-center">
        <div class="h-8 w-8 rounded-full bg-primary-600 flex items-center justify-center text-white">
            <i class="ri-government-line text-lg"></i>
        </div>
        <h2 class="ml-3 text-lg font-semibold text-gray-800">Sefwi Collection</h2>
    </div>

    <div class="flex-1 flex flex-col overflow-y-auto">
        <div class="p-4 border-b">
            <div class="flex items-center">
                <img src="<?php echo $collector['avatar']; ?>" alt="<?php echo $collector['name']; ?>"
                    class="h-10 w-10 rounded-full object-cover">
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-800"><?php echo $collector['name']; ?></p>
                    <p class="text-xs text-gray-500"><?php echo $collector['role']; ?></p>
                </div>
            </div>
        </div>

        <nav class="flex-1 p-4 space-y-1">
            <a href="../dashboard/index.php"
                class="flex items-center px-4 py-2.5 text-primary-600 bg-primary-50 rounded-md font-medium">
                <i class="ri-dashboard-line mr-3 text-lg"></i>
                Dashboard
            </a>
            <a href="../search/index.php"
                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-md">
                <i class="ri-search-line mr-3 text-lg"></i>
                Search Business
            </a>
            <a href="../collections/index.php"
                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-md">
                <i class="ri-money-dollar-circle-line mr-3 text-lg"></i>
                My Collections
            </a>
            <a href="../performance/index.php"
                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-md">
                <i class="ri-bar-chart-line mr-3 text-lg"></i>
                Performance
            </a>
            <a href="../settings/index.php"
                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-md">
                <i class="ri-settings-3-line mr-3 text-lg"></i>
                Settings
            </a>
        </nav>

        <div class="p-4 border-t mt-auto">
            <a href="../login/logout.php" class="flex items-center px-4 py-2.5 text-red-600 hover:bg-red-50 rounded-md">
                <i class="ri-logout-box-r-line mr-3 text-lg"></i>
                Sign Out
            </a>

            <!-- Developer Credit - Desktop -->
            <div class="text-center py-2 mt-4 text-xs text-gray-500">
                <span>Developed by</span>
                <a href="tel:+233541436414" class="mx-1 font-medium inline-flex items-center group">
                    <span class="text-primary-600 group-hover:text-primary-700 transition-colors">Gilbert Elikplim
                        Kukah</span>
                    <i class="ri-arrow-right-up-line ml-0.5 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </a>
                <span class="px-1 text-gray-300">|</span>
                <a href="tel:+233541436414" class="hover:text-primary-600 transition-colors">0541436414</a>
            </div>
        </div>
    </div>
</aside>

<script>
document.getElementById('close-menu').addEventListener('click', function() {
    document.getElementById('mobile-menu').classList.add('-translate-x-full');
    document.getElementById('backdrop').classList.add('hidden');
});

document.getElementById('backdrop').addEventListener('click', function() {
    document.getElementById('mobile-menu').classList.add('-translate-x-full');
    document.getElementById('backdrop').classList.add('hidden');
});
</script>