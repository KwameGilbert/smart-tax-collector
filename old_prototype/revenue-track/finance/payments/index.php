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

// Dummy data for payments
$payments = [
    [
        'id' => 1001,
        'receipt_number' => 'RCP-2023-1001',
        'business_id' => 1,
        'business_name' => 'Adwoa Grocery Shop',
        'tax_type' => 'Business Operating Permit',
        'amount' => 200.00,
        'payment_date' => '2023-07-12',
        'payment_method' => 'Cash',
        'collected_by' => 'John Anane',
        'status' => 'confirmed'
    ],
    [
        'id' => 1002,
        'receipt_number' => 'RCP-2023-1002',
        'business_id' => 2,
        'business_name' => 'Kofi Auto Repairs',
        'tax_type' => 'Business Operating Permit',
        'amount' => 250.00,
        'payment_date' => '2023-07-11',
        'payment_method' => 'Mobile Money',
        'collected_by' => 'Sarah Osei',
        'status' => 'confirmed'
    ],
    [
        'id' => 1003,
        'receipt_number' => 'RCP-2023-1003',
        'business_id' => 3,
        'business_name' => 'Afia Restaurant',
        'tax_type' => 'Food & Beverage License',
        'amount' => 350.00,
        'payment_date' => '2023-07-10',
        'payment_method' => 'Bank Transfer',
        'collected_by' => 'Michael Agyei',
        'status' => 'pending'
    ],
    [
        'id' => 1004,
        'receipt_number' => 'RCP-2023-1004',
        'business_id' => 1,
        'business_name' => 'Adwoa Grocery Shop',
        'tax_type' => 'Sanitation Fee',
        'amount' => 50.00,
        'payment_date' => '2023-07-09',
        'payment_method' => 'Cash',
        'collected_by' => 'John Anane',
        'status' => 'confirmed'
    ],
    [
        'id' => 1005,
        'receipt_number' => 'RCP-2023-1005',
        'business_id' => 7,
        'business_name' => 'Akosua Hair Salon',
        'tax_type' => 'Business Operating Permit',
        'amount' => 180.00,
        'payment_date' => '2023-07-08',
        'payment_method' => 'Mobile Money',
        'collected_by' => 'Sarah Osei',
        'status' => 'confirmed'
    ],
    [
        'id' => 1006,
        'receipt_number' => 'RCP-2023-1006',
        'business_id' => 5,
        'business_name' => 'Ama Fashion Boutique',
        'tax_type' => 'Signage Fee',
        'amount' => 75.00,
        'payment_date' => '2023-07-07',
        'payment_method' => 'Cash',
        'collected_by' => 'John Anane',
        'status' => 'confirmed'
    ],
    [
        'id' => 1007,
        'receipt_number' => 'RCP-2023-1007',
        'business_id' => 6,
        'business_name' => 'Yaw Pharmacy',
        'tax_type' => 'Healthcare License',
        'amount' => 400.00,
        'payment_date' => '2023-07-06',
        'payment_method' => 'Bank Transfer',
        'collected_by' => 'Michael Agyei',
        'status' => 'cancelled'
    ],
    [
        'id' => 1008,
        'receipt_number' => 'RCP-2023-1008',
        'business_id' => 4,
        'business_name' => 'Kwame Building Materials',
        'tax_type' => 'Storage Permit',
        'amount' => 300.00,
        'payment_date' => '2023-07-05',
        'payment_method' => 'Mobile Money',
        'collected_by' => 'Sarah Osei',
        'status' => 'confirmed'
    ],
    [
        'id' => 1009,
        'receipt_number' => 'RCP-2023-1009',
        'business_id' => 2,
        'business_name' => 'Kofi Auto Repairs',
        'tax_type' => 'Sanitation Fee',
        'amount' => 50.00,
        'payment_date' => '2023-07-04',
        'payment_method' => 'Cash',
        'collected_by' => 'John Anane',
        'status' => 'confirmed'
    ],
    [
        'id' => 1010,
        'receipt_number' => 'RCP-2023-1010',
        'business_id' => 3,
        'business_name' => 'Afia Restaurant',
        'tax_type' => 'Sanitation Fee',
        'amount' => 50.00,
        'payment_date' => '2023-07-04',
        'payment_method' => 'Mobile Money',
        'collected_by' => 'Sarah Osei',
        'status' => 'confirmed'
    ]
];

// Calculate total revenue and counts
$totalRevenue = 0;
$cashPayments = 0;
$mobileMoneyPayments = 0;
$bankTransferPayments = 0;
$confirmedCount = 0;
$pendingCount = 0;
$cancelledCount = 0;

foreach ($payments as $payment) {
    if ($payment['status'] !== 'cancelled') {
        $totalRevenue += $payment['amount'];
    }
    
    if ($payment['payment_method'] === 'Cash') {
        $cashPayments++;
    } elseif ($payment['payment_method'] === 'Mobile Money') {
        $mobileMoneyPayments++;
    } elseif ($payment['payment_method'] === 'Bank Transfer') {
        $bankTransferPayments++;
    }
    
    if ($payment['status'] === 'confirmed') {
        $confirmedCount++;
    } elseif ($payment['status'] === 'pending') {
        $pendingCount++;
    } elseif ($payment['status'] === 'cancelled') {
        $cancelledCount++;
    }
}

// Payment method distribution for the chart
$paymentMethodDistribution = [
    'cash' => $cashPayments,
    'mobile_money' => $mobileMoneyPayments,
    'bank_transfer' => $bankTransferPayments
];

// Monthly revenue data for chart (dummy data)
$monthlyRevenue = [
    'Jan' => 12500,
    'Feb' => 15200,
    'Mar' => 18000,
    'Apr' => 16800,
    'May' => 19200,
    'Jun' => 21500,
    'Jul' => 17800, // Current month (partial)
    'Aug' => 0,
    'Sep' => 0,
    'Oct' => 0,
    'Nov' => 0,
    'Dec' => 0
];

// Helper function to format currency
function formatCurrency($amount) {
    return 'GHS ' . number_format($amount, 2);
}

// Helper function to format date
function formatDate($dateString) {
    return date('d M, Y', strtotime($dateString));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Management - Sefwi Tax Collection</title>
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

    /* Payment status styles */
    .status-confirmed {
        background-color: #DEF7EC;
        color: #046C4E;
    }

    .status-pending {
        background-color: #FEF3C7;
        color: #92400E;
    }

    .status-cancelled {
        background-color: #FEE2E2;
        color: #B91C1C;
    }

    /* Tab styling */
    .payment-tab {
        cursor: pointer;
        border-bottom: 2px solid transparent;
        transition: all 0.3s;
    }

    .payment-tab.active {
        border-bottom-color: #2563EB;
        color: #2563EB;
        font-weight: 600;
    }
    </style>
</head>

<body class="min-h-screen bg-white" id="main-body">
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="flex items-center justify-center">
        <div class="spinner"></div>
    </div>

    <div class="md:ml-64 flex flex-col min-h-screen transition-all duration-300">
        <?php renderSidebar('payments', false); ?>

        <!-- Header -->
        <?php renderHeader('Payment Management', false); ?>

        <!-- Main Content -->
        <div class="p-4 md:p-8 bg-gray-100 flex-grow overflow-y-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold">Payment Management</h1>
                    <p class="text-gray-600">Track and manage all tax payments</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative">
                        <input type="text" placeholder="Search payments..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-search-line text-gray-500"></i>
                        </div>
                    </div>
                    <a href="record-payment.php"
                        class="flex items-center justify-center gap-2 bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded-md shadow-sm">
                        <i class="ri-add-line"></i>
                        Record New Payment
                    </a>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                            <i class="ri-money-dollar-circle-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Revenue</p>
                            <p class="text-2xl font-bold"><?php echo formatCurrency($totalRevenue); ?></p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start">
                        <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                            <i class="ri-checkbox-circle-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Confirmed Payments</p>
                            <p class="text-2xl font-bold"><?php echo $confirmedCount; ?></p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
                            <i class="ri-time-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Pending Payments</p>
                            <p class="text-2xl font-bold"><?php echo $pendingCount; ?></p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start">
                        <div class="p-3 rounded-full bg-red-100 text-red-500 mr-4">
                            <i class="ri-close-circle-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Cancelled Payments</p>
                            <p class="text-2xl font-bold"><?php echo $cancelledCount; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Revenue Trend Chart -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold mb-4">Revenue Trend (2023)</h2>
                    <canvas id="revenueChart" height="200"></canvas>
                </div>

                <!-- Payment Method Distribution -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold mb-4">Payment Method Distribution</h2>
                    <div class="flex justify-center">
                        <canvas id="paymentMethodChart" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="mb-6 bg-white p-4 rounded-lg shadow">
                <div class="flex flex-wrap gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                        <div class="flex space-x-2">
                            <input type="date" class="border border-gray-300 rounded-md p-2 text-sm">
                            <span class="flex items-center">to</span>
                            <input type="date" class="border border-gray-300 rounded-md p-2 text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                        <select
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="">All Methods</option>
                            <option value="Cash">Cash</option>
                            <option value="Mobile Money">Mobile Money</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="">All Statuses</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="pending">Pending</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tax Type</label>
                        <select
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="">All Tax Types</option>
                            <option value="Business Operating Permit">Business Operating Permit</option>
                            <option value="Sanitation Fee">Sanitation Fee</option>
                            <option value="Food & Beverage License">Food & Beverage License</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <div class="payment-tab active whitespace-nowrap py-4 px-1 font-medium text-md">
                        All Payments
                    </div>
                    <div
                        class="payment-tab whitespace-nowrap py-4 px-1 font-medium text-gray-500 hover:text-gray-700 text-md">
                        Recent (Last 7 Days)
                    </div>
                    <div
                        class="payment-tab whitespace-nowrap py-4 px-1 font-medium text-gray-500 hover:text-gray-700 text-md">
                        Pending Validation
                    </div>
                </nav>
            </div>

            <!-- Payments Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
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
                                    Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Method
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Collector
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($payments as $payment): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                    <?php echo htmlspecialchars($payment['receipt_number']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="../businesses/view.php?id=<?php echo $payment['business_id']; ?>"
                                        class="text-blue-600 hover:text-blue-900">
                                        <?php echo htmlspecialchars($payment['business_name']); ?>
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php echo htmlspecialchars($payment['tax_type']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">
                                    <?php echo formatCurrency($payment['amount']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php echo formatDate($payment['payment_date']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center">
                                        <?php if ($payment['payment_method'] === 'Cash'): ?>
                                        <i class="ri-money-dollar-box-line mr-1 text-green-600"></i>
                                        <?php elseif ($payment['payment_method'] === 'Mobile Money'): ?>
                                        <i class="ri-smartphone-line mr-1 text-blue-600"></i>
                                        <?php elseif ($payment['payment_method'] === 'Bank Transfer'): ?>
                                        <i class="ri-bank-line mr-1 text-indigo-600"></i>
                                        <?php endif; ?>
                                        <?php echo htmlspecialchars($payment['payment_method']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php echo htmlspecialchars($payment['collected_by']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded-full
                                    <?php 
                                        switch($payment['status']) {
                                            case 'confirmed':
                                                echo 'status-confirmed';
                                                break;
                                            case 'pending':
                                                echo 'status-pending';
                                                break;
                                            case 'cancelled':
                                                echo 'status-cancelled';
                                                break;
                                        }
                                    ?>">
                                        <?php echo ucfirst($payment['status']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-3">
                                        <a href="view-receipt.php?id=<?php echo $payment['id']; ?>"
                                            class="text-blue-600 hover:text-blue-900" title="View Receipt">
                                            <i class="ri-file-list-line text-lg"></i>
                                        </a>
                                        <a href="print-receipt.php?id=<?php echo $payment['id']; ?>"
                                            class="text-gray-600 hover:text-gray-900" title="Print Receipt">
                                            <i class="ri-printer-line text-lg"></i>
                                        </a>
                                        <?php if ($payment['status'] === 'pending'): ?>
                                        <button onclick="confirmPayment(<?php echo $payment['id']; ?>)"
                                            class="text-green-600 hover:text-green-900" title="Confirm Payment">
                                            <i class="ri-checkbox-circle-line text-lg"></i>
                                        </button>
                                        <?php endif; ?>
                                        <?php if ($payment['status'] !== 'cancelled'): ?>
                                        <button onclick="editPayment(<?php echo $payment['id']; ?>)"
                                            class="text-blue-600 hover:text-blue-900" title="Edit Payment">
                                            <i class="ri-pencil-line text-lg"></i>
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span
                                class="font-medium">156</span> payments
                        </div>
                        <div class="flex space-x-1">
                            <button disabled
                                class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md bg-white text-sm font-medium text-gray-400 cursor-not-allowed">
                                Previous
                            </button>
                            <button
                                class="inline-flex items-center px-3 py-1 border border-transparent rounded-md bg-blue-600 text-sm font-medium text-white">
                                1
                            </button>
                            <button
                                class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                2
                            </button>
                            <button
                                class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                3
                            </button>
                            <span class="inline-flex items-center px-3 py-1 text-gray-700">...</span>
                            <button
                                class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                16
                            </button>
                            <button
                                class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm Payment Modal -->
    <div id="confirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Confirm Payment</h3>
                <p class="text-gray-600 mb-6">Are you sure you want to confirm this payment? This action will mark the
                    payment as confirmed and update the business's payment records.</p>
                <div class="flex justify-end gap-3">
                    <button id="cancelConfirm"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md">Cancel</button>
                    <a id="confirmBtn" href="#"
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md">Confirm</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart setup for revenue trend
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: Object.keys(<?php echo json_encode($monthlyRevenue); ?>),
                datasets: [{
                    label: 'Monthly Revenue (GHS)',
                    data: Object.values(<?php echo json_encode($monthlyRevenue); ?>),
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

        // Chart setup for payment methods
        const methodCtx = document.getElementById('paymentMethodChart').getContext('2d');
        const methodChart = new Chart(methodCtx, {
            type: 'doughnut',
            data: {
                labels: ['Cash', 'Mobile Money', 'Bank Transfer'],
                datasets: [{
                    data: [
                        <?php echo $paymentMethodDistribution['cash']; ?>,
                        <?php echo $paymentMethodDistribution['mobile_money']; ?>,
                        <?php echo $paymentMethodDistribution['bank_transfer']; ?>
                    ],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(139, 92, 246, 0.8)'
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

        // Tab functionality
        document.querySelectorAll('.payment-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs
                document.querySelectorAll('.payment-tab').forEach(t => {
                    t.classList.remove('active');
                    t.classList.add('text-gray-500');
                });

                // Add active class to clicked tab
                tab.classList.add('active');
                tab.classList.remove('text-gray-500');

                // In a real implementation, this would filter the payments table
                console.log('Tab clicked:', tab.textContent.trim());
            });
        });
    });

    // Function to handle confirm payment action
    function confirmPayment(id) {
        const modal = document.getElementById('confirmModal');
        const confirmBtn = document.getElementById('confirmBtn');

        // Set the confirmation link
        confirmBtn.href = `confirm-payment.php?id=${id}`;

        // Show the modal
        modal.classList.remove('hidden');
    }

    // Function to handle edit payment action
    function editPayment(id) {
        window.location.href = `edit-payment.php?id=${id}`;
    }

    // Close confirmation modal
    document.getElementById('cancelConfirm').addEventListener('click', function() {
        document.getElementById('confirmModal').classList.add('hidden');
    });

    // Close modal when clicking outside
    document.getElementById('confirmModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
    </script>

    <?php require_once __DIR__ . '/../components/layout/footer.php'; ?>
</body>

</html>