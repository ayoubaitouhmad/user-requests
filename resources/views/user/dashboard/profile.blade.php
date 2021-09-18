<!-- import template --->
@extends('user.layout.base')
<!-- page title --->
@section('title','home')
<!-- page identifier --->
@section('page-id','user-dashboard-profile')


<!-- navbar infos -->
@if(isset($activeUser) )
@section('user-photo')
    {{  $activeUser->user_photo ?? ''}}
@endsection
@section('user-name')
    {{$activeUser->user_fullname ?? ''}}
@endsection
@endif
<!-- end navbar infos -->

@include('inc.adminNotification')


<!-- main content  -->
@section('content')
    <!-- page indexer -->
    @include('inc.indexer' ,  ['page_src' => 'Dashboard /','page_index' => 'Profile'])

@endsection
<!-- end main content  -->
