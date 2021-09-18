<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/img/user.png">
    <title>Document</title>
    <link rel="stylesheet" href="/css/app.css?=<?php echo time();?>">

</head>
<body class="m-5">
<h1>THIS PAGE FOR TESTING NEW STUFF.</h1>

<h2>{{$token}}</h2>

@php
var_dump($_SESSION['token']);
@endphp

<button id="click" class="d-block btn btn-success">click me</button>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $('#click').on('click' , function (){
        $('body').load('/test');
    });
</script>
</body>

</html>