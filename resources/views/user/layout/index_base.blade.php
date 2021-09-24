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
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
            <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                <a class="navbar-brand brand-logo" href="/admin">
                    <img class="brand-logo__img"
                         src="/img/logo_svg.svg"
                         alt="">
                </a>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <a href="/user/login" class=" btn-login">login</a>
            <a href="/user/signup" class=" btn-login">sign up</a>
            <a href="" class=" btn-help" style="background-color: #3E348C !important;color: white !important;">Help
            </a>
        </div>
    </nav>


    @yield('content')


</div>


<script src="/js/app.js"></script>
