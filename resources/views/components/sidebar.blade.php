<aside class="sidebar">
    <div class="menu-list"></div>
    <div class="menu-logout">
        <div class="menu-item">
            <a href="#" class="parent-menu" id="showLogoutModal"><i class="fas fa-arrow-right-from-bracket"></i>Logout<i></i></a>
        </div>
    </div>
</aside>

<!-- Logout user modal -->
<div class="modal fade" id="logoutUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 400px; width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Action Verification</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="col-md-12 mb-3 p-0">
                    <label>Are you sure you want to log out?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn success" id="btnConfirmLogout">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>
    function GetMenu() {
        $.ajax({
            url: `/GetMenu`,
            method: 'GET',
            success: function(menus) {
                let parentMenus = menus.filter(menu => menu.menu_type === 'parent');
                let childMenus = menus.filter(menu => menu.menu_type === 'child');
                
                parentMenus.forEach(parent => {
                    let listItem = `<div class="menu-item">
                                        <a href="${parent.menu_page}" class="parent-menu" data-id="${parent.MenuID}"><i class="${parent.menu_icon}"></i>${parent.menu_name}`;

                    // Add toggle icon only if menu_page is '#'
                    if (parent.menu_page === '#') {
                        listItem += `<i class="fas fa-chevron-down menu-toggle-icon" style="margin-left: auto;"></i>`;
                    } else {
                        listItem += `<i></i>`;
                    }
                    listItem += `</a>`;

                    let children = childMenus.filter(child => child.parent_menu === parent.MenuID);
                    if (children.length) {
                        listItem += `<div class="child-menu">`; // Initially hide the child menu
                        children.forEach(child => {
                            listItem += `<a href="${child.menu_page}"><i class="${child.menu_icon}"></i>${child.menu_name}</a>`;
                        });
                        listItem += `</div>`;
                    }

                    listItem += `</div>`;
                    $('.menu-list').append(listItem);
                });

                // Toggle child menus and icons when parent is clicked
                $(".parent-menu").on("click", function(e) {
                    // Prevent default action only if href is '#'
                    if ($(this).attr('href') === '#') {
                        e.preventDefault(); // Prevent the default action of the link (changing the URL)
                        
                        let parentMenuId = $(this).data('id');
                        let childMenu = $(this).next('.child-menu');
                        let icon = $(this).find('.menu-toggle-icon');

                        // Toggle the icon between up and down
                        if (childMenu.is(':visible')) {
                            childMenu.stop(true, true).slideUp(500);
                            icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
                        } else {
                            childMenu.stop(true, true).slideDown(500);
                            icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
                        }
                    } else {
                        // Let the browser navigate to the URL if it's not '#'
                        window.location.href = $(this).attr('href'); 
                    }
                });
            },
            error: function() {
                console.error('Failed to load menus');
            }
        });
    }

    function logoutUser() {
        const submit = document.getElementById('btnConfirmLogout');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        submit.disabled = true;

        $.ajax({
            url: `/logout`,
            method: 'POST',
            data: {
                _token: csrfToken,
            },
            success: function(response) {
                console.log('User logout successfully', response);
                window.location.reload();
                submit.disabled = false;
            },
            error: function(error) {
                console.log('Error user logout', error);
            }
        });
    }

    document.getElementById('showLogoutModal').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('logoutUserModal'));
        const btnSubmit = document.getElementById('btnConfirmLogout');

        modal.show();

        btnSubmit.setAttribute('onclick', `logoutUser()`);
    });

    document.getElementById('showHeaderLogoutModal').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('logoutUserModal'));
        const btnSubmit = document.getElementById('btnConfirmLogout');

        modal.show();

        btnSubmit.setAttribute('onclick', `logoutUser()`);
    });

    document.addEventListener('DOMContentLoaded', GetMenu);
</script>

