<?php
/**
 * Monthly Revenue Chart Component
 * Displays a bar chart showing monthly revenue
 * 
 * @param array $labels Array of month labels
 * @param array $data Array of revenue data values
 */

function renderMonthlyRevenueChart($labels = [], $data = []) {
    // Generate a unique ID for this chart instance
    $chartId = 'monthly-revenue-chart-' . uniqid();
?>
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-4">
        <h2 class="text-xl font-semibold">Monthly Revenue</h2>
        <p class="text-gray-500 text-sm">Revenue collected per month (GHS)</p>
    </div>
    <div class="h-72">
        <canvas id="<?php echo $chartId; ?>"></canvas>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data from PHP
    const labels = <?php echo json_encode($labels); ?>;
    const data = <?php echo json_encode($data); ?>;

    // Create chart
    const ctx = document.getElementById('<?php echo $chartId; ?>').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Monthly Revenue',
                data: data,
                backgroundColor: 'rgba(99, 102, 241, 0.7)',
                borderColor: 'rgb(99, 102, 241)',
                borderWidth: 1,
                borderRadius: 4,
                barThickness: 'flex',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
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
                            return 'Revenue: GHS ' + context.raw.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    // Expose chart to global scope for AJAX updates
    window.monthlyRevenueChart = chart;
});
</script>
<?php
}
?>