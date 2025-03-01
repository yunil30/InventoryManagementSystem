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
                        <th class="text-left" style="width: 15%; text-align: left;">Product Code</th>
                        <th class="text-left" style="width: 20%; text-align: left;">Product</th>
                        <th class="text-left" style="width: 15%; text-align: left;">Category</th>
                        <th class="text-left" style="width: 15%; text-align: left;">Stocks</th>
                        <th class="text-center" style="width: 15%;">Action</th>
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
                        <div class="row">
                            <div class="col-md-8">
                                <select class="form-control" id="addProductCategory">
                                    <option value="">Select an Option</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-primary" id="btnAddCategory">Add Category</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addProductQuantity">Product quantity:</label>
                        <input type="number" class="form-control" id="addProductQuantity" placeholder="Product quantity" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addProductPrice">Product price:</label>
                        <input type="number" class="form-control" id="addProductPrice" placeholder="Product price" required>
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

<!-- Create user modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Category</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="addCategory">Category</label>
                        <input type="text" class="form-control" id="addCategory" placeholder="Category" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnSubmitCreateCategory" onclick="CreateNewCategory()">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    function LoadListOfProducts() {
        $.ajax({
            url: '/GetAllProducts',
            method: 'GET',
            success: function(products) {
                console.table(products);

                if ($.fn.DataTable.isDataTable('#productListTable')) {
                    $('#productListTable').DataTable().destroy();
                }

                $('#loadProducts').empty();

                products.forEach(function(row, index) {
                    if (row.product_status === 1) { 
                        $('#loadProducts').append(`
                            <tr>
                                <td style="vertical-align: middle; text-align: left;">${row.ProductID}</td>
                                <td style="vertical-align: middle; text-align: left;">${row.product_code}</td>
                                <td style="vertical-align: middle; text-align: left;">${row.product_name}</td>
                                <td style="vertical-align: middle; text-align: left;">${row.product_category}</td>    
                                <td style="vertical-align: middle; text-align: left;">${row.product_stock}</td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <button class="btn btn-transparent"><span class="fas fa-eye"></span></button>
                                    <button class="btn btn-transparent"><span class="fas fa-pencil"></span></button>
                                    <button class="btn btn-transparent"><span class="fas fa-trash"></span></button>
                                </td>
                            </tr>
                        `);
                    }
                });

                $('#productListTable').DataTable({
                    searching: true,
                    pageLength: 7,
                    lengthChange: false,
                    ordering: true,
                    columnDefs: [
                        { type: 'num', targets: 0 }
                    ]
                });
            },
            error: function() {
                console.error('Error fetching product record.');
            }
        });
    }

    function CreateNewProduct() {
        const submit = document.getElementById('btnSubmitCreateProduct');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const productCode = document.getElementById('addProductCode').value;
        const productName = document.getElementById('addProductName').value;
        const productCategory = document.getElementById('addProductCategory').value;
        const productQuantity = document.getElementById('addProductQuantity').value;
        const productPrice = document.getElementById('addProductPrice').value;

        submit.disabled = true;
        
        $.ajax({
            url: `/CreateProductRecord`,
            method: 'POST',
            data: {
                _token: csrfToken,
                product_code: productCode,
                product_name: productName,
                product_category: productCategory,
                product_stock: productQuantity,
                product_price: productPrice,
            },
            success: function(response) {
                console.log('Product record created successfully', response);
                window.location.reload();
                submit.disabled = false;
            },
            error: function(error) {
                console.log('Error creating product record', error);
            }
        });
    }

    function CreateNewCategory() {
        const submit = document.getElementById('btnSubmitCreateCategory');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const categoryDescription = document.getElementById('addCategory').value;

        submit.disabled = true;
        
        $.ajax({
            url: `/CreateProductCategory`,
            method: 'POST',
            data: {
                _token: csrfToken,
                category: categoryDescription,
            },
            success: function(response) {
                console.log('Product category created successfully', response);
                window.location.reload();
                submit.disabled = false;
            },
            error: function(error) {
                console.log('Error creating product category', error);
            }
        });
    }

    function GetAllProductCategory() {
        const selectProductCategory = document.getElementById('addProductCategory');
        selectProductCategory.innerHTML = '';

        $.ajax({
            url: `/GetAllProductCategory`,
            method: 'GET',
            success: function(response) {
                response.forEach(function(row) {
                    const option = document.createElement("option");
                    option.value = row.CategoryID;
                    option.textContent = row.category;

                    selectProductCategory.appendChild(option);
                });
            },
            error: function(error) {
                console.log('Error fetching product category', error);
            }
        });
    }

    document.getElementById('btnAddProduct').addEventListener('click', function() {
        const productModalElement = document.getElementById('createProductModal');
        const productModal = new bootstrap.Modal(productModalElement);
        productModal.show();
        GetAllProductCategory();

        document.getElementById('btnAddCategory').addEventListener('click', function() {
            productModal.hide();

            const existingBackdrop = document.querySelector('.modal-backdrop');
            if (existingBackdrop) {
                existingBackdrop.remove(); 
            }

            const categoryModalElement = document.getElementById('createCategoryModal');
            const categoryModal = new bootstrap.Modal(categoryModalElement);
            categoryModal.show();
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        LoadListOfProducts();
    });
</script>