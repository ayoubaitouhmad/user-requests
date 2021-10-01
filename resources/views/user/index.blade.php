<!-- import template --->
@extends('user.layout.index_base')
<!-- page title --->
@section('title','index')
<!-- page identifier --->
@section('page-id','user-index')


@section('content')


    <header class="banner banner-style">
        <div class="banner-bg banner-bg-gradient"></div>

        <div class="banner-content pt-10">
            <div class="container pr-0 pl-0 pr-sm-5 pl-sm-5  px-5">
                <div class="row  gx-5 align-items-center">
                    <div class="col-lg-6 order-1">
                        <img class="img-fluid" src="/img/vectors/home2.svg">
                    </div>
                    <div class="col-lg-6 pr-0 pl-0 pt-lg-0 pr-lg-0 pl-lg-0 pt-0 pb-5 pb-lg-0  ">
                        <h1 class="banner-title"> Handle users requests fast and easy</h1>
                        <p class="banner-text ">
                            In-depth website users requests provide fast and easy way to deal with users requests and
                            user
                            infos in real time,
                        </p>
                        <div class="text-center text-lg-left pt-2">

                        <a href="/get-started/admin-infos" class="text-dark bg-white pt-2 pb-2 pr-5 pl-5 h6 rounded mb-3 ">Go now</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <section class="features">
        <div class="container  ">
            <div class="row align-items-center">
                <div class="col-12  col-lg-4">
                    <div class="feature user-list">
                        <div class="feature-header">
                            <div class="img-container">
                                <span class="material-icons ico-users">groups</span>
                            </div>
                        </div>
                        <div class="feature-content ">
                            <h3 class="feature-content__title">
                                Users list
                            </h3>
                            <p class="feature-content__text">
                                User list contains all your users that are added to your organization. The new user
                                list has a refreshed view , we’ve simplified the information that is visible about your
                                users.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-12  col-lg-4">
                    <div class="feature requests-list">
                        <div class="feature-header">
                            <div class="img-container">
                                <span class="material-icons header-ico ico-requests">receipt_long</span>
                            </div>
                        </div>
                        <div class="feature-content">
                            <h3 class="feature-content__title">
                                Requests List
                            </h3>
                            <p class="feature-content__text">
                                Its very important for both user and admin to get real time notification when an action
                                happening
                                new registration, new requests , user data changed and also when sensitive into reseted
                                like email or password.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12  col-lg-4">
                    <div class="feature security">
                        <div class="feature-header">
                            <div class="img-container">
                                <span class="material-icons header-ico ico-notifications">notifications</span>
                            </div>
                        </div>
                        <div class="feature-content">
                            <h3 class="feature-content__title">
                                Notification
                            </h3>
                            <p class="feature-content__text">
                                A notification is a message that pops up on the user's device. Notifications can be
                                triggered whene some action happend like adding new requests or for security reason.
                                thats gave users full control.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container ">
            <div class="row align-items-center">
                <div class="col-12  col-lg-4">
                    <div class="feature security-page">
                        <div class="feature-header">
                            <div class="img-container">
                                <span class="material-icons ico-security">verified_user</span>
                            </div>
                        </div>
                        <div class="feature-content">
                            <h3 class="feature-content__title">
                                Security
                            </h3>
                            <p class="feature-content__text">
                                Our team of highly skilled and experienced professionals to protect our clients
                                businesses, employees and organizations.
                                We ensure that the deployed security personnel have undergone a stringent training both
                                in handling security equipments.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12  col-lg-4">
                    <div class="feature statistique">
                        <div class="feature-header">
                            <div class="img-container">
                                <span class="material-icons header-ico ico-requests">devices</span>
                            </div>
                        </div>
                        <div class="feature-content">
                            <h3 class="feature-content__title">
                                Responsive Ui
                            </h3>
                            <p class="feature-content__text">
                                Responsive Web design is the approach that suggests that design and development
                                should respond to the user’s behavior and environment based on screen size, platform
                                and orientation. no mather what the device or the platform users are using.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-12  col-lg-4">
                    <div class="feature notifications">
                        <div class="feature-header">
                            <div class="img-container">
                                <span class="material-icons header-ico ico-settings">settings</span>
                            </div>
                        </div>
                        <div class="feature-content">
                            <h3 class="feature-content__title">
                                Settings
                            </h3>
                            <p class="feature-content__text">
                                Page settings provide an easy way to change the contents and Ui components of each of
                                your page in our website pages. The Page Setting make users change what they want to see
                                and
                                not hiding notification ,toggle sidebar also there infos and security data.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="container ">
            <div class="row align-items-center">
                <span class="col-12 col-lg-4"></span>
                <div class="col-12 col-lg-4">
                    <div class="feature setting-page">
                        <div class="feature-header">
                            <div class="img-container">
                                <span class="material-icons ico-statistics">insert_chart_outlined</span>
                            </div>
                        </div>
                        <div class="feature-content">
                            <h3 class="feature-content__title">
                                statistics
                            </h3>
                            <p class="feature-content__text">
                                The basic features of statistics as a quantitative or numerical data off any subject
                                user registration , number off requests for each month , percentage off user by work .
                                Statistics that help both user and admin to better understand their
                                what acualy is happend.
                            </p>
                        </div>
                    </div>
                </div>
                <span class="col-12 col-lg-4"></span>

            </div>
        </div>
    </section>

    <section class="project-overview">

    </section>

    <footer class="footer">
        <p>&copy; Copyright 2011. All Rights Reserved.</p>
    </footer>




@endsection