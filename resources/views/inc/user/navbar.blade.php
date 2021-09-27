<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand brand-logo" href="/user/dashboard">
                <img class="brand-logo__img"
                     src="/img/logo.svg"
                     alt="">
            </a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize"
                    id="navbar-toggler">
                <span class="material-icons">switch_right</span>
            </button>
        </div>
    </div>
    <div class="navbar-menu-wrapper  d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item dropdown mr-4">
                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown"
                   id="notificationDropdown" href="#" data-toggle="dropdown">
                    @if(isset($settings->hide_notification) && $settings->hide_notification === 0)

                        <span class="material-icons user-notifications__count">notifications</span>

                        @if(
                                isset($notifications) and
                                is_array($notifications) and
                                count($notifications)>0
                                )
                            @php($count = 0)
                            @foreach($notifications as $notification)
                                @if($notification->status === 0)
                                    @php($count++)
                                @endif
                            @endforeach
                            @if($count>0)
                                <span class="user-count">{{$count}}</span>
                            @else
                                <span class="d-none user-count"></span>
                            @endif
                        @endif
                    @endif

                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown " id="notifications-container"
                     aria-labelledby="notificationDropdown">
                    @yield('navbar-notifications')

                </div>
            </li>

            @if(isset($activeUser))
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        <img id="user-profile-photo" class="css-transitions-only-after-page-load"
                             src="{{ $activeUser->user_photo !== '' && $activeUser->user_photo !== null ? $activeUser->user_photo : '/img/unknown.png'}}" alt="profile"/>
                        <span class="nav-profile-name">{{$activeUser->user_fullname ?? ''}}</span>
                        <span class="navbar__user-email d-none">{{$activeUser->user_email}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="/user/dashboard/settings">
                            <i class="mdi mdi-settings text-primary"></i>
                            Settings
                        </a>
                        <a class="dropdown-item close-user-session" href="#">
                            <i class="mdi mdi-logout text-primary"></i>
                            Logout
                        </a>
                    </div>
                </li>
            @endif

        </ul>
        <button class="navbar-toggler navbar-toggler-right  d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
            <span class="material-icons">menu</span>
        </button>
    </div>
</nav>