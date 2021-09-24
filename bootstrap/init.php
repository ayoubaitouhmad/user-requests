<?php
    //require all what we need here
	use Dotenv\Dotenv;
	use App\routing\RouteDispatcher;
	
	session_start();
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../app/routing/RouteDispatcher.php';
    require_once __DIR__.'/../app/routing/router.php';

    Dotenv::createImmutable(__DIR__.'/../')->load();

    new RouteDispatcher($router);
    




