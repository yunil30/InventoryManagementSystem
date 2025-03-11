<x-layout>
    <style>
        .chart {
            display: flex;
            justify-content: center;
            align-items: center;

            .categoryChartDoughnutDiv,
            .categoryChartPieDiv {
                font-size: 5rem;
                font-weight: 500;
                letter-spacing: .5px;
            }

            h5 {
                text-align: center;
            }
        }

        .totalInventoryValueDiv {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

    <div class="col-md-12 main-content">
        <div class="col-md-12 content-header">
            <h3>Inventory Dashboard</h3>
        </div>
        <div class="col-md-12 content-body">
            <div class="row">
                <div class="col-md-12 mt-5 chart">
                    <h5>Product Quantity by Category</h5>
                </div>

                <div class="col-md-6 chart">
                    <div class="col-md-7 categoryChartDoughnutDiv">
                        <h5>Doughnut Graph</h5>
                        <canvas id="categoryChartDoughnut"></canvas>
                    </div>
                </div>

                <div class="col-md-6 chart">
                    <div class="col-md-7 categoryChartPieDiv">
                        <h5>Pie Graph</h5>
                        <canvas id="categoryChartPie"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-5 totalInventoryValueDiv">
                <h5>Total Inventory Value: $150,000.00</h5>
            </div>

            <div class="col-md-12 mt-5">
                <div class="row">
                    <!-- Most Expensive Products -->
                    <div class="col-md-6">
                        <h4>Top 5 Most Expensive Products</h4>
                        <ul>
                            <li>Product Name 1 - $45,999.00</li>
                            <li>Product Name 2 - $35,999.00</li>
                            <li>Product Name 3 - $19,999.00</li>
                            <li>Product Name 4 - $16,599.00</li>
                            <li>Product Name 5 - $15,999.00</li>
                        </ul>
                    </div>

                    <!-- Recently Added Products -->
                    <div class="col-md-6">
                        <h4>Recently Added Products</h4>
                        <ul>
                            <li>Product Name 1 - Added on: Mar 01, 2025</li>
                            <li>Product Name 2 - Added on: Mar 01, 2025</li>
                            <li>Product Name 3 - Added on: Mar 01, 2025</li>
                            <li>Product Name 4 - Added on: Mar 01, 2025</li>
                            <li>Product Name 5 - Added on: Mar 01, 2025</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Function to fetch category data and update the chart
    function GetCategoryDistributionPie() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var categoryChartCtx = document.getElementById('categoryChartDoughnut').getContext('2d');
        var categoryChartDoughnut;

        $.ajax({
            url: `/GetCategoryDistribution`,  // Assuming this is the correct endpoint
            method: 'GET',
            data: {
                _token: csrfToken,
            },
            success: function(response) {
                const categories = response.categories; 
                const quantities = response.quantities;

                // Prepare the data for the chart
                const chartData = {
                    labels: categories,
                    datasets: [{
                        data: categories.map(category => quantities[category] || 0),
                        backgroundColor: ['rgb(255, 99, 132)','rgb(54, 162, 235)','rgb(255, 205, 86)'],
                        hoverOffset: 4,
                        borderColor: '#1f2328',
                    }]
                };

                // Update the chart or create it if it doesn't exist
                if (categoryChartDoughnut) {
                    categoryChartDoughnut.data = chartData; // Update the chart's data
                    categoryChartDoughnut.update();  // Re-render the chart
                } else {
                    categoryChartDoughnut = new Chart(categoryChartCtx, {
                        type: 'doughnut',
                        data: chartData
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log("Error fetching category distribution:", error);
            }
        });
    }

    // Function to fetch category data and update the chart
    function GetCategoryDistributionBar() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var categoryChartCtx = document.getElementById('categoryChartPie').getContext('2d');
        var categoryChartPie;

        $.ajax({
            url: `/GetCategoryDistribution`,  // Assuming this is the correct endpoint
            method: 'GET',
            data: {
                _token: csrfToken,
            },
            success: function(response) {
                const categories = response.categories; 
                const quantities = response.quantities;

                // Prepare the data for the chart
                const chartData = {
                    labels: categories,
                    datasets: [{
                        data: categories.map(category => quantities[category] || 0),
                        backgroundColor: ['rgb(255, 99, 132)','rgb(54, 162, 235)','rgb(255, 205, 86)'],
                        hoverOffset: 4,
                        borderColor: '#1f2328',
                    }]
                };

                // Update the chart or create it if it doesn't exist
                if (categoryChartPie) {
                    categoryChartPie.data = chartData; // Update the chart's data
                    categoryChartPie.update();  // Re-render the chart
                } else {
                    categoryChartPie = new Chart(categoryChartCtx, {
                        type: 'pie',
                        data: chartData
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log("Error fetching category distribution:", error);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        GetCategoryDistributionPie();
        GetCategoryDistributionBar();
    });
</script>
