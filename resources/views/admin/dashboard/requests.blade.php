<!-- import template --->
@extends('admin.base.org')
<!-- page title --->
@section('title','ADMIN DASHBOARD | REQUESTS')
<!-- page identifier --->
@section('page-id','admin-dashboard-requests')

@section('side-bar-request'  , 'active-page')


<!-- bootstrap modals--->
@section('bootstrap-modals')
    <!-- read request message modal-->
    <div class="modal modal-request__message" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Read All</h5>
                    <span class="btn-close material-icons">close</span>
                </div>
                <div class="modal-body">
                    <h2 class="modal-body__title"></h2>
                    <div class="form-floating">
                        <textarea autocorrect="off" spellcheck="false" aria-autocomplete="none" class="form-control"
                                  placeholder="" id="floatingTextarea2" style="height: 100px"></textarea>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-close btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- full requests  modal-->
    <div class="modal modal-requests__full-data" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <span class="btn-close material-icons">close</span>
                    <input type="hidden" id="encContainer">
                </div>

                <div class="modal-body">
                    <!-- Errors container --->
                    <div class="user-form-messages alert alert-dismissible d-none" id="" role="alert">
                        <strong class="modal-error-title"></strong>
                        <span class="modal-error-body"></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body-data">
                        <h2 class="modal-body__title">User</h2>
                        <p class="modal-body__data-body data-body__user-name">
                        </p>
                    </div>

                    <div class="modal-body-data">
                        <h2 class="modal-body__title">Date</h2>
                        <p class="modal-body__data-body data-body__request-date">

                        </p>
                    </div>

                    <div class="modal-body-data">
                        <h2 class="modal-body__title">Request type</h2>
                        <p class="modal-body__data-body data-body__request-type">

                        </p>
                    </div>

                    <div class="modal-body-data">
                        <h2 class="modal-body__title">Request </h2>
                        <p class="modal-body__data-body data-body__textarea data-body__request-reason">

                        </p>
                    </div>

                    <form action="" id="handle-user-request">

                        <div class="modal-body-data">
                            <h2 class="modal-body__title">requests status</h2>
                            <select
                                    id="testParsley"
                                    name=""
                                    class="modal-body__data-body data-body__select data-body__request-status"
                                    required
                                    data-parsley-required-message="select at least one option"
                                    data-parsley-trigger="change"
                            >
                                <option value="" selected>status</option>
                                <option value="approve">approve</option>
                                <option value="reject">reject</option>
                                <option value="postpone">postpone</option>
                                <option value="pending">pending</option>
                            </select>
                        </div>
                        <div class="modal-body-data">
                            <h2 class="modal-body__title">response</h2>
                            <div class="form-floating ">
                            <textarea
                                    id="floatingTextarea2"
                                    autocorrect="off"
                                    spellcheck="false"
                                    aria-autocomplete="none"
                                    class="form-control data-body__request-response"
                                    placeholder="Leave a comment here"
                                    required
                                    data-parsley-pattern="/^[a-zA-Z0-9\s.,:-_()?!]*$/"
                                    data-parsley-required-message="sorry, response is required."
                                    minlength="5"
                                    data-parsley-trigger="keyup"
                            ></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="m-2">
                <div class="modal-footer">
                    <button type="button" id="modal-btn__save" class="base-button icon-button">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- end bootstrap modals--->




<!-- end navbar infos -->
@include('inc.notifications')

<!-- end navbar infos -->

<!-- main content  -->
@section('content')

    <!-- page indexer -->
    @include('inc.indexer' , ['page_src' => 'Dashboard','sep' => '|' ,'page_index' => 'Requests'])

    <!-- charts-->
    <div class="row">
        <div class="col-12  col-xl-6 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="card-title">compare number of request by gender in {{date('Y')}}/{{(date('Y')-1)}}</h4>
                    <canvas id="area-chart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12  col-xl-6 grid-margin grid-margin-lg-0 stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="card-title">compare number of request in {{date('Y')}}</h4>
                    <canvas id="bar-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- requests -->
    <div class="row">

        <!-- requests list -->
{{--        col-md-8  col-xl-9--}}
{{--        col-md-4   col-xl-3--}}
        <div class="col-md-8  col-xl-9  grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body ">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">users requests</h4>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table custom-table" id="requests-list">
                            <thead>
                            <tr>
                                <th></th>
                                <th>

                                    photo

                                </th>

                                <th>

                                    request

                                </th>
                                <th>

                                    response

                                </th>
                                <th>

                                    request date
                                </th>
                                <th>

                                    request status

                                </th>
                                <th>

                                    request type

                                </th>
                                <th>

                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($requests) and is_array($requests))
                                @php($i = 0)
                                @foreach($requests as $request)
                                    <tr row-id="{{$request->request_id ?? ''}} ">
                                        <td>{{++$i}}</td>
                                        <td>
                                            <div class="user-infos__img-fullName">
                                                <img  data-src="{{$request->userPhoto ?? ''}}"
                                                     alt="profile-image"
                                                     class="preload-img user-infos__img">
                                                <span class="requests-list__user-name">{{$request->userName?? ''}}</span>
                                                <input class="requests-list__user-name__hide" type="hidden"
                                                       value="{{$request->userName?? ''}}">
                                            </div>
                                        </td>
                                        <td>
                                            @if(empty($request->request_pretext?? ''))
                                                <span class="custom-badge custom-badge__empty"> Empty</span>
                                            @else
                                                @php($fewWord =  implode(' ', array_slice(explode(' ', $request->request_pretext), 0, 4)))
                                                <p>
                                                    {{$fewWord}}...
                                                    <input class="requests-list__reason__hide" modal-type="Rrquest Reason" type="hidden"
                                                           value="{{$request->request_pretext?? ''}}">
                                                    <span class="read-more alert-link d-block ">
                                                        read more
                                                    </span>
                                                </p>
                                            @endif
                                        </td>
                                        <td>
                                            @if(empty($request->request_response?? ''))
                                                <span class="custom-badge custom-badge__empty"> Empty</span>
                                            @else
                                                @php($fewWord =  implode(' ', array_slice(explode(' ', $request->request_response), 0, 4)))
                                                <p>
                                                    {{$fewWord}}...
                                                    <input type="hidden" modal-type="Rrquest Response" class="requests-list__response__hide"
                                                           value="{{$request->request_response?? ''}}">
                                                    <button class="read-more alert-link d-block ">
                                                        read more
                                                    </button>
                                                </p>
                                            @endif
                                        </td>
                                        <td>
                                            {{$request->request_date ?? ''}}
                                            <input type="hidden" class="requests-list__date__hide"
                                                   value="{{$request->request_date}}">
                                            <span class="request-time">

                                                {{ date('D', strtotime($request->request_date ?? '')) }}
                                                ,
                                                {{date('h:s' ,strtotime($request->request_date ?? ''))}}
                                                PM
                                            </span>
                                        </td>
                                        <td>
                                            <input type="hidden" class="requests-list__status__hide"
                                                   value="{{$request->request_status ?? ''}}">
                                            @if(isset($request->request_status))
                                                @switch($request->request_status)
                                                    @case('approve')
                                                    <span class="custom-badge custom-badge__success"> approved</span>
                                                    @break

                                                    @case('reject')
                                                    <span class="custom-badge custom-badge__dager"> rejected</span>
                                                    @break

                                                    @case('postpone')
                                                    <span class="custom-badge custom-badge__postpone"> postpone</span>
                                                    @break

                                                    @case('pending')
                                                    <span class="custom-badge custom-badge__pending"> pending</span>
                                                    @break

                                                @endswitch
                                            @endif
                                        </td>
                                        <td class="material-icons_container">
                                            @if(!empty($request->request_type ))
                                                <input type="hidden" class="requests-list__type__hide"
                                                       value="{{$request->request_type  ?? ''}}">
                                                @switch($request->request_type)
                                                    @case('change role')
                                                    <span class="material-icons" style="color: #000">work</span>
                                                    <spna>change role</spna>
                                                    @break
                                                    @case('task done')
                                                    <span class="material-icons" style="color: #E1E1EA">task_alt</span>
                                                    <span>task done</span>
                                                    @break
                                                    @case('vacation')
                                                    <span class="material-icons"
                                                          style="color: #D0A554">free_breakfast</span>
                                                    <span>vacation</span>
                                                    @break
                                                    @case('emergency')
                                                    <span class="material-icons" style="color: #EF231C">emergency</span>
                                                    <span>emergency</span>
                                                    @break

                                                @endswitch
                                            @endif
                                        </td>
                                        <td>

                                            <div class="btn-group dropleft">
                                                <button type="button" class="dropdown-user__action dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="material-icons cell-menu__ico">more_vert</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button class="dropdown-item dropdown-menu__check-request" type="button">Edit</button>
                                                    <button class="dropdown-item dropdown-menu__delete-request" type="button">Delete</button>
                                                </div>
                                            </div>
{{--                                            <div class="dropdown w-25">--}}
{{--                                                <span class="material-icons cell-menu__ico" data-toggle="dropdown">more_vert</span>--}}
{{--                                                <div class="cell-menu__submenu dropdown-menu d-none"--}}
{{--                                                     aria-labelledby="dropdownMenuButton">--}}
{{--                                                    <button class="dropdown-menu__check-request dropdown-item" href="#">--}}
{{--                                                        <span class="material-icons">check</span>--}}
{{--                                                    </button>--}}
{{--                                                    <button class="dropdown-menu__delete-request dropdown-item"--}}
{{--                                                            href="#">--}}
{{--                                                        <span class="material-icons">delete</span>--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- requests summary -->
        <div class="col-md-4   col-xl-3 grid-margin stretch-card request-summary">

            <!-- short summary | request order by type -->
            <div class="card shadow ">
                <div class="card-body ">
                    <h5 class="card-title">SHORT SUMMARY</h5>
                    <div class="request-short-summary">
                        <div>
                            <!--
                                    change role
                                    task done
                                    vacation
                                    emergency
                            -->
                            <div class="summary-requests__infos">
                                <strong class="summary-requests__count">
                                    {{count($requests) ?? ''  }}
                                </strong>
                                <span class="summary-requests__title">Requests</span>
                            </div>
                            <div class="progress ">
                            @if(is_array($requestsPercentageByType) and count($requestsPercentageByType)>0 )
                                @foreach($requestsPercentageByType as $ty)
                                    @switch($ty->type)
                                        @case('change role')
                                        @php($role = $ty)
                                        @break
                                        @case('task done')
                                        @php($task = $ty)
                                        @break
                                        @case('vacation')
                                        @php($vacation = $ty)
                                        @break
                                        @case('emergency')
                                        @php($emergency = $ty)
                                        @break
                                    @endswitch
                                @endforeach
                            @endif

                            <!-- change role -->
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{$role->percentage ?? 0}}%; background-color: #423891;"
                                     aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                <!--  task done -->
                                <div class="progress-bar" role="progressbar"
                                     style="width:   {{$task->percentage ?? 0}}%; background-color: #34A7FE;"
                                     aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                <!-- vacation -->
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{$vacation->percentage ?? 0}}%; background-color: #FBA07C;"
                                     aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                <!-- emergency -->
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{$emergency->percentage ?? 0}}%; background-color: #EE4B70;"
                                     aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <ul class="summary-progress__keys">
                                <li class="summary-progress_key">
                                    <div class="right">
                                        <span class="key " style="background-color: #423891;"></span>
                                        <span class="key-name">Roles</span>
                                    </div>
                                    <div class="left">
                                        <span class="key-count">{{$role->count ?? ''}}</span>
                                        <span class="key-percentage"> {{$role->percentage ?? ''}}%</span>
                                    </div>

                                </li>
                                <li class="summary-progress_key">
                                    <div class="right">
                                        <span class="key " style="background-color: #34A7FE"></span>
                                        <span class="key-name"> Tasks </span>
                                    </div>
                                    <div class="left">
                                        <span class="key-count">{{$task->count ?? ''}}</span>
                                        <span class="key-percentage"> {{$task->percentage ?? ''}}%</span>
                                    </div>
                                </li>
                                <li class="summary-progress_key">
                                    <div class="right">
                                        <span class="key " style="background-color: #FBA07C;"></span>
                                        <span class="key-name"> vacations</span>
                                    </div>
                                    <div class="left">
                                        <span class="key-count">{{$vacation->count ?? ''}}</span>
                                        <span class="key-percentage">{{$vacation->percentage ?? ''}}%</span>
                                    </div>

                                </li>
                                <li class="summary-progress_key">
                                    <div class="right">
                                        <span class="key " style="background-color: #EE4B70;"></span>
                                        <span class="key-name"> Emergency </span>
                                    </div>
                                    <div class="left">
                                        <span class="key-count">{{$emergency->count ?? ''}}</span>
                                        <span class="key-percentage">{{$emergency->percentage ?? ''}}%</span>
                                    </div>

                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <!-- short summary | last requests -->
            <div class="card shadow" style="margin-top: 15px;">
                <div class="card-body ">
                    <div class="last-requests">
                        <h6 class="card-title">last requests</h6>
                        @if(is_array($lastFourRequests) and count($lastFourRequests)>0)
                            @foreach($lastFourRequests as $request)
                                <div class="last-requests-data">
                                    <div class="left-side">
                                        <img class="preload-img" src="" data-src="{{$request->user_photo !== null && $request->user_photo !== '' ?$request->user_photo : '/img/unknown.png'}}"
                                             alt="">
                                        <div class="infos">
                                            <div class="name">{{$request->user_fullname}}</div>
                                            <div class="date">
                                                @if($request->request_date !== null && $request->request_date !== "")
                                                    @php($date = date('D M', strtotime($request->request_date )))
                                                    @php($time = date('h:i', strtotime($request->request_date )))

                                                    {{$date}}, AT {{$time}}
                                                @else
                                                    <span class="custom-badge custom-badge__empty"> Empty</span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-side">
                                        <span class="count">{{$request->count !== null && $request->count !== "" ? $request->count : ''}}</span>
                                        <span class="material-icons last-requests__ico">beenhere</span>
                                    </div>

                                </div>
                            @endforeach
                        @else
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
<!-- end main content  -->