<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/img/icon.svg">
    <link rel="stylesheet" href="/css/app.css?=<?php echo time();?>">
    <title>Check Email</title>
</head>
<body page-id="user-reset-password"  page-token="{{$token ?? ''}}">

<div class="container-fluid d-flex flex-column justify-content-center align-items-center h-100">
    <div class="card shadow">
        <div  class="logo d-flex  justify-content-center align-items-center ">
            <img style="height: 5rem " class="img-fluid preload-img" data-src="/img/logo2.png" alt="">
        </div>
        <div class="card-body">
            <div class="container">
                <div class="container__header">
                    <div class="header-up d-none">
                           <span class="container-title ">
                        We have <span class="bg-success p-1 text-white">send</span> a code to your email below ,  enter the code to conferm your email.
                          </span>
                        <input style="display: block; width: 100%; padding: .5rem 1rem; margin: 1rem 0; border: 0;background-color: silver;color: white;"
                               type="text"
                               class="disabled"
                               name=""  disabled
                               id="user-email"
                               value=""
                               data-src="{{$_SESSION['user-to-reset']->user_secretQuestion ?? ''}}"
                        >
                    </div>


                    <div  class="alert alert-dismissible d-none errors-messages"  role="alert">
                        <strong class="modal-error-title"></strong>
                        <span class="modal-error-body"></span>
                    </div>
                </div>

                <hr class="my-2">
                <div class="container__content">
                    <form action="" class="container__form d-flex flex-column" id="reset-password">
                        <div class="form-item with-email">
                            <label for="data-container" class="data-container" >
                               <span class="data-container_title">Email</span>  <span style="color: red">*</span>
                            </label>
                            <input  type="email"
                                    id="data-container"
                                    maxlength="100"
                                    minlength="5"
                                    placeholder="Email"
                                    value=""
                                    class="form-item__data form-item__data-email"
                                    required
                                    data-parsley-required-message="Email is required"
                                    data-parsley-trigger="keyup"
                            >
                            <span class="material-icons input-ico">login</span>
                        </div>




                        <div class="form-item text-center">
                            <input type="submit"  id="next-step" input-action="check-email" value="Next" placeholder="Go" class="disabled base-button">
                        </div>


                        <hr class="my-2">
                        <div class="form-item__footer text-center d-none">
                            <a id="change-with-question" href="" class="">reset password with secret question?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/app.js?version=<?php echo time();?>"></script>
</body>
</html>