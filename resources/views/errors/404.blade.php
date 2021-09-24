<!-- import template --->
@extends('user.layout.index_base')
<!-- page title --->
@section('title','Error 404')
<!-- page identifier --->
@section('page-id','errors-error-404')


@section('content')
    <div class="container error d-flex flex-column justify-content-center align-items-center h-100">
        <div class="error-header">
            <h1 class="error-header__title">404</h1>
        </div>
        <div class="error-content">
            <h6 class="error-content__title">Not Fount</h6>
        </div>
        <div class="error-footer ">
            <h3 class="error-footer__title">We can’t find the page you’re looking for</h3>

        </div>
    </div>
@endsection