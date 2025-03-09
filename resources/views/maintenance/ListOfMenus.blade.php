<x-layout>
    <div class="col-md-12 main-content">
        <div class="col-md-12 content-header">
            <h3>List of Menus</h3>
            <button type="button" class="btn btn-primary" id="btnAddMenu">Add Menu</button>
        </div>
        <div class="col-md-12 content-body">
            <table class="table table-hover table-bordered" id="menutListTable">
                <thead>
                    <tr>
                        <th class="text-left" style="width: 15%; text-align: left;">MenuNo.</th>
                        <th class="text-left" style="width: 30%; text-align: left;">Menu name</th>
                        <th class="text-left" style="width: 30%; text-align: left;">Menu type</th>
                        <th class="text-center" style="width: 25%;">Action</th>
                    </tr>
                </thead>
                <tbody id="loadMenus"></tbody>
            </table> 
        </div>
    </div>
</x-layout>

<!-- Create menu modal -->
<div class="modal fade" id="createMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Menu</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="addMenuName">Menu name:</label>
                        <input type="text" class="form-control" id="addMenuName" placeholder="Menu name" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addMenuPage">Menu Page:</label>
                        <input type="text" class="form-control" id="addMenuPage" placeholder="Menu page" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addMenuType">Menu type:</label>
                        <select class="form-control" id="addMenuType">
                            <option value="">Select an Option</option>
                            <option value="parent">parent</option>
                            <option value="child">child</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="addParentMenu">Parent Menu:</label>
                        <input type="number" class="form-control" id="addParentMenu" placeholder="Parent menu" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="addMenuIndex">Menu Index:</label>
                        <input type="number" class="form-control" id="addMenuIndex" placeholder="Menu index" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnSubmitCreateMenu" onclick="CreateNewMenu()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Show menu modal -->
<div class="modal fade" id="showMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                <button type="button" class="btn btn-danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnSubmitEditProduct">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Remove menu modal -->
<div class="modal fade" id="removeMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 400px; width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Action Verification</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="col-md-12 mb-3 p-0">
                    <label>Are you sure you want to remove this menu?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnConfirmRemoveMenu">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>
    function GetListOfMenus() {
        $.ajax({
            url: '/GetAllMenus',
            method: 'GET',
            success: function(menus) {
                console.table(menus);

                if ($.fn.DataTable.isDataTable('#menutListTable')) {
                    $('#menutListTable').DataTable().destroy();
                }

                $('#loadMenus').empty();

                menus.forEach(function(row, index) {
                    if (row.menu_status === 1) {
                        $('#loadMenus').append(`
                            <tr>
                                <td style="vertical-align: middle; text-align: left;">${row.MenuID}</td>
                                <td style="vertical-align: middle; text-align: left;">${row.menu_name}</td>
                                <td style="vertical-align: middle; text-align: left;">${row.menu_type}</td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div style="display: flex; justify-content: space-evenly; align-items: center; width: 100%;">
                                        <button class="btn btn-transparent" id="btnShowMenu${row.MenuID}" onclick="ShowMenuModal(${row.MenuID}, 'Show')"><span class="fas fa-eye"></span></button>
                                        <button class="btn btn-transparent" id="btnEditMenu${row.MenuID}" onclick="ShowMenuModal(${row.MenuID}, 'Edit')"><span class="fas fa-pencil"></span></button>
                                        <button class="btn btn-transparent" id="btnRemoveMenu${row.MenuID}" onclick="ShowRemoveMenuModal(${row.MenuID})"><span class="fas fa-trash"></span></button>
                                    </div>
                                </td>
                            </tr>
                        `);
                    }
                });

                $('#menutListTable').DataTable({
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

    function CreateNewMenu() {
        // const submit = document.getElementById('btnSubmitCreateProduct');
        // const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // const productCode = document.getElementById('addProductCode').value;
        // const productName = document.getElementById('addProductName').value;

        // submit.disabled = true;
        
        // $.ajax({
        //     url: `/CreateProductRecord`,
        //     method: 'POST',
        //     data: {
        //         _token: csrfToken,
        //         product_code: productCode,
        //         product_name: productName,
        //         product_category: productCategory,
        //         product_quantity: productQuantity,
        //         product_price: productPrice,
        //     },
        //     success: function(response) {
        //         console.log('Product record created successfully', response);
        //         window.location.reload();
        //         submit.disabled = false;
        //     },
        //     error: function(error) {
        //         console.log('Error creating product record', error);
        //     }
        // });
    }

    // function EditProductRecord(ProductNo) {
    //     const submit = document.getElementById('btnSubmitEditProduct');
    //     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    //     const productCode = document.getElementById('showProductCode').value;
    //     const productName = document.getElementById('showProductName').value;
    //     const productCategory = document.getElementById('showProductCategory').value;
    //     const productQuantity = document.getElementById('showProductQuantity').value;
    //     const productPrice = document.getElementById('showProductPrice').value;

    //     submit.disabled = true;

    //     $.ajax({
    //         url: `/EditProductRecord`,
    //         method: 'POST',
    //         data: {
    //             _token: csrfToken,
    //             product_code: productCode,
    //             product_name: productName,
    //             product_category: productCategory,
    //             product_quantity: productQuantity,
    //             product_price: productPrice,
    //             ProductNo: ProductNo,
    //         },
    //         success: function(response) {
    //             console.log('Product record edited successfully', response);
    //             window.location.reload();
    //             submit.disabled = false;
    //         },
    //         error: function(error) {
    //             console.log('Error editing product record', error);
    //         }
    //     });
    // }

    function RemoveMenuRecord(MenuNo) {
        const submit = document.getElementById('btnConfirmRemoveMenu');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        submit.disabled = true;

        $.ajax({
            url: `/RemoveMenuRecord`,
            method: 'POST',
            data: {
                _token: csrfToken,
                MenuNo: MenuNo,
            },
            success: function(response) {
                console.log('Menu record removed successfully', response);
                window.location.reload();
                submit.disabled = false;
            },
            error: function(error) {
                console.log('Error removing menu record', error);
            }
        });
    }

    // function ShowProductModal(ProductNo, Mode) {
    //     const modalTitle = document.getElementById('titleProductModal');
    //     const ProductCode = document.getElementById('showProductCode');
    //     const ProductName = document.getElementById('showProductName');
    //     const productCategory = document.getElementById('showProductCategory');
    //     const productQuantity = document.getElementById('showProductQuantity');
    //     const productPrice = document.getElementById('showProductPrice');
        
    //     const btnSubmit = document.getElementById('btnSubmitEditProduct');
    //     const modal = new bootstrap.Modal(document.getElementById('showProductModal'));
    //     const btnCategoryModal = document.getElementById('btnShowAddCategory');
    //     const categoryModal = new bootstrap.Modal(document.getElementById('createCategoryModal'));
    //     GetAllProductCategory('showProductCategory');
    //     GetProductRecord(ProductNo);

    //     btnCategoryModal.addEventListener('click', function() {
    //         modal.hide();

    //         const existingBackdrop = document.querySelector('.modal-backdrop');
    //         if (existingBackdrop) {
    //             existingBackdrop.remove(); 
    //         }

    //         categoryModal.show();
    //     });

    //     if (Mode == 'Show') {
    //         btnSubmit.style.display = 'none'; 
    //         modalTitle.innerText = 'Product';
    //         ProductCode.disabled = true;
    //         ProductName.disabled = true;
    //         productCategory.disabled = true;
    //         productQuantity.disabled = true;
    //         productPrice.disabled = true;
    //         modal.show();
    //     } else {
    //         btnSubmit.style.display = ''; 
    //         modalTitle.innerText = 'Edit Product';
    //         ProductCode.disabled = false;
    //         ProductName.disabled = false;
    //         productCategory.disabled = false;
    //         productQuantity.disabled = false;
    //         productPrice.disabled = false;
    //         modal.show();
    //         btnSubmit.setAttribute('onclick', `EditProductRecord(${ProductNo})`);
    //     }
    // }

    function ShowRemoveMenuModal(MenuNo) {
        const confirmRemoveButton = document.getElementById('btnConfirmRemoveMenu');
        const modal = new bootstrap.Modal(document.getElementById('removeMenuModal'));

        modal.show();

        confirmRemoveButton.setAttribute('onclick', `RemoveMenuRecord(${MenuNo})`);
    }

    // function GetProductRecord(ProductNo) {
    //     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    //     const ProductCode = document.getElementById('showProductCode');
    //     const ProductName = document.getElementById('showProductName');
    //     const productCategory = document.getElementById('showProductCategory');
    //     const productQuantity = document.getElementById('showProductQuantity');
    //     const productPrice = document.getElementById('showProductPrice');

    //     $.ajax({
    //         url: `/GetProductRecord`,
    //         method: 'GET',
    //         data: {
    //             _token: csrfToken,
    //             ProductNo: ProductNo,
    //         },
    //         success: function(response) {
    //             ProductCode.value = response.product_code;
    //             ProductName.value = response.product_name;
    //             productCategory.value = response.product_category;
    //             productQuantity.value = response.product_quantity;
    //             productPrice.value = response.product_price;
    //         },
    //         error: function(error) {
    //             console.error('Failed to get the product record!', error);
    //         }
    //     });
    // }

    // function GetAllProductCategory(elem) {
    //     const selectProductCategory = document.getElementById(elem);
    //     selectProductCategory.innerHTML = '';

    //     $.ajax({
    //         url: `/GetAllProductCategory`,
    //         method: 'GET',
    //         success: function(response) {
    //             response.forEach(function(row) {
    //                 const option = document.createElement("option");
    //                 option.value = row.CategoryID;
    //                 option.textContent = row.category;

    //                 selectProductCategory.appendChild(option);
    //             });
    //         },
    //         error: function(error) {
    //             console.log('Error fetching product category', error);
    //         }
    //     });
    // }

    document.getElementById('btnAddMenu').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('createMenuModal'));
        modal.show();
    });

    document.addEventListener('DOMContentLoaded', function() {
        GetListOfMenus();
    });
</script>