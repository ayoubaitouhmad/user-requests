<!-- import template --->
@extends('user.layout.base')

@section('page-id','testing')

@section('content')
    <!-- page indexer -->
    @include('inc.indexer' ,  ['page_index' => 'test'])
    <div class="row d-flex justify-content-center align-items-center h-100">
        <a href="" id="click" class="btn btn-info">click</a>
    </div>
@endsection