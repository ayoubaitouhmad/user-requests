
<!-- import template --->
@extends('user.layout.index_base')
<!-- page title --->
@section('title','Admin Accout')
<!-- page identifier --->
@section('page-id','admin-login')

@section('content')
    <div class="container-fluid page-body-wrapper ">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container-fluid d-flex flex-column justify-content-center align-items-center h-100">
                    <div class="container d-flex justify-content-center align-items-center">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="login-container">
                                    <div class="login-container__header">
                        <span class="container-title">
                            Login
                        </span>
                                        <hr class="my-2">

                                        <div class="alert alert-dismissible d-none errors-messages" role="alert">
                                            <strong class="modal-error-title"></strong>
                                            <span class="modal-error-body"></span>
                                        </div>
                                    </div>

                                    <div class="login-container__content">
                                        <form action="" class="login-container__form d-flex flex-column" id="login-form">
                                            <div class="form-item">
                                                <input autocomplete="on" type="text" placeholder="Email" required
                                                       class=" form-item__data form-item__data-email">
                                                <span class="material-icons">email</span>
                                            </div>
                                            <div class="form-item">

                                                <input autocomplete="on" type="password" placeholder="Password" required
                                                       class=" form-item__data form-item__data-password">
                                                <span class="material-icons">lock</span>
                                            </div>
                                            <div class="form-item text-center">
                                                <input type="submit" placeholder="submit" class="form-item__submit">
                                            </div>
                                        </form>

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