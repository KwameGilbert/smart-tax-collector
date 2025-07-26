<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sefwi Municipal Tax Collection System</title>
    <link rel="stylesheet" href="./src/output.css" />

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
     <!-- Remix Icon -->
     <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script>
      // Custom Tailwind configuration
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              collector: {
                light: "#22c55e",
                DEFAULT: "#16a34a",
                dark: "#15803d",
              },
              finance: {
                light: "#3b82f6",
                DEFAULT: "#2563eb",
                dark: "#1d4ed8",
              },
              accent: {
                purple: "#8b5cf6",
                orange: "#f59e0b",
                pink: "#ec4899",
                teal: "#14b8a6",
              },
            },
            fontFamily: {
              sans: ["Poppins", "sans-serif"],
            },
          },
        },
      };
    </script>
    <style>
      body {
        font-family: "Poppins", sans-serif;
        background: linear-gradient(135deg, #f0fdf4 0%, #eff6ff 50%, #F3E9F6FF 100%);
      }

      .card {
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        background: white;
        border-radius: 16px;
        overflow: hidden;
      }

      .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
      }

      .card-finance {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
      }

      .card-collector {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
      }
      .card-executives {
        background: linear-gradient(135deg, #FAF5FDFF 10%, #F5E6F9FF 100%);
      }

      .card-accent {
        height: 8px;
      }

      .blob {
        position: absolute;
        z-index: -1;
        border-radius: 50%;
        filter: blur(40px);
        opacity: 0.6;
      }

      .blob-1 {
        top: 10%;
        left: 10%;
        width: 300px;
        height: 300px;
        background: #f3d9fa;
        animation: float-slow 10s ease-in-out infinite;
      }

      .blob-2 {
        bottom: 10%;
        right: 10%;
        width: 250px;
        height: 250px;
        background: rgba(37, 99, 235, 0.2);
        animation: float-slow 12s ease-in-out infinite reverse;
      }

      .blob-3 {
        top: 50%;
        right: 20%;
        width: 200px;
        height: 200px;
        background: rgba(245, 158, 11, 0.15);
        animation: float-slow 8s ease-in-out infinite;
      }

      .blob-4 {
        bottom: 20%;
        left: 15%;
        width: 180px;
        height: 180px;
        background: rgba(139, 92, 246, 0.15);
        animation: float-slow 9s ease-in-out infinite reverse;
      }
      .blob-5 {
        top: 2%;
        right: 5%;
        width: 280px;
        height: 280px;
        background: rgba(22, 163, 74, 0.2);
        animation: float-slow 9s ease-in-out infinite reverse;
      }

      @keyframes float-slow {
        0%,
        100% {
          transform: translate(0, 0);
        }

        50% {
          transform: translate(10px, 15px);
        }
      }

      .dashboard-icon {
        font-size: 2.5rem;
        transform-origin: center;
        transition: all 0.3s ease;
      }

      .card:hover .dashboard-icon {
        transform: scale(1.2);
      }

      .enter-arrow {
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateX(-10px);
      }

      .card:hover .enter-arrow {
        opacity: 1;
        transform: translateX(0);
      }

      .pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
      }

      @keyframes pulse {
        0%,
        100% {
          opacity: 1;
        }

        50% {
          opacity: 0.7;
        }
      }
    </style>
  </head>
  <body class="min-h-screen flex flex-col">
    <!-- Background Blobs -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
    <div class="blob blob-4"></div>
    <div class="blob blob-5"></div>

    <!-- Header -->
    <header class="py-6 px-8">
      <div class="flex justify-between items-center max-w-7xl mx-auto">
        <div class="flex items-center">
          <div class="bg-white rounded-full p-2 shadow-md">
            <img
              src="assets/logo.png"
              alt="Sefwi Municipality Logo"
              class="h-12 w-12"
            />
          </div>
          <div class="ml-4">
            <h1 class="text-2xl font-bold text-gray-800">Sefwi Municipal</h1>
            <p class="text-gray-600">Tax Collection System</p>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center px-3 md:px-8 py-12">
      <div class="w-full">
        <div class="text-center mb-12">
          <h2
            class="text-2xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-[#16a34a] to-[#2563eb] bg-clip-text text-transparent"
          >
            Welcome to Sefwi Tax Collection System
          </h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Select your dashboard to manage tax collections and municipal
            finances efficiently.
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-5 w-[100%]">
          <!-- Tax Collector Card -->
          <a href="collector/login/index.php" class="card card-collector group">
            <div
              class="card-accent bg-gradient-to-r from-[#22c55e] to-[#16a34a]"
            ></div>
            <div class="p-8">
              <div class="flex items-center justify-between mb-6">
                <div
                  class="h-16 w-16 bg-[#22c55e]/20 rounded-full flex items-center justify-center text-[#16a34a]"
                >
                  <i class="ri-user-3-line dashboard-icon"></i>
                </div>
                <span
                  class="flex items-center text-[#16a34a] font-medium text-lg enter-arrow"
                >
                  Enter <i class="ri-arrow-right-line ml-2"></i>
                </span>
              </div>
              <h3
                class="text-2xl font-semibold text-gray-800 mb-2 group-hover:text-[#16a34a] transition-colors"
              >
                Tax Collector
              </h3>
              <p class="text-gray-600 mb-6">
                Record tax collections, issue receipts, and manage your assigned
                zones and businesses.
              </p>
              <div class="flex flex-wrap gap-2">
                <span
                  class="px-3 py-1 bg-[#22c55e]/10 text-[#16a34a] rounded-full text-xs"
                >
                  <i class="ri-money-dollar-box-line mr-1"></i> Collect Payments
                </span>
                <span
                  class="px-3 py-1 bg-[#22c55e]/10 text-[#16a34a] rounded-full text-xs"
                >
                  <i class="ri-file-list-3-line mr-1"></i> Issue Receipts
                </span>
                <span
                  class="px-3 py-1 bg-[#22c55e]/10 text-[#16a34a] rounded-full text-xs"
                >
                  <i class="ri-store-2-line mr-1"></i> Manage Businesses
                </span>
              </div>
            </div>
          </a>

          <!-- Finance Department Card -->
          <a href="./public/finance/login/index.php" class="card card-finance group">
            <div
              class="card-accent bg-gradient-to-r from-[#3b82f6] to-[#2563eb]"
            ></div>
            <div class="p-8">
              <div class="flex items-center justify-between mb-6">
                <div
                  class="h-16 w-16 bg-[#3b82f6]/20 rounded-full flex items-center justify-center text-[#2563eb]"
                >
                  <i class="ri-bank-line dashboard-icon"></i>
                </div>
                <span
                  class="flex items-center text-[#2563eb] font-medium text-lg enter-arrow"
                >
                  Enter <i class="ri-arrow-right-line ml-2"></i>
                </span>
              </div>
              <h3
                class="text-2xl font-semibold text-gray-800 mb-2 group-hover:text-[#2563eb] transition-colors"
              >
                Finance Department
              </h3>
              <p class="text-gray-600 mb-6">
                Monitor tax collections, generate reports, and manage financial
                data and operations.
              </p>
              <div class="flex flex-wrap gap-2">
                <span
                  class="px-3 py-1 bg-[#3b82f6]/10 text-[#2563eb] rounded-full text-xs"
                >
                  <i class="ri-line-chart-line mr-1"></i> Financial Summary
                </span>
                <span
                  class="px-3 py-1 bg-[#3b82f6]/10 text-[#2563eb] rounded-full text-xs"
                >
                  <i class="ri-file-chart-line mr-1"></i> Export Data
                </span>
                <span
                  class="px-3 py-1 bg-[#3b82f6]/10 text-[#2563eb] rounded-full text-xs"
                >
                  <i class="ri-government-line mr-1"></i> Performance Analytics
                </span>
              </div>
            </div>
          </a>

           <!-- Executives (MCE, MP, Finance) Department Card -->
           <a href="finance/login/index.php" class="card card-executives group">
            <div
              class="card-accent bg-gradient-to-r from-purple-400 to-purple-500"
            ></div>
            <div class="p-8">
              <div class="flex items-center justify-between mb-6">
                <div
                  class="h-16 w-16 bg-purple-400/20 rounded-full flex items-center justify-center text-purple-500"
                >
                <i class="ri-admin-line dashboard-icon"></i>
                </div>
                <span
                  class="flex items-center text-purple-500 font-medium text-lg enter-arrow"
                >
                  Enter <i class="ri-arrow-right-line ml-2"></i>
                </span>
              </div>
              <h3
                class="text-2xl font-semibold text-gray-800 mb-2 group-hover:text-purple-500 transition-colors"
              >
                Executive Department
              </h3>
              <p class="text-gray-600 mb-6">
              The Executive Dashboard displays key financial metrics with quick export options.
              </p>
              <div class="flex flex-wrap gap-2">
                <span
                  class="px-3 py-1 bg-purple-400/10 text-purple-500 rounded-full text-xs"
                >
                  <i class="ri-line-chart-line mr-1"></i> View Analytics
                </span>
                <span
                  class="px-3 py-1 bg-purple-400/10 text-purple-500 rounded-full text-xs"
                >
                  <i class="ri-file-chart-line mr-1"></i> Generate Reports
                </span>
                <span
                  class="px-3 py-1 bg-purple-400/10 text-purple-500 rounded-full text-xs"
                >
                  <i class="ri-government-line mr-1"></i> Manage Tax Types
                </span>
              </div>
            </div>
          </a>
        </div>

        <!-- Additional Resources -->
        <!-- <div class="mt-16 max-w-5xl mx-auto">
          <h3 class="text-xl font-semibold text-gray-800 mb-6 text-center">
            Additional Resources
          </h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a
              href="#"
              class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow flex items-center"
            >
              <div
                class="h-10 w-10 bg-accent-purple/20 rounded-full flex items-center justify-center text-accent-purple mr-3"
              >
                <i class="ri-book-open-line"></i>
              </div>
              <span class="text-gray-700">User Guide</span>
            </a>
            <a
              href="#"
              class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow flex items-center"
            >
              <div
                class="h-10 w-10 bg-accent-orange/20 rounded-full flex items-center justify-center text-accent-orange mr-3"
              >
                <i class="ri-video-line"></i>
              </div>
              <span class="text-gray-700">Tutorial Videos</span>
            </a>
            <a
              href="#"
              class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow flex items-center"
            >
              <div
                class="h-10 w-10 bg-accent-pink/20 rounded-full flex items-center justify-center text-accent-pink mr-3"
              >
                <i class="ri-question-line"></i>
              </div>
              <span class="text-gray-700">FAQ</span>
            </a>
            <a
              href="#"
              class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow flex items-center"
            >
              <div
                class="h-10 w-10 bg-accent-teal/20 rounded-full flex items-center justify-center text-accent-teal mr-3"
              >
                <i class="ri-customer-service-2-line"></i>
              </div>
              <span class="text-gray-700">Support</span>
            </a>
          </div>
        </div> -->
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-inner py-3 px-8 mt-">
      <div
        class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center"
      >
        <div class="text-center md:text-left mb-4 md:mb-0">
          <p class="text-gray-600">
            &copy;
            <?php echo date('Y'); ?>
            Sefwi Municipal Assembly. All rights reserved.
          </p>
          <div class="text-center py-2 text-xs text-gray-500">
            <span>Developed by</span>
            <a
              href="tel:+233541436414"
              class="mx-1 font-medium inline-flex items-center group"
            >
              <span
                class="text-collector group-hover:text-finance transition-colors"
                >Gilbert Elikplim Kukah</span
              >
              <i
                class="ri-arrow-right-up-line ml-0.5 opacity-0 group-hover:opacity-100 transition-opacity"
              ></i>
            </a>
            <span class="px-1 text-gray-300">|</span>
            <a
              href="tel:+233541436414"
              class="hover:text-collector transition-colors"
              >0541436414</a
            >
          </div>
        </div>
        <div class="flex space-x-4">
          <a href="#" class="text-gray-500 hover:text-gray-700">
            <i class="ri-facebook-fill"></i>
          </a>
          <a href="#" class="text-gray-500 hover:text-gray-700">
            <i class="ri-twitter-fill"></i>
          </a>
          <a href="#" class="text-gray-500 hover:text-gray-700">
            <i class="ri-instagram-fill"></i>
          </a>
          <a href="#" class="text-gray-500 hover:text-gray-700">
            <i class="ri-linkedin-fill"></i>
          </a>
        </div>
      </div>
    </footer>

    <script>
      // Simple animation for the blobs to make them more dynamic
      document.addEventListener("mousemove", function (e) {
        const blobs = document.querySelectorAll(".blob");
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;

        blobs.forEach((blob, index) => {
          const offsetX = (mouseX - 0.5) * (10 + index * 5);
          const offsetY = (mouseY - 0.5) * (10 + index * 5);
          blob.style.transform = `translate(${offsetX}px, ${offsetY}px)`;
        });
      });
    </script>
  </body>
</html>
