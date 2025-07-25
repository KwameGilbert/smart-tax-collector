<?php
// Include the database connection class
require_once __DIR__ . '/../../database/database.php';

// require_once __DIR__ . '/../login/authcheck.php';

// Fetch total revenue
$totalRevenueQuery = "SELECT SUM(amount_paid) as total_revenue FROM payments";
$totalRevenueResult = $conn->query($totalRevenueQuery);
$totalRevenue = 0;
if ($totalRevenueResult && $totalRevenueResult->num_rows > 0) {
    $row = $totalRevenueResult->fetch_assoc();
    $totalRevenue = $row["total_revenue"] ?? 0;
}

// Fetch taxpayer count
$taxpayersQuery = "SELECT COUNT(DISTINCT b.id) as taxpayer_count FROM businesses b 
                   JOIN business_taxes bt ON b.id = bt.business_id 
                   WHERE bt.active = 1";
$taxpayersResult = $conn->query($taxpayersQuery);
$taxpayerCount = 0;
if ($taxpayersResult && $taxpayersResult->num_rows > 0) {
    $row = $taxpayersResult->fetch_assoc();
    $taxpayerCount = $row["taxpayer_count"] ?? 0;
}

// Calculate collection rate
$collectionRateQuery = "SELECT 
                        (COUNT(DISTINCT bt.id) * 100 / 
                        (SELECT COUNT(*) FROM business_taxes)) as collection_rate 
                        FROM business_taxes bt 
                        JOIN payments p ON bt.id = p.business_tax_id";
$collectionRateResult = $conn->query($collectionRateQuery);
$collectionRate = 0;
if ($collectionRateResult && $collectionRateResult->num_rows > 0) {
    $row = $collectionRateResult->fetch_assoc();
    $collectionRate = $row["collection_rate"] ?? 0;
}

// Fetch overdue taxes
$overdueQuery = "SELECT SUM(tt.amount) as overdue_amount
                FROM business_taxes bt
                JOIN tax_types tt ON bt.tax_type_id = tt.id
                WHERE bt.active = 1
                AND bt.id NOT IN (SELECT business_tax_id FROM payments)";
                
$overdueResult = $conn->query($overdueQuery);
$overdueAmount = 0;
if ($overdueResult && $overdueResult->num_rows > 0) {
    $row = $overdueResult->fetch_assoc();
    $overdueAmount = $row["overdue_amount"] ?? 0;
}

// Fetch monthly revenue data for chart
$monthlyRevenueQuery = "SELECT 
                        DATE_FORMAT(paid_at, '%Y-%m') as month,
                        SUM(amount_paid) as monthly_revenue
                        FROM payments
                        WHERE paid_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
                        GROUP BY month
                        ORDER BY month ASC";
$monthlyRevenueResult = $conn->query($monthlyRevenueQuery);
$monthlyRevenue = [];
$monthLabels = [];

if ($monthlyRevenueResult->num_rows > 0) {
    while ($row = $monthlyRevenueResult->fetch_assoc()) {
        $monthLabels[] = date('M', strtotime($row["month"] . '-01'));
        $monthlyRevenue[] = (float)$row["monthly_revenue"];
    }
}

// Fetch tax type distribution
$taxDistributionQuery = "SELECT tt.name, 
                        (SUM(p.amount_paid) * 100 / (SELECT SUM(amount_paid) FROM payments)) as percentage
                        FROM payments p
                        JOIN business_taxes bt ON p.business_tax_id = bt.id
                        JOIN tax_types tt ON bt.tax_type_id = tt.id
                        GROUP BY tt.id
                        ORDER BY percentage DESC";
$taxDistributionResult = $conn->query($taxDistributionQuery);
$taxTypes = [];
$taxPercentages = [];

if ($taxDistributionResult->num_rows > 0) {
    while ($row = $taxDistributionResult->fetch_assoc()) {
        $taxTypes[] = $row["name"];
        $taxPercentages[] = (float)$row["percentage"];
    }
}

// Include payment data helper
require_once __DIR__ . '/../components/dashboard/payment_data.php';

// Fetch recent payments
$recentPayments = getRecentPayments(5);

// Include components
require_once __DIR__ . '/../components/layout/header.php';
require_once __DIR__ . '/../components/layout/sidebar.php';
require_once __DIR__ . '/../components/dashboard/metrics.php';
require_once __DIR__ . '/../components/charts/monthly_revenue.php';
require_once __DIR__ . '/../components/charts/dashboard_tax_distribution.php';
require_once __DIR__ . '/../components/dashboard/recent_payments.php';
require_once __DIR__ . '/../components/layout/footer.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Dashboard - Sefwi Tax Collection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/../finance/components/shared/app.js"></script>
    <style>
    /* Fixed header styles */
    .overflow-y-auto {
        height: calc(100vh - 5rem);
        /* Account for header height */
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

    .active-filter {
        background-color: #EBF5FF;
        color: #2563EB;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .spinner {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        border: 4px solid rgba(59, 130, 246, 0.3);
        border-top-color: #3B82F6;
        animation: spin 1s linear infinite;
    }
    </style>
</head>

<body class="min-h-screen bg-white" id="main-body">
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="flex items-center justify-center">
        <div class="spinner"></div>
    </div>

    <div class="md:ml-64 flex flex-col min-h-screen transition-all duration-300">
        <?php renderSidebar('dashboard', false); ?>

        <!-- Header -->
        <?php renderHeader('Finance Dashboard', true); ?>

        <!-- Main Content -->
        <div class="p-4 md:p-8 bg-gray-100 flex-grow overflow-y-auto">
            <div id="dashboard-content">
                <?php renderMetrics($totalRevenue, $taxpayerCount, $collectionRate, $overdueAmount); ?>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <?php 
                    renderTaxDistributionChart($taxTypes, $taxPercentages); 
                    renderMonthlyRevenueChart($monthLabels, $monthlyRevenue);
                    ?>
                </div>

                <!-- Recent Payments Section -->
                <div class="mt-6">
                    <?php renderRecentPayments($recentPayments); ?>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables for chart objects
        let monthlyRevenueChart = null;
        let taxDistributionChart = null;

        // Get chart instances from global scope (set by chart component scripts)
        setTimeout(() => {
            monthlyRevenueChart = window.monthlyRevenueChart;
            taxDistributionChart = window.taxDistributionChart;
        }, 1000);

        // Date filter dropdown toggle
        const dateFilterButton = document.getElementById('date-filter-button');
        const dateFilterDropdown = document.getElementById('date-filter-dropdown');
        const selectedRangeText = document.getElementById('selected-range-text');
        const loadingOverlay = document.getElementById('loading-overlay');

        // Toggle dropdown
        dateFilterButton.addEventListener('click', function() {
            dateFilterDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!dateFilterButton.contains(e.target) && !dateFilterDropdown.contains(e.target)) {
                dateFilterDropdown.classList.add('hidden');
            }
        });

        // Add click event to filter options
        const filterButtons = dateFilterDropdown.querySelectorAll('button');
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const range = this.getAttribute('data-range');
                updateDashboard(range);

                // Update active state
                filterButtons.forEach(btn => btn.classList.remove('active-filter'));
                this.classList.add('active-filter');

                // Update button text
                selectedRangeText.textContent = this.textContent.trim();

                // Hide dropdown
                dateFilterDropdown.classList.add('hidden');
            });
        });

        // Function to update dashboard with AJAX
        function updateDashboard(range) {
            // Show loading overlay
            loadingOverlay.style.display = 'flex';

            // Make AJAX request
            fetch(`get_filtered_data.php?range=${range}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update metrics
                        document.getElementById('total-revenue').textContent = 'GHS ' + formatNumber(data
                            .totalRevenue);
                        document.getElementById('taxpayer-count').textContent = formatNumber(data
                            .taxpayerCount);
                        document.getElementById('collection-rate').textContent = formatNumber(data
                            .collectionRate) + '%';
                        document.getElementById('overdue-amount').textContent = 'GHS ' + formatNumber(data
                            .overdueAmount);

                        // Update charts
                        if (monthlyRevenueChart) {
                            updateMonthlyRevenueChart(monthlyRevenueChart, data.periodLabels, data
                                .periodRevenue);
                        }

                        if (taxDistributionChart) {
                            updateTaxDistributionChart(taxDistributionChart, data.taxTypes, data
                                .taxPercentages);
                        }

                        // Update recent payments table
                        updateRecentPayments(data.recentPayments);
                    } else {
                        console.error('Error updating dashboard:', data.error);
                        alert('Failed to update dashboard: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('AJAX request failed:', error);
                    alert('Network error. Please try again.');
                })
                .finally(() => {
                    // Hide loading overlay
                    loadingOverlay.style.display = 'none';
                });
        }

        // Function to update monthly revenue chart
        function updateMonthlyRevenueChart(chart, labels, data) {
            chart.data.labels = labels;
            chart.data.datasets[0].data = data;
            chart.update();
        }

        // Function to update tax distribution chart
        function updateTaxDistributionChart(chart, labels, data) {
            chart.data.labels = labels;
            chart.data.datasets[0].data = data;
            chart.update();
        }

        // Function to update recent payments table
        function updateRecentPayments(payments) {
            const paymentsTable = document.querySelector('#recent-payments-table tbody');
            if (!paymentsTable) return;

            // Clear existing rows
            paymentsTable.innerHTML = '';

            if (payments.length === 0) {
                // No payments
                const row = document.createElement('tr');
                row.innerHTML =
                    `<td colspan="5" class="px-4 py-4 text-center text-gray-500">No recent payments found</td>`;
                paymentsTable.appendChild(row);
            } else {
                // Render payments
                payments.forEach(payment => {
                    const row = document.createElement('tr');

                    // Determine payment method class
                    let methodClass = '';
                    let methodLabel = payment.payment_method;

                    switch (payment.payment_method) {
                        case 'momo':
                            methodClass = 'bg-yellow-100 text-yellow-800';
                            methodLabel = 'MTN MoMo';
                            break;
                        case 'card':
                            methodClass = 'bg-blue-100 text-blue-800';
                            methodLabel = 'Card Payment';
                            break;
                        case 'ussd':
                            methodClass = 'bg-green-100 text-green-800';
                            methodLabel = 'USSD';
                            break;
                    }

                    const formattedDate = new Date(payment.payment_date)
                        .toLocaleDateString('en-GB', {
                            day: 'numeric',
                            month: 'short',
                            year: 'numeric'
                        });

                    row.innerHTML = `
                        <td class="px-4 py-4 whitespace-nowrap">${escapeHTML(payment.business_name)}</td>
                        <td class="px-4 py-4 whitespace-nowrap">${escapeHTML(payment.tax_type)}</td>
                        <td class="px-4 py-4 whitespace-nowrap">${formattedDate}</td>
                        <td class="px-4 py-4 whitespace-nowrap">GHS ${formatNumber(payment.amount_paid)}</td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full ${methodClass} font-medium">
                                ${escapeHTML(methodLabel)}
                            </span>
                        </td>
                    `;

                    paymentsTable.appendChild(row);
                });
            }
        }

        // Helper function to format numbers
        function formatNumber(num) {
            if (num === null || isNaN(num)) return '0.00';
            return parseFloat(num).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        // Helper function to escape HTML
        function escapeHTML(str) {
            if (!str) return '';
            return str
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }
    });
    </script>

    <?php require_once __DIR__ . '/../components/layout/footer.php'; ?>
</body>

</html>