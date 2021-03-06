<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item @yield('side-bar-home')">
            <a class="nav-link" href="/admin/dashboard">
                <span class="material-icons ico-home">home</span>
                <span class="menu-title">Home</span>
            </a>
        </li>

        <li class="nav-item @yield('side-bar-users')">
            <a class="nav-link" href="/admin/dashboard/users">
                <span class="material-icons ico-users">group</span>
                <span class="menu-title">users</span>
            </a>
        </li>
        <li class="nav-item @yield('side-bar-request')">
            <a class="nav-link" href="/admin/dashboard/requests">
                <span class="material-icons ico-users">receipt_long</span>
                <span class="menu-title">requets</span>
            </a>
        </li>

        <li class="nav-item @yield('side-bar-settings') ">
            <a class="nav-link" href="/admin/dashboard/settings">
                <span class="material-icons">settings</span>
                <span class="menu-title">Settings</span>
            </a>
        </li>

    </ul>
</nav>