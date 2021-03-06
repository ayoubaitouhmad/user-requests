<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/img/icon.svg">
    <link rel="stylesheet" href="/css/app.css?=<?php echo time();?>">
    <title>@yield('title')</title>

</head>
<body page-id="@yield('page-id')"  page-token="{{$token}}" class="preload @if(isset($settings->toggle_sidebar)) {{$settings->toggle_sidebar === 1 ? 'sidebar-icon-only' : ''}} @endif @yield('body-class') ">
<div class="app">

    @yield('bootstrap-modals')
    {{-- navbar --}}
    @include('inc.admin.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper ">
        <!-- partial-->
        @include('inc.admin.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<audio id="audio" src="/sound/notification/notify.ogg" controls style="display: none"></audio>
<script src="/js/app.js?v=<?php echo time();?>"></script>


</body>
</html>