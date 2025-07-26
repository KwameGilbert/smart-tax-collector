<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finance Department Login</title>
  <link rel="stylesheet" href="../../../src/output.css">
  <!-- Remix Icon -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    .login-background {
      background-image: url('https://images.pexels.com/photos/164527/pexels-photo-164527.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
      background-size: cover;
      background-position: center;
    }

    /* Loading animation */
    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    .loader {
      border-radius: 50%;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-top-color: white;
      animation: spin 1s linear infinite;
    }

    /* Fade in/out animation for alerts */
    .alert-fade-in {
      animation: fadeIn 0.3s ease-in-out forwards;
    }

    .alert-fade-out {
      animation: fadeOut 0.3s ease-in-out forwards;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeOut {
      from {
        opacity: 1;
        transform: translateY(0);
      }

      to {
        opacity: 0;
        transform: translateY(-10px);
      }
    }
  </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
  <div class="flex flex-1 min-h-full">
    <!-- Left side - Login Form -->
    <div class="flex flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 w-full lg:w-1/2">
      <div class="mx-auto w-full max-w-sm lg:w-96">
        <div class="mb-10">
          <img src="../../assets/images/logo.png" alt="Sefwi Tax Collection" class="h-12 w-auto">
          <h2 class="mt-8 text-2xl font-bold leading-9 text-gray-900">Finance Department Portal</h2>
          <p class="mt-2 text-sm leading-6 text-gray-500">
            Access your financial management dashboard
          </p>
        </div>

        <div id="alert-container" class="mb-6" style="display: none;">
          <!-- Dynamic alerts will be inserted here -->
        </div>

        <div class="mt-4">
          <form id="login-form" class="space-y-6">
            <div>
              <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                address</label>
              <div class="mt-2">
                <input id="email" name="email" type="email" autocomplete="email" required
                  class="block w-full rounded-md border-0 py-1.5 px-3 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
              </div>
            </div>

            <div>
              <div class="flex items-center justify-between">
                <label for="password"
                  class="block text-sm font-medium leading-6 text-gray-900">Password</label>
              </div>
              <div class="mt-2">
                <input id="password" name="password" type="password" autocomplete="current-password"
                  required
                  class="block w-full rounded-md border-0 py-1.5 px-3 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
              </div>
            </div>
            <div class="text-sm flex items-center justify-end">
              <a href="#" class="font-semibold text-blue-600 hover:text-blue-500">Forgot
                password?</a>
            </div>

            <div>
              <button type="submit" id="login-button"
                class="flex w-full justify-center items-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                <span id="button-text">Login</span>
                <span id="button-loader" class="loader w-4 h-4 ml-2" style="display: none;"></span>
              </button>
            </div>
            <div>
              <p class="text-center text-sm flex flex-col">For technical support and access issues?<a href="tel:+233541436414" class="text-blue-600">Contact the system administrator</a></p>
            </div>
          </form>
        </div>
      </div> <!-- Footer -->
      <footer class="bg-white py-4 border-t border-gray-200 mt-auto">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <p class="text-center text-xs text-gray-500">
            &copy; 2025 Sefwi Municipality Tax Collection System. All rights reserved.
          </p>
          <div class="text-center py-2 text-xs text-gray-500">
            <span>Developed by</span>
            <a href="tel:+233541436414" class="mx-1 font-medium inline-flex items-center group">
              <span class="text-blue-600 group-hover:text-blue-800 transition-colors">Gilbert Elikplim
                Kukah</span>
              <i
                class="ri-arrow-right-up-line ml-0.5 opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>
            <span class="px-1 text-gray-300">|</span>
            <a href="tel:+233541436414" class="hover:text-blue-600 transition-colors">0541436414</a>
          </div>
        </div>
      </footer>
    </div>

    <!-- Right side - Image -->
    <div class="hidden lg:block relative w-0 flex-1 login-background">
      <div class="absolute inset-0 bg-gradient-to-r from-blue-800 to-blue-900 opacity-60"></div>
      <div class="absolute inset-0 flex flex-col justify-center items-center p-8 text-white">
        <div class="bg-black/40 p-8 rounded-lg max-w-md text-center">
          <h2 class="text-3xl font-bold mb-4">Finance Management Portal</h2>
          <p class="mb-6">Access financial reports, manage tax configurations, and monitor revenue collection
            for Sefwi Municipality.</p>
          <div class="flex justify-center space-x-6 items-center">
            <div class="text-center">
              <div class="text-3xl font-bold">GHS 2.4M</div>
              <div class="text-sm opacity-80">Revenue Target</div>
            </div>
            <div class="h-12 border-r border-white opacity-30"></div>
            <div class="text-center">
              <div class="text-3xl font-bold">1,450+</div>
              <div class="text-sm opacity-80">Taxpayers</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const loginForm = document.getElementById('login-form');
      const loginButton = document.getElementById('login-button');
      const buttonText = document.getElementById('button-text');
      const buttonLoader = document.getElementById('button-loader');
      const alertContainer = document.getElementById('alert-container');

      loginForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Show loading state
        buttonText.textContent = 'Signing in...';
        buttonLoader.style.display = 'inline-block';
        loginButton.disabled = true;

        // Clear previous alerts
        alertContainer.innerHTML = '';
        alertContainer.style.display = 'none';

        // Get form data
        const formData = new FormData(loginForm);

        // Make API request
        fetch('', {
            method: 'POST',
            body: formData,
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // Show success message
              showAlert('success', data.message);

              // Redirect after a short delay
              setTimeout(() => {
                window.location.href = data.redirect;
              }, 1000);
            } else {
              // Show error message
              showAlert('error', data.message);

              // Reset button state
              buttonText.textContent = 'Sign in';
              buttonLoader.style.display = 'none';
              loginButton.disabled = false;
            }
          })
          .catch(error => {
            // Handle network or other errors
            showAlert('error', 'Network error. Please try again.');

            // Reset button state
            buttonText.textContent = 'Sign in';
            buttonLoader.style.display = 'none';
            loginButton.disabled = false;
          });
      });

      // Function to show alerts
      function showAlert(type, message) {
        const alertClass = type === 'error' ?
          'bg-red-50 text-red-800' :
          'bg-green-50 text-green-800';

        const iconClass = type === 'error' ?
          'ri-alert-line text-red-400' :
          'ri-check-line text-green-400';

        const alertHTML = `
                <div class="rounded-md ${alertClass} p-4 alert-fade-in">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="${iconClass} text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">${message}</p>
                        </div>
                    </div>
                </div>
            `;

        alertContainer.innerHTML = alertHTML;
        alertContainer.style.display = 'block';
      }
    });
  </script>
</body>

</html>