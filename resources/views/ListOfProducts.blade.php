<x-layout>
    <div class="col-md-12 main-content">
        <div class="col-md-12 content-header">
            <h3>List of Products</h3>
            <button type="button" class="btn btn-primary" id="btnAddProduct">Add Product</button>
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

<!-- Create user modal -->
<div class="modal fade" id="createProductModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Product</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="addProductCode">Product code:</label>
                        <input type="text" class="form-control" id="addProductCode" placeholder="Product code" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="addProductName">Product name:</label>
                        <input type="text" class="form-control" id="addProductName" placeholder="Product name" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addProductCategory">Product category:</label>
                        <select class="form-control" id="addProductCategory">
                            <option value="">Select an Option</option>
                            <option value="user" selected>Mobile</option>
                            <option value="admin">Laptop</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addProductQuantity">Product quantity:</label>
                        <input type="text" class="form-control" id="addProductQuantity" placeholder="Product quantity" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addProductPrice">Product price:</label>
                        <input type="text" class="form-control" id="addProductPrice" placeholder="Product price" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnSubmitCreateProduct" onclick="CreateNewProduct()">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    function LoadListOfProducts() {
        if ($.fn.DataTable.isDataTable('#productListTable')) {
            $('#productListTable').DataTable().destroy();
        }

        $('#loadProducts').empty();
    }

    function CreateNewProduct() {
        console.log('Product created');
    }

    document.getElementById('btnAddProduct').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('createProductModal'));
        modal.show();
    });

    document.addEventListener('DOMContentLoaded', function() {
        LoadListOfProducts();
    });
</script>