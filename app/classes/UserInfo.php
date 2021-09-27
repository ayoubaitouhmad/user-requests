<?php
	
	namespace App\classes;
	
	use Exception;
	
	class UserInfo
	{
		private $ip;
		
		
		
		/**
		 * @return mixed
		 */
		public function getIp()
		{
			
			return $this->ip;
		}
		
		
		
		/**
		 * @param mixed $ip
		 */
		public function setIp($ip): void
		{
			
			$this->ip = $ip;
		}
		public function __construct()
		{
			if (array_key_exists('HTTP_CLIENT_IP',$_SERVER) && $_SERVER['HTTP_CLIENT_IP']!="")
			{
				$this->ip = $_SERVER['HTTP_CLIENT_IP'];
			}
			elseif (array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER) && $_SERVER['HTTP_X_FORWARDED_FOR']!="")
			{
				$this->ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else
			{
				$this->ip = $_SERVER['REMOTE_ADDR'];
			}
			
		}
		
		
		public function info(){
			return json_decode(file_get_contents("http://ipinfo.io/{$this->ip}/json"));
		}
	}