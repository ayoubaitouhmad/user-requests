@extends('admin.layout.org')
@section('title','app')
@section('page-id','users')
@section('admin-photo')
    {{  $admin['photo'] ?? ''}}
@endsection

@section('admin-name')
    {{$admin['name'] ?? ''}}
@endsection
@section('content')

    <div class="row">
        @php
            echo '<pre>';
           var_dump($admin);
        @endphp
    </div>




@endsection

























































































































