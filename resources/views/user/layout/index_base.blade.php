<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/img/icon.svg">

    <link rel="stylesheet" href="/css/app.css?=<?php echo time();?>">

    <title>@yield('title')</title>
</head>
<body page-id="@yield('page-id')" page-token="{{$token ?? ''}}" class="@yield('body-class') ">
<div class="app index">
    {{-- navbar --}}
    <nav class="navbar position-fixed col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-wrapper d-flex justify-content-center">
            <div class="navbar-inner-wrapper d-flex justify-content-between align-items-center w-100">
                <a class=" brand-logo" href="/">
                    <img class="brand-logo__img"
                         src="/img/logo.svg"
                         alt="">
                </a>
            </div>
        </div>
        <span class="material-icons position-absolute ico-menu" id="toggle-navbar-wrapper-menu">menu</span>
        <div class="navbar-wrapper-menu  d-flex align-items-center justify-content-end">
            <a href="/user/login" class="btn-login">Login</a>
            <a href="/user/signup" class="btn-login">Sign up</a>
            <a href="/get-started/admin-infos" class="btn-help">Doc</a>
        </div>
    </nav>

    @yield('content')

</div>


<script src="/js/app.js?v={{time()}}"></script>