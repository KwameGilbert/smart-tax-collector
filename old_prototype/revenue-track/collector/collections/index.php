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
    'name' => 'John Anane',
    'email' => 'john.anane@sefwi.gov.gh',
    'phone' => '0244123456',
    'role' => 'Field Collector',
    'zone' => 'Central Market',
    'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg',
    'last_active' => '2023-07-12 09:45:22'
];

// Dummy collections data with various statuses and payment methods
$collections = [
    [
        'id' => 'PAY-2023-1024',
        'business_id' => 'BUS-2023-001',
        'business_name' => 'Adwoa Grocery Shop',
        'business_owner' => 'Adwoa Mensah',
        'tax_type' => 'Business Operating Permit',
        'tax_id' => 'TAX-001',
        'amount' => 200.00,
        'date' => '2023-07-12 09:45:22',
        'payment_method' => 'Cash',
        'status' => 'completed',
        'receipt_number' => 'RCP-2023-5642',
        'location' => 'Central Market, Shop #45'
    ],
    [
        'id' => 'PAY-2023-1023',
        'business_id' => 'BUS-2023-002',
        'business_name' => 'Afia Restaurant',
        'business_owner' => 'Afia Owusu',
        'tax_type' => 'Food & Beverage License',
        'tax_id' => 'TAX-004',
        'amount' => 150.00,
        'date' => '2023-07-12 09:12:30',
        'payment_method' => 'Mobile Money',
        'status' => 'completed',
        'receipt_number' => 'RCP-2023-5641',
        'location' => 'High Street, Building 12'
    ],
    [
        'id' => 'PAY-2023-1022',
        'business_id' => 'BUS-2023-003',
        'business_name' => 'Ama Fashion Boutique',
        'business_owner' => 'Ama Darko',
        'tax_type' => 'Signage Fee',
        'tax_id' => 'TAX-003',
        'amount' => 75.00,
        'date' => '2023-07-12 08:54:15',
        'payment_method' => 'Cash',
        'status' => 'completed',
        'receipt_number' => 'RCP-2023-5640',
        'location' => 'Shopping Mall, Shop #23'
    ],
    [
        'id' => 'PAY-2023-1021',
        'business_id' => 'BUS-2023-004',
        'business_name' => 'Kofi Auto Repairs',
        'business_owner' => 'Kofi Boateng',
        'tax_type' => 'Business Operating Permit',
        'tax_id' => 'TAX-001',
        'amount' => 225.00,
        'date' => '2023-07-12 08:30:40',
        'payment_method' => 'Cash',
        'status' => 'completed',
        'receipt_number' => 'RCP-2023-5639',
        'location' => 'Mechanic Lane, Building 5'
    ],
    [
        'id' => 'PAY-2023-1020',
        'business_id' => 'BUS-2023-005',
        'business_name' => 'Yaw Pharmacy',
        'business_owner' => 'Yaw Opoku',
        'tax_type' => 'Healthcare License',
        'tax_id' => 'TAX-005',
        'amount' => 300.00,
        'date' => '2023-07-11 16:45:03',
        'payment_method' => 'Mobile Money',
        'status' => 'completed',
        'receipt_number' => 'RCP-2023-5638',
        'location' => 'Medical Street, Building 8'
    ],
    [
        'id' => 'PAY-2023-1019',
        'business_id' => 'BUS-2023-006',
        'business_name' => 'Kwame Electronics',
        'business_owner' => 'Kwame Asante',
        'tax_type' => 'Business Operating Permit',
        'tax_id' => 'TAX-001',
        'amount' => 200.00,
        'date' => '2023-07-11 15:20:18',
        'payment_method' => 'Card',
        'status' => 'completed',
        'receipt_number' => 'RCP-2023-5637',
        'location' => 'Tech Avenue, Shop #12'
    ],
    [
        'id' => 'PAY-2023-1018',
        'business_id' => 'BUS-2023-007',
        'business_name' => 'Abena Fabrics',
        'business_owner' => 'Abena Mensah',
        'tax_type' => 'Market Stall Fee',
        'tax_id' => 'TAX-002',
        'amount' => 50.00,
        'date' => '2023-07-11 14:05:22',
        'payment_method' => 'Cash',
        'status' => 'completed',
        'receipt_number' => 'RCP-2023-5636',
        'location' => 'Central Market, Stall #78'
    ],
    [
        'id' => 'PAY-2023-1017',
        'business_id' => 'BUS-2023-008',
        'business_name' => 'Kwesi Auto Parts',
        'business_owner' => 'Kwesi Osei',
        'tax_type' => 'Business Operating Permit',
        'tax_id' => 'TAX-001',
        'amount' => 200.00,
        'date' => '2023-07-11 11:30:45',
        'payment_method' => 'Mobile Money',
        'status' => 'completed',
        'receipt_number' => 'RCP-2023-5635',
        'location' => 'Industrial Zone, Block C'
    ],
    [
        'id' => 'PAY-2023-1016',
        'business_id' => 'BUS-2023-009',
        'business_name' => 'Akua Beauty Salon',
        'business_owner' => 'Akua Sarpong',
        'tax_type' => 'Business Operating Permit',
        'tax_id' => 'TAX-001',
        'amount' => 200.00,
        'date' => '2023-07-11 10:15:36',
        'payment_method' => 'Cash',
        'status' => 'completed',
        'receipt_number' => 'RCP-2023-5634',
        'location' => 'Fashion Street, Shop #34'
    ],
    [
        'id' => 'PAY-2023-1015',
        'business_id' => 'BUS-2023-010',
        'business_name' => 'Kojo Hardware Store',
        'business_owner' => 'Kojo Frimpong',
        'tax_type' => 'Signage Fee',
        'tax_id' => 'TAX-003',
        'amount' => 75.00,
        'date' => '2023-07-10 16:22:19',
        'payment_method' => 'Mobile Money',
        'status' => 'completed',
        'receipt_number' => 'RCP-2023-5633',
        'location' => 'Builder\'s Avenue, Shop #5'
    ]
];

// Collection summary statistics
$summary = [
    'today' => [
        'count' => 4,
        'amount' => 650.00
    ],
    'yesterday' => [
        'count' => 6,
        'amount' => 1025.00
    ],
    'week' => [
        'count' => 24,
        'amount' => 4250.00
    ],
    'month' => [
        'count' => 68,
        'amount' => 12350.00
    ],
    'by_method' => [
        'Cash' => 450.00,
        'Mobile Money' => 150.00,
        'Card' => 50.00
    ],
    'by_tax_type' => [
        'Business Operating Permit' => 625.00,
        'Food & Beverage License' => 150.00,
        'Signage Fee' => 75.00,
        'Market Stall Fee' => 50.00,
        'Healthcare License' => 0.00
    ]
];

// Filter for tax types
$tax_types = [
    ['id' => 'TAX-001', 'name' => 'Business Operating Permit'],
    ['id' => 'TAX-002', 'name' => 'Market Stall Fee'],
    ['id' => 'TAX-003', 'name' => 'Signage Fee'],
    ['id' => 'TAX-004', 'name' => 'Food & Beverage License'],
    ['id' => 'TAX-005', 'name' => 'Healthcare License']
];

// Filter for payment methods
$payment_methods = ['Cash', 'Mobile Money', 'Card'];

// Helper function to format currency
function formatCurrency($amount) {
    return 'GHS ' . number_format($amount, 2);
}

// Helper function to format date
function formatDate($dateString) {
    return date('d M, Y', strtotime($dateString));
}

// Helper function to format time
function formatTime($dateString) {
    return date('h:i A', strtotime($dateString));
}

// Helper function to get time ago
function timeAgo($dateString) {
    $timestamp = strtotime($dateString);
    $timeDiff = time() - $timestamp;
    
    if ($timeDiff < 60) {
        return 'Just now';
    } elseif ($timeDiff < 3600) {
        $minutes = floor($timeDiff / 60);
        return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
    } elseif ($timeDiff < 86400) {
        $hours = floor($timeDiff / 3600);
        return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
    } elseif ($timeDiff < 604800) {
        $days = floor($timeDiff / 86400);
        return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
    } else {
        return formatDate($dateString);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Collections | Sefwi Tax Collection</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                    },
                    secondary: {
                        50: '#eff6ff',
                        100: '#dbeafe',
                        200: '#bfdbfe',
                        300: '#93c5fd',
                        400: '#60a5fa',
                        500: '#3b82f6',
                        600: '#2563eb',
                        700: '#1d4ed8',
                        800: '#1e40af',
                        900: '#1e3a8a',
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
    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    /* Progress bar animation */
    @keyframes progressFill {
        from {
            width: 0;
        }

        to {
            width: var(--progress-value);
        }
    }

    .progress-bar {
        animation: progressFill 1s ease-out forwards;
    }

    /* Date range picker custom styling */
    .date-range-input {
        position: relative;
    }

    .date-range-input:focus-within {
        border-color: #16a34a;
        box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
    }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <?php require_once __DIR__ . '/../components/sidebar.php'; ?>

    <!-- Main Content -->
    <main class="md:ml-64 min-h-screen">
        <?php require_once __DIR__ . '/../components/header.php'; ?>

        <!-- Main Collections Content -->
        <div class="px-4 py-6">
            <!-- Page Title -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">My Collections</h1>
                <p class="text-gray-600">View and manage your tax collection history</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Today's Collection Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Today</p>
                            <p class="text-2xl font-bold text-gray-800">
                                <?php echo formatCurrency($summary['today']['amount']); ?></p>
                        </div>
                        <div
                            class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600">
                            <i class="ri-calendar-check-line text-xl"></i>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-600"><?php echo $summary['today']['count']; ?> collections</p>
                </div>

                <!-- Yesterday's Collection Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Yesterday</p>
                            <p class="text-2xl font-bold text-gray-800">
                                <?php echo formatCurrency($summary['yesterday']['amount']); ?></p>
                        </div>
                        <div
                            class="h-10 w-10 rounded-full bg-secondary-100 flex items-center justify-center text-secondary-600">
                            <i class="ri-calendar-line text-xl"></i>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-600"><?php echo $summary['yesterday']['count']; ?> collections</p>
                </div>

                <!-- This Week's Collection Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">This Week</p>
                            <p class="text-2xl font-bold text-gray-800">
                                <?php echo formatCurrency($summary['week']['amount']); ?></p>
                        </div>
                        <div
                            class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                            <i class="ri-calendar-2-line text-xl"></i>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-600"><?php echo $summary['week']['count']; ?> collections</p>
                </div>

                <!-- This Month's Collection Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">This Month</p>
                            <p class="text-2xl font-bold text-gray-800">
                                <?php echo formatCurrency($summary['month']['amount']); ?></p>
                        </div>
                        <div
                            class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                            <i class="ri-calendar-todo-line text-xl"></i>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-600"><?php echo $summary['month']['count']; ?> collections</p>
                </div>
            </div>

            <!-- Filter & Search Bar -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between space-y-4 lg:space-y-0">
                    <!-- Left side filters -->
                    <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                        <!-- Date Range Filter -->
                        <div class="flex flex-col">
                            <label for="date-range" class="block text-sm font-medium text-gray-700 mb-1">Date
                                Range</label>
                            <div class="relative flex items-center">
                                <div class="absolute left-3 text-gray-400">
                                    <i class="ri-calendar-line"></i>
                                </div>
                                <input type="text" id="date-range" name="date-range"
                                    class="pl-9 pr-3 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500 w-full"
                                    placeholder="Select date range">
                            </div>
                        </div>

                        <!-- Tax Type Filter -->
                        <div class="flex flex-col">
                            <label for="tax-type" class="block text-sm font-medium text-gray-700 mb-1">Tax Type</label>
                            <div class="relative">
                                <select id="tax-type" name="tax-type"
                                    class="pl-3 pr-9 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500 w-full appearance-none">
                                    <option value="">All Tax Types</option>
                                    <?php foreach($tax_types as $tax): ?>
                                    <option value="<?php echo $tax['id']; ?>"><?php echo $tax['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="ri-arrow-down-s-line text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method Filter -->
                        <div class="flex flex-col">
                            <label for="payment-method" class="block text-sm font-medium text-gray-700 mb-1">Payment
                                Method</label>
                            <div class="relative">
                                <select id="payment-method" name="payment-method"
                                    class="pl-3 pr-9 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500 w-full appearance-none">
                                    <option value="">All Methods</option>
                                    <?php foreach($payment_methods as $method): ?>
                                    <option value="<?php echo $method; ?>"><?php echo $method; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="ri-arrow-down-s-line text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right side search -->
                    <div class="flex flex-col md:flex-row md:items-end space-y-4 md:space-y-0 md:space-x-4">
                        <!-- Search Box -->
                        <div class="flex flex-col flex-grow">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                            <div class="relative">
                                <input type="text" id="search" name="search"
                                    class="pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500 w-full"
                                    placeholder="Search by business name, ID...">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ri-search-line text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Apply & Reset Buttons -->
                        <div class="flex space-x-2">
                            <button type="button"
                                class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                                Apply
                            </button>
                            <button type="button"
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                                Reset
                            </button>
                        </div>

                        <!-- Export Button -->
                        <div class="relative">
                            <button id="export-btn"
                                class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-900 inline-flex items-center">
                                <i class="ri-download-line mr-1"></i> Export
                                <i class="ri-arrow-down-s-line ml-1"></i>
                            </button>
                            <div id="export-dropdown"
                                class="absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden z-10">
                                <div class="py-1" role="none">
                                    <button
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                                        <i class="ri-file-excel-line mr-2 text-green-600"></i> Excel
                                    </button>
                                    <button
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                                        <i class="ri-file-pdf-line mr-2 text-red-600"></i> PDF
                                    </button>
                                    <button
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                                        <i class="ri-file-text-line mr-2 text-blue-600"></i> CSV
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Collection Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Collections Over Time Chart -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Collections Over Time</h2>
                    <div class="h-72">
                        <canvas id="collectionsChart"></canvas>
                    </div>
                </div>

                <!-- Collections by Payment Method Chart -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">By Payment Method</h2>
                    <div class="h-72">
                        <canvas id="paymentMethodChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Collections Table -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-800">Collection History</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Transaction ID
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Business
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tax Type
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Payment Method
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Receipt
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($collections as $index => $collection): ?>
                            <tr
                                class="<?php echo $index % 2 === 0 ? 'bg-white' : 'bg-gray-50'; ?> hover:bg-gray-100 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?php echo $collection['id']; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600">
                                            <i class="ri-store-2-line"></i>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">
                                                <?php echo $collection['business_name']; ?></div>
                                            <div class="text-xs text-gray-500"><?php echo $collection['business_id']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"><?php echo $collection['tax_type']; ?></div>
                                    <div class="text-xs text-gray-500"><?php echo $collection['tax_id']; ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">
                                        <?php echo formatCurrency($collection['amount']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"><?php echo formatDate($collection['date']); ?>
                                    </div>
                                    <div class="text-xs text-gray-500"><?php echo formatTime($collection['date']); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        <?php 
                                        switch ($collection['payment_method']) {
                                            case 'Cash':
                                                echo 'bg-green-100 text-green-800';
                                                break;
                                            case 'Mobile Money':
                                                echo 'bg-blue-100 text-blue-800';
                                                break;
                                            case 'Card':
                                                echo 'bg-purple-100 text-purple-800';
                                                break;
                                            default:
                                                echo 'bg-gray-100 text-gray-800';
                                        }
                                        ?>">
                                        <?php 
                                        switch ($collection['payment_method']) {
                                            case 'Cash':
                                                echo '<i class="ri-money-dollar-box-line mr-1"></i>';
                                                break;
                                            case 'Mobile Money':
                                                echo '<i class="ri-smartphone-line mr-1"></i>';
                                                break;
                                            case 'Card':
                                                echo '<i class="ri-bank-card-line mr-1"></i>';
                                                break;
                                        }
                                        echo $collection['payment_method'];
                                        ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"><?php echo $collection['receipt_number']; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-3">
                                        <a href="../receipt/index.php?id=<?php echo $collection['id']; ?>"
                                            class="text-primary-600 hover:text-primary-900" title="View Receipt">
                                            <i class="ri-file-list-3-line"></i>
                                        </a>
                                        <button class="text-gray-600 hover:text-gray-900 print-receipt"
                                            data-id="<?php echo $collection['id']; ?>" title="Print Receipt">
                                            <i class="ri-printer-line"></i>
                                        </button>
                                        <button class="text-blue-600 hover:text-blue-900 send-receipt"
                                            data-id="<?php echo $collection['id']; ?>" title="Send Receipt">
                                            <i class="ri-send-plane-line"></i>
                                        </button>
                                        <div class="relative">
                                            <button class="text-gray-600 hover:text-gray-900 more-options"
                                                data-id="<?php echo $collection['id']; ?>" title="More Options">
                                                <i class="ri-more-2-fill"></i>
                                            </button>
                                            <div
                                                class="options-dropdown hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10">
                                                <div class="py-1" role="none">
                                                    <button
                                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                                                        <i class="ri-file-copy-line mr-2"></i> Duplicate Receipt
                                                    </button>
                                                    <button
                                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                                                        <i class="ri-edit-line mr-2"></i> Edit Details
                                                    </button>
                                                    <button
                                                        class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 w-full text-left">
                                                        <i class="ri-delete-bin-line mr-2"></i> Void Receipt
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex items-center justify-between">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <button
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Previous
                        </button>
                        <button
                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Next
                        </button>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of
                                <span class="font-medium">68</span> results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                aria-label="Pagination">
                                <button
                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Previous</span>
                                    <i class="ri-arrow-left-s-line"></i>
                                </button>
                                <button
                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-primary-50 text-sm font-medium text-primary-600 hover:bg-primary-100">
                                    1
                                </button>
                                <button
                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    2
                                </button>
                                <button
                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    3
                                </button>
                                <span
                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                    ...
                                </span>
                                <button
                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    7
                                </button>
                                <button
                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Next</span>
                                    <i class="ri-arrow-right-s-line"></i>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Export dropdown toggle
        const exportBtn = document.getElementById('export-btn');
        const exportDropdown = document.getElementById('export-dropdown');

        exportBtn.addEventListener('click', function() {
            exportDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            if (!exportBtn.contains(event.target) && !exportDropdown.contains(event.target)) {
                exportDropdown.classList.add('hidden');
            }
        });

        // More options dropdowns
        document.querySelectorAll('.more-options').forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation();

                // Close all dropdowns first
                document.querySelectorAll('.options-dropdown').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });

                // Open this dropdown
                this.nextElementSibling.classList.toggle('hidden');
            });
        });

        // Close dropdowns when clicking elsewhere
        document.addEventListener('click', function() {
            document.querySelectorAll('.options-dropdown').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        });

        // Print receipt button
        document.querySelectorAll('.print-receipt').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                alert(`Printing receipt ${id}...`);
                // In a real application, this would trigger the print functionality
            });
        });

        // Send receipt button
        document.querySelectorAll('.send-receipt').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                alert(`Send receipt ${id} options...`);
                // In a real application, this might open a modal to choose how to send the receipt
            });
        });

        // Collections Over Time Chart
        const collectionsCtx = document.getElementById('collectionsChart').getContext('2d');
        const collectionsChart = new Chart(collectionsCtx, {
            type: 'line',
            data: {
                labels: ['6 Days Ago', '5 Days Ago', '4 Days Ago', '3 Days Ago', '2 Days Ago',
                    'Yesterday', 'Today'
                ],
                datasets: [{
                    label: 'Amount Collected (GHS)',
                    data: [580, 420, 750, 890, 650, 1025, 650],
                    backgroundColor: 'rgba(22, 163, 74, 0.1)',
                    borderColor: '#16a34a',
                    borderWidth: 2,
                    pointBackgroundColor: '#16a34a',
                    pointRadius: 4,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'GHS ' + value;
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.raw;
                                const formattedValue = new Intl.NumberFormat('en-GH', {
                                    style: 'currency',
                                    currency: 'GHS'
                                }).format(value);
                                return formattedValue;
                            }
                        }
                    }
                }
            }
        });

        // Payment Method Chart
        const paymentMethodCtx = document.getElementById('paymentMethodChart').getContext('2d');
        const paymentMethodChart = new Chart(paymentMethodCtx, {
            type: 'doughnut',
            data: {
                labels: ['Cash', 'Mobile Money', 'Card'],
                datasets: [{
                    data: [450, 150, 50],
                    backgroundColor: [
                        'rgba(22, 163, 74, 0.8)',
                        'rgba(37, 99, 235, 0.8)',
                        'rgba(168, 85, 247, 0.8)'
                    ],
                    borderColor: [
                        'rgba(22, 163, 74, 1)',
                        'rgba(37, 99, 235, 1)',
                        'rgba(168, 85, 247, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 15
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.raw;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                const formattedValue = new Intl.NumberFormat('en-GH', {
                                    style: 'currency',
                                    currency: 'GHS'
                                }).format(value);
                                return `${context.label}: ${formattedValue} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    });
    </script>
</body>

</html>