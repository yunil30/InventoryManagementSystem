<x-layout>
    <div class="col-md-12 main-content">
        <div class="col-md-12 content-header">
            <h3>List of Items</h3>
            @can('create-item-record')
                <button type="button" class="btn btn-primary" id="btnAddItem" onclick="ShowCreateItemModal()">Add Item</button>
            @endcan
        </div>
        <div class="col-md-12 content-body">
            <table class="table table-hover table-bordered" id="itemListTable">
                <thead>
                    <tr>
                        <th class="text-left" style="width: 15%; text-align: left;">ItemNo.</th>
                        <th class="text-left" style="width: 15%; text-align: left;">Item Code</th>
                        <th class="text-left" style="width: 20%; text-align: left;">Item</th>
                        <th class="text-left" style="width: 15%; text-align: left;">Category</th>
                        <th class="text-left" style="width: 15%; text-align: left;">Stocks</th>
                        <th class="text-center" style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody id="loadItems"></tbody>
            </table> 
        </div>
    </div>
</x-layout>

<!-- Create item modal -->
<div class="modal fade" id="createItemModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Item</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="addItemCode">Item code:</label>
                        <input type="text" class="form-control" id="addItemCode" placeholder="Item code" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="addItemName">Item name:</label>
                        <input type="text" class="form-control" id="addItemName" placeholder="Item name" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addItemCategory">Item category:</label>
                        <div class="row">
                            <div class="col-md-8">
                                <select class="form-control" id="addItemCategory">
                                    <option value="">Select an Option</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-primary" id="btnAddCategory">Add Category</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addItemQuantity">Item quantity:</label>
                        <input type="number" class="form-control" id="addItemQuantity" placeholder="Item quantity" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addItemPrice">Item price:</label>
                        <input type="number" class="form-control" id="addItemPrice" placeholder="Item price" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn success" id="btnSubmitCreateItem" onclick="CreateNewItem()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Show item modal -->
<div class="modal fade" id="showItemModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titleItemModal">Edit Item</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="showItemCode">Item code:</label>
                        <input type="text" class="form-control" id="showItemCode" placeholder="Item code" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="showItemName">Item name:</label>
                        <input type="text" class="form-control" id="showItemName" placeholder="Item name" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="showItemCategory">Item category:</label>
                        <div class="row">
                            <div class="col-md-8">
                                <select class="form-control" id="showItemCategory">
                                    <option value="">Select an Option</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-primary" id="btnShowAddCategory">Add Category</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="showItemQuantity">Item quantity:</label>
                        <input type="number" class="form-control" id="showItemQuantity" placeholder="Item quantity" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="showItemPrice">Item price:</label>
                        <input type="number" class="form-control" id="showItemPrice" placeholder="Item price" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn success" id="btnSubmitEditItem">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Remove item modal -->
<div class="modal fade" id="removeItemModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 400px; width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Action Verification</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="col-md-12 mb-3 p-0">
                    <label>Are you sure you want to remove this item?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn success" id="btnConfirmRemoveItem">Confirm</button>
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
                <button type="button" class="btn success" id="btnSubmitCreateCategory" onclick="CreateItemCategory()">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    var canEditItemRecord = @json(auth()->user()->can('edit-item-record'));
    var canRemoveItemRecord = @json(auth()->user()->can('remove-item-record'));

    function LoadListOfItems() {
        $.ajax({
            url: '/GetAllItems',
            method: 'GET',
            success: function(items) {
                console.table(items);

                if ($.fn.DataTable.isDataTable('#itemListTable')) {
                    $('#itemListTable').DataTable().destroy();
                }

                $('#loadItems').empty();

                items.forEach(function(row, index) {
                    if (row.item_status === 1) { 
                        $('#loadItems').append(`
                            <tr>
                                <td style="vertical-align: middle; text-align: left;">${row.ItemID}</td>
                                <td style="vertical-align: middle; text-align: left;">${row.item_code}</td>
                                <td style="vertical-align: middle; text-align: left;">${row.item_name}</td>
                                <td style="vertical-align: middle; text-align: left;">${row.category_name}</td>    
                                <td style="vertical-align: middle; text-align: left;">${row.item_quantity}</td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div style="display: flex; justify-content: space-evenly; align-items: center; width: 100%;">
                                        <button class="btn btn-transparent" id="btnShowItem${row.ItemID}" onclick="ShowItemModal(${row.ItemID}, 'Show')"><span class="fas fa-eye"></span></button>
                                        ${canEditItemRecord ? `<button class="btn btn-transparent" id="btnEditItem${row.ItemID}" onclick="ShowItemModal(${row.ItemID}, 'Edit')"><span class="fas fa-pencil"></span></button>` : ''}
                                        ${canRemoveItemRecord ? `<button class="btn btn-transparent" id="btnRemoveItem${row.ItemID}" onclick="ShowRemoveItemModal(${row.ItemID})"><span class="fas fa-trash"></span></button>` : ''}
                                    </div>
                                </td>
                            </tr>
                        `);
                    }
                });

                $('#itemListTable').DataTable({
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
                console.error('Error fetching item record.');
            }
        });
    }

    function CreateNewItem() {
        const submit = document.getElementById('btnSubmitCreateItem');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const itemCode = document.getElementById('addItemCode').value;
        const itemName = document.getElementById('addItemName').value;
        const itemCategory = document.getElementById('addItemCategory').value;
        const itemQuantity = document.getElementById('addItemQuantity').value;
        const itemPrice = document.getElementById('addItemPrice').value;

        submit.disabled = true;
        
        $.ajax({
            url: `/CreateItemRecord`,
            method: 'POST',
            data: {
                _token: csrfToken,
                item_code: itemCode,
                item_name: itemName,
                item_category: itemCategory,
                item_quantity: itemQuantity,
                item_price: itemPrice,
            },
            success: function(response) {
                console.log('Item record created successfully', response);
                window.location.reload();
                submit.disabled = false;
            },
            error: function(error) {
                console.log('Error creating item record', error);
            }
        });
    }

    function EditItemRecord(ItemNo) {
        const submit = document.getElementById('btnSubmitEditItem');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const itemCode = document.getElementById('showItemCode').value;
        const itemName = document.getElementById('showItemName').value;
        const itemCategory = document.getElementById('showItemCategory').value;
        const itemQuantity = document.getElementById('showItemQuantity').value;
        const itemPrice = document.getElementById('showItemPrice').value;

        submit.disabled = true;

        $.ajax({
            url: `/EditItemRecord`,
            method: 'POST',
            data: {
                _token: csrfToken,
                item_code: itemCode,
                item_name: itemName,
                item_category: itemCategory,
                item_quantity: itemQuantity,
                item_price: itemPrice,
                ItemNo: ItemNo,
            },
            success: function(response) {
                console.log('Item record edited successfully', response);
                window.location.reload();
                submit.disabled = false;
            },
            error: function(error) {
                console.log('Error editing item record', error);
            }
        });
    }

    function RemoveItemRecord(ItemNo) {
        const submit = document.getElementById('btnConfirmRemoveItem');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        submit.disabled = true;

        $.ajax({
            url: `/RemoveItemRecord`,
            method: 'POST',
            data: {
                _token: csrfToken,
                ItemNo: ItemNo,
            },
            success: function(response) {
                console.log('Item record removed successfully', response);
                window.location.reload();
                submit.disabled = false;
            },
            error: function(error) {
                console.log('Error removing item record', error);
            }
        });
    }

    function CreateItemCategory() {
        const submit = document.getElementById('btnSubmitCreateCategory');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const itemCategory = document.getElementById('addCategory').value;

        submit.disabled = true;
        
        $.ajax({
            url: `/CreateItemCategory`,
            method: 'POST',
            data: {
                _token: csrfToken,
                category: itemCategory,
            },
            success: function(response) {
                console.log('Item category created successfully', response);
                window.location.reload();
                submit.disabled = false;
            },
            error: function(error) {
                console.log('Error creating item category', error);
            }
        });
    }

    function ShowCreateItemModal() {
        const itemModalElement = document.getElementById('createItemModal');
        const itemModal = new bootstrap.Modal(itemModalElement);
        itemModal.show();
        GetAllItemCategory('addItemCategory');

        document.getElementById('btnAddCategory').addEventListener('click', function() {
            itemModal.hide();

            const existingBackdrop = document.querySelector('.modal-backdrop');
            if (existingBackdrop) {
                existingBackdrop.remove(); 
            }

            const categoryModalElement = document.getElementById('createCategoryModal');
            const categoryModal = new bootstrap.Modal(categoryModalElement);
            categoryModal.show();
        });
    }

    function ShowItemModal(ItemNo, Mode) {
        const modalTitle = document.getElementById('titleItemModal');
        const ItemCode = document.getElementById('showItemCode');
        const ItemName = document.getElementById('showItemName');
        const itemCategory = document.getElementById('showItemCategory');
        const itemQuantity = document.getElementById('showItemQuantity');
        const itemPrice = document.getElementById('showItemPrice');
        
        const btnSubmit = document.getElementById('btnSubmitEditItem');
        const modal = new bootstrap.Modal(document.getElementById('showItemModal'));
        const btnCategoryModal = document.getElementById('btnShowAddCategory');
        const categoryModal = new bootstrap.Modal(document.getElementById('createCategoryModal'));
        GetAllItemCategory('showItemCategory');
        GetItemRecord(ItemNo);

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
            modalTitle.innerText = 'Item';
            ItemCode.disabled = true;
            ItemName.disabled = true;
            itemCategory.disabled = true;
            itemQuantity.disabled = true;
            itemPrice.disabled = true;
            modal.show();
        } else {
            btnSubmit.style.display = ''; 
            modalTitle.innerText = 'Edit Item';
            ItemCode.disabled = false;
            ItemName.disabled = false;
            itemCategory.disabled = false;
            itemQuantity.disabled = false;
            itemPrice.disabled = false;
            modal.show();
            btnSubmit.setAttribute('onclick', `EditItemRecord(${ItemNo})`);
        }
    }

    function ShowRemoveItemModal(ItemNo) {
        const confirmRemoveButton = document.getElementById('btnConfirmRemoveItem');
        const modal = new bootstrap.Modal(document.getElementById('removeItemModal'));

        modal.show();

        confirmRemoveButton.setAttribute('onclick', `RemoveItemRecord(${ItemNo})`);
    }

    function GetItemRecord(ItemNo) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const ItemCode = document.getElementById('showItemCode');
        const ItemName = document.getElementById('showItemName');
        const itemCategory = document.getElementById('showItemCategory');
        const itemQuantity = document.getElementById('showItemQuantity');
        const itemPrice = document.getElementById('showItemPrice');

        $.ajax({
            url: `/GetItemRecord`,
            method: 'GET',
            data: {
                _token: csrfToken,
                ItemNo: ItemNo,
            },
            success: function(response) {
                ItemCode.value = response.item_code;
                ItemName.value = response.item_name;
                itemCategory.value = response.item_category;
                itemQuantity.value = response.item_quantity;
                itemPrice.value = response.item_price;
            },
            error: function(error) {
                console.error('Failed to get the item record!', error);
            }
        });
    }

    function GetAllItemCategory(elem) {
        const selectItemCategory = document.getElementById(elem);
        selectItemCategory.innerHTML = '';

        $.ajax({
            url: `/GetAllItemCategory`,
            method: 'GET',
            success: function(response) {
                response.forEach(function(row) {
                    const option = document.createElement("option");
                    option.value = row.CategoryID;
                    option.textContent = row.category;

                    selectItemCategory.appendChild(option);
                });
            },
            error: function(error) {
                console.log('Error fetching item category', error);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        LoadListOfItems();
    });
</script>