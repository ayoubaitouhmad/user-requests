<!-- import template --->
@extends('admin.base.org')
<!-- page title --->
@section('title','Admin dashboard - home')
<!-- page identifier --->
@section('page-id','admin-dashboard-home')

@section('side-bar-home' , 'active-page')

<!-- notifications -->
@include('inc.notifications')

<!-- end notifications -->

<!-- main content  -->
@section('content')
    <!-- page indexer -->
    @include('inc.indexer' , ['page_src' => 'Home'])







    <div class="row cards">
        <div class="col-6  col-md-3 custom-card card-users stretch-card">
            <div class="card shadow card-up bg-white">
                <div class="card-body ">
                    <div class="card-body__header  d-flex justify-content-between align-items-center">
                        <div class="header-title">Users</div>
                        <span class="material-icons header-ico ico-users">groups</span>
                    </div>
                    <div class="card-body__Content d-flex justify-content-start align-items-center">
                        <div class="users-count card-body__count">{{$countUsers}}</div>
                    </div>

                </div>
            </div>
            <div class="card card-down  d-flex justify-content-between align-items-center flex-row">

                <span class="footer-left">Today </span>
                <div class="footer-right d-flex justify-content-center align-items-center">
                    <div class="footer-right__users-count ">{{isset($countUsersToday) ? $countUsersToday > 0 ? '+' . $countUsersToday:$countUsersToday ?? '' : '0'}}</div>
                    @if(isset($countUsersToday) && $countUsersToday > 0)
                        <span class="material-icons footer-right__ico" style="color:greenyellow; ">arrow_drop_up</span>
                    @else
                        <span class="material-icons footer-right__ico" style="color: red ">multiline_chart</span>
                    @endif

                </div>

            </div>
        </div>
        <div class="col-6 col-md-3 custom-card card-requests  stretch-card">
            <div class="card card-up shadow bg-white">
                <div class="card-body ">
                    <div class="card-body__header  d-flex justify-content-between align-items-center">
                        <div class="header-title">Requests</div>
                        <span class="material-icons header-ico ico-requests">receipt_long</span>
                    </div>
                    <div class="card-body__Content d-flex justify-content-start align-items-center">
                        <div class="requests-count card-body__count">{{$countRequests}}</div>
                    </div>

                </div>
            </div>
            <div class="card card-down  d-flex justify-content-between align-items-center flex-row">

                <span class="footer-left">Today </span>
                <div class="footer-right d-flex justify-content-center align-items-center">
                    <div class="footer-right__requests-count ">{{isset($countRequestsToday) ? $countRequestsToday > 0 ? '+' . $countRequestsToday:$countRequestsToday ?? '' : '0'}}</div>
                    @if(isset($countRequestsToday) && $countRequestsToday > 0)
                        <span class="material-icons footer-right__ico" style="color:greenyellow">arrow_drop_up</span>
                    @else
                        <span class="material-icons footer-right__ico" style="color: red ">multiline_chart</span>
                    @endif

                </div>

            </div>
        </div>
        <div class="col-6 col-md-3 custom-card card-notifications stretch-card">
            <div class="card card-up shadow bg-white">
                <div class="card-body ">
                    <div class="card-body__header  d-flex justify-content-between align-items-center">
                        <div class="header-title">Notifications</div>
                        <span class="material-icons header-ico ico-notifications">notifications</span>
                    </div>
                    <div class="card-body__Content d-flex justify-content-start align-items-center">
                        <div class="notifications-count card-body__count">{{count($notifications)}}</div>
                    </div>

                </div>
            </div>
            <div class="card card-down  d-flex justify-content-between align-items-center flex-row">

                <span class="footer-left">Today </span>
                <div class="footer-right d-flex justify-content-center align-items-center">
                    <div class="footer-right__notifications-count ">{{isset($countNotificationToday) ? $countNotificationToday > 0 ? '+' . $countNotificationToday:$countNotificationToday ?? '' : '0'}}</div>
                    @if(isset($countNotificationToday) && $countNotificationToday > 0)
                        <span class="material-icons footer-right__ico" style="color: greenyellow ">arrow_drop_up</span>
                    @else
                        <span class="material-icons footer-right__ico" style="color: red ">multiline_chart</span>
                    @endif

                </div>

            </div>
        </div>
        <div class="col-6 col-md-3 custom-card card-visitors stretch-card">
            <div class="card card-up shadow bg-white">
                <div class="card-body ">
                    <div class="card-body__header  d-flex justify-content-between align-items-center">
                        <div class="header-title">Visites</div>
                        <span class="material-icons header-ico">visibility</span>
                    </div>
                    <div class="card-body__Content d-flex justify-content-start align-items-center">
                        <div class="visitors-count card-body__count">{{$visiteurCount[0] ?? ''}}</div>
                    </div>

                </div>
            </div>
            <div class="card card-down  d-flex justify-content-between align-items-center flex-row">

                <span class="footer-left">Today </span>
                <div class="footer-right d-flex justify-content-center align-items-center">
                    <div class="footer-right__visitors-count ">{{isset($visiteurCount[1]) ? $visiteurCount[1] > 0 ? '+' .$visiteurCount[1]   : $visiteurCount[1] ?? '' : ''}}</div>
                    @if($visiteurCount[0] > 0)
                        <span class="material-icons footer-right__ico" style="color: greenyellow ">arrow_drop_up</span>
                    @else
                        <span class="material-icons footer-right__ico" style="color: red ">multiline_chart</span>
                    @endif

                </div>

            </div>
        </div>
    </div>


    <div class="row details-cards">


        <div class="col-12  col-sm-6 col-md-4   stretch-card">
            <div class="card shadow bg-white">
                <div class="card-body ">
                    <div class="card-body__header">
                        <div class="card-body__header-title"> Users</div>
                        <span class="material-icons ico-users">groups</span>
                    </div>
                    <div class="card-body__content users-content">
                        <ul class="users-items">
                            @if(is_array($users) and count($users)>0)
                                @foreach($users as $user)
                                    <li class="users-item">
                                        <div class="users-item__top">
                                            <div class="item-img">
                                                <img class="item-image preload-img"
                                                     data-src="{{getFileFromDirByName($user->user_photo) !== null && !empty(getFileFromDirByName($user->user_photo)) ? getFileFromDirByName($user->user_photo) : '/img/unknown.png' }}"
                                                     alt="profile">
                                            </div>

                                            <div class="item-content">
                                                <span class="item-content__title">new sign up ,   {{$user->user_fullname}} , {{$user->user_role}} has registred </span>
                                                <span class="item-content__time d-flex justify-content-around align-items-center">

                                            <span class="material-icons">schedule</span>
                                                @php($date = $user->created_at)
                                                    {{date('D' , strtotime($date))}} {{date('h:i:s' , strtotime($date))}}
                                        </span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <div class="empty">
                                    <span class="material-icons">sentiment_dissatisfied</span>
                                    No Registred Users Today
                                </div>

                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12  col-sm-6 col-md-4   stretch-card">
            <div class="card shadow bg-white">
                <div class="card-body ">
                    <div class="card-body__header">

                        <div class="card-body__header-title">Requests</div>
                        <span class="material-icons header-ico ico-requests">receipt_long</span>
                    </div>
                    <div class="card-body__content requests-content">
                        <ul class="requests-items">
                            @if(is_array($requests) and count($requests)>0)
                                @foreach($requests as $request)
                                    <li class="requests-item">
                                        <div class="requests-item__top">
                                            <div class="item-img">
                                                <img class="item-image preload-img"
                                                     data-src="{{$request->userPhoto  ?? '/img/unknown.png' }}"
                                                     alt="profile">
                                            </div>

                                            <div class="item-content">
                                                <span class="item-content__title">new  request from  {{$request->userName}} , about  {{$request->request_type}} has sended . </span>
                                                <span class="item-content__time d-flex justify-content-around align-items-center">
                                            <span class="material-icons">schedule</span>
                                                @php($date = $request->request_date)
                                                    {{date('D' , strtotime($date))}} {{date('h:i:s' , strtotime($date))}}
                                        </span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <div class="empty">
                                    <span class="material-icons">sentiment_dissatisfied</span>
                                    No Registred Users Today
                                </div>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12  col-sm-6 col-md-4   stretch-card">
            <div class="card shadow bg-white">
                <div class="card-body ">
                    <div class="card-body__header">
                        <div class="card-body__header-title ">Notifications</div>
                        <span class="material-icons header-ico ico-notifications">notifications</span>

                    </div>
                    <div class="card-body__content notifications-content">
                        <ul class="notifications-items">
                            @if(is_array($notifications) and count($notifications)>0)
                                @php($i = 0)
                                @foreach($notifications as $notification)
                                    @php($i++)
                                    @if($i > 5)
                                        @break
                                    @endif
                                    <li class="notifications-item">
                                        <div class="notifications-item__top">
                                            <div class="item-img">
                                                <img class="item-image preload-img"
                                                     @php($user = new \App\models\User())
                                                     @php($user = $user->get($notification->user))
                                                     data-src="{{getFileFromDirByName($user->user_photo) !== null && !empty(getFileFromDirByName($user->user_photo)) ? getFileFromDirByName($user->user_photo) : '/img/unknown.png' }}"
                                                     alt="profile">
                                            </div>

                                            <div class="item-content">
                                                <span class="item-content__title"> new notification from  {{$user->user_fullname}} ,  has sended. </span>
                                                <span class="item-content__time d-flex justify-content-around align-items-center">

                                            <span class="material-icons">schedule</span>
                                                @php($date = $notification->created_at)
                                                    {{date('D' , strtotime($date))}} {{date('h:i:s' , strtotime($date))}}
                                        </span>
                                            </div>
                                        </div>

                                    </li>
                                @endforeach
                            @else
                                <div class="empty">
                                    <span class="material-icons">sentiment_dissatisfied</span>
                                    No Requests Users Today
                                </div>

                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>







@endsection
<!-- end main content  -->










































































































