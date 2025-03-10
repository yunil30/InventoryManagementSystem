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
                        <th class="text-left" style="width: 15%; text-align: left;">UserNo.</th>
                        <th class="text-left" style="width: 20%; text-align: left;">Username</th>
                        <th class="text-left" style="width: 30%; text-align: left;">Fullname</th>
                        <th class="text-left" style="width: 20%; text-align: left;">Status</th>
                        <th class="text-center" style="width: 15%; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody id="loadUsers"></tbody>
            </table>               
        </div>
    </div>
</x-layout>