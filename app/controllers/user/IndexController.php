<?php
	
	namespace App\controllers\user;
	
	use App\classes\Redirect;
	use App\classes\Session;
	use App\interfaces\Controller;
	use App\models\Admin;
	
	class IndexController implements Controller
	{
		
		public function __construct()
		{
			if(Session::has('user-connected')){
				Redirect::To('/user/dashboard');
			}
		}
		
		
		
		public function index()
		{
			$admin = new Admin();
			$admin->addIp();
//			Session::add('user-connected' , 'ddgfd');
			return view('user/index');
		}
		
		
	}