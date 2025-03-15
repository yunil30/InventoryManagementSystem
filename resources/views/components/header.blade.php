<header class="header">
    
    <div class="logo">
        <div class="header-logo-div">
            <a href="http://localhost:8040/">
                <i class="fas fa-clipboard"></i><span> Company Name</span>
            </a>
        </div>
    </div>

    <div class="dropdown">
        <i class="fa-regular fa-circle-user" id="usernameToggle" style="text-align: right;"></i>
        <div class="dropdownOptions" id="dropdownMenu" style="width: 12rem;">
            <label id="userFullname"><i class="fa-regular fa-circle-user"></i>{{ session('first_name') . ' ' . session('last_name') }}</label>
            <a href="{{ url('/ShowUserProfile') }}" id="showHeaderProfile"><i class="fas fa-gear"></i>Profile</a>
            <a href="javascript:void(0);" id="showHeaderLogoutModal"><i class="fas fa-arrow-right-from-bracket"></i>Logout</a>
        </div>
    </div>
</header>

<script>
    document.getElementById("usernameToggle").addEventListener("click", function() {
        var dropdownMenu = document.getElementById("dropdownMenu");
        dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
    });

    document.addEventListener("click", function(event) {
        var dropdownMenu = document.getElementById("dropdownMenu");
        var dropdownToggle = document.getElementById("usernameToggle");

        if (!dropdownMenu.contains(event.target) && event.target !== dropdownToggle) {
            dropdownMenu.style.display = "none";
        }
    });
</script>
