<x-layout>
    <div class="col-md-12 main-content">
        <div class="col-md-12 content-header">
            <h3>List of Users</h3>
            <button type="button" class="btn btn-primary" id="btnAddUser">Add User</button>
        </div>
        <div class="col-md-12 content-body">
            <table class="table table-hover table-bordered" id="userListTable">
                <thead>
                    <tr>
                        <th class="text-left" style="width: 15%; text-align: left;">UserNo.</th>
                        <th class="text-left" style="width: 20%;">Username</th>
                        <th class="text-left" style="width: 30%;">Fullname</th>
                        <th class="text-left" style="width: 20%;">Status</th>
                        <th class="text-center" style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody id="loadUsers"></tbody>
            </table>               
        </div>
    </div>
</x-layout>

<!-- Create user modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="addFirstName">First name:</label>
                        <input type="text" class="form-control" id="addFirstName" placeholder="First name" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="addLastName">Last name:</label>
                        <input type="text" class="form-control" id="addLastName" placeholder="Last name" required>
                    </div>
                
                    <div class="col-md-12 mb-3">
                        <label for="addUserName">Username:</label>
                        <input type="text" class="form-control" id="addUserName" placeholder="Username" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addUserEmail">Email:</label>
                        <input type="email" class="form-control" id="addUserEmail" placeholder="Email" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addContactNo">Contact number:</label>
                        <input type="text" class="form-control" id="addContactNo" placeholder="Contact no." required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addUserPassword">Password:</label>
                        <input type="password" class="form-control" id="addUserPassword" placeholder="Password" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addUserRole">User role:</label>
                        <select class="form-control" id="addUserRole">
                            <option value="">Select an Option</option>
                            <option value="user" selected>User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnSubmitCreateUser" onclick="CreateNewUser()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Show user modal -->
<div class="modal fade" id="showUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titleUserModal">Edit User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="showFirstName">First name:</label>
                        <input type="text" class="form-control" id="showFirstName" placeholder="First name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="showLastName">Last name:   </label>
                        <input type="text" class="form-control" id="showLastName" placeholder="Last name" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="showUserName">Username:</label>
                        <input type="text" class="form-control" id="showUserName" placeholder="Username" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="showUserEmail">Email:</label>
                        <input type="email" class="form-control" id="showUserEmail" placeholder="Email" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="showContactNo">Contact number:</label>
                        <input type="text" class="form-control" id="showContactNo" placeholder="Contact no." required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="showUserRole">User role:</label>
                        <select class="form-control" id="showUserRole">
                            <option value="">Select an Option</option>
                            <option value="user" selected>User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnSubmitEditUser">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Remove user modal -->
<div class="modal fade" id="removeUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 400px; width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Action Verification</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="col-md-12 mb-3 p-0">
                    <label>Are you sure you want to remove this user?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnConfirmRemoveUser">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('btnAddUser').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('createUserModal'));
        modal.show();
    });

    function LoadListOfUsers() {
        $.ajax({
            url: '/GetActiveUsers',
            method: 'GET',
            success: function(users) {
                if ($.fn.DataTable.isDataTable('#userListTable')) {
                    $('#userListTable').DataTable().destroy();
                }

                $('#loadUsers').empty();

                users.forEach(function(row, index) {
                    if (row.user_status === 1) { 
                        $('#loadUsers').append(`
                            <tr>
                                <td style="vertical-align: middle; text-align: left;">${row.UserID}</td>
                                <td style="vertical-align: middle;">${row.user_name}</td>
                                <td style="vertical-align: middle;">${row.first_name} ${row.last_name}</td>    
                                <td style="vertical-align: middle;">${row.user_status === 1 ? 'Active' : 'Inactive'}</td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <button class="btn btn-transparent" id="btnShowUser${row.UserID}" onclick="ShowUserModal(${row.UserID}, 'Show')"><span class="fas fa-eye"></span></button>
                                    <button class="btn btn-transparent" id="btnEditUser${row.UserID}" onclick="ShowUserModal(${row.UserID}, 'Edit')"><span class="fas fa-pencil"></span></button>
                                    <button class="btn btn-transparent" id="btnRemoveUser${row.UserID}" onclick="ShowRemoveUserModal(${row.UserID})"><span class="fas fa-trash"></span></button>
                                </td>
                            </tr>
                        `);
                    }
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
                console.error('Error fetching users.');
            }
        });
    }

    function ShowUserModal(UserID, Mode) {
        const modalTitle = document.getElementById('titleUserModal');
        const firstName = document.getElementById('showFirstName');
        const lastName = document.getElementById('showLastName');
        const userName = document.getElementById('showUserName');
        const userEmail = document.getElementById('showUserEmail');
        const contactNo = document.getElementById('showContactNo');
        const userRole = document.getElementById('showUserRole');

        const btnSubmit = document.getElementById('btnSubmitEditUser');
        const modal = new bootstrap.Modal(document.getElementById('showUserModal'));
        GetUserRecord(UserID);

        if (Mode == 'Show') {
            btnSubmit.style.display = 'none'; 
            modalTitle.innerText = 'User';
            firstName.disabled = true;
            lastName.disabled = true;
            userName.disabled = true;
            userEmail.disabled = true;
            contactNo.disabled = true;
            userRole.disabled = true;
            modal.show();
        } else {
            btnSubmit.style.display = ''; 
            modalTitle.innerText = 'Edit User';
            firstName.disabled = false;
            lastName.disabled = false;
            userName.disabled = false;
            userEmail.disabled = false;
            contactNo.disabled = false;
            userRole.disabled = false;
            modal.show();
            btnSubmit.setAttribute('onclick', `EditUserRecord(${UserID})`);
        }
    }

    function ShowRemoveUserModal(UserID) {
        const removeUserButton = document.getElementById('btnRemoveUser' + UserID);
        const confirmRemoveButton = document.getElementById('btnConfirmRemoveUser');
        const modal = new bootstrap.Modal(document.getElementById('removeUserModal'));

        modal.show();

        confirmRemoveButton.setAttribute('onclick', `RemoveUserRecord(${UserID})`);
    }

    function CreateNewUser() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const firstName = document.getElementById('addFirstName').value;
        const lastName = document.getElementById('addLastName').value;
        const userName = document.getElementById('addUserName').value;
        const userEmail = document.getElementById('addUserEmail').value;
        const contactNo = document.getElementById('addContactNo').value;
        const userPassword = document.getElementById('addUserPassword').value;
        const userRole = document.getElementById('addUserRole').value;
        
        $.ajax({
            url: `/CreateUserRecord`,
            method: 'POST',
            data: {
                _token: csrfToken,
                first_name: firstName,
                last_name: lastName,
                user_name: userName,
                user_email: userEmail,
                contact_number: contactNo,
                password: userPassword,
                user_role: userRole
            },
            success: function(response) {
                console.log('User created successfully', response);
                window.location.reload();
            },
            error: function(error) {
                console.log('Error creating user', error);
            }
        });
    }

    function GetUserRecord(UserID) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const firstName = document.getElementById('showFirstName');
        const lastName = document.getElementById('showLastName');
        const userName = document.getElementById('showUserName');
        const userEmail = document.getElementById('showUserEmail');
        const contactNo = document.getElementById('showContactNo');
        const userRole = document.getElementById('showUserRole');

        $.ajax({
            url: `/GetUserRecord/${UserID}`,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                firstName.value = response.first_name;
                lastName.value = response.last_name;
                userName.value = response.user_name;
                userEmail.value = response.user_email;
                contactNo.value = response.contact_number;
                userRole.value = response.user_role;
            },
            error: function(error) {
                console.error('Failed to get the user record!', error);
            }
        });
    }

    function EditUserRecord(UserID) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const firstName = document.getElementById('showFirstName').value;
        const lastName = document.getElementById('showLastName').value;
        const userName = document.getElementById('showUserName').value;
        const userEmail = document.getElementById('showUserEmail').value;
        const contactNo = document.getElementById('showContactNo').value;
        const userRole = document.getElementById('showUserRole').value;

        $.ajax({
            url: `/EditUserRecord/${UserID}`,
            method: 'POST',
            data: {
                _token: csrfToken,
                first_name: firstName,
                last_name: lastName,
                user_name: userName,
                user_email: userEmail,
                contact_number: contactNo,
                user_role: userRole
            },
            success: function(response) {
                console.log('Successfully edited!', response);
                window.location.reload();
            },
            error: function(error) {
                console.error('Failed to edit!', error);
            }
        });
    }

    function RemoveUserRecord(UserID) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $.ajax({
            url: `/RemoveUserRecord/${UserID}`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                console.log('Successfully removed!', response);
                window.location.reload();
            },
            error: function(error) {
                console.error('Failed to remove!', error);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        LoadListOfUsers();
    });
</script>
