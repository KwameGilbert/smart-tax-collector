<?php
/**
 * Recent Payments Component
 * Displays a table of recent tax payments received
 * 
 * @param array $recentPayments Array of recent payment records
 */

function renderRecentPayments($recentPayments = []) {
?>
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-4">
        <h2 class="text-xl font-semibold">Recent Collections</h2>
        <p class="text-gray-500 text-sm">Latest tax payments received</p>
    </div>

    <div class="overflow-x-auto">
        <table id="recent-payments-table" class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Business
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tax Type
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment
                        Method</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (empty($recentPayments)): ?>
                <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">No recent payments found</td>
                </tr>
                <?php else: ?>
                <?php foreach ($recentPayments as $payment): ?>
                <tr>
                    <td class="px-4 py-4 whitespace-nowrap"><?php echo htmlspecialchars($payment['business_name']); ?>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap"><?php echo htmlspecialchars($payment['tax_type']); ?></td>
                    <td class="px-4 py-4 whitespace-nowrap">
                        <?php echo date('M d, Y', strtotime($payment['payment_date'])); ?></td>
                    <td class="px-4 py-4 whitespace-nowrap">GHS <?php echo number_format($payment['amount_paid'], 2); ?>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                        <?php 
                        $methodLabels = [
                            'momo' => 'MTN MoMo',
                            'card' => 'Card Payment',
                            'ussd' => 'USSD'
                        ];
                        $method = $payment['payment_method'];
                        $methodClass = '';
                        
                        switch($method) {
                            case 'momo':
                                $methodClass = 'bg-yellow-100 text-yellow-800';
                                break;
                            case 'card':
                                $methodClass = 'bg-blue-100 text-blue-800';
                                break;
                            case 'ussd':
                                $methodClass = 'bg-green-100 text-green-800';
                                break;
                        }
                        ?>
                        <span class="px-2 py-1 text-xs rounded-full <?php echo $methodClass; ?> font-medium">
                            <?php echo $methodLabels[$method] ?? $method; ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (!empty($recentPayments)): ?>
    <div class="mt-4 text-right">
        <a href="../payments/" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
            View all payments <i class="ri-arrow-right-line align-bottom ml-1"></i>
        </a>
    </div>
    <?php endif; ?>
</div>
<?php
}
?>