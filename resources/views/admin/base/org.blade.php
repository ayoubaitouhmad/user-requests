<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/img/user.png">
    <link rel="stylesheet" href="/css/app.css?=<?php echo time();?>">
    <title>@yield('title')</title>
</head>
<body page-id="@yield('page-id')"  page-token="{{$token}}" class="@yield('body-class') ">
<div class="app">

    @yield('bootstrap-modals')
    {{-- navbar --}}
    @include('inc.admin.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
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
<script src="/js/app.js?versio=<?php echo time();?>"></script>



</body>
</html>