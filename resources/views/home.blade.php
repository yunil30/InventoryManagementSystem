<x-layout>
    <style>
        .ItemListingDiv {
            display: flex; 
            justify-content: space-between;
            padding-bottom: 2rem;

            .RecentlyAddedItemsDiv,
            .MostExpensiveItemsDiv {
                background-color: #ffffff;
                padding: 1rem;
                margin: 0rem;
                
                #expensiveItemsTable,
                #recentlyAddedTable {
                    border: 1px solid #ffffff;

                    th {
                        background-color: #0d6Efd;
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

        .ItemDiv {
            display: flex; 
            justify-content: space-between;
            padding-bottom: 2rem;

            .ItemQuantityDiv {
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

            .ItemStatusDiv{
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
                <div class="row ItemListingDiv">
                    <div class="col-md-5 MostExpensiveItemsDiv">
                        <h5>Most Expensive Items</h5>
                        <table class="table table-hover table-bordered" id="expensiveItemsTable">
                            <thead>
                                <tr>
                                    <th class="text-left" style="width: 20%; text-align: left;">No.</th>
                                    <th class="text-left" style="width: 40%; text-align: left;">Item name</th>
                                    <th class="text-left" style="width: 40%; text-align: left;">Item price</th>
                                </tr>
                            </thead>
                            <tbody id="loadExpensiveItems"></tbody>
                        </table> 
                    </div>

                    <div class="col-md-5 RecentlyAddedItemsDiv">
                        <h5>Recently Added Items</h5>
                        <table class="table table-hover table-bordered" id="recentlyAddedTable">
                            <thead>
                                <tr>
                                    <th class="text-left" style="width: 20%; text-align: left;">No.</th>
                                    <th class="text-left" style="width: 40%; text-align: left;">Item name</th>
                                    <th class="text-left" style="width: 40%; text-align: left;">Date Added</th>
                                </tr>
                            </thead>
                            <tbody id="loadRecentlyAdded"></tbody>
                        </table> 
                    </div>
                </div>
            </div>

            <div class="col-md-12 ItemDiv">
                <div class="col-md-5 ItemQuantityDiv">
                    <div class="col-md-12">
                        <div class="row">
                            <h5>Item Quantity by Category</h5>
                            <canvas id="ItemQuantityChart"></canvas>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-5 ItemStatusDiv">
                    <div class="col-md-12">
                        <div class="row">
                            <h5>Item Status</h5>
                            <canvas id="ItemStatusChart"></canvas>
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
        var ItemQuantityChartCtx = document.getElementById('ItemQuantityChart').getContext('2d');
        var ItemQuantityChart;

        $.ajax({
            url: `/GetItemQuantityByCategory`,
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
                        label: 'Item Quantity',
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
                                text: 'Item Category',
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
              
                ItemQuantityChart = new Chart(ItemQuantityChartCtx, {
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

    function GetItemStatus() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            url: '/GetItemStatus',
            method: 'GET',
            data: {
                _token: csrfToken,  // CSRF Token for security
            },
            success: function(items) {
                console.table(items); // Log items for debugging

                var ctx = document.getElementById('ItemStatusChart').getContext('2d');

                const chartData = {
                    labels: ['In Stock', 'Low Stock', 'Out of Stock'],
                    datasets: [{
                        label: 'Item Status Quantities',
                        data: [items.inStock, items.lowStock, items.outOfStock],
                        backgroundColor: [
                            'rgba(41, 128, 185, 0.3)',  // In Stock color
                            'rgba(211, 84, 0, 0.3)',  // Low Stock color
                            'rgba(255, 99, 132, 0.3)'   // Out of Stock color
                        ],
                        borderColor: [
                            'rgba(13, 110, 253)',
                            'rgba(211, 84, 0)',
                            'rgba(255, 99, 132)'
                        ],
                        borderWidth: 2,
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
                                text: 'Item Status',
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

    function GetMostExpensiveItems() {
        $.ajax({
            url: `/GetMostExpensiveItems`, 
            method: 'GET',
            success: function(items) { 
                items.forEach(function(row, index) {
                    const formattedPrice = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'PHP' }).format(row.item_price);

                    $('#loadExpensiveItems').append(`
                        <tr>
                            <td style="vertical-align: middle; text-align: left;">${index + 1}</td>
                            <td style="vertical-align: middle; text-align: left;">${row.item_name}</td>
                            <td style="vertical-align: middle; text-align: left;">${formattedPrice}</td>
                        </tr>
                    `);
                });
            }
        });
    }

    function GetRecentItems() {
        $.ajax({
            url: `/GetRecentItems`, 
            method: 'GET',
            success: function(items) { 
                items.forEach(function(row, index) {
                    const formattedDate = new Date(row.date_created).toLocaleDateString('en-US', {month:'short', day:'numeric', year:'numeric'});

                    $('#loadRecentlyAdded').append(`
                        <tr>
                            <td style="vertical-align: middle; text-align: left;">${index + 1}</td>
                            <td style="vertical-align: middle; text-align: left;">${row.item_name}</td>
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
        GetMostExpensiveItems();
        GetRecentItems();
        GetItemStatus()
    });
</script>
