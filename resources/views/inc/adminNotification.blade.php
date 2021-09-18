@section('navbar-notifications')
    <div class="notifications-header d-flex justify-content-between align-items-center">
        <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>

    </div>
    <div class="notifications">
    @if(isset($notifications) and is_array($notifications) && count($notifications)>0)
        @php($admin = new \App\models\Admin())
        @foreach($notifications as $notification)
            <a class="dropdown-item">
                <div class="item-thumbnail">
                    <div class="item-icon bg-warning">
                        <img style="height: 3rem ; width: 3rem;"
                             data-src="{{getFileFromDirByName($admin->getByID($notification->admin)->admin_photo)}}" alt=""
                            class="preload-img"
                        >
                    </div>
                </div>
                <div class="item-content" style="    white-space: normal;">

                    <div class="d-flex justify-content-between align-items-center">
                        <h6 style="flex:  0 0 80%" class="font-weight-normal">{{$notification->title}}</h6>
                        <div  class="d-flex justify-content-between align-items-center ">
                            <span>{{dateBetween($notification->created_at, date('Y-m-d H:i:s'))}}</span>
                            <span class="material-icons">schedule</span>
                        </div>
                    </div>
                    <p class="font-weight-light small-text mb-0 text-muted">
                        {{$notification->description}}
                    </p>
                </div>
            </a>
        @endforeach
    </div>
    @else
        <p class="d-flex justify-content-center align-items-center  p-2 dropdown-header text-center no-notifications">
            <span class="material-icons">hourglass_disabled</span>
            no notification</p>
    @endif

@endsection