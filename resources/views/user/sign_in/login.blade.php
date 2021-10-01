<!-- import template --->
@extends('user.layout.index_base')
<!-- page title --->
@section('title','Admin Accout')
<!-- page identifier --->
@section('page-id','user-login')


@section('content')
    <div class="container-fluid page-body-wrapper ">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container-fluid d-flex flex-column justify-content-center align-items-center h-100">

                    <div class="container d-flex justify-content-center align-items-center">
                        <div class="card shadow">
                            <div class="logo d-flex  justify-content-center align-items-center ">
                                <img style="height: 5rem " class="img-fluid preload-img" data-src="/img/logo.svg" alt="">
                            </div>
                            <div class="card-body">
                                <div class="login-container">
                                    <div class="login-container__header">
                                        <div class="header-up">
                           <span class="container-title ">
                               <strong> Welcome again !! </strong>, Entre your credentials please
                          </span>
                                        </div>

                                        <hr class="my-2">

                                        <div class="alert alert-dismissible d-none errors-messages" role="alert">
                                            <strong class="modal-error-title"></strong>
                                            <span class="modal-error-body"></span>
                                        </div>
                                    </div>
                                    <div class="login-container__content">
                                        <form action="" class="login-container__form d-flex flex-column" id="login-form">
                                            <div class="form-item">
                                                <label>
                                                    Email <span style="color: red">*</span>
                                                    <input
                                                            type="text"
                                                            placeholder="Email"
                                                            required
                                                            class="form-item__data form-item__data-email"
                                                            data-parsley-type="email"
                                                            data-parsley-required-message="sorry , enter a valid email like(name@domain.com)."
                                                            data-parsley-trigger="keyup"
                                                    >
                                                </label>
                                                <span class="material-icons input-ico">email</span>
                                            </div>

                                            <div class="form-item">

                                                <label class="password-container">
                                                    password <span style="color: red">*</span>
                                                    <input
                                                            type="password"
                                                            placeholder="Password"
                                                            class=" form-item__data form-item__data-password"
                                                            required
                                                            data-parsley-required-message="password is required"
                                                            data-parsley-pattern="^(?:(?:(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]))|(?:(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[a-z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))).{8,32}$"
                                                            data-parsley-error-message="sorry, this entry can only contain character,numbers and spaces."
                                                            data-parsley-maxlength="100"
                                                            data-parsley-trigger="keyup">
                                                    <span class="material-icons input-ico">lock</span>
                                                    <span class="material-icons toggle-password">visibility_off</span>
                                                </label>
                                            </div>
                                            <div class="form-item text-center">
                                                <input type="submit" placeholder="submit" class="form-item__submit base-button">
                                            </div>
                                        </form>
                                    </div>

                                    <hr class="my-2 invisible">

                                    <div class="login-container__footer text-center">
                                        or
                                        <a href="/user/login/reset/password" class="">forget password</a>

                                        <hr class="my-4">

                                        Don't have an account? <a href="/user/signup" class="">Sign up </a>
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