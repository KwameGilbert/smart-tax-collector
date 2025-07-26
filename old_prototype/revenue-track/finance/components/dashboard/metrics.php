<?php
/**
 * Metrics Component
 * Displays the key metrics cards for the finance dashboard
 * 
 * @param float $totalRevenue Total revenue collected
 * @param int $taxpayerCount Number of active taxpayers
 * @param float $collectionRate Tax collection rate percentage
 * @param float $overdueAmount Amount of overdue taxes
 */

function renderMetrics($totalRevenue = 0, $taxpayerCount = 0, $collectionRate = 0, $overdueAmount = 0) {
?>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <!-- Total Revenue -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500">Total Revenue</h3>
            <div class="p-2 bg-green-100 rounded-full">
                <i class="ri-money-dollar-circle-line text-green-600"></i>
            </div>
        </div>
        <p id="total-revenue" class="text-2xl font-bold">GHS <?php echo number_format($totalRevenue, 2); ?></p>
    </div>

    <!-- Taxpayers -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500">Taxpayers</h3>
            <div class="p-2 bg-blue-100 rounded-full">
                <i class="ri-user-3-line text-blue-600"></i>
            </div>
        </div>
        <p id="taxpayer-count" class="text-2xl font-bold"><?php echo number_format($taxpayerCount); ?></p>
    </div>

    <!-- Collection Rate -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500">Collection Rate</h3>
            <div class="p-2 bg-purple-100 rounded-full">
                <i class="ri-percent-line text-purple-600"></i>
            </div>
        </div>
        <p id="collection-rate" class="text-2xl font-bold"><?php echo number_format($collectionRate, 2); ?>%</p>
    </div>

    <!-- Overdue Taxes -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500">Overdue Taxes</h3>
            <div class="p-2 bg-red-100 rounded-full">
                <i class="ri-alarm-warning-line text-red-600"></i>
            </div>
        </div>
        <p id="overdue-amount" class="text-2xl font-bold">GHS <?php echo number_format($overdueAmount, 2); ?></p>
    </div>
</div>
<?php
}
?>