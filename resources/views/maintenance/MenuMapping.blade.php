<x-layout>
    <div class="col-md-12 main-content">
        <div class="col-md-12 content-header">
            <h3>Menu Mapping</h3>
            <button type="button" class="btn btn-primary" id="btnAddUser">Add User</button>
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
                        <select class="form-control" id="editUserRole">
                            <option value="">Select an Option</option>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3" selected>Level 3</option>
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
                <button type="button" class="success" id="btnEditMenuMapping">Submit</button>
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

    let accessMenusChoices;
    let selectedMappedMenus = [];

    function ShowEditMappingModal(AccessLevel) {
        console.log('This is the access level: ', AccessLevel);
        
        const modal = new bootstrap.Modal(document.getElementById('editMenuMappingModal'));

        GetMappedMenusByAccess(AccessLevel, function() {
            GetAccessMenus();
        });

        modal.show();
    }

    function GetMappedMenusByAccess(accessLevel, callback) {
        $.ajax({
            url: '/GetMappedMenusByAccess',
            method: 'GET',
            data: { accessLevel: accessLevel },
            success: function(response) {
                selectedMappedMenus = response.map(item => item.MenuID);  // store mapped MenuIDs
                if (typeof callback === 'function') callback();  // call the next step
            },
            error: function(err) {
                console.error('Failed to get access menus', err);
            }
        });
    }

    function GetAccessMenus() {
    const accessMenus = document.getElementById('editAccessMenus');

    if (accessMenusChoices) {
        accessMenusChoices.destroy();
        accessMenusChoices = null;
    }

    accessMenus.innerHTML = ''; // clear the select

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

            // Now init Choices
            accessMenusChoices = new Choices(accessMenus, {
                removeItemButton: true,
                placeholder: true,
                placeholderValue: 'Select menus',
                searchPlaceholderValue: 'Search menus'
            });

            // Preselect mapped menus using Choices API
            selectedMappedMenus.forEach(menuID => {
                accessMenusChoices.setChoiceByValue(menuID.toString());
            });
        },
        error: function(xhr, status, error) {
            console.error('Failed to get the menu record!', error);
        }
    });
}


    document.addEventListener('DOMContentLoaded', function() {
        LoadListOfMappedMenus();
    });
</script>