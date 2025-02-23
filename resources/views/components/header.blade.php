<header class="header">
    <div class="logo">
        <div class="header-logo-div">
            <a href="http://localhost:8040/"><i class="fas fa-clipboard"></i><span> Company Name</span></a>
        </div>
    </div>
    <ul>
        <li class="menu-item hidden">
            <a href="{{ url('/ShowHomePage') }}">Home</a>
        </li>
        <li class="menu-item hidden">
            <a href="{{ url('/ShowListOfUsers') }}">Users</a>
        </li>
        <li class="menu-item hidden">
            <a href="{{ url('/ShowUserProfile') }}">Profile</a>
        </li>
        <li class="menu-item hidden">
            <a href="{{ url('/') }}">About</a>
        </li>
        <li class="menu-item hidden">
            <form id="logoutForm" action="{{ route('userLogout') }}" method="POST">
                @csrf
            </form>
            <a href="#" onclick="document.getElementById('logoutForm').submit();">Logout</a>
        </li>
    </ul>
</header>