<nav class="sidebar sidebar-offcanvas " id="sidebar">
	<ul class="nav">
		<li class="nav-item @yield('side-bar-home')">
			<a class="nav-link" href="/user/dashboard">
				<span class="material-icons ico-home">home</span>
				<span class="menu-title"> Home </span>
			</a>
		</li>


		@if(isset($activeUser->user_compteEtat) && $activeUser->user_compteEtat === 'active' )
			<li class="nav-item @yield('side-bar-request') ">
				<a class="nav-link" href="/user/dashboard/requests">
					<span class="material-icons ico-users">receipt_long</span>
					<span class="menu-title"> Requests</span>
				</a>
			</li>
		@else

			<li class="nav-item disabled @yield('side-bar-request')" data-toggle="tooltip" data-placement="right" title="you can't do that until admin activate your account">
				<a class="nav-link" href="#">
					<span class="material-icons ico-users">receipt_long</span>
					<span class="menu-title"> Requests</span>
				</a>
			</li>
		@endif



		<li class="nav-item @yield('side-bar-settings')">
			<a class="nav-link" href="/user/dashboard/setting">
				<span class="material-icons">settings</span>
				<span class="menu-title">Settings</span>
			</a>
		</li>
	</ul>
</nav>