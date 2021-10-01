<?php
	
	namespace App\controllers\helpers;
	
	use App\classes\Redirect;
	use App\classes\Session;
	
	class DocController
	{
		public function __construct()
		{
			if(Session::has('admin-connected')){
				Redirect::To('/admin');
			}
			if ( Session::has('user-connected')) {
				Redirect::To('/user/dashboard');
			}
			
		}
		
		
		
		public function show(){
			return view('docs/guide');
		}
		
		
		
	}