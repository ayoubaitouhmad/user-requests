<?php
	
	namespace App\controllers\user\dashboard;
	
	use App\classes\Redirect;
	use App\classes\Session;
	use App\interfaces\Controller;
	use Exception;
	
	/**
	 *
	 */
	class ProfileController implements Controller
	{
		public function __construct()
		{
			if(!Session::has('user-connected')){
				Redirect::To('/');
			}
		}
		
		
		
		/**
		 *
		 * @throws Exception
		 */
		public function index()
		{
			return view('user/dashboard/profile');
		}
	}