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
    @include('inc.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial-->
        @include('inc.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
</div>


{{--<script src="/js/plugins.js"></script>--}}
<script src="/js/app.js"></script>
{{--<script src="/js/all.js"></script>--}}
<script>



















</script>
</body>
</html>