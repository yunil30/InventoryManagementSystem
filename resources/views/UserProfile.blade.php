<x-layout>
    <div class="main-content">
        <div class="col-md-12 content-header">
            <h3 style="margin: 0;">User Profile</h3>
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
            <div class="col-md-12 modal-body" style="max-height: 60vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>First Name:</label>
                        <input type="text" class="form-control" id="showFirstName">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Last Name:</label>
                        <input type="text" class="form-control" id="showLastName">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Username:</label>
                        <input type="text" class="form-control" id="showUserName">
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
            <div class="col-md-12 modal-body" style="max-height: 60vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Contact email:</label>
                        <input type="text" class="form-control" id="showUserContactEmail">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Contact number:</label>
                        <input type="text" class="form-control" id="showUserContactNumber">
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
            <div class="col-md-12 modal-body" style="max-height: 60vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>New Password:</label>
                        <input type="password" class="form-control" id="NewUserPassword">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Confirm Password:</label>
                        <input type="password" class="form-control" id="ConfirmUserPassword">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnChangePassword">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
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

    document.getElementById('btnShowUserInfoModal').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('showUserInfoModal'));

        ShowUserDataToEdit();

        modal.show();
    });

    document.getElementById('btnShowUserContactModal').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('showUserContactModal'));

        ShowUserDataToEdit();

        modal.show();
    });

    document.getElementById('btnShowChangePassModal').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('changePasswordModal'));

        ShowUserDataToEdit();
        
        modal.show();
    });

    document.addEventListener('DOMContentLoaded', function() {
        GetUserInformation();
    });
    
    // $('#btnShowUserInfoModal').click(function() {
    //     $('#btnShowUserInfoModal').attr({
    //         'data-toggle': 'modal',
    //         'data-target': '#showUserInfoModal'
    //     });

    //     ShowUserDataToEdit();
    //     $('#btnEditInfo').attr('onclick', `EditUserInfo()`);
    // });

    // $('#btnShowUserContactModal').click(function() {
    //     $('#btnShowUserContactModal').attr({
    //         'data-toggle': 'modal',
    //         'data-target': '#showUserContactModal'
    //     });

    //     ShowUserDataToEdit();
    //     $('#btnEditContacts').attr('onclick', `EditUserContacts()`);
    // });

    // $('#btnShowChangePassModal').click(function() {
    //     $('#btnShowChangePassModal').attr({
    //         'data-toggle': 'modal',
    //         'data-target': '#changePasswordModal'
    //     });

    //     $('#btnChangePassword').attr('onclick', `ChangePassword()`);
    // });

    // $('#ConfirmUserPassword').on('input', function() {
    //     var NewUserPassword = $('#NewUserPassword').val();
    //     var ConfirmUserPassword = $('#ConfirmUserPassword').val();

    //     $('#NewUserPassword, #ConfirmUserPassword').removeClass('input-error input-correct');

    //     if (NewUserPassword === ConfirmUserPassword && ConfirmUserPassword !== "") {
    //         $('#NewUserPassword, #ConfirmUserPassword').addClass('input-correct');
    //     } else if (ConfirmUserPassword !== "") {
    //         $('#NewUserPassword, #ConfirmUserPassword').addClass('input-error');
    //     }
    // });

    // $('#NewUserPassword').on('input', function() {
    //     var NewUserPassword = $('#NewUserPassword').val();
    //     var ConfirmUserPassword = $('#ConfirmUserPassword').val();

    //     $('#NewUserPassword, #ConfirmUserPassword').removeClass('input-error input-correct');

    //     if (NewUserPassword !== "" || NewUserPassword === "") {
    //         $('#NewUserPassword, #ConfirmUserPassword').removeClass('input-error input-correct');
    //     } else if (NewUserPassword !== ConfirmUserPassword) {
    //         $('#NewUserPassword, #ConfirmUserPassword').addClass('input-error');
    //     }
    // });

    // function ShowMessage(icon, title, text, position = 'center') {
    //     Swal.fire({
    //         icon: icon,
    //         title: title,
    //         text: text,
    //         position: position, 
    //         timerProgressBar: true, 
    //         confirmButtonText: 'OK',
    //         heightAuto: false
    //     }).then((result) => {
    //         if (result.isConfirmed && icon !== 'error') {
    //             window.location.reload();
    //         }
    //     });
    // }

    // function EditUserInfo() {
    //     var data = {
    //         FirstName: $('#showFirstName').val(),
    //         MiddleName: $('#showMiddleName').val(),
    //         LastName: $('#showLastName').val(),
    //         UserName: $('#showUserName').val()
    //     }

    //     axios.post(host_url + 'User/EditUserInfo', data)
    //     .then((res) => {
    //         ShowMessage('success', 'Successful!', res.data.message);
    //     })
    //     .catch((error) => {
    //         ShowMessage('error', 'Failed!', error.response?.data?.error || 'An error occurred while updating data.');
    //     }); 
    // }

    // function EditUserContacts() {
    //     var data = {
    //         UserEmail: $('#showUserContactEmail').val(),
    //         UserNumber: $('#showUserContactNumber').val()
    //     }

    //     axios.post(host_url + 'User/EditUserContacts', data)
    //     .then((res) => {
    //         ShowMessage('success', 'Successful!', res.data.message);
    //     })
    //     .catch((error) => {
    //         ShowMessage('error', 'Failed!', error.response?.data?.error || 'An error occurred while updating data.');
    //     }); 
    // }

    // function ChangePassword() {
    //     if ($('#NewUserPassword').val() === '') {
    //         ShowMessage('error', 'Failed!', 'Please enter a new password!');
    //         $('#NewUserPassword').trigger('chosen:activate');

    //         return false;
    //     }

    //     if ($('#ConfirmUserPassword').val() === '') {
    //         ShowMessage('error', 'Failed!', 'Please confirm your new password!');
    //         $('#ConfirmUserPassword').trigger('chosen:activate');

    //         return false;
    //     }

    //     if ($('#NewUserPassword').val() !== $('#ConfirmUserPassword').val()) {
    //         ShowMessage('error', 'Failed!', 'Passwords do not match. Please try again.');
    //         $('#NewUserPassword').trigger('chosen:activate');

    //         return false;
    //     }

    //     var data = {
    //         NewPassword: $('#NewUserPassword').val(),
    //     };

    //     axios.post(host_url + 'User/ChangePassword', data)
    //     .then((res) => {
    //         ShowMessage('success', 'Successful!', res.data.message);
    //     })
    //     .catch((error) => {
    //         ShowMessage('error', 'Failed!', error.response?.data?.error || 'An error occurred while changing the password.');
    //     }); 
    // }
</script>