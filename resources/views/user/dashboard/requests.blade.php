<!-- import template --->
@extends('user.layout.base')
<!-- page title --->
@section('title','User Requests')
<!-- page identifier --->
@section('page-id','user-dashboard-requests')

<!-- bootstrap modals--->
@section('bootstrap-modals')
    <!-- read request message modal-->
    <div class="modal modal-request__message" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <span class="btn-close material-icons">close</span>
                </div>
                <div class="modal-body">
                    <h2 class="modal-body__title">Request reason</h2>
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

    <!-- add  -->
    <div class="modal modal-request__new-request" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Request</h5>
                    <span class="btn-close material-icons">close</span>
               </div>

                <div class="modal-body">
                    <!-- Errors container --->
                    <div class="user-form-messages alert alert-dismissible d-none " id="" role="alert">
                        <strong class="modal-error-title">error</strong>
                        <span class="modal-error-body">invalid password or (</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--  inputs --->
                    <form action="" id="new-request__form">
                        <div class="modal-body-data">
                            <h2 class="modal-body__title">Request type</h2>
                            <select  class="w-100 modal-body__data-body  data-body__request-type" id="data-body__request-type">
                                <option value="" selected>type</option>
                                <option value="change role">change role</option>
                                <option value="vacation">vacation</option>
                                <option value="emergency">emergency</option>
                            </select>
                        </div>

                        <div class="modal-body-data">
                            <h2 class="modal-body__title">request pretext</h2>

                            <textarea
                                    id="data-body__request-pretext"
                                    autocorrect="off"
                                    res
                                    spellcheck="false"
                                    aria-autocomplete="none"
                                    class="form-control modal-body__data-body data-body__request-pretext"
                                    placeholder="Leave a comment here"
                                    required
                                    data-parsley-pattern="/^[a-zA-Z0-9\s.,:-_()?!]*$/"
                                    data-parsley-required-message="sorry, response is required."
                                    data-parsley-trigger="keyup"
                            ></textarea>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="new-request__save" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- end bootstrap modals--->



@include('inc.adminNotification')


<!-- main content  -->
@section('content')
    <div class="row m-3">
        @php


           //  echo '<pre>';
           // var_dump($percentageRequestsByRole);
           // var_dump($activeUser);
        @endphp
    </div>
    <!-- page indexer -->
    @include('inc.indexer' ,  ['page_src' => 'Dashboard /','page_index' => 'Request'])
    <!-- charts-->
    <div class="row">
        <div class="col-12  col-xl-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">compare number of request by gender in {{date('Y')}}/{{(date('Y')-1)}}</h4>
                    <canvas id="area-chart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12  col-xl-6 grid-margin grid-margin-lg-0 stretch-card">
            <div class="card">
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
        <div class="col-12 col-md-8  col-xl-9 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body  requests-list ">
                    <div class="d-flex justify-content-between align-items-center requests-list__header">
                        <h4 class="card-title">users requests</h4>
                        <span class="material-icons header__add-request">add</span>
                    </div>
                    <div class="table-responsive pt-3 requests-list__content">
                        <table class="table" id="requests-list">
                            <thead>
                            <tr>
                                <th></th>


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
                                @php $i = 0; @endphp
                                @foreach($requests as $request)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>
                                            @if(empty($request->request_pretext))
                                                Empty
                                            @else
                                                @php($fewWord =  implode(' ', array_slice(explode(' ', $request->request_pretext), 0, 4)))
                                                <p>
                                                    {{$fewWord}}...
                                                    <input class="requests-list__reason__hide" type="hidden"
                                                           value="{{$request->request_pretext}}">
                                                    <button class="requests-list__read-request_btn alert-link d-block ">
                                                        read more
                                                    </button>
                                                </p>
                                            @endif
                                        </td>
                                        <td>
                                            @if(empty($request->request_response))
                                                <span class="badge badge-info">No response yet</span>
                                            @else
                                                @php($fewWord =  implode(' ', array_slice(explode(' ', $request->request_response), 0, 4)))
                                                <p>
                                                    {{$fewWord}}...
                                                    <input type="hidden" class="requests-list__response__hide"
                                                           value="{{$request->request_response}}">
                                                    <button class="requests-list__read-request_btn alert-link d-block ">
                                                        read more
                                                    </button>
                                                </p>
                                            @endif
                                        </td>
                                        <td>


                                            <input type="hidden" class="requests-list__date__hide"
                                                   value="{{$request->request_date}}">
                                            <span class="request-time">

                                                {{ date('D', strtotime($request->request_date)) }}
                                                ,
                                                {{date('h:s' ,strtotime($request->request_date))}}
                                                PM
                                            </span>
                                        </td>
                                        <td>
                                            <input type="hidden" class="requests-list__status__hide"
                                                   value="{{$request->request_status}}">
                                            @switch($request->request_status)
                                                @case('approve')
                                                <span class="badge badge-success">approve</span>
                                                @break

                                                @case('reject')
                                                <span class="badge badge-danger">reject</span>
                                                @break

                                                @case('postpone')
                                                <span class="badge badge-secondary">postpone</span>
                                                @break

                                                @case('pending')
                                                <span class="badge badge-warning">pending</span>
                                                @break

                                            @endswitch
                                        </td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            @if(!empty($request->request_type))
                                                <input type="hidden" class="requests-list__type__hide"
                                                       value="{{$request->request_type}}">
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
        <div class="col-12 col-md-4   col-xl-3 grid-margin stretch-card request-summary">

            <!-- short summary | request order by type -->
            <div class="card ">
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
                            @if(is_array($percentageRequestsByRole) and count($percentageRequestsByRole)>0 )
                                @foreach($percentageRequestsByRole as $ty)
                                    @switch($ty->role)
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
                                     style="width: {{$role->percentage}}%; background-color: #423891;"
                                     aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                <!--  task done -->
                                <div class="progress-bar" role="progressbar"
                                     style="width:   {{$task->percentage}}%; background-color: #34A7FE;"
                                     aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                <!-- vacation -->
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{$vacation->percentage}}%; background-color: #FBA07C;"
                                     aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                <!-- emergency -->
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{$emergency->percentage}}%; background-color: #EE4B70;"
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
                                        <span class="key-count">{{$task->count}}</span>
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


        </div>
    </div>
@endsection
<!-- end main content  -->
