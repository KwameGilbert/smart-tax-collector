<?php
/**
 * Tax Distribution Chart Component
 * Displays a pie chart showing distribution of taxes by type
 * 
 * @param array $labels Array of tax type labels
 * @param array $data Array of percentage values
 */

function renderTaxDistributionChart($labels = [], $data = []) {
    // Generate a unique ID for this chart instance
    $chartId = 'tax-distribution-chart-' . uniqid();
?>
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-4">
        <h2 class="text-xl font-semibold">Tax Type Distribution</h2>
        <p class="text-gray-500 text-sm">Percentage of each tax type in total revenue</p>
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

    // Generate colors
    const colors = getColors(data.length);

    // Create chart
    const ctx = document.getElementById('<?php echo $chartId; ?>').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: colors,
                borderColor: colors,
                borderWidth: 1,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.raw.toFixed(1) + '%';
                        }
                    }
                }
            }
        }
    });

    // Function to generate colors
    function getColors(count) {
        const baseColors = [
            'rgba(54, 162, 235, 0.7)', // blue
            'rgba(75, 192, 192, 0.7)', // teal
            'rgba(153, 102, 255, 0.7)', // purple
            'rgba(255, 159, 64, 0.7)', // orange
            'rgba(255, 99, 132, 0.7)', // red
            'rgba(255, 206, 86, 0.7)', // yellow
            'rgba(76, 175, 80, 0.7)', // green
            'rgba(233, 30, 99, 0.7)', // pink
            'rgba(96, 125, 139, 0.7)' // blue-grey
        ];

        const colors = [];
        for (let i = 0; i < count; i++) {
            colors.push(baseColors[i % baseColors.length]);
        }
        return colors;
    }

    // Expose chart to global scope for AJAX updates
    window.taxDistributionChart = chart;
});
</script>
<?php
}
?>