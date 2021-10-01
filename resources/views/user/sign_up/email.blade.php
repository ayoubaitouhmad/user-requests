<!-- import template --->
@extends('user.layout.index_base')
<!-- page title --->
@section('title','Email Confirmation')
<!-- page identifier --->
@section('page-id','user-signup-email')


@section('content')
    <div class="container-fluid d-flex flex-column justify-content-center align-items-center h-100">
        <div class="card shadow">
            <div class="logo d-flex  justify-content-center align-items-center ">
                <img style="height: 4rem " class="img-fluid preload-img" data-src="/img/logo.svg" alt="">
            </div>
            <div class="card-body">
                <div class="signup-container">
                    <div class="signup-container__header">
                        <div class="header-up">
                           <span class="container-title ">
                        We have <span class="bg-success p-1 text-white">send</span> a code to your email below ,  enter the code to conferm your email.
                          </span>
                            <input style="display: block; width: 100%; padding: .5rem 1rem; margin: 1rem 0; border: 0;background-color: silver;color: white;"
                                   type="text" class="disabled" name="" value="{{$emailV ?? ''}}" disabled id="">
                        </div>

                        <hr class="my-2">

                        <div class="alert alert-dismissible d-none errors-messages" role="alert">
                            <strong class="modal-error-title"></strong>
                            <span class="modal-error-body"></span>
                        </div>
                    </div>

                    <div class="signup-container__content">
                        <form action="" class="signup-container__form d-flex flex-column" id="signup-form-complete">
                            <div class="form-item">
                                <input type="number"
                                       maxlength="6" minlength="6"
                                       placeholder="validation code"
                                       value=""
                                       class=" form-item__data form-item__data-code"
                                       required
                                       data-parsley-pattern="^\d{1,6}$"
                                       data-parsley-required-message="Confirmation code is required"
                                       data-parsley-trigger="keyup"
                                >
                                <span class="material-icons">vpn_key</span>
                            </div>

                            <div class="form-item text-center">
                                <input type="submit" placeholder="submit" class="base-button form-item__submit">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection