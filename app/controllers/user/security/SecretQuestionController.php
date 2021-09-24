<?php
	
	namespace App\controllers\user\security;
	
	use App\classes\base\Controller;
	use App\classes\Redirect;
	use App\classes\Session;
	use App\interfaces\Controller as func;
	
	class SecretQuestionController extends Controller implements Func
	{
		
		/**
		 * @throws \Exception
		 */
		public function __construct()
		{
			if(!Session::has('user-to-reset') || isAuthenticated()){
				Redirect::To('/');
			}
		}
		public function index()
		{
			return view('user/security/secret_question');
		}
		
		
		
		
	}