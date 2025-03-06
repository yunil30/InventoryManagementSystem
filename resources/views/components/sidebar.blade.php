<aside class="sidebar">
    <ul id="menu-list"></ul>
</aside>

<script>
    function GetMenu() {
        $.ajax({
            url: `/GetMenu`,
            method: 'GET',
            success: function(menus) {
                $('#menu-list').empty();

                menus.forEach(menu => {
                    let listItem = `<li class="menu-item hidden">
                                        <a href="${menu.menu_page}">${menu.menu_name}</a>
                                    </li>`;
                    $('#menu-list').append(listItem);
                });
            },
            error: function() {
                console.error('Failed to load menus');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        GetMenu();
    });
</script>