<aside class="sidebar">
    <div class="menu-list">
    </div>
</aside>

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
                                        <a href="${parent.menu_page}" class="parent-menu" data-id="${parent.MenuID}">${parent.menu_name}`;

                    // Add toggle icon only if menu_page is '#'
                    if (parent.menu_page === '#') {
                        listItem += `<span class="menu-toggle-icon"><i class="fas fa-chevron-down"></i></span>`;
                    }
                    listItem += `</a>`;

                    let children = childMenus.filter(child => child.parent_menu === parent.MenuID);
                    if (children.length) {
                        listItem += `<div class="child-menu">`; // Initially hide the child menu
                        children.forEach(child => {
                            listItem += `<a href="${child.menu_page}">${child.menu_name}</a>`;
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
                        let icon = $(this).find('.menu-toggle-icon i');

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

    document.addEventListener('DOMContentLoaded', GetMenu);
</script>

