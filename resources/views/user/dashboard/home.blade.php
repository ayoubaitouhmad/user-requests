<!-- import template --->
@extends('user.layout.base')
<!-- page title --->
@section('title','home')
<!-- page identifier --->
@section('page-id','user-dashboard-home')




@include('inc.adminNotification')


<!-- main content  -->
@section('content')
    <!-- page indexer -->
    @include('inc.indexer' , ['page_src' => 'Home'])
    <div class="row m-3">
        @php
            $password = "123456789";
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            if(password_verify($password.'' , $hashed_password)){
            var_dump($hashed_password);

            }

        @endphp
    </div>
@endsection
<!-- end main content  -->
