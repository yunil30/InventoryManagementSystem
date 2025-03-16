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

<!-- Create product modal -->
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
                <button type="button" class="btn danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn success" id="btnSubmitCreateProduct" onclick="CreateNewProduct()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Show product modal -->
<div class="modal fade" id="showProductModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titleProductModal">Edit Product</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="showProductCode">Product code:</label>
                        <input type="text" class="form-control" id="showProductCode" placeholder="Product code" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="showProductName">Product name:</label>
                        <input type="text" class="form-control" id="showProductName" placeholder="Product name" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="showProductCategory">Product category:</label>
                        <div class="row">
                            <div class="col-md-8">
                                <select class="form-control" id="showProductCategory">
                                    <option value="">Select an Option</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-primary" id="btnShowAddCategory">Add Category</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="showProductQuantity">Product quantity:</label>
                        <input type="number" class="form-control" id="showProductQuantity" placeholder="Product quantity" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="showProductPrice">Product price:</label>
                        <input type="number" class="form-control" id="showProductPrice" placeholder="Product price" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn success" id="btnSubmitEditProduct">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Remove product modal -->
<div class="modal fade" id="removeProductModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 400px; width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Action Verification</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="col-md-12 mb-3 p-0">
                    <label>Are you sure you want to remove this product?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn success" id="btnConfirmRemoveProduct">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Create category modal -->
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
                <button type="button" class="btn danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn success" id="btnSubmitCreateCategory" onclick="CreateProductCategory()">Submit</button>
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
                                <td style="vertical-align: middle; text-align: left;">${row.category_name}</td>    
                                <td style="vertical-align: middle; text-align: left;">${row.product_quantity}</td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div style="display: flex; justify-content: space-evenly; align-items: center; width: 100%;">
                                        <button class="btn btn-transparent" id="btnShowProduct${row.ProductID}" onclick="ShowProductModal(${row.ProductID}, 'Show')"><span class="fas fa-eye"></span></button>
                                        <button class="btn btn-transparent" id="btnEditProduct${row.ProductID}" onclick="ShowProductModal(${row.ProductID}, 'Edit')"><span class="fas fa-pencil"></span></button>
                                        <button class="btn btn-transparent" id="btnRemoveProduct${row.ProductID}" onclick="ShowRemoveProductModal(${row.ProductID})"><span class="fas fa-trash"></span></button>
                                    </div>
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
                product_quantity: productQuantity,
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

    function EditProductRecord(ProductNo) {
        const submit = document.getElementById('btnSubmitEditProduct');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const productCode = document.getElementById('showProductCode').value;
        const productName = document.getElementById('showProductName').value;
        const productCategory = document.getElementById('showProductCategory').value;
        const productQuantity = document.getElementById('showProductQuantity').value;
        const productPrice = document.getElementById('showProductPrice').value;

        submit.disabled = true;

        $.ajax({
            url: `/EditProductRecord`,
            method: 'POST',
            data: {
                _token: csrfToken,
                product_code: productCode,
                product_name: productName,
                product_category: productCategory,
                product_quantity: productQuantity,
                product_price: productPrice,
                ProductNo: ProductNo,
            },
            success: function(response) {
                console.log('Product record edited successfully', response);
                window.location.reload();
                submit.disabled = false;
            },
            error: function(error) {
                console.log('Error editing product record', error);
            }
        });
    }

    function RemoveProductRecord(ProductNo) {
        const submit = document.getElementById('btnConfirmRemoveProduct');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        submit.disabled = true;

        $.ajax({
            url: `/RemoveProductRecord`,
            method: 'POST',
            data: {
                _token: csrfToken,
                ProductNo: ProductNo,
            },
            success: function(response) {
                console.log('Product record removed successfully', response);
                window.location.reload();
                submit.disabled = false;
            },
            error: function(error) {
                console.log('Error removing product record', error);
            }
        });
    }

    function CreateProductCategory() {
        const submit = document.getElementById('btnSubmitCreateCategory');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const productCategory = document.getElementById('addCategory').value;

        submit.disabled = true;
        
        $.ajax({
            url: `/CreateProductCategory`,
            method: 'POST',
            data: {
                _token: csrfToken,
                category: productCategory,
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

    function ShowProductModal(ProductNo, Mode) {
        const modalTitle = document.getElementById('titleProductModal');
        const ProductCode = document.getElementById('showProductCode');
        const ProductName = document.getElementById('showProductName');
        const productCategory = document.getElementById('showProductCategory');
        const productQuantity = document.getElementById('showProductQuantity');
        const productPrice = document.getElementById('showProductPrice');
        
        const btnSubmit = document.getElementById('btnSubmitEditProduct');
        const modal = new bootstrap.Modal(document.getElementById('showProductModal'));
        const btnCategoryModal = document.getElementById('btnShowAddCategory');
        const categoryModal = new bootstrap.Modal(document.getElementById('createCategoryModal'));
        GetAllProductCategory('showProductCategory');
        GetProductRecord(ProductNo);

        btnCategoryModal.addEventListener('click', function() {
            modal.hide();

            const existingBackdrop = document.querySelector('.modal-backdrop');
            if (existingBackdrop) {
                existingBackdrop.remove(); 
            }

            categoryModal.show();
        });

        if (Mode == 'Show') {
            btnSubmit.style.display = 'none'; 
            modalTitle.innerText = 'Product';
            ProductCode.disabled = true;
            ProductName.disabled = true;
            productCategory.disabled = true;
            productQuantity.disabled = true;
            productPrice.disabled = true;
            modal.show();
        } else {
            btnSubmit.style.display = ''; 
            modalTitle.innerText = 'Edit Product';
            ProductCode.disabled = false;
            ProductName.disabled = false;
            productCategory.disabled = false;
            productQuantity.disabled = false;
            productPrice.disabled = false;
            modal.show();
            btnSubmit.setAttribute('onclick', `EditProductRecord(${ProductNo})`);
        }
    }

    function ShowRemoveProductModal(ProductNo) {
        const confirmRemoveButton = document.getElementById('btnConfirmRemoveProduct');
        const modal = new bootstrap.Modal(document.getElementById('removeProductModal'));

        modal.show();

        confirmRemoveButton.setAttribute('onclick', `RemoveProductRecord(${ProductNo})`);
    }

    function GetProductRecord(ProductNo) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const ProductCode = document.getElementById('showProductCode');
        const ProductName = document.getElementById('showProductName');
        const productCategory = document.getElementById('showProductCategory');
        const productQuantity = document.getElementById('showProductQuantity');
        const productPrice = document.getElementById('showProductPrice');

        $.ajax({
            url: `/GetProductRecord`,
            method: 'GET',
            data: {
                _token: csrfToken,
                ProductNo: ProductNo,
            },
            success: function(response) {
                ProductCode.value = response.product_code;
                ProductName.value = response.product_name;
                productCategory.value = response.product_category;
                productQuantity.value = response.product_quantity;
                productPrice.value = response.product_price;
            },
            error: function(error) {
                console.error('Failed to get the product record!', error);
            }
        });
    }

    function GetAllProductCategory(elem) {
        const selectProductCategory = document.getElementById(elem);
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
        GetAllProductCategory('addProductCategory');

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