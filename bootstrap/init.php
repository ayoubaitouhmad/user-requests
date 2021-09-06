<?php
    //require all what we need here
	session_start();
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../app/routing/router.php';
    require_once __DIR__.'/../app/routing/RouteDispatcher.php';

    \Dotenv\Dotenv::createImmutable(__DIR__.'/../')->load();

    new \App\RouteDispatcher($router);



