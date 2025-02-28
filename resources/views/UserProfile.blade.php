<x-layout>
    <div class="main-content">
        <div class="col-md-12 content-header">
            <h3 style="margin-top: 7px; margin-bottom: 7px;">User Profile</h3>
        </div>
        <div class="col-md-12 p-0 content-body">
            <div class="col-md-12 accountSettingDiv">
                <div class="col-md-12 mb-4 accSettingDiv1">
                    <div class="col-md-12 mb-0 p-0 accHeadingDiv">
                        <h5>Personal Information</h5>
                        <button type="button" class="edit-button" id="btnShowUserInfoModal"><i class="fas fa-edit"></i>Edit Information</button>
                    </div>
                    <label class="accHeadingDescription">View and update your accounts name and username.</label>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>First name</label>
                            <input type="text" class="form-control" id="accFirstName" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Last name</label>
                            <input type="text" class="form-control" id="accLastName" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Username</label>
                            <input type="text" class="form-control" id="accUserName" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-4 accSettingDiv2">
                    <div class="col-md-12 mb-0 p-0 accHeadingDiv">
                        <h5>Contact Information</h5>
                        <button type="button" class="edit-button" id="btnShowUserContactModal"><i class="fas fa-edit"></i>Edit Contacts</button>
                    </div>
                    <label class="accHeadingDescription">Manage your accounts email address and contact number.</label>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Contact email</label>
                            <input type="text" class="form-control" id="accContactEmail" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Contact number</label>
                            <input type="text" class="form-control" id="accContactNumber" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3 accSettingDiv3">
                    <div class="col-md-12 mb-0 p-0 accHeadingDiv">
                        <h5>User Password</h5>
                        <button type="button" class="edit-button" id="btnShowChangePassModal"><i class="fas fa-edit"></i>Change Password</button>
                    </div>
                    <label class="accHeadingDescription">Modify your currend password</label>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<!-- Show edit information modal -->
<div class="modal fade" id="showUserInfoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 450px; width: 100%;">
        <div class="modal-content" style="height: auto; max-height: 80vh;">
            <div class="modal-header">
                <h4 class="modal-title" id="titleUserModal">Edit Information</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>First Name:</label>
                        <input type="text" class="form-control" id="showFirstName" placeholder="First name" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Last Name:</label>
                        <input type="text" class="form-control" id="showLastName" placeholder="Last name" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Username:</label>
                        <input type="text" class="form-control" id="showUserName" placeholder="Username" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnEditInfo">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Show edit contacts modal -->
<div class="modal fade" id="showUserContactModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 400px; width: 100%;">
        <div class="modal-content" style="height: auto; max-height: 80vh;">
            <div class="modal-header">
                <h4 class="modal-title" id="titleUserModal">Edit Contacts</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Contact email:</label>
                        <input type="text" class="form-control" id="showUserContactEmail" placeholder="Email" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Contact number:</label>
                        <input type="text" class="form-control" id="showUserContactNumber" placeholder="Contact no." required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnEditContacts">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Show change password modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 400px; width: 100%;">
        <div class="modal-content" style="height: auto; max-height: 80vh;">
            <div class="modal-header">
                <h4 class="modal-title" id="titleUserModal">Change Password</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3 password-div">
                        <label>New Password:</label>
                        <input type="password" class="form-control" id="NewUserPassword" style="padding-right: 40px;" placeholder="New Password" required>
                        <button type="button" class="toggle-password" onclick="togglePassword('NewUserPassword')">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    <div class="col-md-12 mb-3 password-div">
                        <label>Confirm Password:</label>
                        <input type="password" class="form-control" id="ConfirmUserPassword" style="padding-right: 40px;" placeholder="Confirm Password" required>
                        <button type="button" class="toggle-password" onclick="togglePassword('ConfirmUserPassword')">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnChangePassword" disabled>Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(element) {
        const passwordField = document.getElementById(element);
        const toggleButton = document.querySelector(".toggle-password i");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleButton.classList.remove("fa-eye");
            toggleButton.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleButton.classList.remove("fa-eye-slash");
            toggleButton.classList.add("fa-eye");
        }
    }

    function GetUserInformation() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const firstName = document.getElementById('accFirstName');
        const lastName = document.getElementById('accLastName');
        const userName = document.getElementById('accUserName');
        const userEmail = document.getElementById('accContactEmail');
        const contactNo = document.getElementById('accContactNumber');

        $.ajax({
            url: `/GetUserInformation`,
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
            },
            error: function(error) {
                console.error('Failed to get the user record!', error);
            }
        });
    }

    function ShowUserDataToEdit() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const firstName = document.getElementById('showFirstName');
        const lastName = document.getElementById('showLastName');
        const userName = document.getElementById('showUserName');
        const userEmail = document.getElementById('showUserContactEmail');
        const contactNo = document.getElementById('showUserContactNumber');

        $.ajax({
            url: `/GetUserInformation`,
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
            },
            error: function(error) {
                console.error('Failed to get the user record!', error);
            }
        });
    }

    function EditUserInfo() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const firstName = document.getElementById('showFirstName').value;
        const lastName = document.getElementById('showLastName').value;
        const userName = document.getElementById('showUserName').value;

        $.ajax({
            url: `/EditUserInfo`,
            method: 'POST',
            data: {
                _token: csrfToken,
                first_name: firstName,
                last_name: lastName,
                user_name: userName,
            },
            success: function(response) {
                console.log('User information updated successfully', response);
                window.location.reload();
            },
            error: function(error) {
                console.log('Error updating user information', error);
            }
        });
    }

    function EditUserContacts() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const userEmail = document.getElementById('showUserContactEmail').value;
        const contactNo = document.getElementById('showUserContactNumber').value;

        $.ajax({
            url: `/EditUserContacts`,
            method: 'POST',
            data: {
                _token: csrfToken,
                user_email: userEmail,
                contact_number: contactNo,
            },
            success: function(response) {
                console.log('User contacts updated successfully', response);
                window.location.reload();
            },
            error: function(error) {
                console.log('Error updating user contacts', error);
            }
        });
    }

    function ChangePassword() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const NewUserPassword = document.getElementById('NewUserPassword').value;
        const ConfirmUserPassword = document.getElementById('ConfirmUserPassword').value;

        if (NewUserPassword === ConfirmUserPassword) {
            $.ajax({
                url: `/ChangePassword`,
                method: 'POST',
                data: {
                    _token: csrfToken,
                    password: NewUserPassword,
                },
                success: function(response) {
                    console.log('User password updated successfully', response);
                    window.location.reload();
                },
                error: function(error) {
                    console.log('Error updating user password', error);
                }
            });
        } 
    }

    document.getElementById('btnShowUserInfoModal').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('showUserInfoModal'));
        modal.show();

        ShowUserDataToEdit();

        document.getElementById('btnEditInfo').onclick = function() {
            EditUserInfo();
        };
    });

    document.getElementById('btnShowUserContactModal').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('showUserContactModal'));
        modal.show();

        ShowUserDataToEdit();

        document.getElementById('btnEditContacts').onclick = function() {
            EditUserContacts();
        };
    });

    document.getElementById('btnShowChangePassModal').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
        modal.show();

        document.getElementById('btnChangePassword').onclick = function() {
            ChangePassword();
        };
    });

    document.getElementById('ConfirmUserPassword').addEventListener('input', function() {
        const NewUserPassword = document.getElementById('NewUserPassword');
        const ConfirmUserPassword = document.getElementById('ConfirmUserPassword');
        const btnChangePassword = document.getElementById('btnChangePassword');

        NewUserPassword.classList.remove('input-error', 'input-correct');
        ConfirmUserPassword.classList.remove('input-error', 'input-correct');

        if (NewUserPassword.value === ConfirmUserPassword.value && ConfirmUserPassword.value !== "") {
            NewUserPassword.classList.add('input-correct');
            ConfirmUserPassword.classList.add('input-correct');
            btnChangePassword.disabled = false;
        } else if (ConfirmUserPassword.value !== "") {
            NewUserPassword.classList.add('input-error');
            ConfirmUserPassword.classList.add('input-error');
            btnChangePassword.disabled = true;
        }
    });

    document.getElementById('NewUserPassword').addEventListener('input', function() {
        const NewUserPassword = document.getElementById('NewUserPassword');
        const ConfirmUserPassword = document.getElementById('ConfirmUserPassword');
        const btnChangePassword = document.getElementById('btnChangePassword');

        NewUserPassword.classList.remove('input-error', 'input-correct');
        ConfirmUserPassword.classList.remove('input-error', 'input-correct');

        if (NewUserPassword.value === ConfirmUserPassword.value && NewUserPassword.value !== "") {
            NewUserPassword.classList.add('input-correct');
            ConfirmUserPassword.classList.add('input-correct');
            btnChangePassword.disabled = false;
        } else if (NewUserPassword.value !== "") {
            NewUserPassword.classList.add('input-error');
            ConfirmUserPassword.classList.add('input-error');
            btnChangePassword.disabled = true;
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        GetUserInformation();
    });
</script>