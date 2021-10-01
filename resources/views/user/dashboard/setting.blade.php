<!-- import template --->
@extends('user.layout.base')
<!-- page title --->
@section('title','Settings')
<!-- page identifier --->
@section('page-id','user-dashboard-settings')

@include('inc.notifications')

@section('side-bar-settings' , 'active-page')

<!-- main content  -->
@section('content')
    <!-- page indexer -->
    @include('inc.indexer' ,  ['page_src' => 'Dashboard','sep' => '|'  ,'page_index' => 'Settings'])



    <!-- content -->
    <div class="row settings">
        <div class="col-12 col-md-3  col-xl-2    settings-row  settings-row__header">
            <div class="settings-row__list">
                <div class="card shadow">
                    <div class="card-body">
                        <ul class="settings-row__list-items">
                            <li class="list-item  active-link" id="link-profile">
                                <span class="material-icons">account_box</span>
                                <span class="list-item__title">Edit Profile</span>
                                <span class="material-icons ico-arrow ">arrow_forward_ios</span>
                            </li>

                            <li class="list-item " id="link-ui">
                                <span class="material-icons">brush</span>
                                <span class="list-item__title">Ui Prefreences</span>
                                <span class="material-icons ico-arrow ico-hide ">arrow_forward_ios</span>
                            </li>

                            <li class="list-item  " id="link-notification">
                                <span class="material-icons">notifications</span>
                                <span class="list-item__title">Notifications</span>
                                <span class="material-icons ico-arrow ico-hide">arrow_forward_ios</span>

                            </li>

                            <li class="list-item " id="link-security">
                                <span class="material-icons">gpp_good</span>
                                <span class="list-item__title">Security</span>
                                <span class="material-icons ico-arrow ico-hide">arrow_forward_ios</span>
                            </li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 col-md-9  col-xl-10  settings-row settings-row__content">
            <div class="card shadow">
                @if($activeUser->user_compteEtat  === 'inactive')
                    <div class="user-inactive-account">

                        <div class="custom-badge custom-badge__dager d-flex justify-content-center align-items-center flex-column flex-sm-row" role="alert">
                            <span class="material-icons">warning</span>
                            <div>
                                You can't change your data and see some settings until admin activate you account , you will
                                get notification when your accout been activated
                            </div>

                        </div>
                    </div>
                @endif

                <div class="settings-items {{$activeUser->user_compteEtat  === 'inactive' ? 'hide' : ''}}">
                    <div id="profile" class="settings-item settings-item__profile flex-xl-row flex-column">
                        <div class="settings-item__header  profile-header">
                            <div class="profile-header__title settings-header__title">Edit Profile</div>
                        </div>
                        <div class="settings-item_content profile-content ">
                            <form id="profile-data-form" action="">
                                <div class="alert alert-dismissible  errors-messages d-none" role="alert">
                                    <strong class="modal-error-title">error</strong>
                                    <span class="modal-error-body">fuck you </span>
                                </div>

                                <div class="profile-content__avatar settings-content__item d-flex flex-column justify-content-start align-items-center">

                                    <div class="custom-uploader">
                                        <img class="custom-uploader__img preload-img"
                                             data-src="{{$activeUser->user_photo !== "" && $activeUser->user_photo !== null ? $activeUser->user_photo : '/img/unknown.png'}}"
                                             alt="">
                                        @if($activeUser->user_compteEtat  === 'active')
                                            <div class="custom-uploader__file">
                                                <div class="custom-file-uploader ">
                                                    <input
                                                            type="file"
                                                            class="custom-file-uploader-input"
                                                            id="user-photo">
                                                    <label class="custom-file-uploader-label shadow " for="user-photo">
                                                        <span class="material-icons">file_upload</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                    <button type="button" id="save-user-avatar"
                                            class="icon-button shadow d-flex justify-content-center">
                                        <span class="material-icons">done</span>
                                    </button>
                                </div>

                                <div class="row profile-content__infos   settings-content__item">
                                    <div class="col-12 row profile-infos__item">
                                        <div class="col-12 col-sm-6 ">
                                            <label class="w-100">
                                                <span class="field-title__inputs">First Name<span
                                                            style="color: red">*</span></span>
                                                <input
                                                        type="text"
                                                        id="user-first-name"
                                                        class="w-100 custom-form__control"
                                                        value="{{implode(' ', array_slice(explode(' ', $activeUser->user_fullname), 0, 1)) ?? ''}}"
                                                        required
                                                        data-parsley-pattern="/^[a-zA-Z\s]+$/"
                                                        data-parsley-error-message="sorry, this entry can only contain character and spaces."
                                                        data-parsley-maxlength="150"
                                                        data-parsley-trigger="keyup"
                                                >
                                            </label>
                                        </div>
                                        <div class="col-12 col-sm-6 ">
                                            <label class="w-100">
                                                <span class="field-title__inputs">Last Name<span
                                                            style="color: red">*</span></span>
                                                <input
                                                        type="text"
                                                        id="user-last-name"
                                                        class="w-100 custom-form__control"
                                                        value="{{implode(' ', array_slice(explode(' ', $activeUser->user_fullname), 1, 2)) ?? ''}}"
                                                        required
                                                        data-parsley-pattern="/^[a-zA-Z\s]+$/"
                                                        data-parsley-error-message="sorry, this entry can only contain character and spaces."
                                                        data-parsley-maxlength="150"
                                                        data-parsley-trigger="keyup"
                                                >
                                            </label>
                                        </div>

                                    </div>
                                    <div class="col-12 row profile-infos__item">
                                        <div class="col-12">
                                            <label class="w-100">
                                                <span class="field-title__inputs">Contact Number<span
                                                            style="color: red">*</span></span>
                                                <input
                                                        type="text"
                                                        id="user-phone"
                                                        class="w-100 custom-form__control"
                                                        value="{{$activeUser->user_phoneNumber ?? ''}}"
                                                        required
                                                        minlength="10"
                                                        maxlength="10"
                                                        data-parsley-type="number"
                                                        data-parsley-error-message="sorry ,this entry can only contain a valid phone number like(0606060606).."
                                                        data-parsley-required-message="sorry, this entry is required."
                                                        data-parsley-trigger="keyup"
                                                >
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 row profile-infos__item">
                                        <div class="col-12">
                                            <label class="w-100">
                                                <span class="field-title__inputs">Address <span
                                                            style="color: red">*</span></span>
                                                <input
                                                        type="text" id="user-address"
                                                        class="w-100 custom-form__control"
                                                        value="{{$activeUser->user_address ?? ''}}"
                                                        required
                                                        data-parsley-pattern="/^[a-zA-Z\s\d]+$/"
                                                        data-parsley-required-message="sorry, this entry is required."
                                                        data-parsley-error-message="sorry, you need to enter an address."
                                                        data-parsley-maxlength="150"
                                                        data-parsley-trigger="keyup"
                                                >
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 row profile-infos__item">
                                        <div class="col-12 col-sm-6 ">
                                            <label class="w-100">

                                                <span class="field-title__inputs">City <span style="color: red">*</span></span>
                                                <select
                                                        id="user-first-city"
                                                        class="custom-form__control custom-form__control-select"
                                                        data-src="{{$activeUser->user_ville ?? ''}}"
                                                        required
                                                        data-parsley-required-message="sorry, this entry is required."
                                                        data-parsley-error-message="sorry, you need to chose your city."
                                                        data-parsley-trigger="change">
                                                    <option value="">city</option>
                                                    <option value="1">Agadir-Ida -Ou-Tanane</option>
                                                    <option value="2">Al Haouz</option>
                                                    <option value="3">Al Hoceima</option>
                                                    <option value="5">Aousserd</option>
                                                    <option value="6">Assa-Zag</option>
                                                    <option value="7">Azilal</option>
                                                    <option value="8">Béni Mellal</option>
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
                                                    <option value="21">El Kelâa des Sraghna</option>
                                                    <option value="22">Errachidia</option>
                                                    <option value="24">Es-Semara</option>
                                                    <option value="23">Essaouira</option>
                                                    <option value="25">Fahs-Anjra</option>
                                                    <option value="26">Fès</option>
                                                    <option value="27">Figuig</option>
                                                    <option value="28">Fquih Ben Salah</option>
                                                    <option value="29">Guelmim</option>
                                                    <option value="30">Guercif</option>
                                                    <option value="31">Ifrane</option>
                                                    <option value="32">Inezgane- Ait Melloul</option>
                                                    <option value="33">Jerada</option>
                                                    <option value="34">Kénitra</option>
                                                    <option value="35">Khémisset</option>
                                                    <option value="36">Khénifra</option>
                                                    <option value="37">Khouribga</option>
                                                    <option value="38">Laâyoune</option>
                                                    <option value="39">Larache</option>
                                                    <option value="70">M'Diq-Fnideq</option>
                                                    <option value="40">Marrakech</option>
                                                    <option value="41">Médiouna</option>
                                                    <option value="4">Meknès</option>
                                                    <option value="42">Midelt</option>
                                                    <option value="43">Mohammadia</option>
                                                    <option value="75">Moulay Yacoub</option>
                                                    <option value="44">Nador</option>
                                                    <option value="45">Nouaceur</option>
                                                    <option value="47">Ouarzazate</option>
                                                    <option value="46">Oued Ed-Dahab</option>
                                                    <option value="48">Ouezzane</option>
                                                    <option value="49">Oujda-Angad</option>
                                                    <option value="76">province non spécifiée</option>
                                                    <option value="77">Provinces étrangères</option>
                                                    <option value="50">Rabat</option>
                                                    <option value="51">Rehamna</option>
                                                    <option value="52">Safi</option>
                                                    <option value="53">Salé</option>
                                                    <option value="54">Sefrou</option>
                                                    <option value="55">Settat</option>
                                                    <option value="56">Sidi Bennour</option>
                                                    <option value="57">Sidi Ifni</option>
                                                    <option value="58">Sidi Kacem</option>
                                                    <option value="59">Sidi Slimane</option>
                                                    <option value="60">Skhirate- Témara</option>
                                                    <option value="62">Tan-Tan</option>
                                                    <option value="61">Tanger-Assilah</option>
                                                    <option value="63">Taounate</option>
                                                    <option value="64">Taourirt</option>
                                                    <option value="65">Tarfaya</option>
                                                    <option value="66">Taroudannt</option>
                                                    <option value="67">Tata</option>
                                                    <option value="68">Taza</option>
                                                    <option value="69">Tétouan</option>
                                                    <option value="71">Tinghir</option>
                                                    <option value="72">Tiznit</option>
                                                    <option value="73">Youssoufia</option>
                                                    <option value="74">Zagora</option>
                                                </select>

                                            </label>
                                        </div>
                                        <div class="col-12 col-sm-6 ">
                                            <label class="w-100">
                                                <span class="field-title__inputs">Gender <span
                                                            style="color: red">*</span></span>
                                                <select
                                                        id="user-first-gender"
                                                        class="custom-form__control custom-form__control-select"
                                                        required
                                                        data-parsley-required-message="sorry, this entry is required."
                                                        data-parsley-error-message="sorry, you need to chose your gender."
                                                        data-parsley-trigger="change">
                                                    <option value="">gender</option>
                                                    <option {{$activeUser->user_gender == 'm' ? 'selected' : '' }} value="male">
                                                        male
                                                    </option>
                                                    <option {{$activeUser->user_gender == 'f' ? 'selected' : '' }} value="female">
                                                        female
                                                    </option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 row profile-infos__item">
                                        <div class="col-12 ">
                                            <label class="w-100">
                                                <span class="field-title__inputs">Date Of Birth <span
                                                            style="color: red">*</span></span>
                                                <input
                                                        type="date" id="user-birth"
                                                        class="w-100 custom-form__control"
                                                        value="{{$activeUser->user_dateOfBirth ?? ''}}"
                                                        required
                                                        data-parsley-type="date"
                                                        data-parsley-required-message="sorry, this entry is required."
                                                        data-parsley-trigger="change"
                                                >
                                            </label>
                                        </div>
                                    </div>
                                    @if($activeUser->user_compteEtat  === 'active')
                                        <button type="button" id="save-user-infos"
                                                class="base-button icon-button shadow d-flex justify-content-center">
                                            <span class="material-icons">done</span>
                                        </button>
                                    @endif

                                </div>

                            </form>
                        </div>
                    </div>
                    <hr class="my-4">

                    <div id="ui" class="settings-item settings-item__security flex-xl-row flex-column">
                        <div class="settings-item__header  ui-header">
                            <div class="ui-header__title settings-header__title">Ui Prefreences</div>
                        </div>
                        <div class=" settings-item_content ui-content ">
                            <div class="row ui-content_item settings-content__item">
                                <div class="col-12 ui-settings__item  ">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="field-title">Toggle Side Bar Always</span>
                                        <label class="switch" id="get-notification">
                                            <input
                                                    class="myCheckbox"
                                                    @if(isset($settings->toggle_sidebar) && $settings->toggle_sidebar === 1)
                                                    checked
                                                    @endif
                                                    type="checkbox"
                                                    id="toggle-sidebar"

                                            >
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                @if($activeUser->user_compteEtat  === 'active')
                                    <div class="col-12 ui-settings__item  ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="field-title">Hide Notifications</span>
                                            <label class="switch" id="get-notification">
                                                <input
                                                        class="myCheckbox"
                                                        @if(isset($settings->hide_notification) && $settings->hide_notification === 1)
                                                        checked
                                                        @endif
                                                        type="checkbox"
                                                        id="hide-notifications">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                    <hr class="my-4">

                    <div id="notification" class="settings-item settings-item__notifications flex-xl-row flex-column">
                        <div class="settings-item__header  notifications-header">
                            <div class="notifications-header__title settings-header__title">Notifications</div>
                        </div>
                        <div class="settings-item_content notifications-content ">
                            <div class="row notifications-content_item settings-content__item">

                                @if($activeUser->user_compteEtat  === 'active')
                                    <div class="col-12 notifications-settings__item ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="field-title">when i send request</span>
                                            <label class="switch" id="get-notification">
                                                <input
                                                        class="myCheckbox"
                                                        @if(isset($settings->notifiy_when_user_send_request) and $settings->notifiy_when_user_send_request === 1)
                                                        checked
                                                        @endif
                                                        type="checkbox"
                                                        id="notify-self-send">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 notifications-settings__item  ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="field-title">when admin send feedback</span>
                                            <label class="switch" id="get-notification">
                                                <input
                                                        class="myCheckbox"
                                                        @if(isset($settings->notifiy_when_admin_send_feedback) and $settings->notifiy_when_admin_send_feedback === 1)
                                                        checked
                                                        @endif
                                                        type="checkbox"
                                                        id="notify-feedback"

                                                >
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12 notifications-settings__item ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="field-title">when my account activated or disactivate</span>
                                            <label class="switch" id="get-notification">
                                                <input
                                                        class="myCheckbox"
                                                        @if(isset($settings->notify_when_account_change) && $settings->notify_when_account_change === 1)
                                                        checked
                                                        @endif
                                                        type="checkbox"
                                                        id="notify-account-change">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                <div class="col-12 notifications-settings__item ">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="field-title">when my security infos changing</span>
                                        <label class="switch" id="get-notification">
                                            <input
                                                    class="myCheckbox"
                                                    @if(isset($settings->notifiy_when_securuty_info_changed) and $settings->notifiy_when_securuty_info_changed === 1)
                                                    checked
                                                    @endif
                                                    type="checkbox"
                                                    id="notify-password-change"

                                            >
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div id="security" class="settings-item settings-item__security flex-xl-row flex-column">
                        <div class="settings-item__header  security-header">
                            <div class="security-header__title settings-header__title">Password & Security</div>
                        </div>
                        <div class="settings-item_content security-content ">

                            <div class="settings-content__item security-content__items">

                                <form action="" id="security-data-form">
                                    <div class="alert alert-dismissible  errors-messages d-none" role="alert">
                                        <strong class="modal-error-title">error</strong>
                                        <span class="modal-error-body">fuck you </span>
                                    </div>
                                    <div class="col-12 row   security-content__item">
                                        <div class="col-12">
                                            <label class="w-100">
                                                <span class="field-title__inputs">Email<span style="color: red">*</span></span>
                                                <input
                                                        type="text"
                                                        id="user-email"
                                                        class="w-100 custom-form__control"
                                                        value="{{$activeUser->user_email ?? ''}}"
                                                        required
                                                        maxlength="100"
                                                        minlength="5"
                                                        data-parsley-type="email"
                                                        data-parsley-error-message="sorry ,this entry can only contain a valid email like(name@domain.com).."
                                                        data-parsley-required-message="sorry, this entry is required."
                                                        data-parsley-trigger="keyup"
                                                >

                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12  row  security-content__item">
                                        <div class="col-12 ">
                                            <label class="w-100 password-container ">
                                                <span class="field-title__inputs">Password <span
                                                            style="color: red">*</span></span>
                                                <input
                                                        type="password" id="user-password"
                                                        class="w-100 custom-form__control"
                                                        value="{{$activeUser->password ?? ''}}"
{{--                                                        required--}}
{{--                                                        data-parsley-pattern="/^(?:(?:(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]))|(?:(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[a-z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))).{8,32}$/"--}}
{{--                                                        data-parsley-required-message="sorry, this entry is required."--}}
{{--                                                        data-parsley-error-message="sorry, you need to entre strong password contains (number,letters) upper and lower case."--}}
{{--                                                        maxlength="50"--}}
{{--                                                        minlength="5"--}}
{{--                                                        data-parsley-trigger="keyup"--}}
                                                >

                                                <span class="material-icons toggle-password">visibility_off</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 row   security-content__item">
                                        <div class="col-12 col-sm-6 ">
                                            <label class="w-100">
                                                <span class="field-title__inputs">Question Secret <span
                                                            style="color: red">*</span></span>
                                                <input
                                                        type="text" id="user-question"
                                                        class="w-100 custom-form__control"
                                                        value="{{$activeUser->user_secretQuestion ?? ''}}"
                                                        required
                                                        minlength="1"
                                                        maxlength="100"
                                                        data-parsley-pattern="/^[a-zA-Z0-9\s.,:-_()?!]*$/"
                                                        data-parsley-required-message="sorry, this entry is required."
                                                        data-parsley-error-message="sorry, you need to entre a question."
                                                        data-parsley-trigger="keyup">
                                            </label>
                                        </div>
                                        <div class="col-12 col-sm-6 ">
                                            <label class="w-100">
                                                <span class="field-title__inputs">Response <span
                                                            style="color: red">*</span></span>
                                                <input
                                                        type="text" id="user-response"
                                                        class="w-100 custom-form__control"
                                                        value="{{$activeUser->user_Response ?? ''}}"
                                                        required
                                                        minlength="1"
                                                        maxlength="100"
                                                        data-parsley-pattern="/^[a-zA-Z0-9\s.,:-_()?!]*$/"
                                                        data-parsley-required-message="sorry, this entry is required."
                                                        data-parsley-error-message="sorry, you need to entre a response."
                                                        data-parsley-trigger="keyup"

                                                >
                                            </label>
                                        </div>
                                    </div>

                                    @if($activeUser->user_compteEtat  === 'active')
                                        <button type="button" id="save-user-security-data"
                                                class="icon-button base-button shadow d-flex justify-content-center">
                                            <span class="material-icons">done</span>
                                        </button>

                                    @endif

                                </form>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection
<!-- end main content  -->













































































