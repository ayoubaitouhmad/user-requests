<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/img/icon.svg">
    <link rel="stylesheet" href="/css/app.css?=<?php echo time();?>">
    <title>Login</title>
</head>
<body page-id="admin-login" page-token="{{$token ?? ''}}">
    <div class="container-fluid d-flex flex-column justify-content-center align-items-center h-100">
    <div class="card shadow">
        <div class="card-body">
            <div class="login-container">
                <div class="login-container__header">
                    <span class="container-title">
                        Login
                    </span>
                    <hr class="my-2">

                    <div  class="alert alert-dismissible d-none errors-messages"  role="alert">
                        <strong class="modal-error-title"></strong>
                        <span class="modal-error-body"></span>
                    </div>
                </div>

                <div class="login-container__content">
                    <form action="" class="login-container__form d-flex flex-column" id="login-form">
                        <div class="form-item">
                            <input autocomplete="on" type="text" placeholder="Email"  required class=" form-item__data form-item__data-email">
                            <span class="material-icons">email</span>
                        </div>
                        <div class="form-item">

                            <input autocomplete="on" type="password" placeholder="Password" required class=" form-item__data form-item__data-password">
                            <span class="material-icons">lock</span>
                        </div>
                        <div class="form-item text-center">
                            <input type="submit" placeholder="submit" class="form-item__submit">
                        </div>
                    </form>

                </div>
                <hr class="my-2">
                <div class="login-container__footer">
                    <a href="" class="float-right">forget password</a>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="/js/app.js"></script>
</body>
</html>