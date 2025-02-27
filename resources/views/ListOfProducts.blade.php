<x-layout>
    <div class="col-md-12 main-content">
        <div class="col-md-12 content-header">
            <h3>List of Products</h3>
            <button type="button" class="btn btn-primary">Add Product</button>
        </div>
        <div class="col-md-12 content-body">
            <table class="table table-hover table-bordered" id="productListTable">
                <thead>
                    <tr>
                        <th class="text-left" style="width: 15%; text-align: left;">ProductNo.</th>
                        <th class="text-left" style="width: 15%;">Product Code</th>
                        <th class="text-left" style="width: 15%;">Product</th>
                        <th class="text-left" style="width: 15%;">Category</th>
                        <th class="text-left" style="width: 15%;">Stocks</th>
                        <th class="text-center" style="width: 20%;">Action</th>
                    </tr>
                </thead>
                <tbody id="loadProducts"></tbody>
            </table>    
        </div>
    </div>
</x-layout>

<script>
    function LoadListOfProducts() {
        if ($.fn.DataTable.isDataTable('#productListTable')) {
            $('#productListTable').DataTable().destroy();
        }

        $('#loadProducts').empty();
    }

    document.addEventListener('DOMContentLoaded', function() {
        LoadListOfProducts();
    });
</script>