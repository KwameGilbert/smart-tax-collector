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

$businessId = intval($_GET['id']);

// In a real implementation, fetch this from the database
// For now, use dummy data for demonstration
$business = [
    'id' => $businessId,
    'name' => 'Adwoa Grocery Shop',
    'owner_name' => 'Adwoa Mensah',
    'contact' => '0244123456',
    'email' => 'adwoa.mensah@example.com',
    'location' => 'Central Market, Sefwi',
    'business_type' => 'Retail',
    'registration_id' => 'BUS-2023-001',
    'registration_date' => '2023-03-15',
    'status' => 'active',
    'description' => 'A small grocery shop selling food items, household supplies, and basic necessities.',
    'zone' => 'Central Commercial',
    'size' => 'Small (0-5 employees)',
    'ownership_type' => 'Sole Proprietorship',
    'registration_authority' => 'Sefwi Municipal Authority'
];

// Dummy data for assigned taxes
$assignedTaxes = [
    [
        'id' => 1,
        'tax_name' => 'Business Operating Permit',
        'amount' => 200.00,
        'frequency' => 'annually',
        'status' => 'active',
        'start_date' => '2023-03-15',
        'end_date' => null,
        'next_due' => '2024-03-15'
    ],
    [
        'id' => 2,
        'tax_name' => 'Sanitation Fee',
        'amount' => 50.00,
        'frequency' => 'monthly',
        'status' => 'active',
        'start_date' => '2023-03-15',
        'end_date' => null,
        'next_due' => '2023-07-15'
    ],
    [
        'id' => 3,
        'tax_name' => 'Street Light Levy',
        'amount' => 25.00,
        'frequency' => 'monthly',
        'status' => 'active',
        'start_date' => '2023-03-15',
        'end_date' => null,
        'next_due' => '2023-07-15'
    ]
];

// Dummy data for payment history
$paymentHistory = [
    [
        'id' => 101,
        'tax_name' => 'Business Operating Permit',
        'amount_paid' => 200.00,
        'payment_date' => '2023-03-15',
        'receipt_number' => 'RCP-2023-00101',
        'payment_method' => 'Cash',
        'collected_by' => 'John Anane'
    ],
    [
        'id' => 102,
        'tax_name' => 'Sanitation Fee',
        'amount_paid' => 50.00,
        'payment_date' => '2023-03-15',
        'receipt_number' => 'RCP-2023-00102',
        'payment_method' => 'Mobile Money',
        'collected_by' => 'John Anane'
    ],
    [
        'id' => 103,
        'tax_name' => 'Sanitation Fee',
        'amount_paid' => 50.00,
        'payment_date' => '2023-04-16',
        'receipt_number' => 'RCP-2023-00156',
        'payment_method' => 'Mobile Money',
        'collected_by' => 'Sarah Osei'
    ],
    [
        'id' => 104,
        'tax_name' => 'Street Light Levy',
        'amount_paid' => 25.00,
        'payment_date' => '2023-03-15',
        'receipt_number' => 'RCP-2023-00103',
        'payment_method' => 'Cash',
        'collected_by' => 'John Anane'
    ],
    [
        'id' => 105,
        'tax_name' => 'Street Light Levy',
        'amount_paid' => 25.00,
        'payment_date' => '2023-04-16',
        'receipt_number' => 'RCP-2023-00157',
        'payment_method' => 'Mobile Money',
        'collected_by' => 'Sarah Osei'
    ],
    [
        'id' => 106,
        'tax_name' => 'Sanitation Fee',
        'amount_paid' => 50.00,
        'payment_date' => '2023-05-14',
        'receipt_number' => 'RCP-2023-00203',
        'payment_method' => 'Cash',
        'collected_by' => 'Michael Agyei'
    ],
    [
        'id' => 107,
        'tax_name' => 'Street Light Levy',
        'amount_paid' => 25.00,
        'payment_date' => '2023-05-14',
        'receipt_number' => 'RCP-2023-00204',
        'payment_method' => 'Cash',
        'collected_by' => 'Michael Agyei'
    ],
    [
        'id' => 108,
        'tax_name' => 'Sanitation Fee',
        'amount_paid' => 50.00,
        'payment_date' => '2023-06-15',
        'receipt_number' => 'RCP-2023-00287',
        'payment_method' => 'Mobile Money',
        'collected_by' => 'Sarah Osei'
    ],
    [
        'id' => 109,
        'tax_name' => 'Street Light Levy',
        'amount_paid' => 25.00,
        'payment_date' => '2023-06-15',
        'receipt_number' => 'RCP-2023-00288',
        'payment_method' => 'Mobile Money',
        'collected_by' => 'Sarah Osei'
    ]
];

// Include components
require_once __DIR__ . '/../components/layout/header.php';
require_once __DIR__ . '/../components/layout/sidebar.php';

// Helper function to calculate total payments
function calculateTotalPayments($payments) {
    $total = 0;
    foreach ($payments as $payment) {
        $total += $payment['amount_paid'];
    }
    return $total;
}

// Helper function to format currency
function formatCurrency($amount) {
    return 'GHS ' . number_format($amount, 2);
}

// Helper function to format date
function formatDate($dateString) {
    return date('d M, Y', strtotime($dateString));
}

// Calculate total payments
$totalPayments = calculateTotalPayments($paymentHistory);

// Calculate next payment dates and due amounts
$nextPaymentDate = '';
$dueAmount = 0;

foreach ($assignedTaxes as $tax) {
    if (empty($nextPaymentDate) || strtotime($tax['next_due']) < strtotime($nextPaymentDate)) {
        $nextPaymentDate = $tax['next_due'];
    }
    $dueAmount += $tax['amount'];
}

// Get payment compliance rate
$totalDueMonths = 0;
$totalPaidMonths = 0;

foreach ($assignedTaxes as $tax) {
    if ($tax['frequency'] === 'monthly') {
        $startDate = new DateTime($tax['start_date']);
        $now = new DateTime();
        $diff = $startDate->diff($now);
        $months = ($diff->y * 12) + $diff->m;
        
        $totalDueMonths += $months;
        
        // Count payments for this tax
        $paidMonths = 0;
        foreach ($paymentHistory as $payment) {
            if ($payment['tax_name'] === $tax['tax_name']) {
                $paidMonths++;
            }
        }
        $totalPaidMonths += $paidMonths;
    } else if ($tax['frequency'] === 'annually') {
        $startDate = new DateTime($tax['start_date']);
        $now = new DateTime();
        $diff = $startDate->diff($now);
        $years = $diff->y + ($diff->m / 12);
        
        $totalDueMonths += ceil($years);
        
        // Count annual payments for this tax
        $paidYears = 0;
        foreach ($paymentHistory as $payment) {
            if ($payment['tax_name'] === $tax['tax_name']) {
                $paidYears++;
            }
        }
        $totalPaidMonths += $paidYears;
    }
}

$complianceRate = $totalDueMonths > 0 ? ($totalPaidMonths / $totalDueMonths) * 100 : 100;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($business['name']); ?> - Sefwi Tax Collection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="/../finance/components/shared/app.js"></script>
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

    .status-active {
        background-color: #DEF7EC;
        color: #046C4E;
    }

    .status-inactive {
        background-color: #FDE8E8;
        color: #9B1C1C;
    }

    .tab {
        cursor: pointer;
    }

    .tab.active {
        color: #1E40AF;
        border-bottom: 2px solid #1E40AF;
    }

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
        <?php renderSidebar('businesses', false); ?>

        <!-- Header -->
        <?php renderHeader($business['name'], false); ?>

        <!-- Main Content -->
        <div class="p-4 md:p-8 bg-gray-100 flex-grow overflow-y-auto">
            <div class="flex items-center mb-6">
                <a href="index.php" class="mr-4 text-blue-600 hover:text-blue-800">
                    <i class="ri-arrow-left-line text-xl"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-bold"><?php echo htmlspecialchars($business['name']); ?></h1>
                    <p class="text-gray-600">Business ID: <?php echo htmlspecialchars($business['registration_id']); ?>
                    </p>
                </div>
            </div>

            <!-- Business Overview Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                            <i class="ri-calendar-check-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Next Payment Due</p>
                            <p class="text-xl font-semibold"><?php echo formatDate($nextPaymentDate); ?></p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                            <i class="ri-money-dollar-circle-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Payments Made</p>
                            <p class="text-xl font-semibold"><?php echo formatCurrency($totalPayments); ?></p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
                            <i class="ri-pie-chart-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Payment Compliance</p>
                            <p class="text-xl font-semibold"><?php echo round($complianceRate); ?>%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="flex flex-wrap gap-2 mb-6">
                <a href="edit.php?id=<?php echo $business['id']; ?>"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    <i class="ri-pencil-line mr-2"></i> Edit Details
                </a>
                <a href="assign-tax.php?id=<?php echo $business['id']; ?>"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                    <i class="ri-bill-line mr-2"></i> Assign Tax
                </a>
                <a href="record-payment.php?id=<?php echo $business['id']; ?>"
                    class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                    <i class="ri-money-dollar-circle-line mr-2"></i> Record Payment
                </a>
                <?php if ($business['status'] === 'active'): ?>
                <button onclick="confirmStatusChange(<?php echo $business['id']; ?>, 'deactivate')"
                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    <i class="ri-close-circle-line mr-2"></i> Deactivate
                </button>
                <?php else: ?>
                <button onclick="confirmStatusChange(<?php echo $business['id']; ?>, 'activate')"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                    <i class="ri-checkbox-circle-line mr-2"></i> Activate
                </button>
                <?php endif; ?>
                <a href="print-statement.php?id=<?php echo $business['id']; ?>"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                    <i class="ri-printer-line mr-2"></i> Print Statement
                </a>
            </div>

            <!-- Tabs -->
            <div class="mb-6">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <div id="tab-details"
                            class="tab active whitespace-nowrap py-4 px-1 border-b-2 font-medium text-lg">
                            Business Details
                        </div>
                        <div id="tab-taxes"
                            class="tab whitespace-nowrap py-4 px-1 border-b-2 font-medium text-gray-500 hover:text-gray-700 text-lg">
                            Assigned Taxes
                        </div>
                        <div id="tab-payments"
                            class="tab whitespace-nowrap py-4 px-1 border-b-2 font-medium text-gray-500 hover:text-gray-700 text-lg">
                            Payment History
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Tab Content: Business Details -->
            <div id="panel-details" class="tab-panel active bg-white rounded-lg shadow">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4">Business Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium mb-3">General Information</h3>
                            <table class="min-w-full">
                                <tbody>
                                    <tr>
                                        <td class="py-2 text-gray-600">Business Name</td>
                                        <td class="py-2 font-medium"><?php echo htmlspecialchars($business['name']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600">Business Type</td>
                                        <td class="py-2"><?php echo htmlspecialchars($business['business_type']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600">Registration ID</td>
                                        <td class="py-2"><?php echo htmlspecialchars($business['registration_id']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600">Registration Date</td>
                                        <td class="py-2"><?php echo formatDate($business['registration_date']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600">Status</td>
                                        <td class="py-2">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full 
                                            <?php echo $business['status'] === 'active' ? 'status-active' : 'status-inactive'; ?>">
                                                <?php echo ucfirst($business['status']); ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600">Description</td>
                                        <td class="py-2"><?php echo htmlspecialchars($business['description']); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium mb-3">Contact Information</h3>
                            <table class="min-w-full">
                                <tbody>
                                    <tr>
                                        <td class="py-2 text-gray-600">Owner Name</td>
                                        <td class="py-2"><?php echo htmlspecialchars($business['owner_name']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600">Contact Number</td>
                                        <td class="py-2"><?php echo htmlspecialchars($business['contact']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600">Email</td>
                                        <td class="py-2"><?php echo htmlspecialchars($business['email']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600">Location</td>
                                        <td class="py-2"><?php echo htmlspecialchars($business['location']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600">Zone</td>
                                        <td class="py-2"><?php echo htmlspecialchars($business['zone']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-gray-600">Business Size</td>
                                        <td class="py-2"><?php echo htmlspecialchars($business['size']); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Assigned Taxes -->
            <div id="panel-taxes" class="tab-panel bg-white rounded-lg shadow">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Assigned Taxes</h2>
                        <a href="assign-tax.php?id=<?php echo $business['id']; ?>"
                            class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                            <i class="ri-add-line mr-1"></i> Assign New Tax
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tax Type
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount (GHS)
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Frequency
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Start Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        End Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Next Due Date
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
                                <?php foreach ($assignedTaxes as $tax): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900">
                                            <?php echo htmlspecialchars($tax['tax_name']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo number_format($tax['amount'], 2); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                            <?php echo ucfirst($tax['frequency']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo formatDate($tax['start_date']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo $tax['end_date'] ? formatDate($tax['end_date']) : 'Ongoing'; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo formatDate($tax['next_due']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full 
                                        <?php echo $tax['status'] === 'active' ? 'status-active' : 'status-inactive'; ?>">
                                            <?php echo ucfirst($tax['status']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-3">
                                            <a href="edit-tax-assignment.php?id=<?php echo $tax['id']; ?>&business_id=<?php echo $business['id']; ?>"
                                                class="text-blue-600 hover:text-blue-900" title="Edit Tax Assignment">
                                                <i class="ri-pencil-line text-lg"></i>
                                            </a>
                                            <button
                                                onclick="confirmTaxRemoval(<?php echo $tax['id']; ?>, '<?php echo addslashes($tax['tax_name']); ?>')"
                                                class="text-red-600 hover:text-red-900" title="Remove Tax">
                                                <i class="ri-delete-bin-line text-lg"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Payment History -->
            <div id="panel-payments" class="tab-panel bg-white rounded-lg shadow">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Payment History</h2>
                        <a href="record-payment.php?id=<?php echo $business['id']; ?>"
                            class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                            <i class="ri-add-line mr-1"></i> Record Payment
                        </a>
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
                                        Tax Type
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount (GHS)
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Payment Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Payment Method
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Collected By
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($paymentHistory as $payment): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900">
                                            <?php echo htmlspecialchars($payment['receipt_number']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo htmlspecialchars($payment['tax_name']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo number_format($payment['amount_paid'], 2); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo formatDate($payment['payment_date']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo htmlspecialchars($payment['payment_method']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo htmlspecialchars($payment['collected_by']); ?>
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

    <!-- Status Change Confirmation Modal -->
    <div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 id="status-modal-title" class="text-lg font-medium text-gray-900 mb-4">Confirm Status Change</h3>
                <p id="status-modal-message" class="text-gray-600 mb-6">Are you sure you want to change this business's
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

    <!-- Remove Tax Confirmation Modal -->
    <div id="taxRemovalModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Confirm Tax Removal</h3>
                <p class="text-gray-600 mb-6">Are you sure you want to remove the tax: <span id="taxNameToRemove"
                        class="font-semibold"></span>?</p>
                <p class="text-sm text-red-600 mb-6">This will remove all future tax obligations but will not delete
                    payment history.</p>
                <div class="flex justify-end gap-3">
                    <button id="cancelRemoval"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md">Cancel</button>
                    <a id="confirmRemovalBtn" href="#"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">Remove</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Tab functionality
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab');
        const panels = document.querySelectorAll('.tab-panel');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and panels
                tabs.forEach(t => t.classList.remove('active', 'border-blue-500',
                    'text-blue-600'));
                tabs.forEach(t => t.classList.add('text-gray-500'));
                panels.forEach(p => p.classList.remove('active'));

                // Add active class to clicked tab
                tab.classList.add('active', 'border-blue-500', 'text-blue-600');
                tab.classList.remove('text-gray-500');

                // Get the associated panel ID and activate it
                const panelId = tab.id.replace('tab', 'panel');
                document.getElementById(panelId).classList.add('active');
            });
        });
    });

    function confirmStatusChange(id, action) {
        const modal = document.getElementById('statusModal');
        const title = document.getElementById('status-modal-title');
        const message = document.getElementById('status-modal-message');
        const confirmBtn = document.getElementById('confirmStatusBtn');

        if (action === 'activate') {
            title.textContent = 'Confirm Activation';
            message.textContent = 'Are you sure you want to activate this business?';
            confirmBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
            confirmBtn.classList.add('bg-green-600', 'hover:bg-green-700');
            confirmBtn.href = `status.php?id=${id}&action=activate`;
        } else {
            title.textContent = 'Confirm Deactivation';
            message.textContent = 'Are you sure you want to deactivate this business?';
            confirmBtn.classList.remove('bg-green-600', 'hover:bg-green-700');
            confirmBtn.classList.add('bg-red-600', 'hover:bg-red-700');
            confirmBtn.href = `status.php?id=${id}&action=deactivate`;
        }

        modal.classList.remove('hidden');
    }

    document.getElementById('cancelStatus').addEventListener('click', function() {
        document.getElementById('statusModal').classList.add('hidden');
    });

    document.getElementById('statusModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });

    function confirmTaxRemoval(id, name) {
        // Set the tax name in the modal
        document.getElementById('taxNameToRemove').textContent = name;

        // Set the removal link
        document.getElementById('confirmRemovalBtn').href =
            `remove-tax.php?id=${id}&business_id=<?php echo $business['id']; ?>`;

        // Show the modal
        document.getElementById('taxRemovalModal').classList.remove('hidden');
    }

    document.getElementById('cancelRemoval').addEventListener('click', function() {
        document.getElementById('taxRemovalModal').classList.add('hidden');
    });

    document.getElementById('taxRemovalModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
    </script>

    <?php require_once __DIR__ . '/../components/layout/footer.php'; ?>
</body>

</html>