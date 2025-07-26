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

// Dummy data for reports
// Monthly revenue data
$monthlyRevenue = [
    'Jan' => 22500,
    'Feb' => 24800,
    'Mar' => 27300,
    'Apr' => 26500,
    'May' => 29700,
    'Jun' => 31200,
    'Jul' => 18600, // Current month (partial)
    'Aug' => 0,
    'Sep' => 0,
    'Oct' => 0,
    'Nov' => 0,
    'Dec' => 0
];

// Collection by zone
$collectionByZone = [
    'Central Market' => 42800,
    'Business District' => 38500,
    'Residential Area' => 21300,
    'Suburban Area' => 18700,
    'Industrial Zone' => 29400
];

// Collection by tax type
$collectionByTaxType = [
    'Business Operating Permit' => 55000,
    'Sanitation Fee' => 32400,
    'Market Stall Fee' => 28700,
    'Signage Fee' => 15600,
    'Food & Beverage License' => 22800,
    'Storage Permit' => 16300
];

// Collection by payment method
$collectionByMethod = [
    'Cash' => 65,
    'Mobile Money' => 30,
    'Bank Transfer' => 5
];

// Top collectors
$topCollectors = [
    [
        'id' => 1,
        'name' => 'John Anane',
        'amount' => 38500,
        'transactions' => 245,
        'zone' => 'Central Market',
        'image' => 'john_anane.jpg'
    ],
    [
        'id' => 3,
        'name' => 'Sarah Osei',
        'amount' => 31200,
        'transactions' => 198,
        'zone' => 'Business District',
        'image' => 'sarah_osei.jpg'
    ],
    [
        'id' => 5,
        'name' => 'Michael Agyei',
        'amount' => 28700,
        'transactions' => 176,
        'zone' => 'Industrial Zone',
        'image' => 'michael_agyei.jpg'
    ],
    [
        'id' => 2,
        'name' => 'Grace Mensah',
        'amount' => 24300,
        'transactions' => 154,
        'zone' => 'Residential Area',
        'image' => 'grace_mensah.jpg'
    ],
    [
        'id' => 4,
        'name' => 'Daniel Kumi',
        'amount' => 21900,
        'transactions' => 132,
        'zone' => 'Suburban Area',
        'image' => 'daniel_kumi.jpg'
    ]
];

// Top businesses
$topBusinesses = [
    [
        'id' => 4,
        'name' => 'Kwame Building Materials',
        'amount' => 4800,
        'tax_types' => 3,
        'last_payment' => '2023-07-05'
    ],
    [
        'id' => 6,
        'name' => 'Yaw Pharmacy',
        'amount' => 3600,
        'tax_types' => 2,
        'last_payment' => '2023-07-06'
    ],
    [
        'id' => 3,
        'name' => 'Afia Restaurant',
        'amount' => 3200,
        'tax_types' => 4,
        'last_payment' => '2023-07-10'
    ],
    [
        'id' => 2,
        'name' => 'Kofi Auto Repairs',
        'amount' => 2800,
        'tax_types' => 3,
        'last_payment' => '2023-07-11'
    ],
    [
        'id' => 7,
        'name' => 'Akosua Hair Salon',
        'amount' => 2400,
        'tax_types' => 2,
        'last_payment' => '2023-07-08'
    ]
];

// Recent reports
$recentReports = [
    [
        'id' => 'RPT-2023-07',
        'name' => 'Monthly Collection Report - June 2023',
        'type' => 'monthly',
        'generated' => '2023-07-02 08:30:15',
        'generated_by' => 'System',
        'file' => 'monthly_collection_june_2023.pdf',
        'size' => '2.4 MB'
    ],
    [
        'id' => 'RPT-2023-06',
        'name' => 'Quarterly Tax Summary - Q2 2023',
        'type' => 'quarterly',
        'generated' => '2023-07-01 14:45:22',
        'generated_by' => 'Admin',
        'file' => 'quarterly_tax_summary_q2_2023.xlsx',
        'size' => '3.8 MB'
    ],
    [
        'id' => 'RPT-2023-05',
        'name' => 'Collector Performance Report - June 2023',
        'type' => 'performance',
        'generated' => '2023-07-01 10:15:40',
        'generated_by' => 'Admin',
        'file' => 'collector_performance_june_2023.pdf',
        'size' => '1.7 MB'
    ],
    [
        'id' => 'RPT-2023-04',
        'name' => 'Business District Revenue Analysis',
        'type' => 'custom',
        'generated' => '2023-06-28 16:22:10',
        'generated_by' => 'Admin',
        'file' => 'business_district_revenue_analysis.pdf',
        'size' => '4.2 MB'
    ],
    [
        'id' => 'RPT-2023-03',
        'name' => 'Monthly Collection Report - May 2023',
        'type' => 'monthly',
        'generated' => '2023-06-02 09:10:30',
        'generated_by' => 'System',
        'file' => 'monthly_collection_may_2023.pdf',
        'size' => '2.3 MB'
    ]
];

// Current year stats
$yearStats = [
    'total_revenue' => 180600,
    'total_transactions' => 1254,
    'collection_target' => 250000,
    'collection_rate' => 72.24, // percentage
    'growth_rate' => 15.3, // percentage compared to last year
    'most_common_tax' => 'Business Operating Permit',
    'most_common_method' => 'Cash'
];

// Helper function to format currency
function formatCurrency($amount) {
    return 'GHS ' . number_format($amount, 2);
}

// Helper function to format date
function formatDate($dateString) {
    return date('d M, Y', strtotime($dateString));
}

// Helper function to format number with commas
function formatNumber($num) {
    return number_format($num);
}

// Helper function to get document icon by file extension
function getFileIcon($filename) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    switch (strtolower($ext)) {
        case 'pdf':
            return 'ri-file-pdf-line';
        case 'xlsx':
        case 'xls':
            return 'ri-file-excel-2-line';
        case 'docx':
        case 'doc':
            return 'ri-file-word-line';
        case 'pptx':
        case 'ppt':
            return 'ri-file-ppt-line';
        case 'csv':
            return 'ri-file-list-3-line';
        default:
            return 'ri-file-line';
    }
}
?>

<!DOCTYPE html>
<html lang=" en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports & Analytics - Sefwi Tax Collection</title>
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

    /* Report type styles */
    .report-monthly {
        background-color: #DBEAFE;
        color: #1E40AF;
    }

    .report-quarterly {
        background-color: #E0E7FF;
        color: #4338CA;
    }

    .report-annual {
        background-color: #EDE9FE;
        color: #6D28D9;
    }

    .report-performance {
        background-color: #FEF3C7;
        color: #92400E;
    }

    .report-custom {
        background-color: #E0F2FE;
        color: #0369A1;
    }

    /* Tab styling */
    .report-tab {
        cursor: pointer;
        border-bottom: 2px solid transparent;
        transition: all 0.3s;
    }

    .report-tab.active {
        border-bottom-color: #2563EB;
        color: #2563EB;
        font-weight: 600;
    }

    /* Progress bar styles */
    .progress-bar {
        height: 0.75rem;
        border-radius: 9999px;
        background-color: #E5E7EB;
        overflow: hidden;
    }

    .progress-value {
        height: 100%;
        background-color: #2563EB;
    }

    /* Tab panel styles */
    .tab-panel {
        display: none;
    }

    .tab-panel.active {
        display: block;
    }

    /* Report card hover effect */
    .report-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .report-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    </style>
</head>

<body class="min-h-screen bg-white" id="main-body">
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="flex items-center justify-center">
        <div class="spinner"></div>
    </div>

    <div class="md:ml-64 flex flex-col min-h-screen transition-all duration-300">
        <?php renderSidebar('reports', false); ?>

        <!-- Header -->
        <?php renderHeader('Reports & Analytics', false); ?>

        <!-- Main Content -->
        <div class="p-4 md:p-8 bg-gray-100 flex-grow overflow-y-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold">Reports & Analytics
                    </h1>
                    <p class="text-gray-600">View detailed reports and
                        tax collection analytics</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <button id="generate-report-btn"
                        class="flex items-center justify-center gap-2 bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded-md shadow-sm">
                        <i class="ri-file-chart-line"></i>
                        Generate New Report
                    </button>
                </div>
            </div>

            <!-- Year Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                            <i class="ri-money-dollar-circle-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total
                                Revenue (2023)</p>
                            <p class="text-2xl font-bold">
                                <?php echo formatCurrency($yearStats['total_revenue']); ?>
                            </p>
                            <p class="text-xs text-green-600">
                                <i class="ri-arrow-up-line"></i>
                                <?php echo $yearStats['growth_rate']; ?>%
                                from last year
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-4">
                            <i class="ri-file-list-3-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total
                                Transactions</p>
                            <p class="text-2xl font-bold">
                                <?php echo formatNumber($yearStats['total_transactions']); ?>
                            </p>
                            <p class="text-xs text-gray-500">For the
                                current year</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start">
                        <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                            <i class="ri-target-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Collection
                                Target</p>
                            <div class="flex items-baseline gap-2">
                                <p class="text-2xl font-bold">
                                    <?php echo $yearStats['collection_rate']; ?>%
                                </p>
                                <p class="text-sm text-gray-500">of
                                    <?php echo formatCurrency($yearStats['collection_target']); ?>
                                </p>
                            </div>
                            <div class="w-full mt-2">
                                <div class="progress-bar">
                                    <div class="progress-value"
                                        style="width: <?php echo $yearStats['collection_rate']; ?>%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
                            <i class="ri-bar-chart-box-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Most Common
                            </p>
                            <div class="mt-1">
                                <div class="flex items-center">
                                    <i class="ri-bill-line text-gray-400 mr-1"></i>
                                    <span class="text-sm"><?php echo $yearStats['most_common_tax']; ?></span>
                                </div>
                                <div class="flex items-center mt-1">
                                    <i class="ri-bank-card-line text-gray-400 mr-1"></i>
                                    <span class="text-sm"><?php echo $yearStats['most_common_method']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8 overflow-x-auto">
                    <div id="tab-overview" class="report-tab active whitespace-nowrap py-4 px-1 font-medium text-md">
                        Overview
                    </div>
                    <div id="tab-collections"
                        class="report-tab whitespace-nowrap py-4 px-1 font-medium text-gray-500 hover:text-gray-700 text-md">
                        Collections Analysis
                    </div>
                    <div id="tab-performance"
                        class="report-tab whitespace-nowrap py-4 px-1 font-medium text-gray-500 hover:text-gray-700 text-md">
                        Performance Metrics
                    </div>
                    <div id="tab-documents"
                        class="report-tab whitespace-nowrap py-4 px-1 font-medium text-gray-500 hover:text-gray-700 text-md">
                        Report Documents
                    </div>
                </nav>
            </div>

            <!-- Tab Content: Overview -->
            <div id="panel-overview" class="tab-panel active">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Monthly Revenue Chart -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Monthly
                            Revenue (2023)</h3>
                        <canvas id="revenueChart" height="300"></canvas>
                    </div>

                    <!-- Collection by Payment Method -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">
                            Collection by Method</h3>
                        <div class="flex justify-center">
                            <canvas id="methodChart" height="250"></canvas>
                        </div>
                        <div class="flex justify-center space-x-8 mt-4">
                            <div class="text-center">
                                <div class="flex items-center justify-center">
                                    <div class="w-3 h-3 rounded-full bg-green-500 mr-1">
                                    </div>
                                    <span class="text-sm">Cash</span>
                                </div>
                                <p class="text-lg font-medium mt-1">
                                    <?php echo $collectionByMethod['Cash']; ?>%
                                </p>
                            </div>
                            <div class="text-center">
                                <div class="flex items-center justify-center">
                                    <div class="w-3 h-3 rounded-full bg-blue-500 mr-1">
                                    </div>
                                    <span class="text-sm">Mobile
                                        Money</span>
                                </div>
                                <p class="text-lg font-medium mt-1">
                                    <?php echo $collectionByMethod['Mobile Money']; ?>%
                                </p>
                            </div>
                            <div class="text-center">
                                <div class="flex items-center justify-center">
                                    <div class="w-3 h-3 rounded-full bg-purple-500 mr-1">
                                    </div>
                                    <span class="text-sm">Bank
                                        Transfer</span>
                                </div>
                                <p class="text-lg font-medium mt-1">
                                    <?php echo $collectionByMethod['Bank Transfer']; ?>%
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Top Collectors -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold">Top
                                    Collectors</h3>
                                <a href="collectors-report.php" class="text-sm text-blue-600 hover:text-blue-800">
                                    View Full Report <i class="ri-arrow-right-line align-middle"></i>
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            <?php foreach ($topCollectors as $index => $collector): ?>
                            <div
                                class="flex items-center <?php echo $index < count($topCollectors) - 1 ? 'mb-5 pb-5 border-b border-gray-100' : ''; ?>">
                                <div class="flex-shrink-0">
                                    <?php if (file_exists(__DIR__ . '/../../assets/images/collectors/' . $collector['image'])): ?>
                                    <img src="/../assets/images/collectors/<?php echo htmlspecialchars($collector['image']); ?>"
                                        alt="<?php echo htmlspecialchars($collector['name']); ?>"
                                        class="h-12 w-12 rounded-full object-cover">
                                    <?php else: ?>
                                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                        <i class="ri-user-3-line text-xl text-blue-400"></i>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex justify-between items-center">
                                        <a href="../collectors/view.php?id=<?php echo $collector['id']; ?>"
                                            class="font-medium text-gray-900 hover:text-blue-600">
                                            <?php echo htmlspecialchars($collector['name']); ?>
                                        </a>
                                        <span
                                            class="text-sm font-semibold"><?php echo formatCurrency($collector['amount']); ?></span>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-500 mt-1">
                                        <span><?php echo htmlspecialchars($collector['zone']); ?></span>
                                        <span><?php echo formatNumber($collector['transactions']); ?>
                                            transactions</span>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Top Businesses -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold">Top
                                    Businesses</h3>
                                <a href="businesses-report.php" class="text-sm text-blue-600 hover:text-blue-800">
                                    View Full Report <i class="ri-arrow-right-line align-middle"></i>
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            <?php foreach ($topBusinesses as $index => $business): ?>
                            <div
                                class="flex items-center <?php echo $index < count($topBusinesses) - 1 ? 'mb-5 pb-5 border-b border-gray-100' : ''; ?>">
                                <div class="flex-shrink-0">
                                    <div
                                        class="h-10 w-10 rounded-lg bg-blue-600 text-white flex items-center justify-center font-bold">
                                        <?php echo strtoupper(substr($business['name'], 0, 2)); ?>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex justify-between items-center">
                                        <a href="../businesses/view.php?id=<?php echo $business['id']; ?>"
                                            class="font-medium text-gray-900 hover:text-blue-600">
                                            <?php echo htmlspecialchars($business['name']); ?>
                                        </a>
                                        <span
                                            class="text-sm font-semibold"><?php echo formatCurrency($business['amount']); ?></span>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-500 mt-1">
                                        <span><?php echo $business['tax_types']; ?>
                                            tax types</span>
                                        <span>Last paid:
                                            <?php echo formatDate($business['last_payment']); ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Recent Reports -->
                <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold">Recent
                                Reports</h3>
                            <a href="#panel-documents" id="view-all-documents"
                                class="text-sm text-blue-600 hover:text-blue-800">
                                View All Reports <i class="ri-arrow-right-line align-middle"></i>
                            </a>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Report ID
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Generated On
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Generated By
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($recentReports as $report): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                        <?php echo htmlspecialchars($report['id']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <i
                                                class="<?php echo getFileIcon($report['file']); ?> text-gray-500 mr-2"></i>
                                            <span><?php echo htmlspecialchars($report['name']); ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            <?php 
                                                switch($report['type']) {
                                                    case 'monthly':
                                                        echo 'report-monthly';
                                                        break;
                                                    case 'quarterly':
                                                        echo 'report-quarterly';
                                                        break;
                                                    case 'annual':
                                                        echo 'report-annual';
                                                        break;
                                                    case 'performance':
                                                        echo 'report-performance';
                                                        break;
                                                    case 'custom':
                                                        echo 'report-custom';
                                                        break;
                                                }
                                            ?>">
                                            <?php echo ucfirst($report['type']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo date('d M, Y', strtotime($report['generated'])); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo htmlspecialchars($report['generated_by']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                        <div class="flex justify-end space-x-3">
                                            <a href="view-report.php?id=<?php echo $report['id']; ?>"
                                                class="text-blue-600 hover:text-blue-900">View</a>
                                            <a href="download-report.php?id=<?php echo $report['id']; ?>"
                                                class="text-green-600 hover:text-green-900">Download</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Collections Analysis -->
            <div id="panel-collections" class="tab-panel">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Collection by Zone -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Collection by Zone</h3>
                        <canvas id="zoneChart" height="300"></canvas>
                    </div>

                    <!-- Collection by Tax Type -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Collection by Tax Type</h3>
                        <canvas id="taxTypeChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Performance Metrics -->
            <div id="panel-performance" class="tab-panel">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Collector Performance -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Top Collector Performance</h3>
                        <canvas id="collectorPerformanceChart" height="300"></canvas>
                    </div>

                    <!-- Collector Rankings -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Collector Rankings</h3>
                        <div class="space-y-4">
                            <?php foreach ($topCollectors as $index => $collector): ?>
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <div class="flex items-center">
                                        <span
                                            class="text-sm font-medium"><?php echo ($index + 1) . '. ' . htmlspecialchars($collector['name']); ?></span>
                                    </div>
                                    <span
                                        class="text-sm font-medium"><?php echo formatCurrency($collector['amount']); ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full"
                                        style="width: <?php echo ($collector['amount'] / $topCollectors[0]['amount']) * 100; ?>%">
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Report Documents -->
            <div id="panel-documents" class="tab-panel">
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="flex flex-col md:flex-row justify-between md:items-center mb-6">
                        <h3 class="text-lg font-semibold">All Reports</h3>
                        <div class="mt-3 md:mt-0 flex space-x-3">
                            <div class="relative">
                                <input type="text" placeholder="Search reports..."
                                    class="pl-8 pr-4 py-2 border border-gray-300 rounded-md shadow-sm w-full focus:ring-blue-500 focus:border-blue-500">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ri-search-line text-gray-500"></i>
                                </div>
                            </div>
                            <div>
                                <select
                                    class="border border-gray-300 rounded-md py-2 px-3 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Types</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="quarterly">Quarterly</option>
                                    <option value="annual">Annual</option>
                                    <option value="performance">Performance</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Report ID
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Generated On
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Size
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($recentReports as $report): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                        <?php echo htmlspecialchars($report['id']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <i
                                                class="<?php echo getFileIcon($report['file']); ?> text-gray-500 mr-2"></i>
                                            <span><?php echo htmlspecialchars($report['name']); ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            <?php 
                                                switch($report['type']) {
                                                    case 'monthly':
                                                        echo 'report-monthly';
                                                        break;
                                                    case 'quarterly':
                                                        echo 'report-quarterly';
                                                        break;
                                                    case 'annual':
                                                        echo 'report-annual';
                                                        break;
                                                    case 'performance':
                                                        echo 'report-performance';
                                                        break;
                                                    case 'custom':
                                                        echo 'report-custom';
                                                        break;
                                                }
                                            ?>">
                                            <?php echo ucfirst($report['type']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo date('d M, Y', strtotime($report['generated'])); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo htmlspecialchars($report['size']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                        <div class="flex justify-end space-x-3">
                                            <a href="view-report.php?id=<?php echo $report['id']; ?>"
                                                class="text-blue-600 hover:text-blue-900">View</a>
                                            <a href="download-report.php?id=<?php echo $report['id']; ?>"
                                                class="text-green-600 hover:text-green-900">Download</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Generate Report Modal -->
    <div id="generateReportModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Generate New Report</h3>
                <form id="reportForm">
                    <div class="mb-4">
                        <label for="reportType" class="block text-sm font-medium text-gray-700 mb-1">Report Type</label>
                        <select id="reportType" name="reportType"
                            class="w-full rounded-md border border-gray-300 p-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="monthly">Monthly Collection Report</option>
                            <option value="quarterly">Quarterly Tax Summary</option>
                            <option value="annual">Annual Revenue Report</option>
                            <option value="performance">Collector Performance Report</option>
                            <option value="custom">Custom Report</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="reportPeriod" class="block text-sm font-medium text-gray-700 mb-1">Period</label>
                        <div class="flex space-x-2">
                            <input type="date" id="startDate" name="startDate"
                                class="flex-1 rounded-md border border-gray-300 p-2 focus:ring-blue-500 focus:border-blue-500">
                            <span class="flex items-center">to</span>
                            <input type="date" id="endDate" name="endDate"
                                class="flex-1 rounded-md border border-gray-300 p-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="reportFormat" class="block text-sm font-medium text-gray-700 mb-1">Format</label>
                        <select id="reportFormat" name="reportFormat"
                            class="w-full rounded-md border border-gray-300 p-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="pdf">PDF Document</option>
                            <option value="excel">Excel Spreadsheet</option>
                            <option value="csv">CSV File</option>
                        </select>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button type="button" id="cancelReportBtn"
                            class="mr-3 px-4 py-2 border border-gray-300 bg-white text-gray-700 rounded-md shadow-sm hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow-sm">
                            Generate Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart setup for monthly revenue
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: Object.keys(<?php echo json_encode($monthlyRevenue); ?>),
                datasets: [{
                    label: 'Monthly Revenue (GHS)',
                    data: Object.values(<?php echo json_encode($monthlyRevenue); ?>),
                    backgroundColor: 'rgba(37, 99, 235, 0.6)',
                    borderColor: 'rgba(37, 99, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'GHS ' + value.toLocaleString();
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'GHS ' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Chart setup for payment methods
        const methodCtx = document.getElementById('methodChart').getContext('2d');
        const methodChart = new Chart(methodCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(<?php echo json_encode($collectionByMethod); ?>),
                datasets: [{
                    data: Object.values(<?php echo json_encode($collectionByMethod); ?>),
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.8)', // green for Cash
                        'rgba(59, 130, 246, 0.8)', // blue for Mobile Money
                        'rgba(139, 92, 246, 0.8)' // purple for Bank
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw + '%';
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