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

// Dummy data for businesses
$businesses = [
    [
        'id' => 1,
        'name' => 'Adwoa Grocery Shop',
        'owner_name' => 'Adwoa Mensah',
        'contact' => '0244123456',
        'location' => 'Central Market, Sefwi',
        'business_type' => 'Retail',
        'registration_date' => '2023-03-15',
        'status' => 'active'
    ],
    [
        'id' => 2,
        'name' => 'Kofi Auto Repairs',
        'owner_name' => 'Kofi Agyemang',
        'contact' => '0201234567',
        'location' => 'Mechanic Lane, Sefwi',
        'business_type' => 'Service',
        'registration_date' => '2023-05-20',
        'status' => 'active'
    ],
    [
        'id' => 3,
        'name' => 'Afia Restaurant',
        'owner_name' => 'Afia Boateng',
        'contact' => '0277654321',
        'location' => 'High Street, Sefwi',
        'business_type' => 'Food & Beverage',
        'registration_date' => '2022-11-10',
        'status' => 'active'
    ],
    [
        'id' => 4,
        'name' => 'Kwame Building Materials',
        'owner_name' => 'Kwame Owusu',
        'contact' => '0234567890',
        'location' => 'Industrial Area, Sefwi',
        'business_type' => 'Construction',
        'registration_date' => '2023-01-25',
        'status' => 'inactive'
    ],
    [
        'id' => 5,
        'name' => 'Ama Fashion Boutique',
        'owner_name' => 'Ama Darkwa',
        'contact' => '0257891234',
        'location' => 'Shopping Mall, Sefwi',
        'business_type' => 'Retail',
        'registration_date' => '2022-08-12',
        'status' => 'active'
    ],
    [
        'id' => 6,
        'name' => 'Yaw Pharmacy',
        'owner_name' => 'Yaw Mensah',
        'contact' => '0269876543',
        'location' => 'Health Street, Sefwi',
        'business_type' => 'Healthcare',
        'registration_date' => '2023-06-05',
        'status' => 'active'
    ],
    [
        'id' => 7,
        'name' => 'Akosua Hair Salon',
        'owner_name' => 'Akosua Frimpong',
        'contact' => '0241234567',
        'location' => 'Beauty Avenue, Sefwi',
        'business_type' => 'Service',
        'registration_date' => '2022-12-18',
        'status' => 'active'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Businesses - Sefwi Tax Collection</title>
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
        <?php renderHeader('Manage Businesses', false); ?>

        <!-- Main Content -->
        <div class="p-4 md:p-8 bg-gray-100 flex-grow overflow-y-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold">Business Registry</h1>
                    <p class="text-gray-600">Manage registered businesses and their tax obligations</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative">
                        <input type="text" placeholder="Search businesses..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-search-line text-gray-500"></i>
                        </div>
                    </div>
                    <a href="add.php"
                        class="flex items-center justify-center gap-2 bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded-md shadow-sm">
                        <i class="ri-add-line"></i>
                        Register New Business
                    </a>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="mb-6 bg-white p-4 rounded-lg shadow">
                <div class="flex flex-wrap gap-4 items-center">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Business Type</label>
                        <select
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="">All Types</option>
                            <option value="Retail">Retail</option>
                            <option value="Service">Service</option>
                            <option value="Food & Beverage">Food & Beverage</option>
                            <option value="Construction">Construction</option>
                            <option value="Healthcare">Healthcare</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Registration Date</label>
                        <select
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="">All Time</option>
                            <option value="last-month">Last Month</option>
                            <option value="last-quarter">Last Quarter</option>
                            <option value="this-year">This Year</option>
                        </select>
                    </div>
                    <div class="self-end">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow">
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6 border-b border-gray-200">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500 text-white mr-4">
                                <i class="ri-store-2-line text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Businesses</p>
                                <p class="text-2xl font-bold">237</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-500 text-white mr-4">
                                <i class="ri-checkbox-circle-line text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Active Businesses</p>
                                <p class="text-2xl font-bold">215</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-red-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-500 text-white mr-4">
                                <i class="ri-close-circle-line text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Inactive Businesses</p>
                                <p class="text-2xl font-bold">22</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Business Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Owner
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contact
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Location
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Registration Date
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
                            <?php foreach ($businesses as $business): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">
                                        <?php echo htmlspecialchars($business['name']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <?php echo htmlspecialchars($business['owner_name']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <?php echo htmlspecialchars($business['contact']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <?php echo htmlspecialchars($business['location']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <?php echo htmlspecialchars($business['business_type']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <?php echo date('d M, Y', strtotime($business['registration_date'])); ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php echo $business['status'] === 'active' ? 'status-active' : 'status-inactive'; ?>">
                                        <?php echo ucfirst($business['status']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-3">
                                        <a href="view.php?id=<?php echo $business['id']; ?>"
                                            class="text-blue-600 hover:text-blue-900" title="View Business Details">
                                            <i class="ri-eye-line text-lg"></i>
                                        </a>
                                        <a href="edit.php?id=<?php echo $business['id']; ?>"
                                            class="text-blue-600 hover:text-blue-900" title="Edit Business">
                                            <i class="ri-pencil-line text-lg"></i>
                                        </a>
                                        <a href="assign-tax.php?id=<?php echo $business['id']; ?>"
                                            class="text-green-600 hover:text-green-900" title="Assign Taxes">
                                            <i class="ri-bill-line text-lg"></i>
                                        </a>
                                        <?php if ($business['status'] === 'active'): ?>
                                        <button
                                            onclick="confirmStatusChange(<?php echo $business['id']; ?>, 'deactivate')"
                                            class="text-red-600 hover:text-red-900" title="Deactivate Business">
                                            <i class="ri-close-circle-line text-lg"></i>
                                        </button>
                                        <?php else: ?>
                                        <button
                                            onclick="confirmStatusChange(<?php echo $business['id']; ?>, 'activate')"
                                            class="text-green-600 hover:text-green-900" title="Activate Business">
                                            <i class="ri-checkbox-circle-line text-lg"></i>
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
                            Showing <span class="font-medium">1</span> to <span class="font-medium">7</span> of <span
                                class="font-medium">237</span> businesses
                        </div>
                        <div class="flex space-x-1">
                            <button disabled
                                class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md bg-white text-sm font-medium text-gray-400 cursor-not-allowed">
                                Previous
                            </button>
                            <button
                                class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                1
                            </button>
                            <button
                                class="inline-flex items-center px-3 py-1 border border-transparent rounded-md bg-blue-600 text-sm font-medium text-white">
                                2
                            </button>
                            <button
                                class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                3
                            </button>
                            <span class="inline-flex items-center px-3 py-1 text-gray-700">...</span>
                            <button
                                class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                34
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

    <script>
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