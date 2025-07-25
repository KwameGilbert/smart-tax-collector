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

// Dummy data for businesses
$businesses = [
    [
        'id' => 'BUS-2023-001',
        'name' => 'Adwoa Grocery Shop',
        'owner' => 'Adwoa Mensah',
        'category' => 'Retail',
        'phone' => '0244111222',
        'location' => 'Central Market, Shop #45',
        'zone' => 'Central Market'
    ],
    [
        'id' => 'BUS-2023-002',
        'name' => 'Afia Restaurant',
        'owner' => 'Afia Owusu',
        'category' => 'Food & Beverage',
        'phone' => '0244333444',
        'location' => 'High Street, Building 12',
        'zone' => 'High Street'
    ],
    [
        'id' => 'BUS-2023-003',
        'name' => 'Ama Fashion Boutique',
        'owner' => 'Ama Darko',
        'category' => 'Clothing & Apparel',
        'phone' => '0244555666',
        'location' => 'Shopping Mall, Shop #23',
        'zone' => 'New Town'
    ],
    [
        'id' => 'BUS-2023-004',
        'name' => 'Kofi Auto Repairs',
        'owner' => 'Kofi Boateng',
        'category' => 'Automotive',
        'phone' => '0244777888',
        'location' => 'Mechanic Lane, Building 5',
        'zone' => 'Industrial Zone'
    ],
    [
        'id' => 'BUS-2023-005',
        'name' => 'Yaw Pharmacy',
        'owner' => 'Yaw Opoku',
        'category' => 'Healthcare',
        'phone' => '0244999000',
        'location' => 'Medical Street, Building 8',
        'zone' => 'High Street'
    ]
];

// Current business (simulate selecting a business)
$currentBusiness = null;

// Dummy tax types
$taxTypes = [
    [
        'id' => 'TAX-001',
        'name' => 'Business Operating Permit',
        'description' => 'Annual permit for operating a business within the municipality',
        'amount' => 200.00,
        'frequency' => 'annual',
        'last_payment' => '2022-06-15'
    ],
    [
        'id' => 'TAX-002',
        'name' => 'Market Stall Fee',
        'description' => 'Monthly fee for operating a stall in the market',
        'amount' => 50.00,
        'frequency' => 'monthly',
        'last_payment' => '2023-06-30'
    ],
    [
        'id' => 'TAX-003',
        'name' => 'Signage Fee',
        'description' => 'Annual fee for business signage or advertising',
        'amount' => 75.00,
        'frequency' => 'annual',
        'last_payment' => '2022-09-22'
    ],
    [
        'id' => 'TAX-004',
        'name' => 'Food & Beverage License',
        'description' => 'License required for selling food and beverages',
        'amount' => 150.00,
        'frequency' => 'annual',
        'last_payment' => '2022-08-10'
    ],
    [
        'id' => 'TAX-005',
        'name' => 'Environmental Health Permit',
        'description' => 'Permit ensuring compliance with health standards',
        'amount' => 120.00,
        'frequency' => 'annual',
        'last_payment' => '2022-07-05'
    ]
];

// Month names for period selection
$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

// Helper function to format currency
function formatCurrency($amount) {
    return 'GHS ' . number_format($amount, 2);
}

// Helper function to calculate overdue periods based on frequency and last payment
function calculatePeriods($frequency, $lastPayment) {
    $lastPaymentDate = new DateTime($lastPayment);
    $today = new DateTime();
    $periods = [];
    
    if ($frequency === 'monthly') {
        // Clone the last payment date
        $periodDate = clone $lastPaymentDate;
        $periodDate->modify('+1 month'); // Start from next month after last payment
        
        // Add periods for each month until current month
        while ($periodDate <= $today) {
            $periods[] = $periodDate->format('F Y');
            $periodDate->modify('+1 month');
        }
    } else if ($frequency === 'annual') {
        // For annual payments, check if it's been over a year
        $nextPaymentDate = clone $lastPaymentDate;
        $nextPaymentDate->modify('+1 year');
        
        if ($nextPaymentDate <= $today) {
            $periods[] = $nextPaymentDate->format('Y');
            
            // If more than one year overdue, add additional years
            $additionalYear = clone $nextPaymentDate;
            $additionalYear->modify('+1 year');
            
            while ($additionalYear <= $today) {
                $periods[] = $additionalYear->format('Y');
                $additionalYear->modify('+1 year');
            }
        }
    }
    
    return $periods;
}

// Mobile money providers
$mobileMoneyProviders = [
    ['id' => 'mtn', 'name' => 'MTN Mobile Money', 'logo' => 'ri-smartphone-line text-yellow-500'],
    ['id' => 'vodafone', 'name' => 'Vodafone Cash', 'logo' => 'ri-smartphone-line text-red-500'],
    ['id' => 'airteltigo', 'name' => 'AirtelTigo Money', 'logo' => 'ri-smartphone-line text-blue-500']
];

// Card providers
$cardProviders = [
    ['id' => 'visa', 'name' => 'Visa', 'logo' => 'ri-visa-line text-blue-700'],
    ['id' => 'mastercard', 'name' => 'MasterCard', 'logo' => 'ri-mastercard-line text-orange-600']
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collect Payment | Sefwi Tax Collection</title>

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

    /* Step indicator animation */
    .step-active {
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
        }
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

    /* Radio button custom styling */
    .radio-container input:checked+.radio-tile {
        border-color: #16a34a;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        color: #16a34a;
    }

    .radio-container input:checked+.radio-tile:before {
        transform: scale(1);
        opacity: 1;
        background-color: #16a34a;
        border-color: #16a34a;
    }

    .radio-container input:checked+.radio-tile .radio-icon,
    .radio-container input:checked+.radio-tile .radio-label {
        color: #16a34a;
    }

    .radio-tile {
        transition: all 0.3s ease;
    }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <?php require_once __DIR__ . '/../components/sidebar.php'; ?>

    <!-- Main Content -->
    <main class="md:ml-64 min-h-screen">
        <?php require_once __DIR__ . '/../components/header.php'; ?>

        <!-- Main Collection Content -->
        <div class="px-4 py-6">
            <!-- Page Title -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Collect Payment</h1>
                <p class="text-gray-600">Process tax payments from businesses</p>
            </div>

            <!-- Progress Steps -->
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div class="w-full flex items-center">
                        <div class="relative flex flex-col items-center">
                            <div
                                class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 bg-primary-600 border-primary-600 step-active flex items-center justify-center text-white font-bold">
                                1</div>
                            <div
                                class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium text-primary-600">
                                Select Business</div>
                        </div>
                        <div class="flex-auto border-t-2 border-primary-600"></div>

                        <div class="relative flex flex-col items-center">
                            <div
                                class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-gray-300 bg-white flex items-center justify-center text-gray-400 font-bold">
                                2</div>
                            <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium text-gray-500">
                                Choose Tax</div>
                        </div>
                        <div class="flex-auto border-t-2 border-gray-300"></div>

                        <div class="relative flex flex-col items-center">
                            <div
                                class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-gray-300 bg-white flex items-center justify-center text-gray-400 font-bold">
                                3</div>
                            <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium text-gray-500">
                                Payment Details</div>
                        </div>
                        <div class="flex-auto border-t-2 border-gray-300"></div>

                        <div class="relative flex flex-col items-center">
                            <div
                                class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-gray-300 bg-white flex items-center justify-center text-gray-400 font-bold">
                                4</div>
                            <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium text-gray-500">
                                Confirmation</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Multi-step Form Container -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6 mb-6">
                <!-- Step 1: Business Selection -->
                <div id="step1" class="step-content">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Select Business</h2>

                    <!-- Search Box -->
                    <div class="mb-6">
                        <div class="relative">
                            <input type="text" id="business-search"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Search by business name, ID, or phone...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ri-search-line text-gray-400 text-lg"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Business Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <?php foreach($businesses as $business): ?>
                        <div
                            class="business-card cursor-pointer bg-white border border-gray-200 rounded-lg p-4 hover:border-primary-500 transition-all card-hover">
                            <div class="flex items-start">
                                <div
                                    class="h-12 w-12 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mr-4">
                                    <i class="ri-store-2-line text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-800"><?php echo $business['name']; ?></h3>
                                    <p class="text-gray-500"><?php echo $business['id']; ?></p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p class="text-sm text-gray-600"><i class="ri-user-line mr-1"></i>
                                    <?php echo $business['owner']; ?></p>
                                <p class="text-sm text-gray-600"><i class="ri-phone-line mr-1"></i>
                                    <?php echo $business['phone']; ?></p>
                                <p class="text-sm text-gray-600"><i class="ri-map-pin-line mr-1"></i>
                                    <?php echo $business['location']; ?></p>
                            </div>
                            <div class="mt-3 flex justify-end">
                                <button
                                    class="select-business px-3 py-1 text-sm bg-primary-50 text-primary-600 rounded hover:bg-primary-100"
                                    data-business-id="<?php echo $business['id']; ?>">
                                    Select <i class="ri-arrow-right-line ml-1"></i>
                                </button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Scan QR Code Option -->
                    <div class="text-center p-6 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                        <div
                            class="inline-flex h-12 w-12 rounded-full bg-primary-100 items-center justify-center text-primary-600 mb-3">
                            <i class="ri-qr-scan-line text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800">Scan Business QR Code</h3>
                        <p class="text-sm text-gray-500 mt-1">Quickly find a business by scanning their ID card or
                            certificate</p>
                        <button class="mt-3 px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                            <i class="ri-camera-line mr-1"></i> Scan QR Code
                        </button>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button id="nextToStep2"
                            class="px-6 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 opacity-50 cursor-not-allowed"
                            disabled>
                            Next <i class="ri-arrow-right-line ml-1"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Tax Selection -->
                <div id="step2" class="step-content hidden">
                    <div class="flex items-center mb-4">
                        <button id="backToStep1" class="mr-3 text-gray-500 hover:text-gray-700">
                            <i class="ri-arrow-left-line text-xl"></i>
                        </button>
                        <h2 class="text-xl font-semibold text-gray-800">Select Tax Type</h2>
                    </div>

                    <!-- Selected Business Info -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6 border border-gray-200">
                        <div class="flex items-start">
                            <div
                                class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mr-3">
                                <i class="ri-store-2-line text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-md font-medium text-gray-800" id="selected-business-name">Adwoa Grocery
                                    Shop</h3>
                                <p class="text-sm text-gray-500" id="selected-business-id">BUS-2023-001</p>
                                <p class="text-sm text-gray-600" id="selected-business-location">Central Market, Shop
                                    #45</p>
                            </div>
                            <button class="text-primary-600 hover:text-primary-700 text-sm font-medium"
                                id="change-business">
                                Change
                            </button>
                        </div>
                    </div>

                    <!-- Tax Type Selection -->
                    <div class="space-y-4 mb-6">
                        <h3 class="text-md font-medium text-gray-700">Available Taxes</h3>

                        <?php foreach($taxTypes as $index => $tax): ?>
                        <div
                            class="tax-option bg-white border border-gray-200 rounded-lg p-4 hover:border-primary-500 transition-all cursor-pointer">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <input type="radio" name="tax_type" id="tax_<?php echo $tax['id']; ?>"
                                        value="<?php echo $tax['id']; ?>" class="hidden tax-radio">
                                    <div
                                        class="w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center tax-radio-custom">
                                        <div class="hidden w-3 h-3 bg-primary-600 rounded-full tax-radio-dot"></div>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <div class="flex justify-between">
                                        <label for="tax_<?php echo $tax['id']; ?>"
                                            class="text-lg font-medium text-gray-800 cursor-pointer"><?php echo $tax['name']; ?></label>
                                        <span
                                            class="font-semibold text-primary-600"><?php echo formatCurrency($tax['amount']); ?></span>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1"><?php echo $tax['description']; ?></p>
                                    <div class="mt-2">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <?php echo ucfirst($tax['frequency']); ?>
                                        </span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 ml-2">
                                            Last paid: <?php echo date('d M, Y', strtotime($tax['last_payment'])); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button id="nextToStep3"
                            class="px-6 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 opacity-50 cursor-not-allowed"
                            disabled>
                            Next <i class="ri-arrow-right-line ml-1"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Payment Details -->
                <div id="step3" class="step-content hidden">
                    <div class="flex items-center mb-4">
                        <button id="backToStep2" class="mr-3 text-gray-500 hover:text-gray-700">
                            <i class="ri-arrow-left-line text-xl"></i>
                        </button>
                        <h2 class="text-xl font-semibold text-gray-800">Payment Details</h2>
                    </div>

                    <!-- Payment Summary -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6 border border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between">
                            <div class="mb-3 sm:mb-0">
                                <p class="text-sm text-gray-500">Business</p>
                                <p class="text-md font-medium text-gray-800" id="payment-business-name">Adwoa Grocery
                                    Shop</p>
                                <p class="text-sm text-gray-500" id="payment-business-id">BUS-2023-001</p>
                            </div>
                            <div class="mb-3 sm:mb-0">
                                <p class="text-sm text-gray-500">Tax Type</p>
                                <p class="text-md font-medium text-gray-800" id="payment-tax-name">Business Operating
                                    Permit</p>
                                <p class="text-sm text-gray-500" id="payment-tax-id">TAX-001</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Amount</p>
                                <p class="text-lg font-bold text-primary-600" id="payment-tax-amount">GHS 200.00</p>
                            </div>
                        </div>
                    </div>

                    <!-- Period Selection -->
                    <div class="mb-6">
                        <h3 class="text-md font-medium text-gray-700 mb-3">Select Payment Period</h3>

                        <div id="period-annual" class="period-container">
                            <p class="text-sm text-gray-500 mb-2">Select year(s) to pay for:</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <div class="period-checkbox">
                                    <input type="checkbox" id="period-2023" class="hidden period-checkbox-input"
                                        value="2023">
                                    <label for="period-2023"
                                        class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md cursor-pointer hover:bg-gray-50 period-checkbox-label">
                                        <span>2023</span>
                                    </label>
                                </div>
                                <div class="period-checkbox">
                                    <input type="checkbox" id="period-2022" class="hidden period-checkbox-input"
                                        value="2022">
                                    <label for="period-2022"
                                        class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md cursor-pointer hover:bg-gray-50 period-checkbox-label">
                                        <span>2022</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="period-monthly" class="period-container hidden">
                            <p class="text-sm text-gray-500 mb-2">Select month(s) to pay for:</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <?php foreach($months as $index => $month): ?>
                                <div class="period-checkbox">
                                    <input type="checkbox" id="period-<?php echo strtolower($month); ?>"
                                        class="hidden period-checkbox-input" value="<?php echo $month; ?>">
                                    <label for="period-<?php echo strtolower($month); ?>"
                                        class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md cursor-pointer hover:bg-gray-50 period-checkbox-label">
                                        <span><?php echo substr($month, 0, 3); ?></span>
                                    </label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Total Calculation -->
                        <div class="bg-primary-50 rounded-lg p-4 border border-primary-100">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-700">Base Amount:</span>
                                <span class="font-medium" id="base-amount">GHS 200.00</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-700">Periods:</span>
                                <span class="font-medium" id="period-count">1</span>
                            </div>
                            <div class="flex justify-between items-center text-lg font-bold">
                                <span class="text-gray-700">Total:</span>
                                <span class="text-primary-600" id="total-amount">GHS 200.00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Selection -->
                    <div class="mb-6">
                        <h3 class="text-md font-medium text-gray-700 mb-3">Select Payment Method</h3>

                        <div class="flex flex-col space-y-2">
                            <!-- Payment Method Tabs -->
                            <div class="flex border-b border-gray-200">
                                <button id="tab-mobile-money"
                                    class="px-4 py-2 border-b-2 border-primary-600 text-primary-600 font-medium">Mobile
                                    Money</button>
                                <button id="tab-card"
                                    class="px-4 py-2 border-b-2 border-transparent text-gray-500 hover:text-gray-700">Credit/Debit
                                    Card</button>
                                <button id="tab-cash"
                                    class="px-4 py-2 border-b-2 border-transparent text-gray-500 hover:text-gray-700">Cash</button>
                            </div>

                            <!-- Mobile Money Options -->
                            <div id="panel-mobile-money" class="payment-panel">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-2">
                                    <?php foreach($mobileMoneyProviders as $provider): ?>
                                    <div class="radio-container">
                                        <input type="radio" name="payment_method" id="<?php echo $provider['id']; ?>"
                                            value="<?php echo $provider['id']; ?>" class="hidden payment-radio">
                                        <label for="<?php echo $provider['id']; ?>"
                                            class="radio-tile flex flex-col items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                            <i class="<?php echo $provider['logo']; ?> text-3xl mb-2"></i>
                                            <span
                                                class="radio-label text-sm font-medium"><?php echo $provider['name']; ?></span>
                                        </label>
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="tel"
                                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="e.g. 024 000 0000">
                                    <p class="text-xs text-gray-500 mt-1">Enter the phone number associated with the
                                        mobile money account</p>
                                </div>
                            </div>

                            <!-- Card Payment Options -->
                            <div id="panel-card" class="payment-panel hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-2">
                                    <?php foreach($cardProviders as $provider): ?>
                                    <div class="radio-container">
                                        <input type="radio" name="card_type" id="<?php echo $provider['id']; ?>"
                                            value="<?php echo $provider['id']; ?>" class="hidden payment-radio">
                                        <label for="<?php echo $provider['id']; ?>"
                                            class="radio-tile flex flex-col items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                            <i class="<?php echo $provider['logo']; ?> text-3xl mb-2"></i>
                                            <span
                                                class="radio-label text-sm font-medium"><?php echo $provider['name']; ?></span>
                                        </label>
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Card Number</label>
                                        <input type="text"
                                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                            placeholder="1234 5678 9012 3456">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                                        <input type="text"
                                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                            placeholder="MM/YY">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                        <input type="text"
                                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                            placeholder="123">
                                    </div>
                                </div>
                            </div>

                            <!-- Cash Payment Options -->
                            <div id="panel-cash" class="payment-panel hidden">
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mt-2">
                                    <h4 class="font-medium text-yellow-800 flex items-center">
                                        <i class="ri-information-line mr-2"></i> Cash Payment
                                    </h4>
                                    <p class="text-sm text-yellow-700 mt-1">
                                        Collect cash payment and issue a printed receipt.
                                    </p>

                                    <div class="mt-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Amount
                                            Received</label>
                                        <input type="text"
                                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                            placeholder="e.g. 200.00">
                                    </div>

                                    <div class="mt-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Change</label>
                                        <input type="text"
                                            class="w-full p-2 border border-gray-300 rounded-md bg-gray-50"
                                            placeholder="0.00" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button id="nextToStep4"
                            class="px-6 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                            Process Payment <i class="ri-arrow-right-line ml-1"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 4: Confirmation -->
                <div id="step4" class="step-content hidden">
                    <!-- Loading State (temporarily shown during processing) -->
                    <div id="payment-processing" class="py-12">
                        <div class="flex flex-col items-center justify-center">
                            <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-primary-600 mb-4"></div>
                            <h3 class="text-xl font-semibold text-gray-800">Processing Payment</h3>
                            <p class="text-gray-500 mt-2">Please wait while we process your transaction...</p>
                        </div>
                    </div>

                    <!-- Success State (shown after successful processing) -->
                    <div id="payment-success" class="py-12 hidden">
                        <div class="flex flex-col items-center justify-center">
                            <div class="rounded-full h-16 w-16 bg-green-100 flex items-center justify-center mb-4">
                                <i class="ri-check-line text-green-600 text-4xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Payment Successful!</h3>
                            <p class="text-gray-500 mt-2">Transaction ID: PAY-2023-1025</p>

                            <div class="mt-8 w-full max-w-md">
                                <!-- Receipt Summary -->
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                    <h4 class="font-medium text-gray-800 mb-3 text-center">Receipt Summary</h4>

                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Business:</span>
                                            <span class="font-medium">Adwoa Grocery Shop</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Tax Type:</span>
                                            <span class="font-medium">Business Operating Permit</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Period:</span>
                                            <span class="font-medium">2023</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Payment Method:</span>
                                            <span class="font-medium">MTN Mobile Money</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Date:</span>
                                            <span class="font-medium"><?php echo date('d M, Y h:i A'); ?></span>
                                        </div>
                                        <div class="flex justify-between border-t pt-2 mt-2">
                                            <span class="font-semibold">Total:</span>
                                            <span class="font-bold text-primary-600">GHS 200.00</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- QR Code -->
                                <div class="flex justify-center my-6">
                                    <div class="p-3 bg-white border border-gray-200 rounded-lg">
                                        <div class="bg-gray-200 h-36 w-36 flex items-center justify-center">
                                            <i class="ri-qr-code-line text-4xl text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col sm:flex-row sm:space-x-3 space-y-3 sm:space-y-0">
                                    <a href="../receipt/index.php"
                                        class="flex-1 flex items-center justify-center px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                                        <i class="ri-file-list-3-line mr-1"></i> View Receipt
                                    </a>
                                    <button
                                        class="flex-1 flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">
                                        <i class="ri-printer-line mr-1"></i> Print Receipt
                                    </button>
                                    <button
                                        class="flex-1 flex items-center justify-center px-4 py-2 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200">
                                        <i class="ri-message-2-line mr-1"></i> SMS Receipt
                                    </button>
                                </div>

                                <div class="mt-6 text-center">
                                    <a href="../dashboard/index.php" class="text-primary-600 hover:text-primary-700">
                                        <i class="ri-home-line mr-1"></i> Back to Dashboard
                                    </a>
                                    <span class="mx-2 text-gray-300">|</span>
                                    <a href="index.php" class="text-primary-600 hover:text-primary-700">
                                        <i class="ri-add-line mr-1"></i> New Collection
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Step navigation
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const step3 = document.getElementById('step3');
        const step4 = document.getElementById('step4');

        const nextToStep2 = document.getElementById('nextToStep2');
        const backToStep1 = document.getElementById('backToStep1');
        const nextToStep3 = document.getElementById('nextToStep3');
        const backToStep2 = document.getElementById('backToStep2');
        const nextToStep4 = document.getElementById('nextToStep4');
        const changeBusinessBtn = document.getElementById('change-business');

        // Business selection
        const businessCards = document.querySelectorAll('.business-card');
        const selectBusinessButtons = document.querySelectorAll('.select-business');

        selectBusinessButtons.forEach(button => {
            button.addEventListener('click', function() {
                businessCards.forEach(card => card.classList.remove('border-primary-500'));
                this.closest('.business-card').classList.add('border-primary-500');
                nextToStep2.classList.remove('opacity-50', 'cursor-not-allowed');
                nextToStep2.disabled = false;

                // Store selected business ID
                const businessId = this.dataset.businessId;
                // Here you would fetch the business data based on ID
            });
        });

        // Step 1 to Step 2
        nextToStep2.addEventListener('click', function() {
            step1.classList.add('hidden');
            step2.classList.remove('hidden');
            updateProgressSteps(2);
        });

        // Step 2 back to Step 1
        backToStep1.addEventListener('click', function() {
            step2.classList.add('hidden');
            step1.classList.remove('hidden');
            updateProgressSteps(1);
        });

        // Change business button 
        changeBusinessBtn.addEventListener('click', function() {
            step2.classList.add('hidden');
            step1.classList.remove('hidden');
            updateProgressSteps(1);
        });

        // Tax selection
        const taxOptions = document.querySelectorAll('.tax-option');
        const taxRadios = document.querySelectorAll('.tax-radio');

        taxOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Clear all selected
                taxOptions.forEach(opt => opt.classList.remove('border-primary-500'));
                taxRadios.forEach(radio => {
                    radio.checked = false;
                    radio.closest('.tax-option').querySelector('.tax-radio-dot')
                        .classList.add('hidden');
                    radio.closest('.tax-option').querySelector('.tax-radio-custom')
                        .classList.remove('border-primary-500');
                });

                // Select this one
                this.classList.add('border-primary-500');
                const radio = this.querySelector('.tax-radio');
                radio.checked = true;
                this.querySelector('.tax-radio-dot').classList.remove('hidden');
                this.querySelector('.tax-radio-custom').classList.add('border-primary-500');

                nextToStep3.classList.remove('opacity-50', 'cursor-not-allowed');
                nextToStep3.disabled = false;

                // Store selected tax ID
                const taxId = radio.value;
                // Here you would fetch the tax data based on ID
            });
        });

        // Step 2 to Step 3
        nextToStep3.addEventListener('click', function() {
            step2.classList.add('hidden');
            step3.classList.remove('hidden');
            updateProgressSteps(3);
        });

        // Step 3 back to Step 2
        backToStep2.addEventListener('click', function() {
            step3.classList.add('hidden');
            step2.classList.remove('hidden');
            updateProgressSteps(2);
        });

        // Period checkbox styling
        const periodCheckboxes = document.querySelectorAll('.period-checkbox-input');
        periodCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const label = this.nextElementSibling;
                if (this.checked) {
                    label.classList.add('bg-primary-50', 'border-primary-500',
                        'text-primary-700');
                } else {
                    label.classList.remove('bg-primary-50', 'border-primary-500',
                        'text-primary-700');
                }
                updateTotal();
            });
        });

        // Payment method tabs
        const tabMobileMoney = document.getElementById('tab-mobile-money');
        const tabCard = document.getElementById('tab-card');
        const tabCash = document.getElementById('tab-cash');
        const panelMobileMoney = document.getElementById('panel-mobile-money');
        const panelCard = document.getElementById('panel-card');
        const panelCash = document.getElementById('panel-cash');

        tabMobileMoney.addEventListener('click', function() {
            setActiveTab(this, panelMobileMoney);
        });

        tabCard.addEventListener('click', function() {
            setActiveTab(this, panelCard);
        });

        tabCash.addEventListener('click', function() {
            setActiveTab(this, panelCash);
        });

        function setActiveTab(tab, panel) {
            // Deactivate all tabs
            [tabMobileMoney, tabCard, tabCash].forEach(t => {
                t.classList.remove('border-primary-600', 'text-primary-600');
                t.classList.add('border-transparent', 'text-gray-500');
            });

            // Hide all panels
            [panelMobileMoney, panelCard, panelCash].forEach(p => {
                p.classList.add('hidden');
            });

            // Activate selected tab and panel
            tab.classList.add('border-primary-600', 'text-primary-600');
            tab.classList.remove('border-transparent', 'text-gray-500');
            panel.classList.remove('hidden');
        }

        // Radio button styling for payment methods
        const paymentRadios = document.querySelectorAll('.payment-radio');
        paymentRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Reset all radio styles in the same group
                const groupName = this.getAttribute('name');
                document.querySelectorAll(`input[name="${groupName}"]`).forEach(r => {
                    const label = r.nextElementSibling;
                    if (r.checked) {
                        label.classList.add('border-primary-500', 'bg-primary-50');
                    } else {
                        label.classList.remove('border-primary-500', 'bg-primary-50');
                    }
                });
            });
        });

        // Process payment and show confirmation
        nextToStep4.addEventListener('click', function() {
            step3.classList.add('hidden');
            step4.classList.remove('hidden');
            updateProgressSteps(4);

            // Simulate payment processing
            setTimeout(function() {
                document.getElementById('payment-processing').classList.add('hidden');
                document.getElementById('payment-success').classList.remove('hidden');
            }, 2000);
        });

        // Function to update progress steps
        function updateProgressSteps(activeStep) {
            const steps = document.querySelectorAll('.rounded-full.transition');
            const lines = document.querySelectorAll('.flex-auto.border-t-2');

            steps.forEach((step, index) => {
                if (index + 1 < activeStep) {
                    // Completed steps
                    step.classList.add('bg-primary-600', 'border-primary-600');
                    step.classList.remove('bg-white', 'border-gray-300', 'text-gray-400');
                    step.innerHTML = `<i class="ri-check-line text-white"></i>`;
                } else if (index + 1 === activeStep) {
                    // Current step
                    step.classList.add('bg-primary-600', 'border-primary-600', 'text-white',
                        'step-active');
                    step.classList.remove('bg-white', 'border-gray-300', 'text-gray-400');
                    step.innerHTML = (index + 1).toString();

                    // Update step label color
                    step.nextElementSibling.classList.add('text-primary-600');
                    step.nextElementSibling.classList.remove('text-gray-500');
                } else {
                    // Future steps
                    step.classList.add('bg-white', 'border-gray-300', 'text-gray-400');
                    step.classList.remove('bg-primary-600', 'border-primary-600', 'text-white',
                        'step-active');
                    step.innerHTML = (index + 1).toString();

                    // Update step label color
                    step.nextElementSibling.classList.add('text-gray-500');
                    step.nextElementSibling.classList.remove('text-primary-600');
                }
            });

            // Update connecting lines
            lines.forEach((line, index) => {
                if (index + 1 < activeStep) {
                    // Completed lines
                    line.classList.add('border-primary-600');
                    line.classList.remove('border-gray-300');
                } else {
                    // Future lines
                    line.classList.add('border-gray-300');
                    line.classList.remove('border-primary-600');
                }
            });
        }

        // Function to update total amount based on selected periods
        function updateTotal() {
            const periodCount = document.querySelectorAll('.period-checkbox-input:checked').length || 1;
            const baseAmount = 200.00; // This would come from the selected tax
            const total = baseAmount * periodCount;

            document.getElementById('period-count').textContent = periodCount;
            document.getElementById('total-amount').textContent = `GHS ${total.toFixed(2)}`;
        }

        // Business search functionality
        const businessSearch = document.getElementById('business-search');
        businessSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            businessCards.forEach(card => {
                const businessName = card.querySelector('h3').textContent.toLowerCase();
                const businessId = card.querySelector('p').textContent.toLowerCase();

                if (businessName.includes(searchTerm) || businessId.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    </script>

</body>

</html>