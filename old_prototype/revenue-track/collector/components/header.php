  <!-- Top Header -->
  <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
      <div class="flex items-center justify-between px-4 h-16">
          <!-- Mobile Menu Toggle -->
          <button id="menu-toggle" class="md:hidden text-gray-500 hover:text-gray-700">
              <i class="ri-menu-line text-2xl"></i>
          </button>

          <!-- Search Bar -->
          <div class="hidden md:flex md:flex-1 md:max-w-md mx-4">
              <div class="relative w-full">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <i class="ri-search-line text-gray-400"></i>
                  </div>
                  <input type="text"
                      class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                      placeholder="Search for a business...">
              </div>
          </div>

          <!-- Right Header Elements -->
          <div class="flex items-center">
              <!-- Help Button -->
              <button class="p-2 text-gray-500 hover:text-gray-700 relative">
                  <i class="ri-question-line text-xl"></i>
              </button>

              <!-- Notification Button -->
              <button class="p-2 text-gray-500 hover:text-gray-700 relative bell-animation">
                  <i class="ri-notification-3-line text-xl"></i>
                  <span class="absolute top-1 right-1 h-2 w-2 bg-red-500 rounded-full"></span>
              </button>

              <!-- Profile Dropdown -->
              <div class="relative ml-3">
                  <button id="profile-menu-button"
                      class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                      <img class="h-8 w-8 rounded-full object-cover" src="<?php echo $collector['avatar']; ?>"
                          alt="<?php echo $collector['name']; ?>">
                  </button>
                  <!-- Profile dropdown menu - hidden by default -->
                  <div id="profile-dropdown"
                      class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden">
                      <div class="py-1">
                          <a href="../settings/index.php"
                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                          <a href="../settings/index.php?tab=settings"
                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                          <a href="../login/logout.php"
                              class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Sign Out</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </header>

  <script>
// Toggle profile dropdown
document.getElementById('profile-menu-button').addEventListener('click', function() {
    document.getElementById('profile-dropdown').classList.toggle('hidden');
});

// Toggle mobile menu
document.getElementById('menu-toggle').addEventListener('click', function() {
    document.getElementById('mobile-menu').classList.toggle('-translate-x-full');
    document.getElementById('backdrop').classList.toggle('hidden');
});


// Close profile dropdown when clicking elsewhere
document.addEventListener('click', function(event) {
    const profileButton = document.getElementById('profile-menu-button');
    const profileDropdown = document.getElementById('profile-dropdown');

    if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
        profileDropdown.classList.add('hidden');
    }
});
  </script>