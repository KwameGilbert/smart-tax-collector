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

// Dummy data for notifications
$notifications = [
    [
        'id' => 1,
        'type' => 'payment_due',
        'title' => 'Payment Due Reminder',
        'message' => 'Adwoa Grocery Shop has 3 taxes due in the next 7 days.',
        'business_id' => 1,
        'business_name' => 'Adwoa Grocery Shop',
        'timestamp' => '2023-07-12 08:45:22',
        'is_read' => false,
        'priority' => 'high'
    ],
    [
        'id' => 2,
        'type' => 'payment_received',
        'title' => 'New Payment Recorded',
        'message' => 'Kofi Auto Repairs has made a payment of GHS 200.00 for Business Operating Permit.',
        'business_id' => 2,
        'business_name' => 'Kofi Auto Repairs',
        'timestamp' => '2023-07-11 14:22:36',
        'is_read' => true,
        'priority' => 'medium'
    ],
    [
        'id' => 3,
        'type' => 'overdue',
        'title' => 'Overdue Payment Alert',
        'message' => 'Yaw Pharmacy has 2 overdue payments totaling GHS 275.00.',
        'business_id' => 6,
        'business_name' => 'Yaw Pharmacy',
        'timestamp' => '2023-07-11 09:15:47',
        'is_read' => false,
        'priority' => 'high'
    ],
    [
        'id' => 4,
        'type' => 'business_registered',
        'title' => 'New Business Registered',
        'message' => 'New business "Grace Fashion Hub" has been registered in the system.',
        'business_id' => 10,
        'business_name' => 'Grace Fashion Hub',
        'timestamp' => '2023-07-10 16:30:12',
        'is_read' => true,
        'priority' => 'low'
    ],
    [
        'id' => 5,
        'type' => 'tax_assigned',
        'title' => 'New Tax Assignment',
        'message' => 'Afia Restaurant has been assigned 2 new taxes by Admin User.',
        'business_id' => 3,
        'business_name' => 'Afia Restaurant',
        'timestamp' => '2023-07-10 11:45:33',
        'is_read' => true,
        'priority' => 'medium'
    ],
    [
        'id' => 6,
        'type' => 'collection_target',
        'title' => 'Collection Target Alert',
        'message' => 'Monthly collection target is currently at 65%. Goal: GHS 50,000.00, Collected: GHS 32,500.00',
        'business_id' => null,
        'business_name' => null,
        'timestamp' => '2023-07-09 09:00:00',
        'is_read' => false,
        'priority' => 'medium'
    ],
    [
        'id' => 7,
        'type' => 'overdue',
        'title' => 'Overdue Payment Alert',
        'message' => 'Kwame Building Materials has 1 overdue payment of GHS 800.00.',
        'business_id' => 4,
        'business_name' => 'Kwame Building Materials',
        'timestamp' => '2023-07-08 13:22:11',
        'is_read' => false,
        'priority' => 'high'
    ],
    [
        'id' => 8,
        'type' => 'system',
        'title' => 'System Update Completed',
        'message' => 'The tax collection system has been updated to version 2.3. New features include improved reporting and SMS notifications.',
        'business_id' => null,
        'business_name' => null,
        'timestamp' => '2023-07-08 02:15:00',
        'is_read' => true,
        'priority' => 'low'
    ],
    [
        'id' => 9,
        'type' => 'payment_received',
        'title' => 'New Payment Recorded',
        'message' => 'Akosua Hair Salon has made a payment of GHS 75.00 for Sanitation Fee.',
        'business_id' => 7,
        'business_name' => 'Akosua Hair Salon',
        'timestamp' => '2023-07-07 16:45:23',
        'is_read' => true,
        'priority' => 'medium'
    ],
    [
        'id' => 10,
        'type' => 'business_deactivated',
        'title' => 'Business Deactivated',
        'message' => 'Kwabena Electronics has been deactivated by Admin User.',
        'business_id' => 12,
        'business_name' => 'Kwabena Electronics',
        'timestamp' => '2023-07-06 10:30:45',
        'is_read' => true,
        'priority' => 'medium'
    ],
    [
        'id' => 11,
        'type' => 'report_ready',
        'title' => 'Monthly Report Ready',
        'message' => 'The tax collection report for June 2023 is now available for download and review.',
        'business_id' => null,
        'business_name' => null,
        'timestamp' => '2023-07-05 08:00:00',
        'is_read' => false,
        'priority' => 'medium'
    ],
    [
        'id' => 12,
        'type' => 'tax_updated',
        'title' => 'Tax Type Updated',
        'message' => 'The "Sanitation Fee" tax type has been updated. New amount: GHS 55.00 (was: GHS 50.00)',
        'business_id' => null,
        'business_name' => null,
        'timestamp' => '2023-07-04 14:15:32',
        'is_read' => true,
        'priority' => 'medium'
    ]
];

// Count unread notifications
$unreadCount = 0;
foreach ($notifications as $notification) {
    if (!$notification['is_read']) {
        $unreadCount++;
    }
}

// Notification type colors and icons
$notificationStyles = [
    'payment_due' => [
        'bg' => 'bg-yellow-100',
        'text' => 'text-yellow-800',
        'border' => 'border-yellow-200',
        'icon' => 'ri-calendar-event-line',
        'icon_bg' => 'bg-yellow-200'
    ],
    'payment_received' => [
        'bg' => 'bg-green-100',
        'text' => 'text-green-800',
        'border' => 'border-green-200',
        'icon' => 'ri-money-dollar-circle-line',
        'icon_bg' => 'bg-green-200'
    ],
    'overdue' => [
        'bg' => 'bg-red-100',
        'text' => 'text-red-800',
        'border' => 'border-red-200',
        'icon' => 'ri-alarm-warning-line',
        'icon_bg' => 'bg-red-200'
    ],
    'business_registered' => [
        'bg' => 'bg-blue-100',
        'text' => 'text-blue-800',
        'border' => 'border-blue-200',
        'icon' => 'ri-store-2-line',
        'icon_bg' => 'bg-blue-200'
    ],
    'tax_assigned' => [
        'bg' => 'bg-indigo-100',
        'text' => 'text-indigo-800',
        'border' => 'border-indigo-200',
        'icon' => 'ri-bill-line',
        'icon_bg' => 'bg-indigo-200'
    ],
    'collection_target' => [
        'bg' => 'bg-purple-100',
        'text' => 'text-purple-800',
        'border' => 'border-purple-200',
        'icon' => 'ri-target-line',
        'icon_bg' => 'bg-purple-200'
    ],
    'system' => [
        'bg' => 'bg-gray-100',
        'text' => 'text-gray-800',
        'border' => 'border-gray-200',
        'icon' => 'ri-computer-line',
        'icon_bg' => 'bg-gray-200'
    ],
    'business_deactivated' => [
        'bg' => 'bg-orange-100',
        'text' => 'text-orange-800',
        'border' => 'border-orange-200',
        'icon' => 'ri-close-circle-line',
        'icon_bg' => 'bg-orange-200'
    ],
    'report_ready' => [
        'bg' => 'bg-teal-100',
        'text' => 'text-teal-800',
        'border' => 'border-teal-200',
        'icon' => 'ri-file-chart-line',
        'icon_bg' => 'bg-teal-200'
    ],
    'tax_updated' => [
        'bg' => 'bg-cyan-100',
        'text' => 'text-cyan-800',
        'border' => 'border-cyan-200',
        'icon' => 'ri-edit-line',
        'icon_bg' => 'bg-cyan-200'
    ]
];

// Format relative time
function timeAgo($timestamp) {
    $datetime1 = new DateTime($timestamp);
    $datetime2 = new DateTime();
    $interval = $datetime1->diff($datetime2);
    
    if ($interval->d > 7) {
        return date('M j, Y', strtotime($timestamp));
    } elseif ($interval->d > 0) {
        return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
    } elseif ($interval->h > 0) {
        return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
    } else {
        return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Center - Sefwi Tax Collection</title>
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

    /* Custom notification styles */
    .notification-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .notification-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .notification-unread {
        position: relative;
    }

    .notification-unread::before {
        content: '';
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 20px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #3B82F6;
    }

    /* Priority indicators */
    .priority-high {
        border-left: 4px solid #EF4444;
    }

    .priority-medium {
        border-left: 4px solid #F59E0B;
    }

    .priority-low {
        border-left: 4px solid #10B981;
    }

    /* Filter button active state */
    .filter-btn.active {
        color: #ffffff;
        background-color: #1E40AF;
    }
    </style>
</head>

<body class="min-h-screen bg-white" id="main-body">
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="flex items-center justify-center">
        <div class="spinner"></div>
    </div>

    <div class="md:ml-64 flex flex-col min-h-screen transition-all duration-300">
        <?php renderSidebar('notifications', false); ?>

        <!-- Header -->
        <?php renderHeader('Notification Center', false); ?>

        <!-- Main Content -->
        <div class="p-4 md:p-8 bg-gray-100 flex-grow overflow-y-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold">Notification Center</h1>
                    <p class="text-gray-600">Stay updated on important events and actions</p>
                </div>
                <div class="flex space-x-2">
                    <?php if ($unreadCount > 0): ?>
                    <button id="mark-all-read"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        <i class="ri-check-double-line mr-2"></i>
                        Mark All as Read (<?php echo $unreadCount; ?>)
                    </button>
                    <?php endif; ?>
                    <div class="relative">
                        <button id="settings-btn"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50">
                            <i class="ri-settings-3-line mr-1"></i> Settings
                        </button>
                        <div id="settings-dropdown"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 hidden">
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Email
                                    Preferences</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">SMS
                                    Notifications</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Notification
                                    Types</a>
                                <div class="border-t border-gray-100"></div>
                                <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Clear All
                                    Notifications</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notification Filters -->
            <div class="mb-6 bg-white p-4 rounded-lg shadow">
                <div class="flex flex-wrap items-center justify-between">
                    <div class="flex flex-wrap gap-2 mb-4 md:mb-0">
                        <button
                            class="filter-btn active px-3 py-1 rounded-md text-sm font-medium bg-gray-100 hover:bg-gray-200">
                            All
                        </button>
                        <button
                            class="filter-btn px-3 py-1 rounded-md text-sm font-medium bg-gray-100 hover:bg-gray-200">
                            Unread
                        </button>
                        <button
                            class="filter-btn px-3 py-1 rounded-md text-sm font-medium bg-gray-100 hover:bg-gray-200">
                            High Priority
                        </button>
                        <button
                            class="filter-btn px-3 py-1 rounded-md text-sm font-medium bg-gray-100 hover:bg-gray-200">
                            Payments
                        </button>
                        <button
                            class="filter-btn px-3 py-1 rounded-md text-sm font-medium bg-gray-100 hover:bg-gray-200">
                            Businesses
                        </button>
                        <button
                            class="filter-btn px-3 py-1 rounded-md text-sm font-medium bg-gray-100 hover:bg-gray-200">
                            System
                        </button>
                    </div>
                    <div class="relative">
                        <input type="text" placeholder="Search notifications..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-search-line text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notification Cards -->
            <div class="space-y-4">
                <?php foreach ($notifications as $notification): 
                    $style = $notificationStyles[$notification['type']] ?? [
                        'bg' => 'bg-gray-100',
                        'text' => 'text-gray-800',
                        'border' => 'border-gray-200',
                        'icon' => 'ri-notification-2-line',
                        'icon_bg' => 'bg-gray-200'
                    ];
                    
                    $priorityClass = 'priority-' . $notification['priority'];
                ?>
                <div
                    class="notification-card <?php echo $style['bg']; ?> <?php echo $style['border']; ?> <?php echo $priorityClass; ?> rounded-lg shadow <?php echo !$notification['is_read'] ? 'notification-unread' : ''; ?>">
                    <div class="p-5">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div
                                    class="<?php echo $style['icon_bg']; ?> <?php echo $style['text']; ?> p-3 rounded-full">
                                    <i class="<?php echo $style['icon']; ?> text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-lg font-medium <?php echo $style['text']; ?>">
                                        <?php echo htmlspecialchars($notification['title']); ?></h3>
                                    <span
                                        class="text-sm text-gray-500"><?php echo timeAgo($notification['timestamp']); ?></span>
                                </div>
                                <p class="mt-1 text-gray-700"><?php echo htmlspecialchars($notification['message']); ?>
                                </p>

                                <div class="mt-3 flex flex-wrap justify-between items-center">
                                    <?php if ($notification['business_id']): ?>
                                    <a href="../businesses/view.php?id=<?php echo $notification['business_id']; ?>"
                                        class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                                        <i class="ri-store-2-line mr-1"></i>
                                        View <?php echo htmlspecialchars($notification['business_name']); ?>
                                    </a>
                                    <?php endif; ?>

                                    <?php if ($notification['type'] === 'payment_due'): ?>
                                    <a href="../businesses/record-payment.php?id=<?php echo $notification['business_id']; ?>"
                                        class="inline-flex items-center text-sm text-green-600 hover:text-green-800">
                                        <i class="ri-money-dollar-circle-line mr-1"></i>
                                        Record Payment
                                    </a>
                                    <?php elseif ($notification['type'] === 'report_ready'): ?>
                                    <a href="../reports/view.php"
                                        class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                                        <i class="ri-file-chart-line mr-1"></i>
                                        View Report
                                    </a>
                                    <?php endif; ?>

                                    <div class="flex space-x-2 mt-2 md:mt-0">
                                        <?php if (!$notification['is_read']): ?>
                                        <button
                                            class="mark-read-btn inline-flex items-center px-2 py-1 text-xs bg-blue-50 text-blue-700 rounded hover:bg-blue-100"
                                            data-id="<?php echo $notification['id']; ?>">
                                            <i class="ri-check-line mr-1"></i> Mark as Read
                                        </button>
                                        <?php endif; ?>
                                        <div class="relative">
                                            <button
                                                class="notification-action-btn inline-flex items-center px-2 py-1 text-xs bg-gray-50 text-gray-700 rounded hover:bg-gray-100">
                                                <i class="ri-more-2-fill"></i>
                                            </button>
                                            <div
                                                class="notification-dropdown absolute right-0 mt-1 w-40 bg-white rounded-md shadow-lg z-10 hidden">
                                                <div class="py-1">
                                                    <?php if ($notification['is_read']): ?>
                                                    <a href="#"
                                                        class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100">
                                                        Mark as Unread
                                                    </a>
                                                    <?php endif; ?>
                                                    <a href="#"
                                                        class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100">
                                                        Turn Off This Type
                                                    </a>
                                                    <a href="#"
                                                        class="block px-4 py-2 text-xs text-red-600 hover:bg-gray-100">
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <!-- Load More Button -->
                <div class="mt-6 text-center">
                    <button
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50">
                        <i class="ri-refresh-line mr-2"></i> Load More
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Settings dropdown toggle
        const settingsBtn = document.getElementById('settings-btn');
        const settingsDropdown = document.getElementById('settings-dropdown');

        settingsBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            settingsDropdown.classList.toggle('hidden');
        });

        // Hide dropdowns when clicking elsewhere
        document.addEventListener('click', function() {
            settingsDropdown.classList.add('hidden');
            document.querySelectorAll('.notification-dropdown').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        });

        // Filter button click handlers
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => {
                    b.classList.remove('active');
                    b.classList.remove('bg-blue-800');
                    b.classList.remove('text-white');
                });

                this.classList.add('active');
                this.classList.add('bg-blue-800');
                this.classList.add('text-white');

                // In a real implementation, this would filter the notifications
                console.log('Filter selected:', this.textContent.trim());
            });
        });

        // Mark as read button handlers
        document.querySelectorAll('.mark-read-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const id = this.getAttribute('data-id');
                const notificationCard = this.closest('.notification-card');

                // In a real implementation, this would call an API to mark as read
                console.log('Marking notification as read:', id);

                // Visual update
                notificationCard.classList.remove('notification-unread');
                this.remove();
            });
        });

        // Mark all as read button
        const markAllReadBtn = document.getElementById('mark-all-read');
        if (markAllReadBtn) {
            markAllReadBtn.addEventListener('click', function() {
                // In a real implementation, this would call an API to mark all as read
                console.log('Marking all notifications as read');

                // Visual update
                document.querySelectorAll('.notification-unread').forEach(card => {
                    card.classList.remove('notification-unread');
                });

                document.querySelectorAll('.mark-read-btn').forEach(btn => {
                    btn.remove();
                });

                this.remove();
            });
        }

        // Notification action button dropdowns
        document.querySelectorAll('.notification-action-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdown = this.nextElementSibling;

                // Close all other dropdowns first
                document.querySelectorAll('.notification-dropdown').forEach(d => {
                    if (d !== dropdown) d.classList.add('hidden');
                });

                dropdown.classList.toggle('hidden');
            });
        });
    });
    </script>

    <?php require_once __DIR__ . '/../components/layout/footer.php'; ?>
</body>

</html>