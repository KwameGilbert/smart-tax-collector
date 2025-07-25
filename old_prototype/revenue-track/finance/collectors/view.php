<?php
// Include the database connection class
require_once __DIR__ . '/../../database/database.php';

// Check authentication
require_once __DIR__ . '/../login/authcheck.php';

// Get database connection
$db = Database::getInstance();
$conn = $db->getConnection();

// Check if ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$collectorId = intval($_GET['id']);

// In a real implementation, fetch this from the database
// For now, use dummy data for demonstration
$collector = [
    'id' => $collectorId,
    'name' => 'John Anane',
    'email' => 'john.anane@sefwi.gov.gh',
    'phone' => '0244123456',
    'status' => 'active',
    'zone' => 'Central Market',
    'joined_date' => '2022-08-15',
    'collections_today' => 4,
    'collections_week' => 23,
    'collections_month' => 87,
    'collections_total' => 1254,
    'amount_today' => 650.00,
    'amount_week' => 3750.00,
    'amount_month' => 12480.00,
    'amount_total' => 187650.00,
    'last_collection' => '2023-07-12 09:45:22',
    'device_id' => 'SM-G975F-354651234567890',
    'device_name' => 'Samsung Galaxy S10+',
    'device_status' => 'online',
    'last_login' => '2023-07-12 07:30:15',
    'last_location' => ['lat' => 6.21462, 'lng' => -2.17898, 'timestamp' => '2023-07-12 09:43:18'],
    'address' => '24 Market Avenue, Sefwi',
    'national_id' => 'GHA-123456789-0',
    'employment_id' => 'EMP-SEFWI-2022-015',
    'image' => 'john_anane.jpg', // Placeholder, in real implementation this would be path to image
    'performance_rating' => 4.8,
    'performance_level' => 'High',
    'supervisor' => 'Michael Addo',
    'targets' => [
        'daily' => 1000.00,
        'weekly' => 5000.00,
        'monthly' => 20000.00
    ],
    'achievement' => [
        'daily' => 65, // percentage
        'weekly' => 75, // percentage
        'monthly' => 62  // percentage
    ]
];

// Dummy data for recent collections
$recentCollections = [
    [
        'id' => 1001,
        'receipt_number' => 'RCP-2023-1001',
        'business_id' => 1,
        'business_name' => 'Adwoa Grocery Shop',
        'tax_type' => 'Business Operating Permit',
        'amount' => 200.00,
        'payment_date' => '2023-07-12 09:45:22',
        'payment_method' => 'Cash',
        'status' => 'confirmed'
    ],
    [
        'id' => 995,
        'receipt_number' => 'RCP-2023-995',
        'business_id' => 3,
        'business_name' => 'Afia Restaurant',
        'tax_type' => 'Food & Beverage License',
        'amount' => 150.00,
        'payment_date' => '2023-07-12 09:12:30',
        'payment_method' => 'Mobile Money',
        'status' => 'confirmed'
    ],
    [
        'id' => 982,
        'receipt_number' => 'RCP-2023-982',
        'business_id' => 5,
        'business_name' => 'Ama Fashion Boutique',
        'tax_type' => 'Signage Fee',
        'amount' => 75.00,
        'payment_date' => '2023-07-12 08:54:15',
        'payment_method' => 'Cash',
        'status' => 'confirmed'
    ],
    [
        'id' => 975,
        'receipt_number' => 'RCP-2023-975',
        'business_id' => 2,
        'business_name' => 'Kofi Auto Repairs',
        'tax_type' => 'Business Operating Permit',
        'amount' => 225.00,
        'payment_date' => '2023-07-12 08:30:40',
        'payment_method' => 'Cash',
        'status' => 'confirmed'
    ]
];

// Monthly collection data for chart
$monthlyCollections = [
    'Jan' => 8750,
    'Feb' => 10200,
    'Mar' => 12400,
    'Apr' => 11300,
    'May' => 14500,
    'Jun' => 12800,
    'Jul' => 7800, // Current month (partial)
    'Aug' => 0,
    'Sep' => 0,
    'Oct' => 0,
    'Nov' => 0,
    'Dec' => 0
];

// Dummy data for collection by method
$collectionByMethod = [
    'Cash' => 68,
    'Mobile Money' => 27,
    'Bank Transfer' => 5
];

// Dummy data for activity log
$activityLog = [
    [
        'action' => 'Login',
        'timestamp' => '2023-07-12 07:30:15',
        'details' => 'Logged in from device SM-G975F',
        'location' => 'Sefwi Central'
    ],
    [
        'action' => 'Collection',
        'timestamp' => '2023-07-12 08:30:40',
        'details' => 'Collected GHS 225.00 from Kofi Auto Repairs',
        'location' => 'Mechanic Lane, Sefwi'
    ],
    [
        'action' => 'Collection',
        'timestamp' => '2023-07-12 08:54:15',
        'details' => 'Collected GHS 75.00 from Ama Fashion Boutique',
        'location' => 'Shopping Mall, Sefwi'
    ],
    [
        'action' => 'Collection',
        'timestamp' => '2023-07-12 09:12:30',
        'details' => 'Collected GHS 150.00 from Afia Restaurant',
        'location' => 'High Street, Sefwi'
    ],
    [
        'action' => 'Collection',
        'timestamp' => '2023-07-12 09:45:22',
        'details' => 'Collected GHS 200.00 from Adwoa Grocery Shop',
        'location' => 'Central Market, Sefwi'
    ]
];

// Include components
require_once __DIR__ . '/../components/layout/header.php';
require_once __DIR__ . '/../components/layout/sidebar.php';

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
        return formatDateTime($dateString);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($collector['name']); ?> - Collector Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="/../finance/components/shared/app.js"></script>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include Leaflet.js for the map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
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

    /* Map container */
    #map {
        height: 300px;
        border-radius: 0.5rem;
        z-index: 10;
    }

    /* Target progress bar styles */
    .target-bar {
        height: 0.75rem;
        border-radius: 9999px;
        background-color: #E5E7EB;
        overflow: hidden;
    }

    .target-progress {
        height: 100%;
    }

    .target-daily {
        background-color: #3B82F6;
    }

    .target-weekly {
        background-color: #8B5CF6;
    }

    .target-monthly {
        background-color: #EC4899;
    }

    /* Tab panel styles */
    .tab-panel {
        display: none;
    }

    .tab-panel.active {
        display: block;
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
        <?php renderHeader('Collector Details', false); ?>

        <!-- Main Content -->
        <div class="p-4 md:p-8 bg-gray-100 flex-grow overflow-y-auto">
            <div class="flex items-center mb-6">
                <a href="index.php" class="mr-4 text-blue-600 hover:text-blue-800">
                    <i class="ri-arrow-left-line text-xl"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-bold"><?php echo htmlspecialchars($collector['name']); ?></h1>
                    <p class="text-gray-600">ID: <?php echo htmlspecialchars($collector['employment_id']); ?></p>
                </div>
            </div>

            <!-- Collector Overview -->
            <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row">
                        <!-- Profile Image Column -->
                        <div class="flex flex-col items-center md:w-1/4 mb-6 md:mb-0">
                            <div class="relative mb-4">
                                <?php if (file_exists(__DIR__ . '/../../assets/images/collectors/' . $collector['image'])): ?>
                                <img src="/../assets/images/collectors/<?php echo htmlspecialchars($collector['image']); ?>"
                                    alt="<?php echo htmlspecialchars($collector['name']); ?>"
                                    class="h-48 w-48 rounded-full object-cover border-4 border-blue-100">
                                <?php else: ?>
                                <div class="h-48 w-48 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="ri-user-3-line text-7xl text-blue-400"></i>
                                </div>
                                <?php endif; ?>
                                <span class="absolute bottom-2 right-2 h-6 w-6 rounded-full 
                                    <?php echo $collector['device_status'] === 'online' ? 'bg-green-500' : 'bg-gray-400'; ?> 
                                    border-4 border-white"></span>
                            </div>
                            <div class="text-center mb-4">
                                <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($collector['name']); ?>
                                </h2>
                                <p class="text-gray-500"><?php echo htmlspecialchars($collector['zone']); ?> Zone</p>
                                <span class="inline-block mt-2 px-3 py-1 text-sm rounded-full 
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
                            <div class="flex flex-col items-center">
                                <div class="text-center mb-3">
                                    <div class="text-sm text-gray-500">Performance Rating</div>
                                    <div class="flex items-center mt-1">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if ($i <= floor($collector['performance_rating'])): ?>
                                        <i class="ri-star-fill text-yellow-400 text-xl"></i>
                                        <?php elseif ($i - $collector['performance_rating'] < 1 && $i - $collector['performance_rating'] > 0): ?>
                                        <i class="ri-star-half-fill text-yellow-400 text-xl"></i>
                                        <?php else: ?>
                                        <i class="ri-star-line text-yellow-400 text-xl"></i>
                                        <?php endif; ?>
                                        <?php endfor; ?>
                                        <span
                                            class="ml-2 text-lg font-medium"><?php echo $collector['performance_rating']; ?></span>
                                    </div>
                                </div>
                                <div class="w-full flex justify-center space-x-2">
                                    <a href="edit.php?id=<?php echo $collector['id']; ?>"
                                        class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                                        <i class="ri-pencil-line mr-1"></i> Edit
                                    </a>
                                    <button
                                        onclick="toggleStatus(<?php echo $collector['id']; ?>, '<?php echo $collector['status']; ?>')"
                                        class="px-3 py-1 <?php echo $collector['status'] === 'active' ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600'; ?> text-white text-sm rounded">
                                        <?php if ($collector['status'] === 'active'): ?>
                                        <i class="ri-stop-circle-line mr-1"></i> Deactivate
                                        <?php else: ?>
                                        <i class="ri-play-circle-line mr-1"></i> Activate
                                        <?php endif; ?>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Collector Details Column -->
                        <div class="md:w-3/4 md:pl-6 md:border-l border-gray-200">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Contact Information -->
                                <div>
                                    <h3 class="text-lg font-semibold mb-3">Contact Information</h3>
                                    <ul class="space-y-3">
                                        <li class="flex items-center">
                                            <i class="ri-mail-line text-gray-500 mr-2"></i>
                                            <span><?php echo htmlspecialchars($collector['email']); ?></span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="ri-smartphone-line text-gray-500 mr-2"></i>
                                            <span><?php echo htmlspecialchars($collector['phone']); ?></span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="ri-map-pin-line text-gray-500 mr-2"></i>
                                            <span><?php echo htmlspecialchars($collector['address']); ?></span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="ri-government-line text-gray-500 mr-2"></i>
                                            <span>ID: <?php echo htmlspecialchars($collector['national_id']); ?></span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Employment Information -->
                                <div>
                                    <h3 class="text-lg font-semibold mb-3">Employment Information</h3>
                                    <ul class="space-y-3">
                                        <li class="flex items-center">
                                            <i class="ri-calendar-line text-gray-500 mr-2"></i>
                                            <span>Joined: <?php echo formatDate($collector['joined_date']); ?></span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="ri-user-follow-line text-gray-500 mr-2"></i>
                                            <span>Reports to:
                                                <?php echo htmlspecialchars($collector['supervisor']); ?></span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="ri-map-2-line text-gray-500 mr-2"></i>
                                            <span>Assignment: <?php echo htmlspecialchars($collector['zone']); ?></span>
                                        </li>
                                        <li class="flex items-center">
                                            <i class="ri-device-line text-gray-500 mr-2"></i>
                                            <span class="flex items-center">
                                                Device: <?php echo htmlspecialchars($collector['device_name']); ?>
                                                <span
                                                    class="ml-2 w-2 h-2 rounded-full 
                                                    <?php echo $collector['device_status'] === 'online' ? 'bg-green-500' : 'bg-gray-400'; ?>">
                                                </span>
                                                <span
                                                    class="ml-1 text-sm <?php echo $collector['device_status'] === 'online' ? 'text-green-600' : 'text-gray-500'; ?>">
                                                    <?php echo ucfirst($collector['device_status']); ?>
                                                </span>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Collection Statistics -->
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold mb-3">Collection Statistics</h3>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <div class="bg-blue-50 rounded-lg p-4 text-center">
                                        <p class="text-sm text-gray-600">Today</p>
                                        <p class="text-xl font-bold">
                                            <?php echo formatCurrency($collector['amount_today']); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo $collector['collections_today']; ?>
                                            transactions</p>
                                    </div>
                                    <div class="bg-purple-50 rounded-lg p-4 text-center">
                                        <p class="text-sm text-gray-600">This Week</p>
                                        <p class="text-xl font-bold">
                                            <?php echo formatCurrency($collector['amount_week']); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo $collector['collections_week']; ?>
                                            transactions</p>
                                    </div>
                                    <div class="bg-pink-50 rounded-lg p-4 text-center">
                                        <p class="text-sm text-gray-600">This Month</p>
                                        <p class="text-xl font-bold">
                                            <?php echo formatCurrency($collector['amount_month']); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo $collector['collections_month']; ?>
                                            transactions</p>
                                    </div>
                                    <div class="bg-indigo-50 rounded-lg p-4 text-center">
                                        <p class="text-sm text-gray-600">All Time</p>
                                        <p class="text-xl font-bold">
                                            <?php echo formatCurrency($collector['amount_total']); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo $collector['collections_total']; ?>
                                            transactions</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Performance Targets -->
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold mb-3">Performance Targets</h3>
                                <div class="space-y-4">
                                    <div>
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-sm font-medium">Daily Target</span>
                                            <span
                                                class="text-sm font-medium"><?php echo $collector['achievement']['daily']; ?>%</span>
                                        </div>
                                        <div class="target-bar">
                                            <div class="target-progress target-daily"
                                                style="width: <?php echo $collector['achievement']['daily']; ?>%"></div>
                                        </div>
                                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                                            <span>Collected:
                                                <?php echo formatCurrency($collector['amount_today']); ?></span>
                                            <span>Target:
                                                <?php echo formatCurrency($collector['targets']['daily']); ?></span>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-sm font-medium">Weekly Target</span>
                                            <span
                                                class="text-sm font-medium"><?php echo $collector['achievement']['weekly']; ?>%</span>
                                        </div>
                                        <div class="target-bar">
                                            <div class="target-progress target-weekly"
                                                style="width: <?php echo $collector['achievement']['weekly']; ?>%">
                                            </div>
                                        </div>
                                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                                            <span>Collected:
                                                <?php echo formatCurrency($collector['amount_week']); ?></span>
                                            <span>Target:
                                                <?php echo formatCurrency($collector['targets']['weekly']); ?></span>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-sm font-medium">Monthly Target</span>
                                            <span
                                                class="text-sm font-medium"><?php echo $collector['achievement']['monthly']; ?>%</span>
                                        </div>
                                        <div class="target-bar">
                                            <div class="target-progress target-monthly"
                                                style="width: <?php echo $collector['achievement']['monthly']; ?>%">
                                            </div>
                                        </div>
                                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                                            <span>Collected:
                                                <?php echo formatCurrency($collector['amount_month']); ?></span>
                                            <span>Target:
                                                <?php echo formatCurrency($collector['targets']['monthly']); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <div id="tab-collections"
                        class="collector-tab active whitespace-nowrap py-4 px-1 font-medium text-md">
                        Collection Activity
                    </div>
                    <div id="tab-performance"
                        class="collector-tab whitespace-nowrap py-4 px-1 font-medium text-gray-500 hover:text-gray-700 text-md">
                        Performance Analytics
                    </div>
                    <div id="tab-location"
                        class="collector-tab whitespace-nowrap py-4 px-1 font-medium text-gray-500 hover:text-gray-700 text-md">
                        Location Tracking
                    </div>
                    <div id="tab-device"
                        class="collector-tab whitespace-nowrap py-4 px-1 font-medium text-gray-500 hover:text-gray-700 text-md">
                        Device Information
                    </div>
                </nav>
            </div>

            <!-- Tab Content: Collection Activity -->
            <div id="panel-collections" class="tab-panel active">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Collections -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow">
                            <div class="p-6 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold">Recent Collections</h3>
                                    <a href="history.php?id=<?php echo $collector['id']; ?>"
                                        class="text-sm text-blue-600 hover:text-blue-800">
                                        View All <i class="ri-arrow-right-line align-middle"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Receipt No.
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
                                                Time
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <?php foreach ($recentCollections as $collection): ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                                <?php echo htmlspecialchars($collection['receipt_number']); ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="../businesses/view.php?id=<?php echo $collection['business_id']; ?>"
                                                    class="text-blue-600 hover:text-blue-900">
                                                    <?php echo htmlspecialchars($collection['business_name']); ?>
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php echo htmlspecialchars($collection['tax_type']); ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap font-medium">
                                                <?php echo formatCurrency($collection['amount']); ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php echo timeAgo($collection['payment_date']); ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                                <a href="../payments/view-receipt.php?id=<?php echo $collection['id']; ?>"
                                                    class="text-blue-600 hover:text-blue-900">
                                                    <i class="ri-file-list-line"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Log -->
                    <div>
                        <div class="bg-white rounded-lg shadow">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-lg font-semibold">Today's Activity Log</h3>
                            </div>
                            <div class="p-6">
                                <div class="relative">
                                    <!-- Activity timeline -->
                                    <div class="border-l-2 border-blue-200 ml-3 pl-6 space-y-6">
                                        <?php foreach ($activityLog as $activity): ?>
                                        <div class="relative">
                                            <!-- Timeline dot -->
                                            <div
                                                class="absolute -left-10 mt-1.5 w-4 h-4 rounded-full bg-blue-500 border-2 border-white">
                                            </div>

                                            <!-- Activity content -->
                                            <div>
                                                <p class="text-sm font-medium">
                                                    <?php echo htmlspecialchars($activity['action']); ?>
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    <?php echo date('h:i A', strtotime($activity['timestamp'])); ?>
                                                </p>
                                                <p class="text-sm mt-1">
                                                    <?php echo htmlspecialchars($activity['details']); ?>
                                                </p>
                                                <?php if (isset($activity['location'])): ?>
                                                <p class="text-xs text-gray-600 mt-1">
                                                    <i class="ri-map-pin-line"></i>
                                                    <?php echo htmlspecialchars($activity['location']); ?>
                                                </p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="mt-6 text-center">
                                    <a href="activity.php?id=<?php echo $collector['id']; ?>"
                                        class="text-sm text-blue-600 hover:text-blue-800">
                                        View Full Activity History
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Performance Analytics -->
            <div id="panel-performance" class="tab-panel">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Monthly Collection Chart -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Monthly Collections (2023)</h3>
                        <canvas id="monthlyCollectionChart" height="300"></canvas>
                    </div>

                    <!-- Collection by Method Chart -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Collection by Payment Method</h3>
                        <div class="flex justify-center">
                            <div style="max-width: 300px;">
                                <canvas id="collectionMethodChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Metrics -->
                    <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
                        <h3 class="text-lg font-semibold mb-4">Performance Metrics</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-500">Average Collection</h4>
                                <p class="text-2xl font-bold">
                                    <?php echo formatCurrency($collector['amount_month'] / date('j')); ?></p>
                                <p class="text-xs text-gray-500">Per day this month</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-500">Collection Efficiency</h4>
                                <p class="text-2xl font-bold">
                                    <?php echo round(($collector['amount_month'] / $collector['targets']['monthly']) * 100); ?>%
                                </p>
                                <p class="text-xs text-gray-500">Of monthly target</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-500">Success Rate</h4>
                                <p class="text-2xl font-bold">98%</p>
                                <p class="text-xs text-gray-500">Payment completions</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-500">Average Transaction</h4>
                                <p class="text-2xl font-bold">
                                    <?php echo formatCurrency($collector['amount_month'] / $collector['collections_month']); ?>
                                </p>
                                <p class="text-xs text-gray-500">Per collection</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-500">Collection Time</h4>
                                <p class="text-2xl font-bold">5.2 min</p>
                                <p class="text-xs text-gray-500">Average per transaction</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-500">Customer Feedback</h4>
                                <p class="text-2xl font-bold">4.9/5.0</p>
                                <p class="text-xs text-gray-500">From 125 ratings</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Location Tracking -->
            <div id="panel-location" class="tab-panel">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Map -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Current Location</h3>
                        <div id="map" class="w-full"></div>
                        <div class="mt-4 text-sm text-gray-600">
                            <p>
                                <i class="ri-map-pin-time-line text-blue-600"></i>
                                Last updated: <?php echo formatDateTime($collector['last_location']['timestamp']); ?>
                            </p>
                            <p class="mt-1">
                                <i class="ri-map-pin-line text-blue-600"></i>
                                Coordinates: <?php echo $collector['last_location']['lat']; ?>,
                                <?php echo $collector['last_location']['lng']; ?>
                            </p>
                        </div>
                    </div>

                    <!-- Location History -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold">Today's Route</h3>
                        </div>
                        <div class="p-6">
                            <div class="relative">
                                <!-- Route timeline -->
                                <div class="border-l-2 border-blue-200 ml-3 pl-6 space-y-6">
                                    <?php foreach (array_reverse($activityLog) as $index => $activity): ?>
                                    <div class="relative">
                                        <!-- Timeline dot -->
                                        <div class="absolute -left-10 mt-1.5 w-4 h-4 rounded-full 
                                            <?php echo $index === count($activityLog) - 1 ? 'bg-green-500' : 'bg-blue-500'; ?> 
                                            border-2 border-white"></div>

                                        <!-- Location content -->
                                        <div>
                                            <p class="text-sm font-medium">
                                                <?php echo htmlspecialchars($activity['location']); ?>
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                <?php echo date('h:i A', strtotime($activity['timestamp'])); ?>
                                            </p>
                                            <p class="text-sm mt-1">
                                                <?php echo htmlspecialchars($activity['action']); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="mt-6 text-center">
                                <a href="route-history.php?id=<?php echo $collector['id']; ?>"
                                    class="text-sm text-blue-600 hover:text-blue-800">
                                    View Complete Route History
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Device Information -->
            <div id="panel-device" class="tab-panel">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Device Details -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold">Device Information</h3>
                                <span
                                    class="px-2 py-1 text-xs rounded-full 
                                    <?php echo $collector['device_status'] === 'online' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; ?>">
                                    <?php echo ucfirst($collector['device_status']); ?>
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-center mb-6">
                                <div class="w-24 h-40 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="ri-smartphone-line text-5xl text-gray-400"></i>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Device Name</p>
                                    <p class="font-medium"><?php echo htmlspecialchars($collector['device_name']); ?>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Device ID</p>
                                    <p class="font-medium"><?php echo htmlspecialchars($collector['device_id']); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Last Login</p>
                                    <p class="font-medium"><?php echo formatDateTime($collector['last_login']); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Last Sync</p>
                                    <p class="font-medium"><?php echo formatDateTime($collector['last_collection']); ?>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">App Version</p>
                                    <p class="font-medium">v2.3.5</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">OS Version</p>
                                    <p class="font-medium">Android 12</p>
                                </div>
                            </div>

                            <div class="mt-6 flex space-x-3 justify-center">
                                <button class="px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200">
                                    <i class="ri-refresh-line mr-1"></i> Sync Device
                                </button>
                                <button class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-md hover:bg-yellow-200">
                                    <i class="ri-lock-line mr-1"></i> Lock Device
                                </button>
                                <button class="px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200">
                                    <i class="ri-delete-bin-line mr-1"></i> Unregister
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- System Logs -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold">System Logs</h3>
                        </div>
                        <div class="p-6">
                            <div class="bg-gray-50 p-4 rounded-lg max-h-96 overflow-y-auto font-mono text-sm">
                                <div class="text-gray-600">[<?php echo date('Y-m-d H:i:s', strtotime('-5 minutes')); ?>]
                                    Device sync completed successfully</div>
                                <div class="text-gray-600">[<?php echo date('Y-m-d H:i:s', strtotime('-2 hours')); ?>]
                                    Location tracking enabled</div>
                                <div class="text-gray-600">[<?php echo date('Y-m-d H:i:s', strtotime('-2 hours')); ?>]
                                    User logged in</div>
                                <div class="text-gray-600">[<?php echo date('Y-m-d H:i:s', strtotime('-1 day')); ?>]
                                    Device sync completed successfully</div>
                                <div class="text-gray-600">[<?php echo date('Y-m-d H:i:s', strtotime('-1 day')); ?>]
                                    Location tracking disabled</div>
                                <div class="text-gray-600">[<?php echo date('Y-m-d H:i:s', strtotime('-1 day')); ?>]
                                    User logged out</div>
                                <div class="text-gray-600">
                                    [<?php echo date('Y-m-d H:i:s', strtotime('-1 day -8 hours')); ?>] Device sync
                                    completed successfully</div>
                                <div class="text-gray-600">
                                    [<?php echo date('Y-m-d H:i:s', strtotime('-1 day -8 hours')); ?>] Collection data
                                    uploaded</div>
                                <div class="text-gray-600">
                                    [<?php echo date('Y-m-d H:i:s', strtotime('-1 day -8 hours')); ?>] Location tracking
                                    enabled</div>
                                <div class="text-gray-600">
                                    [<?php echo date('Y-m-d H:i:s', strtotime('-1 day -8 hours')); ?>] User logged in
                                </div>
                                <div class="text-gray-600">[<?php echo date('Y-m-d H:i:s', strtotime('-2 days')); ?>]
                                    App updated to version 2.3.5</div>
                                <div class="text-gray-600">[<?php echo date('Y-m-d H:i:s', strtotime('-2 days')); ?>]
                                    Device sync completed successfully</div>
                                <div class="text-gray-600">[<?php echo date('Y-m-d H:i:s', strtotime('-2 days')); ?>]
                                    Collection data uploaded</div>
                            </div>

                            <div class="mt-6 flex justify-center">
                                <button class="px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200">
                                    <i class="ri-download-2-line mr-1"></i> Download Full Logs
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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
        // Tab functionality
        document.querySelectorAll('.collector-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and panels
                document.querySelectorAll('.collector-tab').forEach(t => {
                    t.classList.remove('active');
                    t.classList.add('text-gray-500');
                });
                document.querySelectorAll('.tab-panel').forEach(p => {
                    p.classList.remove('active');
                });

                // Add active class to clicked tab
                tab.classList.add('active');
                tab.classList.remove('text-gray-500');

                // Get the associated panel ID and activate it
                const panelId = tab.id.replace('tab-', 'panel-');
                document.getElementById(panelId).classList.add('active');
            });
        });

        // Set up the map
        const map = L.map('map').setView([<?php echo $collector['last_location']['lat']; ?>,
            <?php echo $collector['last_location']['lng']; ?>
        ], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add marker for current location
        const marker = L.marker([<?php echo $collector['last_location']['lat']; ?>,
            <?php echo $collector['last_location']['lng']; ?>
        ]).addTo(map);
        marker.bindPopup(
            "<?php echo htmlspecialchars($collector['name']); ?><br>Last updated: <?php echo formatDateTime($collector['last_location']['timestamp']); ?>"
            ).openPopup();

        // Monthly collection chart
        const collectionCtx = document.getElementById('monthlyCollectionChart').getContext('2d');
        const collectionChart = new Chart(collectionCtx, {
            type: 'line',
            data: {
                labels: Object.keys(<?php echo json_encode($monthlyCollections); ?>),
                datasets: [{
                    label: 'Monthly Collections (GHS)',
                    data: Object.values(<?php echo json_encode($monthlyCollections); ?>),
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    borderColor: 'rgba(37, 99, 235, 1)',
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

        // Collection by method chart
        const methodCtx = document.getElementById('collectionMethodChart').getContext('2d');
        const methodChart = new Chart(methodCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(<?php echo json_encode($collectionByMethod); ?>),
                datasets: [{
                    data: Object.values(<?php echo json_encode($collectionByMethod); ?>),
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.8)', // Cash
                        'rgba(59, 130, 246, 0.8)', // Mobile Money
                        'rgba(139, 92, 246, 0.8)' // Bank Transfer
                    ],
                    borderColor: [
                        'rgba(16, 185, 129, 1)',
                        'rgba(59, 130, 246, 1)',
                        'rgba(139, 92, 246, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
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