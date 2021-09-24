<?php
	
	namespace App\classes;
	
	
	class fbLogin
	{
		
		public const APP_ID = '766718221403-vulehrvp6o58he74mhvs2p2r7vvcsle4.apps.googleusercontent.com';
		public const KEY = '9qua-yNicCzZnX57P-kxssL9';
		public const FB_REDIRECT_URI = 'http://mvc.test/test';
	
		
		
		
		
		
		
		
		
		
		public static function login(){
			$google  = new \Google_Client();
			$google->setClientId(self::APP_ID);
			$google->setClientSecret(self::KEY);
			$google->setRedirectUri(self::FB_REDIRECT_URI);
			
			$google->addScope('email');
			$google->addScope('profile');
			
			echo $google->createAuthUrl();
			
		}
		
		
		
		
		public static function callBack(){
		
		
		}
	}