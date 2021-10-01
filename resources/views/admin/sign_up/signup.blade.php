<!-- import template --->
@extends('user.layout.index_base')
<!-- page title --->
@section('title','Admin Accout')
<!-- page identifier --->
@section('page-id','admin-signup')


@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">

            <div class="content-wrapper d-flex justify-content-center align-items-center  position-relative ">
                <div class="signup-wrapper d-flex  justify-content-center h-100  align-items-center">
                    <div class="container ">

                        <div class="card p-2  stretch-card">
                            <div class="card-body pb-0  position-relative rounded bg-white">
                                <div class="row">
                                    <div class="col-12 pt-md-0 pt-0 col-md-5 order-0 order-md-1">

                                        <div class="h-100  w-100">
                                            <img class="h-100 w-100" src="/img/vectors/signup8.svg?v={{time()}}" alt="">
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-7 pr-sm-0 pl-sm-0 pb-0">
                                        <form id="formData" class="" action="">
                                            <span class="form-title pl-4 mb-2">Sign up</span>

                                            <div class="container  p-0 pt-sm-3">
                                                <div class="alert  alert-dismissible  d-none errors-messages mr-0 ml-0  mr-sm-5 ml-sm-5"
                                                     role="alert">
                                                    <strong class="modal-error-title"></strong>
                                                    <span class="modal-error-body"></span>
                                                </div>
                                                <div class="row form-item pb-0  pr-sm-5 pl-sm-5 pr-0 pl-0 pb-sm-0   ">
                                                    <label class="w-100 w-100 col-12  col-sm-6 pb-0 pb-sm-3">
                                                        <span class="text-muted input-title">First name</span> <span
                                                                class="text-danger">*</span>
                                                        <input
                                                                type="text"
                                                                required
                                                                class="custom-form__control "
                                                                id="input-fname"
                                                                value="sdfsdf"
                                                                data-parsley-pattern="/^[a-zA-Z\s]+$/"
                                                                data-parsley-required-message="name is required"
                                                                data-parsley-error-message="sorry, this entry can only contain character and spaces."
                                                                data-parsley-maxlength="150"
                                                                data-parsley-trigger="keyup"
                                                        >
                                                    </label>
                                                    <label class="w-100 w-100 col-12 col-sm-6 pb-0 pb-sm-3 ">
                                                        <span class="text-muted input-title">Last name</span> <span
                                                                class="text-danger">*</span>
                                                        <input
                                                                type="text"
                                                                required
                                                                class="custom-form__control "
                                                                id="input-lname"
                                                                value="sdfsdf"
                                                                data-parsley-pattern="/^[a-zA-Z\s]+$/"
                                                                data-parsley-required-message="name is required"
                                                                data-parsley-error-message="sorry, this entry can only contain character and spaces."
                                                                data-parsley-maxlength="150"
                                                                data-parsley-trigger="keyup"
                                                        >
                                                    </label>
                                                </div>
                                                <div class="form-item pr-sm-5 pl-sm-5 pr-0 pl-0   pb-3        ">
                                                    <label class="w-100 pr-1">
                                                        <span class="text-muted input-title">Username</span> <span
                                                                class="text-danger">*</span>
                                                        <input
                                                                type="text"
                                                                class="custom-form__control "
                                                                required
                                                                value="sdfsddsff"
                                                                id="input-username"
                                                                data-parsley-pattern="/^(?=[a-zA-Z0-9._]{8,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/"
                                                                data-parsley-required-message="name is required"
                                                                data-parsley-error-message="sorry, this entry can only contain character and spaces."
                                                                data-parsley-maxlength="150"
                                                                data-parsley-trigger="keyup"
                                                        >
                                                    </label>

                                                </div>
                                                <div class="form-item pr-sm-5 pl-sm-5 pr-0 pl-0   pb-3         ">
                                                    <label class="w-100 pr-1">

                                                        <span class="text-muted input-title"> <span>Phone number</span> </span>
                                                        <input
                                                                type="text"
                                                                required
                                                                class="custom-form__control "
                                                                id="input-phone"
                                                                value="0606060603"
                                                                data-parsley-type="number"
                                                                data-parsley-required-message="sorry , this entry can only contain 10 number (Ex : 0606060606)"
                                                                data-parsley-maxlength="10"
                                                                data-parsley-minlength="10"
                                                                data-parsley-trigger="keyup"
                                                        >
                                                    </label>

                                                </div>
                                                <div class="form-item pr-sm-5 pl-sm-5 pr-0 pl-0   pb-3         ">
                                                    <label class="w-100 pr-1">
                                                        <span class="text-muted input-title">Email</span> <span
                                                                class="text-danger">*</span>
                                                        <input
                                                                type="text"
                                                                required
                                                                class="custom-form__control "
                                                                id="input-email"
                                                                value="sdfsdf@dsgfdg.com"
                                                                data-parsley-type="email"
                                                                data-parsley-required-message="email is required"
                                                                data-parsley-error-message="sorry , enter a valid email like(name@domain.com)."
                                                                data-parsley-trigger="keyup"
                                                        >
                                                    </label>

                                                </div>
                                                <div class="form-item pr-sm-5 pl-sm-5 pr-0 pl-0   pb-3         ">
                                                    <label class="w-100 pr-1">
                                                        <span class="text-muted input-title">Password</span> <span
                                                                class="text-danger">*</span>
                                                        <input
                                                                type="text"
                                                                class="custom-form__control "
                                                                id="input-password"
                                                                value="sdfsddsfsdf@777_Df"
                                                                required
                                                                data-parsley-pattern="^(?:(?:(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]))|(?:(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[a-z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))).{8,32}$"
                                                                data-parsley-required-message="password is required"
                                                                data-parsley-error-message="sorry, for your safety we can't accept this password , you need to use strong password."
                                                                data-parsley-trigger="keyup"

                                                        >
                                                    </label>

                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=" text-center pt-2 pb-3 ">
                            <a href="#" id="submit"  class="base-button rounded round  p-2 pr-4 pl-4 text-white">Next</a>
                        </div>
                    </div>
                </div>
                <div class="emailConfirmation-wrapper  d-flex justify-content-center h-100  align-items-center">
                    <div class="container pr-3 pl-3">
                        <div class="card p-2  stretch-card">
                            <div class="card-body pb-0 pr-0 pl-0 pt-0   pr-sm-5 pl-sm-5  position-relative rounded bg-white">
                                <div class="row justify-content-center align-items-center flex-column">
                                    <div class="col-12 pb-3 col-md-5 order-0">
                                        <div class="h-75 ml-auto mr-auto w-75">
                                            <img class="h-100 w-100" src="/img/vectors/mail.svg?v={{time()}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-12 pb-0 col-md-7 ">
                                        <div class="text-center">
                                            <span class="title"> Confirm your email address</span>
                                            <p class="text">
                                                We have sent an email with a confirmation code to your email address. In
                                                order to complete the sign-up process, copy and past code below.

                                            </p>
                                        </div>
                                        <form id="formDataCode" class="" action="">

                                            <div class="container pt-3">
                                                <div class="alert  alert-dismissible  d-none  errors-messages "
                                                     role="alert">
                                                    <strong class="modal-error-title"></strong>
                                                    <span class="modal-error-body"></span>
                                                </div>
                                                <div class="form-item  justify-content-center align-items-center h-100 d-flex pb-3">
                                                    <label class="w-100 pl-1">
                                                        <span class="text-muted input-title">Confirmation code  <span class="text-danger">*</span></span>
                                                        <input
                                                                type="number"
                                                                required
                                                                class="custom-form__control "
                                                                id="input-code"
                                                                data-parsley-required-message="Confirmation code"
                                                                data-parsley-error-message="sorry, this entry can only contain numbers and 6 digits."
                                                                minlength="6"
                                                                maxlength="6"
                                                                data-parsley-trigger="keyup"
                                                        >
                                                    </label>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=" text-center pt-sm-2 pt-0  pb-3 ">
                            <a href="#" id="submit-formDataCode"
                               class="base-button rounded round p-2 pr-4 pl-4 text-white">Go</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection