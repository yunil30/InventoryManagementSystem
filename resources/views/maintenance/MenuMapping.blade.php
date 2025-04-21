<x-layout>
    <div class="col-md-12 main-content">
        <div class="col-md-12 content-header">
            <h3>Menu Mapping</h3>
            <button type="button" class="btn btn-primary" id="btnAddUser" onclick="ShowMappingModal()">Add User</button>
        </div>
        <div class="col-md-12 content-body">
            <table class="table table-hover table-bordered" id="userListTable">
                <thead>
                    <tr>
                        <th class="text-left" style="width: 15%; text-align: left;">Access Level</th>
                        <th class="text-left" style="width: 70%; text-align: left;">Assigned Menus</th>
                        <th class="text-center" style="width: 15%; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody id="loadMappedMenus"></tbody>
            </table>               
        </div>
    </div>
</x-layout>

<!-- Create mapped menu modal -->
<div class="modal fade" id="addMenuMappingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px; width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Mapping</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Access level:</label>
                        <select class="form-control" id="addUserRole">
                            <option value="">Select an Option</option>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3">Level 3</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Access menus:</label>
                        <select class="form-control" id="addAccessMenus" multiple></select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="success" id="btnAddMenuMapping" onclick="CreateAccessMenus()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit mapped menu modal -->
<div class="modal fade" id="editMenuMappingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px; width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Mapping</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Access level:</label>
                        <select class="form-control" id="editUserRole" disabled>
                            <option value="">Select an Option</option>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3">Level 3</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Access menus:</label>
                        <select class="form-control" id="editAccessMenus" multiple></select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="success" id="btnEditMenuMapping" onclick="EditAccessMenus()">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    function LoadListOfMappedMenus() {
        $.ajax({
            url: '/GetAllMappedMenus',
            method: 'GET',
            success: function(menus) {
                
                if ($.fn.DataTable.isDataTable('#userListTable')) {
                    $('#userListTable').DataTable().destroy();
                }

                $('#loadMappedMenus').empty();

                const groupedData = menus.reduce((acc, { access_level, menu_name }) => {
                    acc[access_level] = [...(acc[access_level] || []), menu_name];
                    return acc;
                }, {});

                Object.entries(groupedData).forEach(([access, menus]) => {
                    $('#loadMappedMenus').append(`
                        <tr>
                            <td style="vertical-align: middle; text-align: left;">Level ${access.charAt(0).toUpperCase() + access.slice(1)}</td>
                            <td style="vertical-align: middle; text-align: left;">${menus.join(', ')}</td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div style="display: flex; justify-content: space-evenly; align-items: center; width: 100%;">
                                    <button class="btn btn-transparent" id="btnEditMapping${access}" onclick="ShowEditMappingModal(${access})"><span class="fas fa-pencil"></span></button>
                                </div>
                            </td>
                        </tr>
                    `);
                });

                $('#userListTable').DataTable({
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

    const notyf = new Notyf({
        duration: 20000,
        ripple: true,
        position: {
            x: 'right',
            y: 'top',
        }
    });

    let accessMenusChoices;
    let selectedMappedMenus = [];

    function ShowEditMappingModal(AccessLevel) {
        document.getElementById('editUserRole').value = AccessLevel;
        const modal = new bootstrap.Modal(document.getElementById('editMenuMappingModal'));

        GetMappedMenusByAccess(AccessLevel, function() {
            GetAccessMenus('editAccessMenus');
        });

        modal.show();
    }

    function ShowMappingModal() {
        const modal = new bootstrap.Modal(document.getElementById('addMenuMappingModal'));

        GetAccessMenus('addAccessMenus');

        modal.show();
    }

    function GetMappedMenusByAccess(accessLevel, callback) {
        $.ajax({
            url: '/GetMappedMenusByAccess',
            method: 'GET',
            data: { accessLevel: accessLevel },
            success: function(response) {
                selectedMappedMenus = response.map(item => item.MenuID); 
                if (typeof callback === 'function') callback(); 
            },
            error: function(err) {
                console.error('Failed to get access menus', err);
            }
        });
    }

    function GetAccessMenus(elem) {
        const accessMenus = document.getElementById(elem);

        if (accessMenusChoices) {
            accessMenusChoices.destroy();
            accessMenusChoices = null;
        }

        accessMenus.innerHTML = ''; 

        $.ajax({
            url: '/GetAccessMenus',
            method: 'GET',
            success: function(response) {
                response.forEach(function(row) {
                    const option = document.createElement("option");
                    option.value = row.MenuID;
                    option.textContent = row.menu_name;

                    accessMenus.appendChild(option);
                });

                accessMenusChoices = new Choices(accessMenus, {
                    removeItemButton: true,
                    placeholder: true,
                    placeholderValue: 'Select menus',
                    searchPlaceholderValue: 'Search menus'
                });

                selectedMappedMenus.forEach(menuID => {
                    accessMenusChoices.setChoiceByValue(menuID.toString());
                });
            },
            error: function(xhr, status, error) {
                console.error('Failed to get the menu record!', error);
            }
        });
    }

    function EditAccessMenus() {
        const submit = document.getElementById('btnEditMenuMapping');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const accessLevel = document.getElementById('editUserRole').value;
        const accessMenus = Array.from(document.getElementById('editAccessMenus').selectedOptions).map(option => option.value).join(',');

        submit.disabled = true;
    
        $.ajax({
            url: '/EditAccessMenus',
            method: 'POST',
            data: {
                _token: csrfToken,
                accessLevel: accessLevel,
                accessMenus: accessMenus,
            },
            success: function(response) {
                notyf.success(response.message || 'Successfully edited!');
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
                submit.disabled = false;
            },
            error: function(error) {
                notyf.error(error.responseJSON?.message || 'Failed to edit!');
                submit.disabled = false;
            }
        });
    }

    function CreateAccessMenus() {
        const submit = document.getElementById('btnAddMenuMapping');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const accessLevel = document.getElementById('addUserRole').value;
        const accessMenus = Array.from(document.getElementById('addAccessMenus').selectedOptions).map(option => option.value).join(',');

        submit.disabled = true;
    
        $.ajax({
            url: '/CreateAccessMenus',
            method: 'POST',
            data: {
                _token: csrfToken,
                accessLevel: accessLevel,
                accessMenus: accessMenus,
            },
            success: function(response) {
                notyf.success(response.message || 'Successfully mapped!');
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
                submit.disabled = false;
            },
            error: function(error) {
                notyf.error(error.responseJSON?.message || 'Failed to Add!');
                submit.disabled = false;
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        LoadListOfMappedMenus();
    });
</script>