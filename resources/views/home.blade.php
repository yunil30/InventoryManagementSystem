<x-layout>
    <style>


        .ProductListingDiv {
            display: flex; 
            justify-content: space-between;
            padding-bottom: 2rem;

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

        .ProductDiv {
            display: flex; 
            justify-content: space-between;
            padding-bottom: 2rem;

            .ProductQuantityDiv {
                background-color: #ffffff;
                display: flex;
                justify-content: center;
                align-items: center;
                padding-bottom: 2rem;

                h5 {
                    text-align: start;
                }

                canvas {
                    letter-spacing: .5px;
                }
            }

            .ProductStatusDiv{
                background-color: #ffffff;
                display: flex;
                justify-content: center;
                align-items: center;
                padding-bottom: 2rem;

                h5 {
                    text-align: start;
                }

                canvas {
                    letter-spacing: .5px;
                }
            }
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

            <div class="col-md-12 ProductDiv">
                <div class="col-md-5 ProductQuantityDiv">
                    <div class="col-md-12">
                        <div class="row">
                            <h5>Product Quantity by Category</h5>
                            <canvas id="ProductQuantityChart"></canvas>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-5 ProductStatusDiv">
                    <div class="col-md-12">
                        <div class="row">
                            <h5>Product Status</h5>
                            <canvas id="ProductStatusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 totalInventoryValueDiv">
                <h5>Total Inventory Value: ₱<span class="totalAmount"></span></h5>
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
                    labels: categories,
                    datasets: [{
                        label: 'Product Quantity',
                        data: categories.map(category => Math.round(quantities[category] || 0)),
                        borderColor: '#357edd',
                        backgroundColor: 'rgba(41, 128, 185, 0.3)', 
                        fill: true,
                        tension: 0.5, 
                        borderWidth: 2,
                    }]
                };

                const chartOptions = {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Product Category',
                            },
                            grid: {
                                color: '#1f2328',
                                lineWidth: 1,
                            },
                            ticks: {
                                font: {
                                    family: 'Arial',
                                    size: 14,
                                    weight: 'bold',
                                    style: 'normal',
                                },
                                color: '#1f2328',
                                maxTicksLimit: 5,
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Product Quantity',
                            },
                            grid: {
                                color: '#1f2328',
                                lineWidth: 1,
                            },
                            ticks: {
                                font: {
                                    family: 'Arial',
                                    size: 14,
                                    weight: 'bold',
                                    style: 'normal',
                                },
                                color: '#1f2328',
                                maxTicksLimit: 10,
                                beginAtZero: true,
                                stepSize: 1,
                            },
                            min: 0
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    family: 'Arial',
                                    size: 14,
                                    weight: 'bold',
                                    style: 'normal',
                                },
                                color: '#1f2328',
                            }
                        }
                    }
                };
              
                ProductQuantityChart = new Chart(ProductQuantityChartCtx, {
                    type: 'line',
                    data: chartData,
                    options: chartOptions
                });
            },
            error: function(xhr, status, error) {
                console.log("Error fetching category distribution:", error);
            }
        });
    }

    function GetProductStatus() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            url: '/GetProductStatus',
            method: 'GET',
            data: {
                _token: csrfToken,  // CSRF Token for security
            },
            success: function(products) {
                console.table(products); // Log products for debugging

                var ctx = document.getElementById('ProductStatusChart').getContext('2d');

                const chartData = {
                    labels: ['In Stock', 'Low Stock', 'Out of Stock'],
                    datasets: [{
                        label: 'Product Status Quantities',
                        data: [products.inStock, products.lowStock, products.outOfStock],
                        backgroundColor: [
                            'rgba(41, 128, 185, 0.3)',  // In Stock color
                            'rgba(211, 84, 0, 0.3)',  // Low Stock color
                            'rgba(255, 99, 132, 0.3)'   // Out of Stock color
                        ],
                        borderColor: [
                            'rgba(41, 128, 185, 1)',
                            'rgba(211, 84, 0, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1,
                        // Adjust bar thickness if necessary
                        barThickness: 100, // This controls the width of each individual bar (try adjusting this value)
                        maxBarThickness: 100, // Max thickness for bars
                    }]
                };

                // Common Chart Options (For Consistency)
                const commonChartOptions = {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Product Status',
                            },
                            grid: {
                                color: '#1f2328',
                                lineWidth: 1,
                            },
                            ticks: {
                                font: {
                                    family: 'Arial',
                                    size: 14,
                                    weight: 'bold',
                                    style: 'normal',
                                },
                                color: '#1f2328',
                                maxTicksLimit: 5,
                            },
                            // Adjust the gap between bars here
                            barPercentage: 0.6,  // 0.6 adjusts width of bars
                            categoryPercentage: 0.7,  // Adjusts space between bars
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Total Quantity',
                            },
                            grid: {
                                color: '#1f2328',
                                lineWidth: 1,
                            },
                            ticks: {
                                font: {
                                    family: 'Arial',
                                    size: 14,
                                    weight: 'bold',
                                    style: 'normal',
                                },
                                color: '#1f2328',
                                maxTicksLimit: 10,
                                beginAtZero: true,
                                stepSize: 1,
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    family: 'Arial',
                                    size: 14,
                                    weight: 'bold',
                                    style: 'normal',
                                },
                                color: '#1f2328',
                            }
                        }
                    }
                };

                // Create the chart (Bar chart in this case)
                new Chart(ctx, {
                    type: 'bar',  // For Bar chart
                    data: chartData,
                    options: commonChartOptions
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
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

    document.addEventListener('DOMContentLoaded', function() {
        GetCategoryLineChart();
        GetTotalInventoryValue();
        GetMostExpensiveProducts();
        GetRecentProducts();
        GetProductStatus()
    });
</script>
