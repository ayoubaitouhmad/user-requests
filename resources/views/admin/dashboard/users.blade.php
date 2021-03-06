<!-- import template --->
@extends('admin.base.org')
<!-- page title --->
@section('title','userRequests | Users List')
<!-- page identifier --->
@section('page-id','admin-dashboard-users')

@section('side-bar-users' , 'active-page')


<!-- bootstrap modals--->
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
                    </div>

                    <form id="user-save-form">
                        <div class="form-group">
                            {{--  name  --}}
                            <div class="form-group__custom-control">
                                <input

                                        type="text"
                                        class="custom-form__control custom-form__control-input"
                                        id="user-save-name"
                                        name="user-save-name[0]"
                                        required
                                        data-parsley-pattern="/^[a-zA-Z\s]+$/"
                                        data-parsley-required-message="name is required"
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
                                        data-parsley-required-message="email is required"
                                        data-parsley-error-message="sorry , enter a valid email like(name@domain.com)."
                                        data-parsley-trigger="keyup">
                                <label for="" class="custom-control__label">
                                    <span class="custom-control__label-placeholder">EMAIL</span>
                                </label>
                            </div>

                            <div class="form-group__custom-control">
                                <input
                                        type="text"
                                        class="custom-form__control custom-form__control-input"
                                        id="user-save-phone"
                                        name="user-up-phoneNumber"
                                        required
                                        data-parsley-type="number"
                                        data-parsley-required-message="sorry , this entry can only contain 10 number (Ex : 0606060606)"
                                        data-parsley-maxlength="10"
                                        data-parsley-minlength="10"
                                        data-parsley-trigger="keyup">
                                <label for="" class="custom-control__label">
                                    <span class="custom-control__label-placeholder">Phone</span>
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
                    <button type="button" class="btn base-button " id="submit-user-save-form">save</button>

                </div>
            </div>
        </div>
    </div>

    {{-- bootsrap modals : update user modal--}}
    <div class="modal fade " id="update-user" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">update user</h5>
                    <span class="btn-close material-icons">close</span>
                    <input type="hidden" id="user-to-update">
                </div>

                <div class="modal-body">
                    <form id="user-up-form"
                          class="profile-form flex-column d-flex justify-content-center align-items-center">
                        <div class="profile-form__header row ">
                            <!-- Errors container --->
                            <div class="modal-messages alert w-100 alert-dismissible  d-none" id="" role="alert">
                                <strong class="modal-error-title"></strong>
                                <span class="modal-error-body"></span>
                            </div>
                            <!-- user photo --->
                            <div class="d-flex justify-content-center row col-sm-12 col-md-4 left-side">
                                <div class="image-shower card col-12 d-flex justify-content-center align-items-center">
                                    <img id="image-preview" src="/img/unknown.png"
                                         class="shadow img-thumbnail user-update-photo__container " alt="">
                                    <div class="custom-file shadow">
                                        <input
                                                type="file"
                                                class="custom-file-input"
                                                id="user-update-photo"
                                                accept="image/*">
                                        <label class="custom-file-label" for="validatedCustomFile"></label>
                                    </div>
                                </div>
                            </div>
                            <!-- fields--->
                            <div class="row col-sm-12  col-md-8 right-side">
                                <div class="form-group form-group_up col-12 col-sm-6 ">
                                    {{--  name  --}}
                                    <div class="form-group__custom-control">
                                        <input
                                                type="text"
                                                class="custom-form__control custom-form__control-input"
                                                id="user-update-name"
                                                name="user-update-name"
                                                data-user="{{$currentUser['name'] ?? ''}}"
                                                required
                                                data-parsley-pattern="/^[a-zA-Z\s]+$/"
                                                data-parsley-error-message="sorry, this entry can only contain character and spaces."
                                                data-parsley-maxlength="150"
                                                data-parsley-trigger="keyup"
                                        >
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">FULL NAME</span>
                                        </label>
                                    </div>

                                    {{--  gender  --}}
                                    <div class="form-group__custom-control">
                                        <select
                                                id="user-update-gender"
                                                name="user-update-gender"
                                                class="custom-form__control custom-form__control-select"
                                                required
                                                data-parsley-required-message="sorry, you need to select gender. ">
                                            <option value="">Gender</option>
                                            <option selected value="male">Male</option>
                                            <option value="female">Female</option>
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
                                                id="user-update-address"
                                                name="user-update-address"
                                                data-user="fes 1050 miedlt"
                                                required
                                                data-parsley-pattern="/^[a-zA-Z\s\d]+$/"
                                                data-parsley-required-message="sorry, you need to enter an address."
                                                data-parsley-maxlength="150"
                                                data-parsley-trigger="keyup">
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">ADDRESS</span>
                                        </label>
                                    </div>

                                    {{--  role  --}}
                                    <div class="form-group__custom-control">
                                        <select
                                                id="user-update-role"
                                                name="user-update-role"
                                                class="custom-form__control custom-form__control-select"
                                                required
                                                data-parsley-required-message="role is required.">
                                            <option value="">Role</option>
                                            <option value="Developer Web">Developer Web</option>
                                            <option value="Developer Desktop">Developer Desktop</option>
                                            <option value="Project Chef">Project Chef</option>
                                            <option value="Ui Analysis">Ui Analysis</option>
                                            <option value="Designer">Designer</option>

                                        </select>
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">ROLE</span>
                                        </label>
                                    </div>

                                    {{--  secret Question  --}}
                                    <div class="form-group__custom-control">
                                        <input
                                                type="text"
                                                id="user-update-secretQuestion"
                                                class="custom-form__control custom-form__control-input"
                                                name="user-update-secretQuestion"
                                                required
                                                data-user="how mush money you have"
                                                data-parsley-required-message="sorry , this field is necessary, in case that you forget password you can reset your password with this option."
                                        >
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">SECRET QUESTION</span>
                                        </label>
                                    </div>

                                    {{--  account  --}}
                                    <div class="form-group__custom-control">
                                        <select
                                                id="user-update-account"
                                                name="user-update-account"
                                                class="custom-form__control custom-form__control-select"
                                                required
                                                data-parsley-required-message="role is required.">
                                            <option value="" selected>Account Status</option>
                                            --}}
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>

                                        </select>
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">Account Status</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group form-group_down col-12 col-sm-6">
                                    {{--  date  --}}

                                    <div class="form-group__custom-control">
                                        <input
                                                type="date"
                                                class="custom-form__control custom-form__control-date"
                                                id="user-update-date"
                                                name="user-update-date"
                                                required
                                                data-user="09/04/1999"
                                                data-parsley-required-message="date of birth is required."
                                                data-parslet-trigger="change">
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">DATE OF BIRTH</span>
                                        </label>
                                    </div>

                                    {{--  city  --}}
                                    <div class="form-group__custom-control">
                                        <select
                                                id="user-update-city"
                                                name="user-update-city"
                                                class="custom-form__control custom-form__control-select mar-cities"
                                                required
                                                data-parsley-required-message="city is required."
                                                data-parsley-trigger="change">
                                            <option value="">City</option>
                                            <option value="1">Agadir-Ida -Ou-Tanane</option>
                                            <option value="2">Al Haouz</option>
                                            <option value="3">Al Hoceima</option>
                                            <option value="5">Aousserd</option>
                                            <option selected value="6">Assa-Zag</option>
                                            <option value="7">Azilal</option>
                                            <option value="8">B??ni Mellal</option>
                                            <option value="9">Benslimane</option>
                                            <option value="10">Berkane</option>
                                            <option value="11">Berrechid</option>
                                            <option value="12">Boujdour</option>
                                            <option value="13">Boulemane</option>
                                            <option value="14">Casablanca</option>
                                            <option value="15">Chefchaouen</option>
                                            <option value="16">Chichaoua</option>
                                            <option value="17">Chtouka- Ait Baha</option>
                                            <option value="18">Driouch</option>
                                            <option value="19">El Hajeb</option>
                                            <option value="20">El Jadida</option>
                                            <option value="21">El Kel??a des Sraghna</option>
                                            <option value="22">Errachidia</option>
                                            <option value="24">Es-Semara</option>
                                            <option value="23">Essaouira</option>
                                            <option value="25">Fahs-Anjra</option>
                                            <option value="26">F??s</option>
                                            <option value="27">Figuig</option>
                                            <option value="28">Fquih Ben Salah</option>
                                            <option value="29">Guelmim</option>
                                            <option value="30">Guercif</option>
                                            <option value="31">Ifrane</option>
                                            <option value="32">Inezgane- Ait Melloul</option>
                                            <option value="33">Jerada</option>
                                            <option value="34">K??nitra</option>
                                            <option value="35">Kh??misset</option>
                                            <option value="36">Kh??nifra</option>
                                            <option value="37">Khouribga</option>
                                            <option value="38">La??youne</option>
                                            <option value="39">Larache</option>
                                            <option value="70">M'Diq-Fnideq</option>
                                            <option value="40">Marrakech</option>
                                            <option value="41">M??diouna</option>
                                            <option value="4">Mekn??s</option>
                                            <option value="42">Midelt</option>
                                            <option value="43">Mohammadia</option>
                                            <option value="75">Moulay Yacoub</option>
                                            <option value="44">Nador</option>
                                            <option value="45">Nouaceur</option>
                                            <option value="47">Ouarzazate</option>
                                            <option value="46">Oued Ed-Dahab</option>
                                            <option value="48">Ouezzane</option>
                                            <option value="49">Oujda-Angad</option>
                                            <option value="76">province non sp??cifi??e</option>
                                            <option value="77">Provinces ??trang??res</option>
                                            <option value="50">Rabat</option>
                                            <option value="51">Rehamna</option>
                                            <option value="52">Safi</option>
                                            <option value="53">Sal??</option>
                                            <option value="54">Sefrou</option>
                                            <option value="55">Settat</option>
                                            <option value="56">Sidi Bennour</option>
                                            <option value="57">Sidi Ifni</option>
                                            <option value="58">Sidi Kacem</option>
                                            <option value="59">Sidi Slimane</option>
                                            <option value="60">Skhirate- T??mara</option>
                                            <option value="62">Tan-Tan</option>
                                            <option value="61">Tanger-Assilah</option>
                                            <option value="63">Taounate</option>
                                            <option value="64">Taourirt</option>
                                            <option value="65">Tarfaya</option>
                                            <option value="66">Taroudannt</option>
                                            <option value="67">Tata</option>
                                            <option value="68">Taza</option>
                                            <option value="69">T??touan</option>
                                            <option value="71">Tinghir</option>
                                            <option value="72">Tiznit</option>
                                            <option value="73">Youssoufia</option>
                                            <option value="74">Zagora</option>
                                        </select>
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">City</span>
                                        </label>
                                    </div>

                                    {{--  phone number  --}}
                                    <div class="form-group__custom-control">
                                        <input
                                                type="text"
                                                class="custom-form__control custom-form__control-input disabled"
                                                id="user-update-phoneNumber"
                                                name="user-update-phoneNumber"
                                                data-user="{{$currentUser['phoneNumber'] ?? ''}}"

                                        >
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">PHONE NUMBER</span>
                                        </label>
                                    </div>

                                    {{--  email  --}}
                                    <div class="form-group__custom-control">
                                        <input
                                                type="text"
                                                class="custom-form__control custom-form__control-input disabled"
                                                id="user-update-email"
                                                name="user-update-email"

                                                data-user="{{$currentUser['email'] ?? ''}}"

                                        >
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder">EMAIL</span>
                                        </label>
                                    </div>

                                    {{--  secret Question response  --}}
                                    <div class="form-group__custom-control">
                                        <input
                                                type="text"
                                                class="custom-form__control custom-form__control-input"
                                                id="user-update-response"
                                                name="user-update-response"
                                                required
                                                data-user="how much money you have"
                                                data-parsley-required-message="response is required."
                                                data-parsley-trigger="keyup">
                                        <label for="" class="custom-control__label">
                                            <span class="custom-control__label-placeholder"> RESPONSE</span>
                                        </label>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </form>
                </div>

                <div class="modal-footer d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn base-button " id="submit-update-form">save</button>
                    {{--                    <button type="button" class="btn-close btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
                </div>
            </div>
        </div>
    </div>

    {{-- bootsrap modals : conferm --}}
    <div class="modal fade" tabindex="-1" id="confirm" role="dialog" aria-labelledby="confirm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete user ? </h5>
                    <input type="hidden" value="">
                    <span class="btn-close material-icons">close</span>
                </div>

                <div class="modal-body">
                    <div class="modal-body__header">
                        <!-- Errors container --->
                        <div class=" user-form-messages alert d-none alert-dismissible" style="margin:.5rem 0"
                             id=""
                             role="alert">
                            <strong class="modal-error-title"></strong>
                            <span class="modal-error-body"></span>

                        </div>
                    </div>
                    <div class="modal-body__header">
                        <p>
                            Deleting this user will remove all data and infos about this user forever
                            you cannot <strong style="color: red">undo</strong> this once is done
                        </p>
                        <h5>are you sure want to do delete ? </h5>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn delete-button" id="delete-user">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- end bootstrap modals--->



@include('inc.notifications')


<!-- main content  -->
@section('content')



    <!-- page indexer -->
    @include('inc.indexer' , ['page_src' => 'Dashboard','sep' => '|' ,'page_index' => 'Users'])


    <!-- charts -->


    <div class="row pt-0">
        <div class="col-12 py-1  col-xl-6 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="card-title">compare users sign up percentage by gender in 2021</h4>
                    <canvas id="area-chart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 py-1 col-xl-6 grid-margin grid-margin-lg-0 stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="card-title">compare users sign up percentage by months in 2021/2020</h4>
                    <canvas id="bar-chart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-md-8 py-1  col-xl-9  grid-margin stretch-card">
            <div class="card  shadow">
                <div class="card-body ">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">users list</h4>
                        <button type="button" class=" icon-button" id="btn-add-user">
                            <span class="material-icons">person_add</span>
                        </button>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-fixed  custom-table" id="users-list">
                            <thead>
                            <tr>
                                <th>

                                </th>
                                <th>User</th>

                                <th>
                                    City
                                </th>
                                <th>
                                    Gender
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Account Status
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(isset($users) and is_array($users) && count($users) > 0)
                                @php $i = 0; @endphp
                                @foreach($users as $user)
                                    <tr row-id="{{enc($user->user_id)?? ''}}">
                                        <td>{{++$i}}</td>
                                        <td>
                                            <div class="user-infos__img-fullName">

                                                <img data-src="{{!empty(getFileFromDirByName($user->user_photo)) ? getFileFromDirByName($user->user_photo) : '/img/unknown.png' }}"
                                                     alt="profile-image" class="user-infos__img preload-img">

                                                {{--                                                <img data-src="{{!empty(getFileFromDirByName($user->user_photo)) ? getFileFromDirByName($user->user_photo) : '/img/unknown.png' }}"--}}
                                                {{--                                                     alt="profile-image" class="user-image-preview preload-img">--}}

                                                <span class="requests-list__user-name">
                                                    {{$user->user_fullname}}
                                                </span>
                                            </div>

                                        </td>
                                        <td>
                                            @if(empty( $user->user_ville))
                                                <span class="custom-badge custom-badge__empty"> Empty</span>
                                            @else
                                                {{$user->user_ville}}
                                            @endif
                                        </td>
                                        <td>
                                            @if(!isset($request->user_gender) && !empty($request->user_gender) )
                                                <span class="custom-badge custom-badge__empty">Empty</span>

                                            @else

                                                @if($user->user_gender === 'm')
                                                    <span class="material-icons"
                                                          style="color: white ;background-color: #34a7fe  ">male</span>
                                                @else
                                                    <span class="material-icons"
                                                          style="background-color: #ee4b70  !important; color: white ">female</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if(empty($user->user_email) )
                                                <span class="custom-badge custom-badge__empty"> Empty</span>
                                            @else
                                                {{$user->user_email}}

                                            @endif
                                        </td>
                                        <td>
                                            @if(empty($user->user_compteEtat))
                                                <span class="badge badge-info"> Empty</span>
                                            @else
                                                @switch($user->user_compteEtat)
                                                    @case('active')
                                                    <span class="custom-badge custom-badge__success">
                                                        active
                                                    </span>
                                                    @break

                                                    @case('inactive')
                                                    <span class="custom-badge custom-badge__pending">
                                                        In progress
                                                    </span>
                                                    @break
                                                @endswitch
                                            @endif

                                        </td>
                                        <td>
                                            <div class="table-users__tools">
                                                <span class="material-icons ico-edit">edit</span>
                                                <span class="material-icons ico-delete" id="delete-user-ico">person_remove</span>
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

        <div class="col-12 col-md-4 py-1  col-xl-3 grid-margin stretch-card request-summary">

            <!-- short summary | number of user for eash role --->
            <div class="card  shadow pt-1 ">
                <div class="card-body  pt-1">
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
                                        <span class="key-count">{{ $developerWeb->count ?? ''}}</span>
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
            <div class="card shadow pt-1" style="margin-top: 15px;">
                <div class="card-body  ">
                    <div class="last-requests">
                        <h6 class="card-title">last users</h6>
                        @if(is_array($lastFourUsers) and count($lastFourUsers)>0)
                            @foreach($lastFourUsers as $user)
                                <div class="last-requests-data">
                                    <div class="left-side">
                                        <img src=""
                                             data-src="{{isset($user->user_photo) &&  !empty($user->user_photo) ? $user->user_photo : '/img/unknown.png'}}"
                                             alt="" class="preload-img">
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
                                                <span class="material-icons"
                                                      style="background-color: #ee4b70 !important; color: white ">female</span>
                                            @else
                                                <span class="material-icons"
                                                      style="color: white ;background-color: #34a7fe  ">male</span>
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
<!-- end main content  -->