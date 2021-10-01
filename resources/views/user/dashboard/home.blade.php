<!-- import template --->
@extends('user.layout.base')
<!-- page title --->
@section('title','home')
<!-- page identifier --->
@section('page-id','user-dashboard-home')




@include('inc.notifications')

@section('side-bar-home' , 'active-page')
<!-- main content  -->
@section('content')
    <!-- page indexer -->
    @include('inc.indexer' , ['page_src' => 'Home'])


@endsection
<!-- end main content  -->
