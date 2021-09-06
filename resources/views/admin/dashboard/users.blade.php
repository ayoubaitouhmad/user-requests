@extends('admin.layout.org')
@section('title','app')
@section('page-id','users')
@section('bootstrap-modals')
    {{-- bootsrap modals : add user modal--}}
    <div class="modal fade hide" id="save-user-modal" tabindex="-1" role="dialog" aria-labelledby="save-user-modal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <span class="btn-close material-icons">close</span>
                </div>
                <div class="modal-body">
                    <div class="alert  alert-dismissible d-none" id="user-save-modal-messages" role="alert">
                        <strong class="modal-error-title"></strong>
                        <span class="modal-error-body"></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="user-save-form">
                        <div class="form-group">
                            @if(isset($token) and !empty($token))
                                <input type="hidden" value="{{$token}}">
                            @endif
                            {{--  name  --}}
                            <div class="form-group__custom-control">
                                <input

                                        type="text"
                                        class="custom-form__control custom-form__control-input"
                                        id="user-save-name"
                                        name="user-save-name[0]"
                                        required
                                        data-parsley-pattern="/^[a-zA-Z\s]+$/"
                                        data-parsley-required-message="password is required"
                                        data-parsley-error-message="sorry, this entry can only contain character and spaces."
                                        data-parsley-maxlength="150"
                                        data-parsley-trigger="keyup">
                                <label for="" class="custom-control__label">
                                    <span class="custom-control__label-placeholder">FULL NAME</span>
                                </label>
                            </div>
                            {{--  email  --}}
                            <div class="form-group__custom-control">
                                <input
                                        type="text"
                                        class="custom-form__control custom-form__control-input"
                                        id="user-save-email"
                                        name=user-save-email[1]"
                                        required
                                        data-parsley-type="email"
                                        data-parsley-required-message="password is required"
                                        data-parsley-error-message="sorry , enter a valid email like(name@domain.com)."
                                        data-parsley-trigger="keyup">
                                <label for="" class="custom-control__label">
                                    <span class="custom-control__label-placeholder">EMAIL</span>
                                </label>
                            </div>
                            {{--  pass  --}}
                            <div class="form-group__custom-control">
                                <input
                                        type="text"
                                        class="custom-form__control custom-form__control-input"
                                        id="user-save-password"
                                        name="user-save-password[2]"

                                        required
                                        autocomplete="off"
                                        data-parsley-pattern="^(?:(?:(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]))|(?:(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[a-z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))).{8,32}$"
                                        data-parsley-required-message="password is required"
                                        data-parsley-error-message="sorry, for your safety we can't accept this password , you need to use strong password."
                                        data-parsley-trigger="keyup">
                                <label for="" class="custom-control__label">
                                    <span class="custom-control__label-placeholder">PASSWORD</span>
                                </label>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-close btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="OK" id="submit-user-save-form">
                </div>
            </div>
        </div>
    </div>

    {{-- bootsrap modals : update user modal--}}
    <div class="modal fade " id="update-user" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>update data</h3>
                    <span class="btn-close material-icons">close</span>
                    <input type="hidden" id="user-to-update">
                </div>

                <div class="modal-body">

                    <div class="row modal-body__content">

                        <div class="alert  alert-dismissible d-none " id="user-update-form-messages" role="alert">
                            <strong class="modal-error-title"></strong>
                            <span class="modal-error-body"></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form id="user-up-form" enctype="multipart/form-data">
                            @if(isset($token) and !empty($token))
                                <input type="hidden" name="token" value="{{$token}}">
                            @endif
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6 ">
                                    {{--  name  --}}
                                    <div class="form-group__custom-control">
                                        <input
                                                type="text"
                                                class="custom-form__control custom-form__control-input"
                                                id="user-up-name"
                                                name="user-up-name"

                                                data-parsley-pattern="/^[a-zA-Z\s]+$/"
                                                data-parsley-error-message="sorry, this entry can only contain character and spaces."
                                                data-parsley-maxlength="150"
                                                data-parsley-trigger="keyup">
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">FULL NAME</span>
                                        </label>
                                    </div>

                                    {{--  gender  --}}
                                    <div class="form-group__custom-control">
                                        <select
                                                id="user-up-gender"
                                                name="user-up-gender"
                                                class="custom-form__control custom-form__control-select"
                                                required
                                                data-parsley-required-message="sorry, you need to select gender. ">
                                            <option value="" selected>gender</option>
                                            <option value="male">male</option>
                                            <option value="female">female</option>
                                        </select>
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">GENDER</span>
                                        </label>
                                    </div>

                                    {{--  adresse  --}}
                                    <div class="form-group__custom-control">
                                        <input
                                                type="text"
                                                class="custom-form__control custom-form__control-input"
                                                id="user-up-address"
                                                name="user-up-address"
                                                required
                                                data-parsley-pattern="/^[a-zA-Z\s\d]+$/"
                                                data-parsley-required-message="sorry, you need to enter an address."
                                                data-parsley-maxlength="150"
                                                data-parsley-trigger="keyup">
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">ADDRESS</span>
                                        </label>
                                    </div>

                                    {{--  pass  --}}
                                    <div class="form-group__custom-control">
                                        <input
                                                type="text"
                                                class="custom-form__control custom-form__control-input"
                                                id="user-up-ps"
                                                name="user-up-ps"
                                                required
                                                data-parsley-pattern="^(?:(?:(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]))|(?:(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[a-z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))).{8,32}$"
                                                data-parsley-required-message="sorry, for your safety we can't accept this password , you need to use strong password."
                                                data-parsley-trigger="keyup">
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">PASSWORD</span>
                                        </label>
                                    </div>

                                    {{--  secret Question  --}}
                                    <div class="form-group__custom-control">
                                        <input
                                                type="text"
                                                id="user-up-secretQuestion"
                                                class="custom-form__control custom-form__control-input"
                                                name="user-up-secretQuestion"
                                                required
                                                data-parsley-required-message="sorry , this field is necessary, in case that you forget password you can reset your password with this option."
                                        >
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">SECRET QUESTION</span>
                                        </label>
                                    </div>








                                    {{--  role  --}}
                                    <div class="form-group__custom-control">
                                        <select
                                                id="user-up-role"
                                                name="user-up-role"
                                                class="custom-form__control custom-form__control-select"
                                                required
                                                data-parsley-required-message="role is required.">
                                            <option value="" selected>role</option>
                                            <option value="developer web">developer web</option>
                                            <option value="developer desktop">developer desktop</option>
                                            <option value="chef project">chef project</option>
                                            <option value="ui analysis">ui analysis</option>
                                            <option value="designer">designer</option>

                                        </select>
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">ROLE</span>
                                        </label>
                                    </div>

                                    {{--  photo  --}}
                                    <div class="form-group__custom-control">
                                        <div class="custom-control__file-checked">
                                            <div class="custom-form__control-checkbox">
                                                <input type="checkbox" checked="false" name="d" id="dfdsfdd"
                                                       class="control-checkbox__origin"
                                                       title="if you want to add new photo check this option"/>
                                            </div>
                                            <div class="custom-form__control-file inactive-file">
                                                <input
                                                        type="file"
                                                        name="user-up-photo"
                                                        id="user-up-photo"
                                                        class="control-file__origin "
                                                        disabled=""
                                                        accept="image/*"
                                                        data-parsley-check="4"
                                                        data-parsley-trigger="focusout"
                                                        data-parsley-required-message="that is required."/>
                                                <span class="control-file__value-container" id="user-up-photo"> new image </span>
                                            </div>
                                        </div>
                                        <div class="errors">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    {{--  date  --}}

                                    <div class="form-group__custom-control">
                                        <input
                                                type="date"
                                                class="custom-form__control custom-form__control-date"
                                                id="user-up-date"
                                                name="user-up-date"
                                                required
                                                data-parsley-required-message="date of birth is required."
                                                data-parslet-trigger="change">
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">DATE OF BIRTH</span>
                                        </label>
                                    </div>

                                    {{--  city  --}}
                                    <div class="form-group__custom-control">
                                        <select
                                                id="user-up-city"
                                                name="user-up-city"
                                                class="custom-form__control custom-form__control-select mar-cities"
                                                required
                                                data-parsley-required-message="city is required."
                                                data-parsley-trigger="change">
                                        </select>
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder"></span>
                                        </label>
                                    </div>

                                    {{--  phone number  --}}
                                    <div class="form-group__custom-control">
                                        <input
                                                type="text"
                                                class="custom-form__control custom-form__control-input"
                                                id="user-up-phoneNumber"
                                                name="user-up-phoneNumber"
                                                required
                                                data-parsley-type="number"
                                                data-parsley-required-message="sorry , this entry can only contain 10 number (Ex : 0606060606)"
                                                data-parsley-maxlength="10"
                                                data-parsley-minlength="10"
                                                data-parsley-trigger="keyup">
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">PHONE NUMBER</span>
                                        </label>
                                    </div>

                                    {{--  email  --}}
                                    <div class="form-group__custom-control">
                                        <input
                                                type="text"
                                                class="custom-form__control custom-form__control-input"
                                                id="user-up-email"
                                                name="user-up-email"
                                                required
                                                data-parsley-type="email"
                                                data-parsley-required-message="sorry , enter a valid email like(name@domain.com)."
                                                data-parsley-trigger="keyup">
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">EMAIL</span>
                                        </label>
                                    </div>

                                    {{--  secret Question response  --}}
                                    <div class="form-group__custom-control">
                                        <input
                                                type="text"
                                                class="custom-form__control custom-form__control-input"
                                                id="user-up-response"
                                                name="user-up-response"
                                                required
                                                data-parsley-required-message="response is required."
                                                data-parsley-trigger="keyup">
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">SECRET QUESTION RESPONSE</span>
                                        </label>

                                        {{--  account status  --}}
                                        <div class="form-group__custom-control">
                                            <select
                                                    id="user-up-compteEtat"
                                                    name="user-up-compteEtat"
                                                    class="custom-form__control custom-form__control-select"
                                                    required
                                                    data-parsley-required-message="account status is required."
                                                    data-parsley-trigger="change">
                                                <option value="" selected>account</option>
                                                <option value="active">active</option>
                                                <option value="inactive">inactive</option>
                                            </select>
                                            <label for="" class="custom-control__label">
                                                <span class="custom-control__label-placeholder">ACCOUNT STATUS</span>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" value="OK" class="btn btn-primary" id="submit-user-up-form">
                    <button type="button" class="btn-close btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- bootsrap modals : conferm --}}
    <div class="modal" tabindex="-1" id="confirm" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete data</h5>
                    <input type="hidden" value="">
                    <span class="btn-close material-icons">close</span>
                </div>

                <div class="modal-body">
                    <!-- Errors container --->
                    <div class="user-form-messages alert  alert-dismissible d-none" style="margin:.5rem 0" id=""
                         role="alert">
                        <strong class="modal-error-title">Error</strong>
                        <span class="modal-error-body">Data can't updated</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <p>Are you sure you want delete that</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="delete-user">confirm delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('admin-photo')
    {{  $admin['photo'] ?? ''}}
@endsection

@section('admin-name')
    {{$admin['name'] ?? ''}}
@endsection



@section('content')






    <!-- page indexer -->
    <div class="row">
        <div class="col-12 grid-margin stretch-card ">
            <div class="dashboard-indexer">

                <div class="d-flex align-items-center">
                    <span class="material-icons">home</span>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor">Users</p>
                </div>
            </div>
        </div>

    </div>

{{--    <div class="row">--}}
{{--        @php--}}
{{--            echo '<pre>';--}}

{{--           var_dump($admin);--}}
{{--        @endphp--}}
{{--    </div>--}}

    <!-- charts -->
    <div class="row">
        <div class="col-12  col-xl-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">compare users sign up percentage by gender in 2021</h4>
                    <canvas id="area-chart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12  col-xl-6 grid-margin grid-margin-lg-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">compare users sign up percentage by months in 2021/2020</h4>
                    <canvas id="bar-chart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-md-8  col-xl-9  grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body ">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">users list</h4>
                        <button type="button" class="btn btn-primary" id="btn-add-user" data-toggle="modal"
                                data-target="#save-user-modal">
                            ADD
                        </button>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-fixed" id="users-list">
                            <thead>
                            <tr>
                                <th>

                                </th>
                                <th>user</th>

                                <th>
                                    ville
                                </th>
                                <th>
                                    gender
                                </th>
                                <th>
                                    email
                                </th>
                                <th>
                                    account status
                                </th>
                                <th>
                                    action
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(isset($users) and is_array($users))
                                @php $i = 0; @endphp
                                @foreach($users as $user)
                                    <tr row-id="{{$user->user_id ?? ''}}">
                                        <td>{{++$i}}</td>
                                        <td>
                                            <div class="user-infos__-img-fullName">
                                            <img data-src="{{$user->user_photo}}" class=""
                                                 alt="profile-image">
                                            <p class="requests-list__user-name">
                                                {{$user->user_fullname}}
                                            </p>
                                            </div>

                                        </td>
                                        <td>
                                            @if(empty( $user->user_ville))
                                                <span class="badge badge-info"> No Data yet</span>
                                            @else
                                                {{$user->user_ville}}
                                            @endif
                                        </td>
                                        <td>
                                            @if(empty($request->user_gender) )
                                                <span class="badge badge-info"> No Data yet</span>
                                            @else
                                                @if($user->user_gender == 'm') male @else female @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if(empty($user->user_email) )
                                                <span class="badge badge-info"> No Data yet</span>
                                            @else
                                                {{$user->user_email}}

                                            @endif
                                        </td>

                                        <td>
                                            @if(empty($user->user_compteEtat))
                                                <span class="badge badge-info"> No Data yet</span>
                                            @else
                                                @switch($user->user_compteEtat)
                                                    @case('active')
                                                    <div class="badge badge-success" role="alert">
                                                        active
                                                    </div>
                                                    @break

                                                    @case('inactive')
                                                    <div class="badge badge-warning" role="alert">
                                                        In progress
                                                    </div>
                                                    @break
                                                @endswitch
                                            @endif

                                        </td>

                                        <td>
                                            <div class="table-users__tools" bootstrap-data-toggle="{{$user->user_id}}">
                                                <span class="material-icons ico-valid">done</span>
                                                <span class="material-icons ico-edit">edit</span>
                                                <span class="material-icons ico-delete"
                                                      id="delete-user-ico">person_remove</span>
                                            </div>
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

        <div class="col-12 col-md-4   col-xl-3 grid-margin stretch-card request-summary">

            <!-- short summary | number of user for eash role --->
            <div class="card ">
                <div class="card-body ">
                    <h5 class="card-title">users roles</h5>
                    <div class="request-short-summary">
                        <div>
                            <div class="summary-requests__infos">
                                <strong class="summary-requests__count">
                                    {{count($users) ?? ''  }}
                                </strong>
                                <span class="summary-requests__title">users</span>


                            </div>
                            <div class="progress ">
                            @if(is_array($usersRoleCountByUser) and count($usersRoleCountByUser)>0 )
                                @foreach($usersRoleCountByUser as $ty)
                                    @switch($ty->role)
                                        @case('chef project')
                                        @php($chef = $ty)
                                        @break
                                        @case('designer')
                                        @php($designer = $ty)
                                        @break
                                        @case('developer desktop')
                                        @php($developerDesk = $ty)
                                        @break
                                        @case('developer web')
                                        @php($developerWeb = $ty)
                                        @break
                                        @case('ui analysis')
                                        @php($uiAnalysis = $ty)
                                        @break
                                    @endswitch
                                @endforeach
                            @endif


                            <!--chef project--->
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{$chef->percentage}}%; background-color: #423891;"
                                     aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                <!--developer desktop--->
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{$developerDesk->percentage}}%; background-color: #34A7FE;"
                                     aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                <!--developer web--->
                                <div class="progress-bar" role="progressbar"
                                     style="width:{{$developerWeb->percentage}}%; background-color: #FBA07C;"
                                     aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                <!--ui analysis--->
                                <div class="progress-bar" role="progressbar"
                                     style="width:{{$uiAnalysis->percentage}}%; background-color: #EE4B70;"
                                     aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                <!--designer --->
                                <div class="progress-bar" role="progressbar"
                                     style="width:  {{$designer->percentage}}%; background-color: #ffcf16;"
                                     aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <ul class="summary-progress__keys">

                                <li class="summary-progress_key">
                                    <div class="right">
                                        <span class="key " style="background-color: #423891;"></span>
                                        <span class="key-name"> chef project </span>
                                    </div>
                                    <div class="left">
                                        <span class="key-count">{{ $chef->count ?? ''}}</span>
                                        <span class="key-percentage">{{ $chef->percentage ?? ''}}%</span>
                                    </div>
                                </li>

                                <li class="summary-progress_key">
                                    <div class="right">
                                        <span class="key " style="background-color: #34A7FE;"></span>
                                        <span class="key-name"> developer desktop</span>
                                    </div>
                                    <div class="left">
                                        <span class="key-count">{{ $developerDesk->count ?? ''}}</span>
                                        <span class="key-percentage">{{ $developerDesk->percentage ?? ''}}%</span>
                                    </div>
                                </li>

                                <li class="summary-progress_key">
                                    <div class="right">
                                        <span class="key " style="background-color: #FBA07C"></span>
                                        <span class="key-name"> developer web </span>
                                    </div>
                                    <div class="left">
                                        <span class="key-count">{{$developerWeb->count}}</span>
                                        <span class="key-percentage"> {{$developerWeb->percentage ?? ''}}%</span>
                                    </div>
                                </li>
                                <li class="summary-progress_key">
                                    <div class="right">
                                        <span class="key " style="background-color: #EE4B70;"></span>
                                        <span class="key-name">ui analysis</span>
                                    </div>
                                    <div class="left">
                                        <span class="key-count">{{$uiAnalysis->count ?? ''}}</span>
                                        <span class="key-percentage"> {{$uiAnalysis->percentage ?? ''}}%</span>
                                    </div>

                                </li>


                                <li class="summary-progress_key">
                                    <div class="right">
                                        <span class="key " style="background-color: #ffcf16;"></span>
                                        <span class="key-name"> designer </span>
                                    </div>
                                    <div class="left">
                                        <span class="key-count">{{ $designer->count ?? ''}}</span>
                                        <span class="key-percentage">{{ $designer->percentage ?? ''}}%</span>
                                    </div>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <!-- last user added -->
            <div class="card " style="margin-top: 15px;">
                <div class="card-body ">
                    <div class="last-requests">
                        <h6 class="card-title">last user added</h6>
                        @if(is_array($lastFourUsers) and count($lastFourUsers)>0)
                            @foreach($lastFourUsers as $user)
                                <div class="last-requests-data">
                                    <div class="left-side">
                                        <img src="" data-src="{{$user->user_photo}}"
                                             alt="">
                                        <div class="infos">
                                            <div class="name">{{$user->user_fullname}}</div>
                                            <div class="date">
                                                @php($date = date('D M', strtotime($user->user_dateOfBirth)))
                                                @php($time = date('i:d', strtotime($user->user_dateOfBirth)))

                                                {{$date}}, AT {{$time}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-side">
                                        <span class="count">
                                            @if($user->user_gender==='f')
                                                <span class="material-icons" style="background-color: #f81cff !important; color: white ">female</span>
                                            @else
                                                <span class="material-icons bg-info" style="color: white !important;">male</span>
                                            @endif

                                        </span>

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


























































































































