<!-- import template --->
@extends('admin.base.org')
<!-- page title --->
@section('title','Admin dashboard - home')
<!-- page identifier --->
@section('page-id','admin-dashboard-home')

<!-- navbar infos -->
@section('admin-photo')
    {{  $admin->admin_photo }}
@endsection
@section('admin-name')
    {{$admin->admin_name ?? ''}}
@endsection
<!-- end navbar infos -->

<!-- notifications -->
@include('inc.adminNotification')
<!-- end notifications -->

<!-- main content  -->
@section('content')
    <!-- page indexer -->

    @include('inc.indexer' , ['page_src' => 'Home'])
    <div class="row m-3">
        @php
        $val = '(Note to teachers: The podcast contains accounts ? of physical and sexual abuse.
                    Please listen to the entire episode to make sure it is appropriate for your class.)';
            $d = '""';
            $option = array(
                                'options' => array('regexp' => "/^[a-zA-Z0-9\s.,:-_()?!]*$/")
                            );

                  var_dump(filter_var($val, FILTER_VALIDATE_REGEXP, $option) === $val);

                $word = "ddfdsfd";
                echo "$word";
        @endphp
    </div>



@endsection
<!-- end main content  -->










































































































