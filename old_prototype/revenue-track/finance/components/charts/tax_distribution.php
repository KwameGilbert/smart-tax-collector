<?php
// Tax Type Distribution Chart component
function renderTaxDistributionChart($taxTypes, $taxPercentages) {
?>
<div class="card p-6 bg-white border border-gray-200 shadow-md rounded-lg">
    <h3 class="text-lg font-semibold mb-2">Tax Type Distribution</h3>
    <p class="text-sm text-gray-500 mb-4">Percentage of each tax type in total revenue</p>
    <div class="h-64">
        <canvas id="taxDistributionChart"></canvas>
    </div>
</div>
<script>
window.renderTaxDistChart = function() {
    const taxDistCtx = document.getElementById('taxDistributionChart').getContext('2d');
    new Chart(taxDistCtx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($taxTypes); ?>,
            datasets: [{
                label: 'Percentage',
                data: <?php echo json_encode($taxPercentages); ?>,
                borderColor: '#818cf8',
                backgroundColor: '#818cf820',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#818cf8'
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        borderDash: [2, 2],
                        color: '#e5e7eb'
                    },
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
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
}
window.renderTaxDistChart();
</script>
<?php
}