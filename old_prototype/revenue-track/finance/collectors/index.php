<?php
// Include the database connection class
require_once __DIR__ . '/../../database/database.php';

// Check authentication
require_once __DIR__ . '/../login/authcheck.php';

// Get database connection
$db = Database::getInstance();
$conn = $db->getConnection();

// Include components
require_once __DIR__ . '/../components/layout/header.php';
require_once __DIR__ . '/../components/layout/sidebar.php';

// Dummy data for collectors
$collectors = [
    [
        'id' => 1,
        'name' => 'John Anane',
        'email' => 'john.anane@sefwi.gov.gh',
        'phone' => '0244123456',
        'status' => 'active',
        'zone' => 'Central Market',
        'joined_date' => '2022-08-15',
        'collections_today' => 4,
        'collections_week' => 23,
        'collections_month' => 87,
        'amount_today' => 650.00,
        'amount_week' => 3750.00,
        'amount_month' => 12480.00,
        'last_collection' => '2023-07-12 09:45:22',
        'device_id' => 'SM-G975F-354651234567890',
        'device_status' => 'online'
    ],
    [
        'id' => 2,
        'name' => 'Sarah Osei',
        'email' => 'sarah.osei@sefwi.gov.gh',
        'phone' => '0201234567',
        'status' => 'active',
        'zone' => 'North District',
        'joined_date' => '2022-09-10',
        'collections_today' => 6,
        'collections_week' => 27,
        'collections_month' => 92,
        'amount_today' => 825.00,
        'amount_week' => 4120.00,
        'amount_month' => 14350.00,
        'last_collection' => '2023-07-12 10:12:33',
        'device_id' => 'SM-A515F-861234567890123',
        'device_status' => 'online'
    ],
    [
        'id' => 3,
        'name' => 'Michael Agyei',
        'email' => 'michael.agyei@sefwi.gov.gh',
        'phone' => '0277654321',
        'status' => 'active',
        'zone' => 'South District',
        'joined_date' => '2022-10-05',
        'collections_today' => 2,
        'collections_week' => 19,
        'collections_month' => 75,
        'amount_today' => 350.00,
        'amount_week' => 3180.00,
        'amount_month' => 10920.00,
        'last_collection' => '2023-07-12 08:30:15',
        'device_id' => 'SM-S908B-359876543210987',
        'device_status' => 'online'
    ],
    [
        'id' => 4,
        'name' => 'Grace Mensah',
        'email' => 'grace.mensah@sefwi.gov.gh',
        'phone' => '0234567890',
        'status' => 'inactive',
        'zone' => 'East District',
        'joined_date' => '2022-11-15',
        'collections_today' => 0,
        'collections_week' => 8,
        'collections_month' => 45,
        'amount_today' => 0.00,
        'amount_week' => 1250.00,
        'amount_month' => 7860.00,
        'last_collection' => '2023-07-08 14:45:30',
        'device_id' => 'SM-A325F-352987654321098',
        'device_status' => 'offline'
    ],
    [
        'id' => 5,
        'name' => 'Daniel Owusu',
        'email' => 'daniel.owusu@sefwi.gov.gh',
        'phone' => '0257891234',
        'status' => 'active',
        'zone' => 'Industrial Area',
        'joined_date' => '2023-01-20',
        'collections_today' => 3,
        'collections_week' => 21,
        'collections_month' => 79,
        'amount_today' => 480.00,
        'amount_week' => 3640.00,
        'amount_month' => 11250.00,
        'last_collection' => '2023-07-12 09:22:47',
        'device_id' => 'SM-A536B-356789012345678',
        'device_status' => 'online'
    ],
    [
        'id' => 6,
        'name' => 'Abigail Boateng',
        'email' => 'abigail.boateng@sefwi.gov.gh',
        'phone' => '0269876543',
        'status' => 'on_leave',
        'zone' => 'West District',
        'joined_date' => '2023-02-10',
        'collections_today' => 0,
        'collections_week' => 12,
        'collections_month' => 52,
        'amount_today' => 0.00,
        'amount_week' => 2130.00,
        'amount_month' => 8970.00,
        'last_collection' => '2023-07-07 11:15:40',
        'device_id' => 'SM-G990B-357654321098765',
        'device_status' => 'offline'
    ]
];

// Calculate total collections and amounts
$totalCollectionsToday = 0;
$totalCollectionsWeek = 0;
$totalCollectionsMonth = 0;
$totalAmountToday = 0;
$totalAmountWeek = 0;
$totalAmountMonth = 0;
$activeCollectors = 0;

foreach ($collectors as $collector) {
    $totalCollectionsToday += $collector['collections_today'];
    $totalCollectionsWeek += $collector['collections_week'];
    $totalCollectionsMonth += $collector['collections_month'];
    $totalAmountToday += $collector['amount_today'];
    $totalAmountWeek += $collector['amount_week'];
    $totalAmountMonth += $collector['amount_month'];
    
    if ($collector['status'] === 'active') {
        $activeCollectors++;
    }
}

// Helper function to format currency
function formatCurrency($amount) {
    return 'GHS ' . number_format($amount, 2);
}

// Helper function to format date
function formatDate($dateString) {
    return date('d M, Y', strtotime($dateString));
}

// Helper function to format datetime
function formatDateTime($dateString) {
    return date('d M, Y h:i A', strtotime($dateString));
}

// Monthly collection data for chart (dummy data)
$monthlyCollections = [
    'Jan' => 45200,
    'Feb' => 52800,
    'Mar' => 59600,
    'Apr' => 48900,
    'May' => 62300,
    'Jun' => 57400,
    'Jul' => 38600, // Current month (partial)
    'Aug' => 0,
    'Sep' => 0,
    'Oct' => 0,
    'Nov' => 0,
    'Dec' => 0
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collector Management - Sefwi Tax Collection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="/../finance/components/shared/app.js"></script>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    /* Fixed header styles */
    .overflow-y-auto {
        height: calc(100vh - 5rem);
        padding-top: 0.5rem;
    }

    /* Ensure sidebar is above everything except header */
    #sidebar {
        z-index: 30;
    }

    /* Prevent content from going under header */
    .md\:ml-64 {
        padding-top: 0;
    }

    /* Loading overlay */
    #loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.7);
        z-index: 9999;
    }

    .spinner {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        border: 4px solid rgba(59, 130, 246, 0.3);
        border-top-color: #3B82F6;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Collector status styles */
    .status-active {
        background-color: #DEF7EC;
        color: #046C4E;
    }

    .status-inactive {
        background-color: #FEE2E2;
        color: #B91C1C;
    }

    .status-on_leave {
        background-color: #FEF3C7;
        color: #92400E;
    }

    /* Device status styles */
    .device-online {
        color: #059669;
    }

    .device-offline {
        color: #9CA3AF;
    }

    /* Collector card styles */
    .collector-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .collector-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Tab styling */
    .collector-tab {
        cursor: pointer;
        border-bottom: 2px solid transparent;
        transition: all 0.3s;
    }

    .collector-tab.active {
        border-bottom-color: #2563EB;
        color: #2563EB;
        font-weight: 600;
    }

    /* Performance indicator */
    .performance-high {
        color: #047857;
    }

    .performance-medium {
        color: #B45309;
    }

    .performance-low {
        color: #DC2626;
    }
    </style>
</head>

<body class="min-h-screen bg-white" id="main-body">
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="flex items-center justify-center">
        <div class="spinner"></div>
    </div>

    <div class="md:ml-64 flex flex-col min-h-screen transition-all duration-300">
        <?php renderSidebar('collectors', false); ?>

        <!-- Header -->
        <?php renderHeader('Collector Management', false); ?>

        <!-- Main Content -->
        <div class="p-4 md:p-8 bg-gray-100 flex-grow overflow-y-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold">Tax Collectors</h1>
                    <p class="text-gray-600">Manage and monitor tax collection personnel</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative">
                        <input type="text" placeholder="Search collectors..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-search-line text-gray-500"></i>
                        </div>
                    </div>
                    <a href="add.php"
                        class="flex items-center justify-center gap-2 bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded-md shadow-sm">
                        <i class="ri-user-add-line"></i>
                        Add New Collector
                    </a>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                            <i class="ri-team-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Active Collectors</p>
                            <p class="text-2xl font-bold"><?php echo $activeCollectors; ?> /
                                <?php echo count($collectors); ?></p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start">
                        <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                            <i class="ri-money-dollar-circle-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Today's Collection</p>
                            <p class="text-2xl font-bold"><?php echo formatCurrency($totalAmountToday); ?></p>
                            <p class="text-xs text-gray-500"><?php echo $totalCollectionsToday; ?> transactions</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-4">
                            <i class="ri-calendar-check-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">This Week</p>
                            <p class="text-2xl font-bold"><?php echo formatCurrency($totalAmountWeek); ?></p>
                            <p class="text-xs text-gray-500"><?php echo $totalCollectionsWeek; ?> transactions</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start">
                        <div class="p-3 rounded-full bg-indigo-100 text-indigo-500 mr-4">
                            <i class="ri-bar-chart-grouped-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">This Month</p>
                            <p class="text-2xl font-bold"><?php echo formatCurrency($totalAmountMonth); ?></p>
                            <p class="text-xs text-gray-500"><?php echo $totalCollectionsMonth; ?> transactions</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Collection Trend Chart -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold mb-4">Collection Trend (2023)</h2>
                    <canvas id="collectionChart" height="200"></canvas>
                </div>

                <!-- Top Collectors Performance -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold mb-4">Top Collectors (This Month)</h2>
                    <div class="space-y-4">
                        <?php 
                        // Sort collectors by monthly amount
                        $sortedCollectors = $collectors;
                        usort($sortedCollectors, function($a, $b) {
                            return $b['amount_month'] - $a['amount_month'];
                        });
                        
                        $topCollectors = array_slice($sortedCollectors, 0, 3);
                        $maxAmount = $topCollectors[0]['amount_month'];
                        
                        foreach ($topCollectors as $index => $collector):
                            $percentage = ($collector['amount_month'] / $maxAmount) * 100;
                            $color = $index === 0 ? 'bg-blue-500' : ($index === 1 ? 'bg-blue-400' : 'bg-blue-300');
                        ?>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span
                                    class="text-sm font-medium"><?php echo htmlspecialchars($collector['name']); ?></span>
                                <span
                                    class="text-sm font-medium"><?php echo formatCurrency($collector['amount_month']); ?></span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="<?php echo $color; ?> h-2 rounded-full"
                                    style="width: <?php echo $percentage; ?>%"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <div class="text-right mt-4">
                            <a href="performance.php" class="text-sm text-blue-600 hover:text-blue-800">
                                View complete ranking <i class="ri-arrow-right-line align-middle"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <div class="collector-tab active whitespace-nowrap py-4 px-1 font-medium text-md">
                        All Collectors
                    </div>
                    <div
                        class="collector-tab whitespace-nowrap py-4 px-1 font-medium text-gray-500 hover:text-gray-700 text-md">
                        Active
                    </div>
                    <div
                        class="collector-tab whitespace-nowrap py-4 px-1 font-medium text-gray-500 hover:text-gray-700 text-md">
                        On Leave
                    </div>
                    <div
                        class="collector-tab whitespace-nowrap py-4 px-1 font-medium text-gray-500 hover:text-gray-700 text-md">
                        Device Status
                    </div>
                </nav>
            </div>

            <!-- Collectors Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <?php foreach ($collectors as $collector): 
                    // Determine performance class based on monthly collections
                    $performanceClass = '';
                    if ($collector['collections_month'] > 80) {
                        $performanceClass = 'performance-high';
                    } elseif ($collector['collections_month'] > 50) {
                        $performanceClass = 'performance-medium';
                    } else {
                        $performanceClass = 'performance-low';
                    }
                ?>
                <div class="collector-card bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div
                                class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 mr-4">
                                <i class="ri-user-line text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">
                                    <?php echo htmlspecialchars($collector['name']); ?></h3>
                                <p class="text-sm text-gray-500"><?php echo htmlspecialchars($collector['zone']); ?></p>
                            </div>
                            <div class="ml-auto">
                                <span class="px-2 py-1 text-xs rounded-full 
                                <?php 
                                    switch($collector['status']) {
                                        case 'active':
                                            echo 'status-active';
                                            break;
                                        case 'inactive':
                                            echo 'status-inactive';
                                            break;
                                        case 'on_leave':
                                            echo 'status-on_leave';
                                            break;
                                    }
                                ?>">
                                    <?php echo ucfirst(str_replace('_', ' ', $collector['status'])); ?>
                                </span>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4">
                            <div class="grid grid-cols-3 gap-4 mb-4">
                                <div class="text-center">
                                    <p class="text-xs text-gray-500">Today</p>
                                    <p class="text-lg font-semibold">
                                        <?php echo formatCurrency($collector['amount_today']); ?></p>
                                    <p class="text-xs text-gray-500"><?php echo $collector['collections_today']; ?>
                                        payments</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs text-gray-500">Week</p>
                                    <p class="text-lg font-semibold">
                                        <?php echo formatCurrency($collector['amount_week']); ?></p>
                                    <p class="text-xs text-gray-500"><?php echo $collector['collections_week']; ?>
                                        payments</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs text-gray-500">Month</p>
                                    <p class="text-lg font-semibold">
                                        <?php echo formatCurrency($collector['amount_month']); ?></p>
                                    <p class="text-xs text-gray-500"><?php echo $collector['collections_month']; ?>
                                        payments</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between text-sm">
                                <div>
                                    <i
                                        class="ri-smartphone-line mr-1 <?php echo $collector['device_status'] === 'online' ? 'device-online' : 'device-offline'; ?>"></i>
                                    <span><?php echo ucfirst($collector['device_status']); ?></span>
                                </div>
                                <div class="<?php echo $performanceClass; ?>">
                                    <i class="ri-bar-chart-line mr-1"></i>
                                    <?php 
                                        if ($performanceClass === 'performance-high') {
                                            echo 'High Performance';
                                        } elseif ($performanceClass === 'performance-medium') {
                                            echo 'Average Performance';
                                        } else {
                                            echo 'Low Performance';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                        <div class="flex justify-between items-center">
                            <div class="text-sm">
                                <span class="text-gray-500">Last collection:</span>
                                <?php 
                                    $lastCollectionTime = strtotime($collector['last_collection']);
                                    $timeDiff = time() - $lastCollectionTime;
                                    
                                    if ($timeDiff < 3600) { // Less than 1 hour
                                        $minutes = floor($timeDiff / 60);
                                        echo "<span class='text-green-600'>{$minutes} minutes ago</span>";
                                    } else if ($timeDiff < 86400) { // Less than 24 hours
                                        $hours = floor($timeDiff / 3600);
                                        echo "<span class='text-blue-600'>{$hours} hours ago</span>";
                                    } else {
                                        echo "<span class='text-gray-600'>" . date('d M, h:i A', $lastCollectionTime) . "</span>";
                                    }
                                ?>
                            </div>
                            <div class="flex space-x-2">
                                <a href="view.php?id=<?php echo $collector['id']; ?>"
                                    class="text-sm px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200">
                                    View Details
                                </a>
                                <button class="text-gray-400 hover:text-gray-600"
                                    id="menu-btn-<?php echo $collector['id']; ?>">
                                    <i class="ri-more-2-line"></i>
                                </button>
                                <div class="relative">
                                    <div class="dropdown-menu hidden absolute right-0 mt-1 w-48 bg-white rounded-md shadow-lg z-10"
                                        id="dropdown-<?php echo $collector['id']; ?>">
                                        <div class="py-1">
                                            <a href="edit.php?id=<?php echo $collector['id']; ?>"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="ri-pencil-line mr-2"></i> Edit Collector
                                            </a>
                                            <a href="history.php?id=<?php echo $collector['id']; ?>"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="ri-history-line mr-2"></i> Collection History
                                            </a>
                                            <a href="device.php?id=<?php echo $collector['id']; ?>"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="ri-smartphone-line mr-2"></i> Device Management
                                            </a>
                                            <a href="track.php?id=<?php echo $collector['id']; ?>"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="ri-map-pin-line mr-2"></i> Track Location
                                            </a>
                                            <div class="border-t border-gray-100"></div>
                                            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
                                                onclick="toggleStatus(<?php echo $collector['id']; ?>, '<?php echo $collector['status']; ?>')">
                                                <?php if ($collector['status'] === 'active'): ?>
                                                <i class="ri-stop-circle-line mr-2"></i> Deactivate
                                                <?php else: ?>
                                                <i class="ri-play-circle-line mr-2"></i> Activate
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Status Change Modal -->
    <div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 id="status-modal-title" class="text-lg font-medium text-gray-900 mb-4">Change Collector Status</h3>
                <p id="status-modal-message" class="text-gray-600 mb-6">Are you sure you want to change this collector's
                    status?</p>
                <div class="flex justify-end gap-3">
                    <button id="cancelStatus"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md">Cancel</button>
                    <a id="confirmStatusBtn" href="#"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">Confirm</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart setup for collection trend
        const collectionCtx = document.getElementById('collectionChart').getContext('2d');
        const collectionChart = new Chart(collectionCtx, {
            type: 'line',
            data: {
                labels: Object.keys(<?php echo json_encode($monthlyCollections); ?>),
                datasets: [{
                    label: 'Monthly Collections (GHS)',
                    data: Object.values(<?php echo json_encode($monthlyCollections); ?>),
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Tab functionality
        document.querySelectorAll('.collector-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs
                document.querySelectorAll('.collector-tab').forEach(t => {
                    t.classList.remove('active');
                    t.classList.add('text-gray-500');
                });

                // Add active class to clicked tab
                tab.classList.add('active');
                tab.classList.remove('text-gray-500');

                // In a real implementation, this would filter the collectors cards
                console.log('Tab clicked:', tab.textContent.trim());
            });
        });

        // Dropdown menu toggle for each collector
        <?php foreach ($collectors as $collector): ?>
        document.getElementById('menu-btn-<?php echo $collector['id']; ?>').addEventListener('click', function(
            e) {
            e.stopPropagation();
            const dropdown = document.getElementById('dropdown-<?php echo $collector['id']; ?>');

            // Hide all other dropdowns first
            document.querySelectorAll('.dropdown-menu').forEach(d => {
                if (d !== dropdown) d.classList.add('hidden');
            });

            dropdown.classList.toggle('hidden');
        });
        <?php endforeach; ?>

        // Close dropdowns when clicking elsewhere
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        });
    });

    // Function to handle collector status toggle
    function toggleStatus(id, currentStatus) {
        const modal = document.getElementById('statusModal');
        const title = document.getElementById('status-modal-title');
        const message = document.getElementById('status-modal-message');
        const confirmBtn = document.getElementById('confirmStatusBtn');

        let newStatus, actionText;

        if (currentStatus === 'active') {
            newStatus = 'inactive';
            actionText = 'deactivate';
            title.textContent = 'Deactivate Collector';
            message.textContent =
                'Are you sure you want to deactivate this collector? They will no longer be able to collect payments.';
            confirmBtn.classList.remove('bg-green-600', 'hover:bg-green-700');
            confirmBtn.classList.add('bg-red-600', 'hover:bg-red-700');
        } else {
            newStatus = 'active';
            actionText = 'activate';
            title.textContent = 'Activate Collector';
            message.textContent =
                'Are you sure you want to activate this collector? They will be able to collect payments.';
            confirmBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
            confirmBtn.classList.add('bg-green-600', 'hover:bg-green-700');
        }

        confirmBtn.href = `status.php?id=${id}&action=${actionText}`;
        modal.classList.remove('hidden');
    }

    // Close status modal
    document.getElementById('cancelStatus').addEventListener('click', function() {
        document.getElementById('statusModal').classList.add('hidden');
    });

    // Close modal when clicking outside
    document.getElementById('statusModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
    </script>

    <?php require_once __DIR__ . '/../components/layout/footer.php'; ?>
</body>

</html>