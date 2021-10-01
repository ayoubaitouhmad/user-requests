<!-- import template --->
@extends('user.layout.index_base')
<!-- page title --->
@section('title','Sign up')
<!-- page identifier --->
@section('page-id','user-signup')


@section('content')
    <div class="container-fluid page-body-wrapper ">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container-fluid d-flex flex-column justify-content-center align-items-center h-100 shadow">
                    <div class="container d-flex justify-content-center align-items-center">
                        <div class="card shadow">
                            <div class="card-body shadow bg-white rounded">
                                <div class="signup-container">
                                    <div class="signup-container__header">
                    <span class="container-title">
                        sign up
                    </span>
                                        <hr class="my-2">

                                        <div class="alert alert-dismissible d-none errors-messages" role="alert">
                                            <strong class="modal-error-title"></strong>
                                            <span class="modal-error-body"></span>
                                        </div>
                                    </div>

                                    <div class="signup-container__content">
                                        <form action="" class="signup-container__form d-flex flex-column" id="signup-form">
                                            <div class="form-item">
                                                <input autocomplete="on"
                                                       type="text" placeholder="Full Name"
                                                       class=" form-item__data form-item__data-name"
                                                       required
                                                       data-parsley-pattern="/^[a-zA-Z\s]+$/"
                                                       data-parsley-required-message="name is required"
                                                       data-parsley-error-message="sorry, this entry can only contain character and spaces."
                                                       data-parsley-maxlength="150"
                                                       data-parsley-trigger="keyup">
                                                <span class="material-icons">email</span>
                                            </div>

                                            <div class="form-item">
                                                <input autocomplete="on"
                                                       type="text" placeholder="Email"
                                                       class="form-item__data form-item__data-email"
                                                       required
                                                       data-parsley-type="email"
                                                       data-parsley-required-message="email is required"
                                                       data-parsley-error-message="sorry , enter a valid email like(name@domain.com)."
                                                       data-parsley-trigger="keyup">
                                                <span class="material-icons">email</span>
                                            </div>
                                            <div class="form-item">

                                                <input autocomplete="on"
                                                       type="text" placeholder="phone number"
                                                       class=" form-item__data form-item__data-phone"
                                                       required
                                                       data-parsley-type="number"
                                                       data-parsley-required-message="sorry , this entry can only contain 10 number (Ex : 0606060606)"
                                                       data-parsley-maxlength="10"
                                                       data-parsley-minlength="10"
                                                       data-parsley-trigger="keyup">
                                                <span class="material-icons">lock</span>

                                            </div>

                                            <div class="form-item">

                                                <input autocomplete="on"
                                                       type="text" placeholder="Password"
                                                       class=" form-item__data form-item__data-password"
                                                       required
                                                       data-parsley-pattern="^(?:(?:(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]))|(?:(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[a-z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))).{8,32}$"
                                                       data-parsley-required-message="password is required"
                                                       data-parsley-error-message="sorry, for your safety we can't accept this password , you need to use strong password."
                                                       data-parsley-trigger="keyup">
                                                <span class="material-icons">lock</span>
                                            </div>
                                            {{--                        <hr class="my-2">--}}
                                            {{--                        <label for="">--}}
                                            {{--                            or continue with :--}}

                                            {{--                        </label>--}}

                                            {{--                        <div class="form-item">--}}
                                            {{--                            <input autocomplete="on"--}}
                                            {{--                                   type="button" placeholder=""--}}
                                            {{--                                   value="google"--}}
                                            {{--                                   class="form-item__data form-item__btn-google">--}}
                                            {{--                            <span></span>--}}
                                            {{--                        </div>--}}

                                            {{--                        <div class="form-item">--}}
                                            {{--                            <input autocomplete="on"--}}
                                            {{--                                   type="button"--}}
                                            {{--                                   placeholder="" value="facebook"--}}
                                            {{--                                   class=" form-item__data form-item__btn-facebook">--}}
                                            {{--                            <span></span>--}}
                                            {{--                        </div>--}}

                                            <div class="form-item text-center">
                                                <input type="submit"
                                                       placeholder="submit"
                                                       class="form-item__submit base-button">
                                            </div>
                                        </form>
                                    </div>
                                    <hr class="my-2">
                                    <div class="signup-container__footer text-center">
                                        Already have an account? <a href="/user/login">Log In</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection