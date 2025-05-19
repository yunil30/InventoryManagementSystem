<x-layout>
    <div class="col-md-12 main-content">
        <div class="col-md-12 content-header">
            <h3>List of Menus</h3>
            @can('create-menu-record')
                <button type="button" class="btn btn-primary" id="btnAddMenu" onclick="ShowCreateMenuModal()">Add Menu</button>
            @endcan
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
                    <div class="col-md-6 mb-3">
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
                    <div class="col-md-6 mb-3">
                        <label for="addMenuIcon">Menu Icon:</label>
                        <input type="text" class="form-control" id="addMenuIcon" placeholder="Menu icon" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn success" id="btnSubmitCreateMenu" onclick="CreateNewMenu()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Show menu modal -->
<div class="modal fade" id="showMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titleMenuModal">Edit Menu</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="showMenuName">Menu name:</label>
                        <input type="text" class="form-control" id="showMenuName" placeholder="Menu name" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="showMenuPage">Menu Page:</label>
                        <input type="text" class="form-control" id="showMenuPage" placeholder="Menu page" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="showMenuType">Menu type:</label>
                        <select class="form-control" id="showMenuType">
                            <option value="">Select an Option</option>
                            <option value="parent">parent</option>
                            <option value="child">child</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="showParentMenu">Parent Menu:</label>
                        <input type="number" class="form-control" id="showParentMenu" placeholder="Parent menu" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="showMenuIndex">Menu Index:</label>
                        <input type="number" class="form-control" id="showMenuIndex" placeholder="Menu index" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="showMenuIcon">Menu Icon:</label>
                        <input type="text" class="form-control" id="showMenuIcon" placeholder="Menu icon" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn success" id="btnSubmitEditMenu">Submit</button>
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
                <button type="button" class="btn danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn success" id="btnConfirmRemoveMenu">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>
    var canEditMenuRecord = @json(auth()->user()->can('edit-menu-record'));
    var canRemoveMenuRecord = @json(auth()->user()->can('remove-menu-record'));

    const notyf = new Notyf({
        duration: 2000,
        ripple: true,
        position: {
            x: 'right',
            y: 'top',
        }
    });

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
                                        ${canEditMenuRecord ? `<button class="btn btn-transparent" id="btnEditMenu${row.MenuID}" onclick="ShowMenuModal(${row.MenuID}, 'Edit')"><span class="fas fa-pencil"></span></button>` : ''}
                                        ${canRemoveMenuRecord ? `<button class="btn btn-transparent" id="btnRemoveMenu${row.MenuID}" onclick="ShowRemoveMenuModal(${row.MenuID})"><span class="fas fa-trash"></span></button>` : ''}
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

    function ShowCreateMenuModal() {
        const modal = new bootstrap.Modal(document.getElementById('createMenuModal'));

        modal.show();
    }

    function ShowMenuModal(MenuID, Mode) {
        const modalTitle = document.getElementById('titleMenuModal');
        const menuName = document.getElementById('showMenuName');
        const menuPage = document.getElementById('showMenuPage');
        const menuType = document.getElementById('showMenuType');
        const parentMenu = document.getElementById('showParentMenu');
        const menuIndex = document.getElementById('showMenuIndex');
        const menuIcon = document.getElementById('showMenuIcon');
        
        const btnSubmit = document.getElementById('btnSubmitEditMenu');
        const modal = new bootstrap.Modal(document.getElementById('showMenuModal'));
        GetMenuRecord(MenuID);

        if (Mode == 'Show') {
            btnSubmit.style.display = 'none'; 
            modalTitle.innerText = 'Menu';
            menuName.disabled = true;
            menuPage.disabled = true;
            menuType.disabled = true;
            parentMenu.disabled = true;
            menuIndex.disabled = true;
            menuIcon.disabled = true;
            modal.show();
        } else {
            btnSubmit.style.display = ''; 
            modalTitle.innerText = 'Edit Menu';
            menuName.disabled = false;
            menuPage.disabled = false;
            menuType.disabled = false;
            parentMenu.disabled = false;
            menuIndex.disabled = false;
            menuIcon.disabled = false;
            modal.show();
            btnSubmit.setAttribute('onclick', `EditMenuRecord(${MenuID})`);
        }
    }

    function ShowRemoveMenuModal(MenuID) {
        const confirmRemoveButton = document.getElementById('btnConfirmRemoveMenu');
        const modal = new bootstrap.Modal(document.getElementById('removeMenuModal'));

        modal.show();

        confirmRemoveButton.setAttribute('onclick', `RemoveMenuRecord(${MenuID})`);
    }

    function CreateNewMenu() {
        const submit = document.getElementById('btnSubmitCreateMenu');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const menuName = document.getElementById('addMenuName').value;
        const menuPage = document.getElementById('addMenuPage').value;
        const menuType = document.getElementById('addMenuType').value;
        const parentMenu = document.getElementById('addParentMenu').value;
        const menuIndex = document.getElementById('addMenuIndex').value;
        const menuIcon = document.getElementById('addMenuIcon').value;

        submit.disabled = true;
        
        $.ajax({
            url: `/CreateMenuRecord`,
            method: 'POST',
            data: {
                _token: csrfToken,
                menu_name: menuName,
                menu_page: menuPage,
                menu_type: menuType,
                parent_menu: parentMenu,
                menu_index: menuIndex,
                menu_icon: menuIcon,
            },
            success: function(response) {
                notyf.success(response || 'Menu record created successfully!');
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
                submit.disabled = false;
            },
            error: function(error) {
                notyf.error(error || 'Error creating menu record!');
            }
        });
    }

    function GetMenuRecord(MenuID) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const menuName = document.getElementById('showMenuName');
        const menuPage = document.getElementById('showMenuPage');
        const menuType = document.getElementById('showMenuType');
        const parentMenu = document.getElementById('showParentMenu');
        const menuIndex = document.getElementById('showMenuIndex');
        const menuIndex = document.getElementById('showMenuIndex');
    
        $.ajax({
            url: `/GetMenuRecord`,
            method: 'GET',
            data: {
                _token: csrfToken,
                MenuID: MenuID,
            },
            success: function(response) {
                menuName.value = response.menu_name;
                menuPage.value = response.menu_page;
                menuType.value = response.menu_type;
                parentMenu.value = response.parent_menu;
                menuIndex.value = response.menu_index;
            },
            error: function(error) {
                console.error('Failed to get the menu record!', error);
            }
        });
    }

    function EditMenuRecord(MenuID) {
        const submit = document.getElementById('btnSubmitEditMenu');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const menuName = document.getElementById('showMenuName').value;
        const menuPage = document.getElementById('showMenuPage').value;
        const menuType = document.getElementById('showMenuType').value;
        const parentMenu = document.getElementById('showParentMenu').value;
        const menuIndex = document.getElementById('showMenuIndex').value;
        const menuIcon = document.getElementById('showMenuIcon').value;

        submit.disabled = true;

        $.ajax({
            url: `/EditMenuRecord`,
            method: 'POST',
            data: {
                _token: csrfToken,
                menu_name: menuName,
                menu_page: menuPage,
                menu_type: menuType,
                parent_menu: parentMenu,
                menu_index: menuIndex,
                menu_icon: menuIcon,
                MenuID: MenuID,
            },
            success: function(response) {
                notyf.success(response || 'Menu record edited successfully!');
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
                submit.disabled = false;
            },
            error: function(error) {
                notyf.error(error || 'Error editing menu record!');
            }
        });
    }

    function RemoveMenuRecord(MenuID) {
        const submit = document.getElementById('btnConfirmRemoveMenu');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        submit.disabled = true;

        $.ajax({
            url: `/RemoveMenuRecord`,
            method: 'POST',
            data: {
                _token: csrfToken,
                MenuID: MenuID,
            },
            success: function(response) {
                notyf.success(response || 'Menu record removed successfully');
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
                submit.disabled = false;
            },
            error: function(error) {
                notyf.error(error || 'Error removing menu record');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        GetListOfMenus();
    });
</script>