<x-layout>
    <style>
        .ProductQuantityDiv {
            background-color: #ffffff;
            padding: 0rem;
            margin: 0rem;
            display: flex;
            justify-content: center;
            align-items: center;

            h5 {
                text-align: start;
            }

            canvas {
                letter-spacing: .5px;
            }
        }

        .ProductListingDiv {
            display: flex; 
            justify-content: space-between;

            .RecentlyAddedProductsDiv,
            .MostExpensiveProductsDiv {
                background-color: #ffffff;
                padding: 1rem;
                margin: 0rem;
                
                #expensiveProductsTable,
                #recentlyAddedTable {
                    border: 1px solid #ffffff;

                    th {
                        background-color: #357edd;
                        color: #ffffff;
                        font-size: 14.4px;
                        font-weight: 500;
                        letter-spacing: .5px;
                    }

                    td {
                        background-color: #ffffff;
                        font-size: 14.4px;
                        font-weight: 400;
                        letter-spacing: .5px;
                    }
                }
            }
        }

        .totalInventoryValueDiv {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }
    </style>

    <div class="col-md-12 main-content">
        <div class="col-md-12 content-header">
            <h3>Dashboard</h3>
        </div>
        <div class="col-md-12 content-body">
            <div class="col-md-12">
                <div class="row ProductListingDiv">
                    <div class="col-md-6 MostExpensiveProductsDiv">
                        <h5>Most Expensive Products</h5>
                        <table class="table table-hover table-bordered" id="expensiveProductsTable">
                            <thead>
                                <tr>
                                    <th class="text-left" style="width: 20%; text-align: left;">No.</th>
                                    <th class="text-left" style="width: 40%; text-align: left;">Product name</th>
                                    <th class="text-left" style="width: 40%; text-align: left;">Product price</th>
                                </tr>
                            </thead>
                            <tbody id="loadExpensiveProducts"></tbody>
                        </table> 
                    </div>

                    <div class="col-md-5 RecentlyAddedProductsDiv">
                        <h5>Recently Added Products</h5>
                        <table class="table table-hover table-bordered" id="recentlyAddedTable">
                            <thead>
                                <tr>
                                    <th class="text-left" style="width: 20%; text-align: left;">No.</th>
                                    <th class="text-left" style="width: 40%; text-align: left;">Product name</th>
                                    <th class="text-left" style="width: 40%; text-align: left;">Date Added</th>
                                </tr>
                            </thead>
                            <tbody id="loadRecentlyAdded"></tbody>
                        </table> 
                    </div>
                </div>
            </div>

            <div class="col-md-12 totalInventoryValueDiv">
                <h5>Total Inventory Value: ₱<span class="totalAmount"></span></h5>
            </div>

            <div class="col-md-6">
                <div class="row ProductQuantityDiv">
                    <h5>Product Quantity by Category</h5>
                    <canvas id="ProductQuantityChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function GetCategoryLineChart() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var ProductQuantityChartCtx = document.getElementById('ProductQuantityChart').getContext('2d');
        var ProductQuantityChart;

        $.ajax({
            url: `/GetProductQuantityByCategory`,
            method: 'GET',
            data: {
                _token: csrfToken,
            },
            success: function(response) {
                const categories = response.categories;
                const quantities = response.quantities;

                const chartData = {
                    labels: categories, // Categories as X-axis labels
                    datasets: [{
                        label: 'Product Quantity', // Label for the line chart
                        data: categories.map(category => Math.round(quantities[category] || 0)), // Quantities as Y-axis data
                        borderColor: '#357edd', // Line color
                        backgroundColor: 'rgba(41, 128, 185, 0.3)', // Background color under the line (optional)
                        fill: true, // To fill the area under the line (optional)
                        tension: 0.5, // Line smoothness (optional)
                        borderWidth: 2,
                    }]
                };

                // Chart options with font customization for axes and legend
                const chartOptions = {
                    scales: {
                        x: {
                            grid: {
                                color: '#1f2328', // Color of the grid lines
                                lineWidth: 1, // Thickness of the grid lines
                            },
                            ticks: {
                                font: {
                                    family: 'Arial', // Set the font family
                                    size: 14, // Set the font size
                                    weight: 'bold', // Set the font weight (e.g., 'normal', 'bold')
                                    style: 'normal', // Set the font style (optional)
                                },
                                color: '#1f2328',
                                maxTicksLimit: 5,
                            }
                        },
                        y: {
                            grid: {
                                color: '#1f2328', // Color of the grid lines
                                lineWidth: 1, // Thickness of the grid lines
                            },
                            ticks: {
                                font: {
                                    family: 'Arial', // Set the font family
                                    size: 14, // Set the font size
                                    weight: 'bold', // Set the font weight
                                    style: 'normal', // Set the font style (optional)
                                },
                                color: '#1f2328',
                                stepSize: 1, 
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    family: 'Arial', // Set the font family for the legend
                                    size: 14, // Set the font size for the legend
                                    weight: 'bold', // Set the font weight for the legend (e.g., 'normal', 'bold')
                                    style: 'normal', // Set the font style for the legend (optional)
                                },
                                color: '#1f2328',
                            }
                        }
                    }
                };

                // If the chart already exists, update it with the new data and options
                if (ProductQuantityChart) {
                    ProductQuantityChart.data = chartData;
                    ProductQuantityChart.options = chartOptions; // Apply new options for the font
                    ProductQuantityChart.update();
                } else {
                    // Create a new Line chart if it doesn't exist
                    ProductQuantityChart = new Chart(ProductQuantityChartCtx, {
                        type: 'line', // Set the chart type to 'line'
                        data: chartData,
                        options: chartOptions // Apply the font customization options
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log("Error fetching category distribution:", error);
            }
        });
    }

    function GetTotalInventoryValue() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var totalAmount = document.querySelector('.totalAmount');

        $.ajax({
            url: `/GetTotalInventoryValue`, 
            method: 'GET',
            data: {
                _token: csrfToken,
            },
            success: function(response) { 
                console.log(response.totalValue);

                let formattedValue = parseFloat(response.totalValue)
                    .toFixed(2)
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                totalAmount.textContent = formattedValue;
            }
        });
    }

    function GetMostExpensiveProducts() {
        $.ajax({
            url: `/GetMostExpensiveProducts`, 
            method: 'GET',
            success: function(products) { 
                products.forEach(function(row, index) {
                    const formattedPrice = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'PHP' }).format(row.product_price);

                    $('#loadExpensiveProducts').append(`
                        <tr>
                            <td style="vertical-align: middle; text-align: left;">${index + 1}</td>
                            <td style="vertical-align: middle; text-align: left;">${row.product_name}</td>
                            <td style="vertical-align: middle; text-align: left;">${formattedPrice}</td>
                        </tr>
                    `);
                });
            }
        });
    }

    function GetRecentProducts() {
        $.ajax({
            url: `/GetRecentProducts`, 
            method: 'GET',
            success: function(products) { 
                products.forEach(function(row, index) {
                    const formattedDate = new Date(row.date_created).toLocaleDateString('en-US', {month:'short', day:'numeric', year:'numeric'});

                    $('#loadRecentlyAdded').append(`
                        <tr>
                            <td style="vertical-align: middle; text-align: left;">${index + 1}</td>
                            <td style="vertical-align: middle; text-align: left;">${row.product_name}</td>
                            <td style="vertical-align: middle; text-align: left;">${formattedDate}</td>
                        </tr>
                    `);
                });
            }
        });
    }

    function testing() {
        $.ajax({
            url: `/testing`, 
            method: 'GET',
            success: function(products) { 
                console.log(products);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        GetCategoryLineChart();
        GetTotalInventoryValue();
        GetMostExpensiveProducts();
        GetRecentProducts();
        testing()
    });
</script>
