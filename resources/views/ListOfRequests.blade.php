<x-layout>
    <div class="col-md-12 main-content">
        <div class="col-md-12 content-header">
            <h3>List of Requests</h3>
            <button type="button" class="btn btn-primary" id="btnAddRequest" onclick="ShowCreateUserModal()">Create Request</button>
        </div>
        <div class="col-md-12 content-body">
            <table class="table table-hover table-bordered" id="requestListTable">
                <thead>
                    <tr>
                        <th class="text-left" style="width: 15%; text-align: left;">UserNo.</th>
                        <th class="text-left" style="width: 20%; text-align: left;">Username</th>
                        <th class="text-left" style="width: 30%; text-align: left;">Fullname</th>
                        <th class="text-left" style="width: 20%; text-align: left;">Status</th>
                        <th class="text-center" style="width: 15%; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody id="loadRequests"></tbody>
            </table>               
        </div>
    </div>
</x-layout>

<!-- Create user modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Request</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="addFirstName">First name:</label>
                        <input type="text" class="form-control" id="addFirstName" placeholder="First name" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="addLastName">Last name:</label>
                        <input type="text" class="form-control" id="addLastName" placeholder="Last name" required>
                    </div>
                
                    <div class="col-md-12 mb-3">
                        <label for="addReason">Reason:</label>
                        <textarea class="form-control" id="addReason" placeholder="Reason for request" required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn success" id="btnSubmitCreateUser" onclick="CreateNewUser()">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    function LoadListOfRequests() {
        $.ajax({
            url: '/GetAllItems',
            method: 'GET',
            success: function(items) {
                console.table(items);

                if ($.fn.DataTable.isDataTable('#requestListTable')) {
                    $('#requestListTable').DataTable().destroy();
                }

                $('#loadRequests').empty();

                $('#requestListTable').DataTable({
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

    function ShowCreateUserModal() {
        const modal = new bootstrap.Modal(document.getElementById('createUserModal'));

        modal.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
        LoadListOfRequests();
    });
</script>