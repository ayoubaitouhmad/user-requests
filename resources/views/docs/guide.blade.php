<!-- import template --->
@extends('user.layout.index_base')
<!-- page title --->
@section('title','Simple Guide')
<!-- page identifier --->
@section('page-id','admin-guide')


@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper ">
                <div class="guide-wrapper d-flex justify-content-center h-100  align-items-center">

                        <div class="container ">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center  align-items-start pb-3 mr-3 ml-3 ">
                                <blockquote class="blockquote">
                                    <h5 class="">How to get started </h5>
                                    <footer class="blockquote-footer">Simple and easy <cite title="Source Title">
                                            <mark>guide</mark>
                                        </cite></footer>
                                </blockquote>
                                <small class="text-muted align-self-end align-self-md-center">Here's quick overview of how to get started</small>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-12 col-md-4 ">
                                    <div class="card p-2  stretch-card">
                                        <div class="card-body  position-relative rounded bg-white">
                                            <span class="position-absolute card-indexer">1</span>

                                            <span class="guide-title ">Create admin acount</span>
                                            <p class="pt-3 guide-text">
                                                Create your admin account by adding name,username and email , you can
                                                also add your profile photo in your settings/profile after registring.
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 col-md-4 ">
                                    <div class="card p-2  stretch-card">
                                        <div class="card-body  position-relative rounded bg-white">
                                            <span class="position-absolute card-indexer">2</span>

                                            <span class="guide-title ">Share web site link with users</span>
                                            <p class="pt-3 guide-text">
                                                Next step is sharing our web site link with your users , in our landing
                                                page
                                                we provide <strong>login/signup</strong> for your users.
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 col-md-4 ">
                                    <div class="card p-2  stretch-card">
                                        <div class="card-body  position-relative rounded bg-white">
                                            <span class="position-absolute card-indexer">3</span>

                                            <span class="guide-title ">All done</span>
                                            <p class="pt-3 guide-text">
                                                Now you are ready to start, in your dashboard you will find all what you
                                                need
                                                to handle users and user requests easy and fast. <br>
                                                <mark>Thank you !</mark>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class=" text-center pt-3 pb-3 ">
                                <a href="/get-started/admin-infos" class="base-button rounded round p-2 pr-4 pl-4 text-white">Let's go</a>
                            </div>
                        </div>



                </div>

            </div>
        </div>
    </div>
@endsection