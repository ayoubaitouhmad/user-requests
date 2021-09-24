<!-- import template --->
@extends('admin.base.org')
<!-- page title --->
@section('title','Admin dashboard - home')
<!-- page identifier --->
@section('page-id','admin-dashboard-home')



<!-- notifications -->
@include('inc.notifications')

<!-- end notifications -->

<!-- main content  -->
@section('content')
    <!-- page indexer -->

    @include('inc.indexer' , ['page_src' => 'Home'])


@endsection
<!-- end main content  -->










































































































