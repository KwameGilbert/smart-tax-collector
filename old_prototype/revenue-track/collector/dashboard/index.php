<?php
// Start session
session_start();

// In production, check if collector is logged in
// if (!isset($_SESSION['collector_id'])) {
//     header('Location: ../login/index.php');
//     exit();
// }

// Dummy data for dashboard
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

// Collection statistics
$stats = [
    'collections_today' => [
        'count' => 12,
        'amount' => 1850.00,
        'target' => 2000.00
    ],
    'collections_week' => [
        'count' => 56,
        'amount' => 8750.00,
        'target' => 10000.00
    ],
    'collections_month' => [
        'count' => 215,
        'amount' => 32480.00,
        'target' => 40000.00
    ],
    'businesses_visited_today' => 18,
    'completion_rate' => 85 // percentage
];

// Dummy data for most collected tax types
$taxTypes = [
    [
        'name' => 'Business Operating Permit',
        'count' => 78,
        'amount' => 15600.00
    ],
    [
        'name' => 'Market Stall Fee',
        'count' => 65,
        'amount' => 6500.00
    ],
    [
        'name' => 'Signage/Advertising',
        'count' => 42,
        'amount' => 6300.00
    ],
    [
        'name' => 'Food & Beverage License',
        'count' => 30,
        'amount' => 4500.00
    ]
];

// Top collection areas
$topAreas = [
    [
        'name' => 'Central Market',
        'amount' => 12600.00
    ],
    [
        'name' => 'Main Street',
        'amount' => 8750.00
    ],
    [
        'name' => 'Industrial Zone',
        'amount' => 6430.00
    ],
    [
        'name' => 'New Town',
        'amount' => 4700.00
    ]
];

// Recent collections data
$recentCollections = [
    [
        'id' => 'PAY-2023-1024',
        'business_name' => 'Adwoa Grocery Shop',
        'tax_type' => 'Business Operating Permit',
        'amount' => 200.00,
        'date' => '2023-07-12 09:45:22',
        'payment_method' => 'Cash'
    ],
    [
        'id' => 'PAY-2023-1023',
        'business_name' => 'Afia Restaurant',
        'tax_type' => 'Food & Beverage License',
        'amount' => 150.00,
        'date' => '2023-07-12 09:12:30',
        'payment_method' => 'Mobile Money'
    ],
    [
        'id' => 'PAY-2023-1022',
        'business_name' => 'Ama Fashion Boutique',
        'tax_type' => 'Signage Fee',
        'amount' => 75.00,
        'date' => '2023-07-12 08:54:15',
        'payment_method' => 'Cash'
    ],
    [
        'id' => 'PAY-2023-1021',
        'business_name' => 'Kofi Auto Repairs',
        'tax_type' => 'Business Operating Permit',
        'amount' => 225.00,
        'date' => '2023-07-12 08:30:40',
        'payment_method' => 'Cash'
    ],
    [
        'id' => 'PAY-2023-1020',
        'business_name' => 'Yaw Pharmacy',
        'tax_type' => 'Healthcare License',
        'amount' => 300.00,
        'date' => '2023-07-11 16:45:03',
        'payment_method' => 'Mobile Money'
    ]
];

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
    <title>Tax Collector Dashboard | Sefwi Tax Collection</title>

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

    /* Animation for notification bell */
    @keyframes bellShake {
        0% {
            transform: rotate(0);
        }

        15% {
            transform: rotate(5deg);
        }

        30% {
            transform: rotate(-5deg);
        }

        45% {
            transform: rotate(4deg);
        }

        60% {
            transform: rotate(-4deg);
        }

        75% {
            transform: rotate(2deg);
        }

        85% {
            transform: rotate(-2deg);
        }

        92% {
            transform: rotate(1deg);
        }

        100% {
            transform: rotate(0);
        }
    }

    .bell-animation:hover {
        animation: bellShake 0.6s cubic-bezier(.36, .07, .19, .97) both;
        transform-origin: top center;
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

    /* Card hover effect */
    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <?php require_once __DIR__ .'/../components/sidebar.php';?>

    <!-- Main Content -->
    <main class="md:ml-64 min-h-screen">
        <?php require_once __DIR__ .'/../components/header.php';?>

        <!-- Main Dashboard Content -->
        <div class="px-4 py-6">
            <!-- Welcome Section -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Welcome back,
                    <?php echo explode(' ', $collector['name'])[0]; ?>!</h1>
                <p class="text-gray-600">Here's your tax collection summary for today</p>
            </div>

            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Today's Collection Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Today's Collection</p>
                            <p class="text-2xl font-bold text-gray-800">
                                <?php echo formatCurrency($stats['collections_today']['amount']); ?></p>
                        </div>
                        <div
                            class="h-12 w-12 rounded-full bg-primary-100 flex items-center justify-center text-primary-600">
                            <i class="ri-money-dollar-circle-line text-2xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Progress</span>
                            <span
                                class="text-gray-800 font-medium"><?php echo round(($stats['collections_today']['amount'] / $stats['collections_today']['target']) * 100); ?>%</span>
                        </div>
                        <div class="mt-1 h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-primary-500 rounded-full progress-bar"
                                style="--progress-value: <?php echo ($stats['collections_today']['amount'] / $stats['collections_today']['target']) * 100; ?>%">
                            </div>
                        </div>
                        <div class="mt-1 flex justify-between text-xs text-gray-500">
                            <span><?php echo $stats['collections_today']['count']; ?> transactions</span>
                            <span>Target: <?php echo formatCurrency($stats['collections_today']['target']); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Weekly Collection Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">This Week's Collection</p>
                            <p class="text-2xl font-bold text-gray-800">
                                <?php echo formatCurrency($stats['collections_week']['amount']); ?></p>
                        </div>
                        <div
                            class="h-12 w-12 rounded-full bg-secondary-100 flex items-center justify-center text-secondary-600">
                            <i class="ri-calendar-check-line text-2xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Progress</span>
                            <span
                                class="text-gray-800 font-medium"><?php echo round(($stats['collections_week']['amount'] / $stats['collections_week']['target']) * 100); ?>%</span>
                        </div>
                        <div class="mt-1 h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-secondary-500 rounded-full progress-bar"
                                style="--progress-value: <?php echo ($stats['collections_week']['amount'] / $stats['collections_week']['target']) * 100; ?>%">
                            </div>
                        </div>
                        <div class="mt-1 flex justify-between text-xs text-gray-500">
                            <span><?php echo $stats['collections_week']['count']; ?> transactions</span>
                            <span>Target: <?php echo formatCurrency($stats['collections_week']['target']); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Businesses Visited Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Businesses Visited Today</p>
                            <p class="text-2xl font-bold text-gray-800">
                                <?php echo $stats['businesses_visited_today']; ?></p>
                        </div>
                        <div
                            class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                            <i class="ri-store-2-line text-2xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Completion Rate</span>
                            <span class="text-gray-800 font-medium"><?php echo $stats['completion_rate']; ?>%</span>
                        </div>
                        <div class="mt-1 h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-purple-500 rounded-full progress-bar"
                                style="--progress-value: <?php echo $stats['completion_rate']; ?>%"></div>
                        </div>
                        <div class="mt-1 flex justify-between text-xs text-gray-500">
                            <span><?php echo $stats['collections_today']['count']; ?> collections made</span>
                            <span><?php echo $stats['businesses_visited_today'] - $stats['collections_today']['count']; ?>
                                pending</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons Section -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    <a href="../search/index.php"
                        class="bg-white border border-gray-200 rounded-lg p-4 text-center hover:bg-primary-50 hover:border-primary-200 transition-colors card-hover">
                        <div
                            class="inline-flex h-12 w-12 rounded-full bg-primary-100 items-center justify-center text-primary-600 mb-3">
                            <i class="ri-search-line text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800">Search Business</h3>
                        <p class="text-sm text-gray-500 mt-1">Find businesses to collect from</p>
                    </a>

                    <a href="./../collect/index.php"
                        class="bg-white border border-gray-200 rounded-lg p-4 text-center hover:bg-secondary-50 hover:border-secondary-200 transition-colors card-hover">
                        <div
                            class="inline-flex h-12 w-12 rounded-full bg-secondary-100 items-center justify-center text-secondary-600 mb-3">
                            <i class="ri-money-dollar-box-line text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800">Start Collection</h3>
                        <p class="text-sm text-gray-500 mt-1">Begin a new tax collection</p>
                    </a>

                    <a href="../receipt/index.php"
                        class="bg-white border border-gray-200 rounded-lg p-4 text-center hover:bg-green-50 hover:border-green-200 transition-colors card-hover">
                        <div
                            class="inline-flex h-12 w-12 rounded-full bg-green-100 items-center justify-center text-green-600 mb-3">
                            <i class="ri-file-list-3-line text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800">Recent Receipts</h3>
                        <p class="text-sm text-gray-500 mt-1">View or print recent receipts</p>
                    </a>

                    <a href="../performance/index.php"
                        class="bg-white border border-gray-200 rounded-lg p-4 text-center hover:bg-purple-50 hover:border-purple-200 transition-colors card-hover">
                        <div
                            class="inline-flex h-12 w-12 rounded-full bg-purple-100 items-center justify-center text-purple-600 mb-3">
                            <i class="ri-bar-chart-grouped-line text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800">My Performance</h3>
                        <p class="text-sm text-gray-500 mt-1">Track your collection metrics</p>
                    </a>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Most Collected Tax Types -->
                <div class="lg:col-span-2">
                    <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-4">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Most Collected Tax Types</h2>
                        <div class="space-y-4">
                            <?php foreach ($taxTypes as $tax): ?>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700"><?php echo $tax['name']; ?></span>
                                    <span
                                        class="text-sm font-medium text-gray-900"><?php echo formatCurrency($tax['amount']); ?></span>
                                </div>
                                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full"
                                        style="width: <?php echo ($tax['amount'] / $taxTypes[0]['amount']) * 100; ?>%">
                                    </div>
                                </div>
                                <div class="mt-1 text-xs text-gray-500">
                                    <?php echo $tax['count']; ?> collections
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-6">
                            <canvas id="taxTypesChart" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Top Collection Areas -->
                <div>
                    <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-4 h-full">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Top Collection Areas</h2>
                        <div class="space-y-3">
                            <?php foreach ($topAreas as $index => $area): ?>
                            <div class="flex items-center bg-gray-50 p-3 rounded-md">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br <?php 
                                    if($index == 0) echo 'from-yellow-400 to-yellow-500';
                                    elseif($index == 1) echo 'from-gray-300 to-gray-400';
                                    elseif($index == 2) echo 'from-amber-500 to-amber-600';
                                    else echo 'from-blue-200 to-blue-300';
                                ?> flex items-center justify-center text-white font-bold">
                                    <?php echo $index + 1; ?>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-sm font-medium text-gray-800"><?php echo $area['name']; ?></h3>
                                        <span
                                            class="text-sm font-semibold text-gray-900"><?php echo formatCurrency($area['amount']); ?></span>
                                    </div>
                                    <div class="w-full h-1.5 bg-gray-200 rounded-full mt-2 overflow-hidden">
                                        <div class="h-full bg-gradient-to-r <?php 
                                            if($index == 0) echo 'from-yellow-400 to-yellow-500';
                                            elseif($index == 1) echo 'from-gray-300 to-gray-400';
                                            elseif($index == 2) echo 'from-amber-500 to-amber-600';
                                            else echo 'from-blue-200 to-blue-300';
                                        ?> rounded-full"
                                            style="width: <?php echo ($area['amount'] / $topAreas[0]['amount']) * 100; ?>%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-4">
                            <canvas id="areasChart" height="170"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Collections Section -->
            <div class="mt-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Recent Collections</h2>
                    <a href="../collections/index.php"
                        class="text-primary-600 hover:text-primary-700 font-medium text-sm">View All</a>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Receipt ID</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Business</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tax Type</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Payment Method</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">View</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($recentCollections as $collection): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?php echo $collection['id']; ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            <?php echo $collection['business_name']; ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500"><?php echo $collection['tax_type']; ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">
                                            <?php echo formatCurrency($collection['amount']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500"><?php echo timeAgo($collection['date']); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <?php if ($collection['payment_method'] === 'Cash'): ?>
                                            <i class="ri-money-dollar-box-line mr-1 text-green-600"></i>
                                            <?php elseif ($collection['payment_method'] === 'Mobile Money'): ?>
                                            <i class="ri-smartphone-line mr-1 text-blue-600"></i>
                                            <?php else: ?>
                                            <i class="ri-bank-card-line mr-1 text-purple-600"></i>
                                            <?php endif; ?>
                                            <?php echo $collection['payment_method']; ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="../receipt/index.php?id=<?php echo $collection['id']; ?>"
                                            class="text-primary-600 hover:text-primary-900">View</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
    // Chart for tax types
    const taxTypesChart = new Chart(
        document.getElementById('taxTypesChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($taxTypes, 'name')); ?>,
                datasets: [{
                    label: 'Amount Collected (GHS)',
                    data: <?php echo json_encode(array_column($taxTypes, 'amount')); ?>,
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.7)',
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(168, 85, 247, 0.7)',
                        'rgba(236, 72, 153, 0.7)'
                    ],
                    borderColor: [
                        'rgba(34, 197, 94, 1)',
                        'rgba(59, 130, 246, 1)',
                        'rgba(168, 85, 247, 1)',
                        'rgba(236, 72, 153, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
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
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'GHS ' + value;
                            }
                        }
                    }
                }
            }
        }
    );

    // Chart for areas
    const areasChart = new Chart(
        document.getElementById('areasChart'), {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode(array_column($topAreas, 'name')); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_column($topAreas, 'amount')); ?>,
                    backgroundColor: [
                        'rgba(251, 191, 36, 0.8)',
                        'rgba(156, 163, 175, 0.8)',
                        'rgba(217, 119, 6, 0.8)',
                        'rgba(96, 165, 250, 0.8)'
                    ],
                    borderColor: [
                        'rgba(251, 191, 36, 1)',
                        'rgba(156, 163, 175, 1)',
                        'rgba(217, 119, 6, 1)',
                        'rgba(96, 165, 250, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
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
                                const formattedValue = new Intl.NumberFormat('en-GH', {
                                    style: 'currency',
                                    currency: 'GHS'
                                }).format(value);
                                return context.label + ': ' + formattedValue;
                            }
                        }
                    }
                }
            }
        }
    );
    </script>
</body>

</html>