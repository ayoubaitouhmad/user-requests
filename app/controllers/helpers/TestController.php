<?php

namespace App\controllers\helpers;

use App\classes\CSRF;
use App\classes\fbLogin;
use App\interfaces\Controller;
use App\models\AdminNotification;
use App\models\UserNotification;
use Pusher\Pusher;


class TestController implements Controller
{
	
	
	public function index()
	{
		$token = new CSRF();
		$token = $token->token();
		return view('test/test' , compact('token'));
	}
	
	
	
	
	public function login(){
		fbLogin::login();
	}
	
	
}