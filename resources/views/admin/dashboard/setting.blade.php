

<!-- import template --->
@extends('admin.base.org')
<!-- page title --->
@section('title','Admin dashboard - Settings')
<!-- page identifier --->
@section('page-id','admin-dashboard-settings')



<!-- notifications -->
@include('inc.notifications')

<!-- end notifications -->

<!-- main content  -->
@section('content')
    <!-- page indexer -->

    <div class="row m-2">
        @php
        var_dump(date('Y') - 18 - 40 . '-01-01'  )
        @endphp
    </div>
    @include('inc.indexer' , ['page_src' => 'Dashboard' , 'sep' => '|'  , 'page_index'=>'Settings'])





    <div class="row settings">
        <div class="col-12 col-md-3  col-xl-2    settings-row  settings-row__header">
            <div class="settings-row__list">
                <div class="card ">
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
            <div class="card">
                <div class="settings-items">
                    <div id="profile" class="settings-item settings-item__profile flex-xl-row flex-column">
                        <div class="settings-item__header  profile-header">
                            <div class="profile-header__title settings-header__title">Edit Profile</div>
                        </div>
                        <div class="settings-item_content profile-content ">
                            <form id="profile-data-form" action="">
                                <div class="alert alert-dismissible  errors-messages d-none" role="alert">
                                    <strong class="modal-error-title"></strong>
                                    <span class="modal-error-body"></span>
                                </div>

                                <div class="profile-content__avatar settings-content__item d-flex flex-column justify-content-start align-items-center">
                                    <div class="custom-uploader">
                                        <img class="custom-uploader__img preload-img"
                                             data-src="{{$admin->admin_photo !== null && $admin->admin_photo !== "" ? $admin->admin_photo : '/img/unknown.png'}}"
                                             alt="">
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
                                    </div>
                                    <button type="button" id="save-user-avatar"
                                            class="icon-button shadow d-flex justify-content-center">
                                        <span class="material-icons">done</span>
                                    </button>

                                </div>

                                <div class="row profile-content__infos settings-content__item">
                                    <div class="col-12 row profile-infos__item">
                                        <div class="col-12 col-sm-6 ">
                                            <label class="w-100">
                                                <span class="field-title__inputs">First Name<span
                                                            style="color: red">*</span></span>
                                                <input
                                                        type="text"
                                                        id="user-first-name"
                                                        class="w-100 custom-form__control"
                                                        value="{{isset($admin->admin_name) ? implode(' ', array_slice(explode(' ', $admin->admin_name), 0, 1)) : ''}}"

                                                        minlength="2"
                                                        maxlength="25"
                                                        data-parsley-pattern="/^[a-zA-Z\s]+$/"
                                                        data-parsley-error-message="sorry, this entry can only contain character and spaces."
                                                        data-parsley-trigger="keyup">
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
                                                        value="{{isset($admin->admin_name) ? implode(' ', array_slice(explode(' ', $admin->admin_name), 1, 2)) : ''}}"

                                                        minlength="2"
                                                        maxlength="25"
                                                        data-parsley-pattern="/^[a-zA-Z\s]+$/"
                                                        data-parsley-error-message="sorry, this entry can only contain character and spaces."
                                                        data-parsley-trigger="keyup"
                                                >
                                            </label>
                                        </div>

                                    </div>


                                    <button type="button" id="save-user-infos"
                                            class="icon-button shadow d-flex justify-content-center">
                                        <span class="material-icons">done</span>
                                    </button>

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
                                <div class="col-12 ui-settings__item">
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
                                <div class="col-12 notifications-settings__item ">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="field-title">when new request send</span>
                                        <label class="switch" id="get-notification">
                                            <input
                                                    class="myCheckbox"

                                                    @if(isset($settings->notifiy_when_new_request) and $settings->notifiy_when_new_request === 1)
                                                    checked
                                                    @endif
                                                    type="checkbox"
                                                    id="new-request"

                                            >
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 notifications-settings__item  ">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="field-title">when new user registre</span>
                                        <label class="switch" id="get-notification">
                                            <input
                                                    class="myCheckbox"
                                                    @if(isset($settings->notifiy_when_new_registre) and $settings->notifiy_when_new_registre === 1)
                                                    checked
                                                    @endif
                                                    type="checkbox"
                                                    id="new-registre"

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
                                        <strong class="modal-error-title"></strong>
                                        <span class="modal-error-body"> </span>
                                    </div>
                                    <div class="col-12 row security-content__item">
                                        <div class="col-12">
                                            <label class="w-100">
                                                <span class="field-title__inputs">Username<span style="color: red">*</span></span>
                                                <input
                                                        type="text"
                                                        id="user-email"
                                                        class="w-100 custom-form__control"
                                                        value="{{$admin->admin_username ?? ''}}"
                                                        required
                                                        data-parsley-pattern="/^[a-zA-Z0-9_-]+$/"
                                                        data-parsley-required-message="sorry, this entry is required."
                                                        data-parsley-error-message="sorry, you need to entre valid username contains (number,letters) upper and lower case."
                                                        maxlength="50"
                                                        minlength="5"
                                                        data-parsley-trigger="keyup"
                                                >

                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12  row  security-content__item">
                                        <div class="col-12 ">
                                            <label class="w-100 password-container ">
                                                <span class="field-title__inputs">Password<span
                                                            style="color: red">*</span></span>
                                                <input
                                                        type="password" id="user-password"
                                                        class="w-100 custom-form__control"
                                                        value="{{$admin->admin_password ?? ''}}"
                                                        required
                                                        data-parsley-required-message="sorry, this entry is required."
                                                        data-parsley-error-message="sorry, you need to entre strong password contains (number,letters) upper and lower case."
                                                        maxlength="50"
                                                        minlength="5"
                                                        data-parsley-trigger="keyup">

                                                <span class="material-icons toggle-password">visibility_off</span>
                                            </label>
                                        </div>
                                    </div>


                                    <button type="button" id="save-user-security-data"
                                            class="icon-button shadow d-flex justify-content-center">
                                        <span class="material-icons">done</span>
                                    </button>


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











































































































