<nav class="sidebar sidebar-offcanvas " id="sidebar">
	<ul class="nav">
		<li class="nav-item @yield('side-bar-home')">
			<a class="nav-link" href="/user/dashboard">
				<span class="material-icons ico-home">home</span>
				<span class="menu-title"> Home </span>
			</a>
		</li>


		<li class="nav-item @yield('side-bar-request')">
			<a class="nav-link" href="/user/dashboard/requests">
				<span class="material-icons ico-users">receipt_long</span>
				<span class="menu-title"> Requests</span>
			</a>
		</li>


		<li class="nav-item @yield('side-bar-settings')">
			<a class="nav-link" href="/user/dashboard/settings">
				<span class="material-icons">settings</span>
				<span class="menu-title">Settings</span>
			</a>
		</li>
	</ul>
</nav>