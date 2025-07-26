<?php
// Start session
session_start();

// In production, check if collector is logged in
// if (!isset($_SESSION['collector_id'])) {
//     header('Location: ../login/index.php');
//     exit();
// }

// Dummy data for collector
$collector = [
    'id' => 'COL-2023-001',
    'name' => 'Gilbert Elikplim Kukah',
    'email' => 'kwamegilbert1114@gmail.com',
    'phone' => '0244123456',
    'role' => 'Field Collector',
    'zone' => 'Central Market',
    'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg',
    'last_active' => '2023-07-12 09:45:22'
];

// Dummy businesses data
$businesses = [
    [
        'id' => 'BUS-2023-001',
        'name' => 'Adwoa Grocery Shop',
        'owner' => 'Adwoa Mensah',
        'category' => 'Retail',
        'phone' => '0244111222',
        'location' => 'Central Market, Shop #45',
        'zone' => 'Central Market',
        'tax_balance' => 200.00,
        'taxes_due' => [
            ['id' => 'TAX-001', 'name' => 'Business Operating Permit', 'amount' => 200.00, 'due_date' => '2023-06-30'],
            ['id' => 'TAX-002', 'name' => 'Market Stall Fee', 'amount' => 50.00, 'due_date' => '2023-07-31']
        ],
        'last_payment' => '2022-06-15'
    ],
    [
        'id' => 'BUS-2023-002',
        'name' => 'Afia Restaurant',
        'owner' => 'Afia Owusu',
        'category' => 'Food & Beverage',
        'phone' => '0244333444',
        'location' => 'High Street, Building 12',
        'zone' => 'High Street',
        'tax_balance' => 150.00,
        'taxes_due' => [
            ['id' => 'TAX-004', 'name' => 'Food & Beverage License', 'amount' => 150.00, 'due_date' => '2023-08-15']
        ],
        'last_payment' => '2022-08-15'
    ],
    [
        'id' => 'BUS-2023-003',
        'name' => 'Ama Fashion Boutique',
        'owner' => 'Ama Darko',
        'category' => 'Clothing & Apparel',
        'phone' => '0244555666',
        'location' => 'Shopping Mall, Shop #23',
        'zone' => 'New Town',
        'tax_balance' => 75.00,
        'taxes_due' => [
            ['id' => 'TAX-003', 'name' => 'Signage Fee', 'amount' => 75.00, 'due_date' => '2023-07-15']
        ],
        'last_payment' => '2022-07-15'
    ],
    [
        'id' => 'BUS-2023-004',
        'name' => 'Kofi Auto Repairs',
        'owner' => 'Kofi Boateng',
        'category' => 'Automotive',
        'phone' => '0244777888',
        'location' => 'Mechanic Lane, Building 5',
        'zone' => 'Industrial Zone',
        'tax_balance' => 250.00,
        'taxes_due' => [
            ['id' => 'TAX-001', 'name' => 'Business Operating Permit', 'amount' => 200.00, 'due_date' => '2023-06-30'],
            ['id' => 'TAX-005', 'name' => 'Environmental Health Permit', 'amount' => 50.00, 'due_date' => '2023-06-30']
        ],
        'last_payment' => '2022-06-15'
    ],
    [
        'id' => 'BUS-2023-005',
        'name' => 'Yaw Pharmacy',
        'owner' => 'Yaw Opoku',
        'category' => 'Healthcare',
        'phone' => '0244999000',
        'location' => 'Medical Street, Building 8',
        'zone' => 'High Street',
        'tax_balance' => 300.00,
        'taxes_due' => [
            ['id' => 'TAX-001', 'name' => 'Business Operating Permit', 'amount' => 200.00, 'due_date' => '2023-06-30'],
            ['id' => 'TAX-005', 'name' => 'Healthcare License', 'amount' => 100.00, 'due_date' => '2023-06-30']
        ],
        'last_payment' => '2022-06-15'
    ],
    [
        'id' => 'BUS-2023-006',
        'name' => 'Kwame Electronics',
        'owner' => 'Kwame Asante',
        'category' => 'Electronics',
        'phone' => '0244222333',
        'location' => 'Tech Avenue, Shop #12',
        'zone' => 'New Town',
        'tax_balance' => 200.00,
        'taxes_due' => [
            ['id' => 'TAX-001', 'name' => 'Business Operating Permit', 'amount' => 200.00, 'due_date' => '2023-06-30']
        ],
        'last_payment' => '2022-06-15'
    ],
    [
        'id' => 'BUS-2023-007',
        'name' => 'Abena Fabrics',
        'owner' => 'Abena Mensah',
        'category' => 'Textiles',
        'phone' => '0244444555',
        'location' => 'Central Market, Stall #78',
        'zone' => 'Central Market',
        'tax_balance' => 100.00,
        'taxes_due' => [
            ['id' => 'TAX-002', 'name' => 'Market Stall Fee', 'amount' => 50.00, 'due_date' => '2023-07-31'],
            ['id' => 'TAX-003', 'name' => 'Signage Fee', 'amount' => 50.00, 'due_date' => '2023-07-15']
        ],
        'last_payment' => '2022-07-15'
    ],
    [
        'id' => 'BUS-2023-008',
        'name' => 'Kwesi Auto Parts',
        'owner' => 'Kwesi Osei',
        'category' => 'Automotive',
        'phone' => '0244666777',
        'location' => 'Industrial Zone, Block C',
        'zone' => 'Industrial Zone',
        'tax_balance' => 200.00,
        'taxes_due' => [
            ['id' => 'TAX-001', 'name' => 'Business Operating Permit', 'amount' => 200.00, 'due_date' => '2023-06-30']
        ],
        'last_payment' => '2022-06-15'
    ],
    [
        'id' => 'BUS-2023-009',
        'name' => 'Akua Beauty Salon',
        'owner' => 'Akua Sarpong',
        'category' => 'Beauty & Wellness',
        'phone' => '0244888999',
        'location' => 'Fashion Street, Shop #34',
        'zone' => 'New Town',
        'tax_balance' => 250.00,
        'taxes_due' => [
            ['id' => 'TAX-001', 'name' => 'Business Operating Permit', 'amount' => 200.00, 'due_date' => '2023-06-30'],
            ['id' => 'TAX-005', 'name' => 'Environmental Health Permit', 'amount' => 50.00, 'due_date' => '2023-06-30']
        ],
        'last_payment' => '2022-06-15'
    ],
    [
        'id' => 'BUS-2023-010',
        'name' => 'Kojo Hardware Store',
        'owner' => 'Kojo Frimpong',
        'category' => 'Hardware',
        'phone' => '0244000111',
        'location' => 'Builder\'s Avenue, Shop #5',
        'zone' => 'Industrial Zone',
        'tax_balance' => 200.00,
        'taxes_due' => [
            ['id' => 'TAX-001', 'name' => 'Business Operating Permit', 'amount' => 200.00, 'due_date' => '2023-06-30']
        ],
        'last_payment' => '2022-06-15'
    ]
];

// Categories filter
$categories = [
    'All Categories',
    'Retail',
    'Food & Beverage',
    'Clothing & Apparel',
    'Automotive',
    'Healthcare',
    'Electronics',
    'Textiles',
    'Beauty & Wellness',
    'Hardware'
];

// Zones filter
$zones = [
    'All Zones',
    'Central Market',
    'High Street',
    'New Town',
    'Industrial Zone'
];

// Helper functions
function formatCurrency($amount) {
    return 'GHS ' . number_format($amount, 2);
}

function getStatusClass($dueDate) {
    $due = strtotime($dueDate);
    $now = time();
    $thirtyDays = 30 * 24 * 60 * 60;
    
    if ($now > $due) {
        return 'bg-red-100 text-red-800'; // Overdue
    } elseif ($now + $thirtyDays > $due) {
        return 'bg-yellow-100 text-yellow-800'; // Due soon
    } else {
        return 'bg-green-100 text-green-800'; // Upcoming
    }
}

function getStatusText($dueDate) {
    $due = strtotime($dueDate);
    $now = time();
    
    if ($now > $due) {
        $days = floor(($now - $due) / (24 * 60 * 60));
        return "Overdue by {$days} days";
    } else {
        $days = floor(($due - $now) / (24 * 60 * 60));
        return "Due in {$days} days";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Businesses | Sefwi Tax Collection</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <script>
    // Custom Tailwind configuration
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: {
                        50: '#f0fdf4',
                        100: '#dcfce7',
                        200: '#bbf7d0',
                        300: '#86efac',
                        400: '#4ade80',
                        500: '#22c55e',
                        600: '#16a34a',
                        700: '#15803d',
                        800: '#166534',
                        900: '#14532d',
                    }
                }
            }
        }
    };
    </script>

    <style>
    /* Custom scrollbar styles */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Card hover effect */
    .business-card {
        transition: all 0.3s ease;
    }

    .business-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    /* Pulse animation for scan button */
    .pulse-button {
        position: relative;
    }

    .pulse-button::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: inherit;
        box-shadow: 0 0 0 0 rgba(22, 163, 74, 0.7);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(22, 163, 74, 0.7);
        }

        70% {
            transform: scale(1);
            box-shadow: 0 0 0 10px rgba(22, 163, 74, 0);
        }

        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(22, 163, 74, 0);
        }
    }

    /* Filter tags */
    .filter-tag {
        transition: all 0.2s ease;
    }

    .filter-tag:hover {
        transform: translateY(-2px);
    }

    .filter-tag.active {
        background-color: #16a34a;
        color: white;
    }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <?php require_once __DIR__ . '/../components/sidebar.php'; ?>

    <!-- Main Content -->
    <main class="md:ml-64 min-h-screen">
        <?php require_once __DIR__ . '/../components/header.php'; ?>

        <!-- Main Content -->
        <div class="px-4 py-6">
            <!-- Page Title -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Search Businesses</h1>
                <p class="text-gray-600">Find businesses to collect taxes from</p>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
                <!-- Search Bar -->
                <div class="flex flex-col md:flex-row md:items-center mb-4">
                    <div class="relative flex-grow mb-3 md:mb-0 md:mr-4">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-search-line text-gray-400"></i>
                        </div>
                        <input type="text" id="business-search"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Search by business name, owner, ID...">
                    </div>
                    <div class="flex space-x-2">
                        <button id="scan-qr"
                            class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 pulse-button flex items-center">
                            <i class="ri-qr-scan-line mr-2"></i>
                            Scan QR Code
                        </button>
                        <button id="filter-toggle"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 flex items-center">
                            <i class="ri-filter-3-line mr-2"></i>
                            Filters
                        </button>
                    </div>
                </div>

                <!-- Advanced Filters (Hidden by default) -->
                <div id="advanced-filters" class="hidden pt-4 border-t border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <!-- Category Filter -->
                        <div>
                            <label for="category-filter" class="block text-sm font-medium text-gray-700 mb-1">Business
                                Category</label>
                            <select id="category-filter"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Zone Filter -->
                        <div>
                            <label for="zone-filter" class="block text-sm font-medium text-gray-700 mb-1">Zone</label>
                            <select id="zone-filter"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                <?php foreach($zones as $zone): ?>
                                <option value="<?php echo $zone; ?>"><?php echo $zone; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Tax Status Filter -->
                        <div>
                            <label for="tax-status-filter" class="block text-sm font-medium text-gray-700 mb-1">Tax
                                Status</label>
                            <select id="tax-status-filter"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                <option value="all">All Statuses</option>
                                <option value="overdue">Overdue</option>
                                <option value="due-soon">Due Soon</option>
                                <option value="paid">Up to Date</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button id="reset-filters"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg mr-2 hover:bg-gray-100">
                            Reset
                        </button>
                        <button id="apply-filters"
                            class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quick Filter Tags -->
            <div class="flex flex-wrap gap-2 mb-6">
                <button
                    class="filter-tag px-3 py-1 rounded-full bg-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-300 active">
                    All Businesses
                </button>
                <button
                    class="filter-tag px-3 py-1 rounded-full bg-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-300">
                    <i class="ri-error-warning-line mr-1 text-red-500"></i> Overdue
                </button>
                <button
                    class="filter-tag px-3 py-1 rounded-full bg-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-300">
                    <i class="ri-time-line mr-1 text-yellow-500"></i> Due This Month
                </button>
                <button
                    class="filter-tag px-3 py-1 rounded-full bg-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-300">
                    <i class="ri-map-pin-line mr-1 text-blue-500"></i> Central Market
                </button>
                <button
                    class="filter-tag px-3 py-1 rounded-full bg-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-300">
                    <i class="ri-store-2-line mr-1 text-green-500"></i> Recently Added
                </button>
            </div>

            <!-- Business Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <?php foreach($businesses as $business): ?>
                <div class="business-card bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center">
                                <div
                                    class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mr-3">
                                    <i class="ri-store-2-line text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800"><?php echo $business['name']; ?></h3>
                                    <p class="text-sm text-gray-500"><?php echo $business['id']; ?></p>
                                </div>
                            </div>
                            <div>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <?php echo $business['category']; ?>
                                </span>
                            </div>
                        </div>

                        <div class="space-y-2 mb-3">
                            <div class="flex items-start">
                                <i class="ri-user-line text-gray-400 mr-2 mt-0.5"></i>
                                <span class="text-sm text-gray-600"><?php echo $business['owner']; ?></span>
                            </div>
                            <div class="flex items-start">
                                <i class="ri-map-pin-line text-gray-400 mr-2 mt-0.5"></i>
                                <span class="text-sm text-gray-600"><?php echo $business['location']; ?></span>
                            </div>
                            <div class="flex items-start">
                                <i class="ri-phone-line text-gray-400 mr-2 mt-0.5"></i>
                                <span class="text-sm text-gray-600"><?php echo $business['phone']; ?></span>
                            </div>
                        </div>

                        <!-- Tax Summary -->
                        <div class="bg-gray-50 rounded-md p-3 mb-3">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-700">Total Due:</span>
                                <span
                                    class="text-lg font-bold text-primary-600"><?php echo formatCurrency($business['tax_balance']); ?></span>
                            </div>
                            <div class="space-y-1">
                                <?php foreach($business['taxes_due'] as $tax): ?>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500"><?php echo $tax['name']; ?></span>
                                    <div class="flex items-center">
                                        <span
                                            class="text-xs font-medium mr-2"><?php echo formatCurrency($tax['amount']); ?></span>
                                        <span
                                            class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium <?php echo getStatusClass($tax['due_date']); ?>">
                                            <?php echo getStatusText($tax['due_date']); ?>
                                        </span>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">Last payment:
                                <?php echo date('d M Y', strtotime($business['last_payment'])); ?></span>
                            <a href="../collect/index.php?business_id=<?php echo $business['id']; ?>"
                                class="px-3 py-1 bg-primary-600 text-white text-sm font-medium rounded-md hover:bg-primary-700 transition-colors">
                                Collect <i class="ri-arrow-right-line ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Quick Actions -->
            <div class="fixed bottom-6 right-6 flex flex-col space-y-2 md:hidden">
                <button id="mobile-scan-qr"
                    class="h-14 w-14 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-lg hover:bg-primary-700 pulse-button">
                    <i class="ri-qr-scan-line text-xl"></i>
                </button>
                <button id="mobile-add-business"
                    class="h-14 w-14 rounded-full bg-gray-800 text-white flex items-center justify-center shadow-lg hover:bg-gray-900">
                    <i class="ri-add-line text-xl"></i>
                </button>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-6">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span
                            class="font-medium">20</span> businesses
                    </p>
                </div>
                <div class="flex space-x-2 items-center">
                    <a href="#"
                        class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-100">
                        Previous
                    </a>
                    <span class="text-sm text-gray-500">Page 1 of 2</span>
                    <a href="#"
                        class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-100">
                        Next
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- QR Scan Modal (Hidden by default) -->
    <div id="qr-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
            <div class="p-4 border-b flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Scan Business QR Code</h3>
                <button id="close-qr-modal" class="text-gray-500 hover:text-gray-700">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            <div class="p-4">
                <div
                    class="bg-gray-100 rounded-lg aspect-square max-w-xs mx-auto mb-4 flex items-center justify-center">
                    <div class="text-center">
                        <i class="ri-qr-code-line text-5xl text-gray-400 mb-2"></i>
                        <p class="text-gray-500">Camera feed will appear here</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600 text-center mb-4">Position the QR code within the frame to scan</p>
                <div class="flex justify-center">
                    <button id="start-scan" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                        Start Camera
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle advanced filters
        document.getElementById('filter-toggle').addEventListener('click', function() {
            document.getElementById('advanced-filters').classList.toggle('hidden');
        });

        // Toggle filter tags
        document.querySelectorAll('.filter-tag').forEach(tag => {
            tag.addEventListener('click', function() {
                document.querySelectorAll('.filter-tag').forEach(t => t.classList.remove(
                    'active'));
                this.classList.add('active');
            });
        });

        // Search functionality
        document.getElementById('business-search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('.business-card').forEach(card => {
                const businessName = card.querySelector('h3').textContent.toLowerCase();
                const businessId = card.querySelector('h3 + p').textContent.toLowerCase();
                const businessOwner = card.querySelector('.ri-user-line + span').textContent
                    .toLowerCase();

                if (businessName.includes(searchTerm) || businessId.includes(searchTerm) ||
                    businessOwner.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Reset filters
        document.getElementById('reset-filters').addEventListener('click', function() {
            document.getElementById('category-filter').selectedIndex = 0;
            document.getElementById('zone-filter').selectedIndex = 0;
            document.getElementById('tax-status-filter').selectedIndex = 0;
        });

        // QR modal functionality
        const qrModal = document.getElementById('qr-modal');

        document.getElementById('scan-qr').addEventListener('click', function() {
            qrModal.classList.remove('hidden');
        });

        document.getElementById('mobile-scan-qr').addEventListener('click', function() {
            qrModal.classList.remove('hidden');
        });

        document.getElementById('close-qr-modal').addEventListener('click', function() {
            qrModal.classList.add('hidden');
        });

        document.getElementById('start-scan').addEventListener('click', function() {
            // In a real implementation, this would initialize the camera
            this.textContent = 'Scanning...';
            this.disabled = true;

            // Simulate finding a QR code after 3 seconds
            setTimeout(() => {
                qrModal.classList.add('hidden');

                // Reset button
                this.textContent = 'Start Camera';
                this.disabled = false;

                // Redirect to the first business
                window.location.href = '../collect/index.php?business_id=BUS-2023-001';
            }, 3000);
        });

        // Close modal when clicking outside
        qrModal.addEventListener('click', function(e) {
            if (e.target === qrModal) {
                qrModal.classList.add('hidden');
            }
        });
    });
    </script>
</body>

</html>