<?php
	
	namespace App\classes;
	
	class AxiosHttpRequest
	{
		
		/**
		 * @param false $isAssoc
		 * @return mixed
		 */
		public static function all(bool $isAssoc = false)
		{
			
			return json_decode(file_get_contents('php://input'), $isAssoc);
		}
		
		
		
		/**
		 * @param $key
		 * @return false|mixed
		 */
		public static function get($key, $subkey)
		{
			
			$all = self::all();
			
			return $all->$key->$subkey ?? false;
		}
		
		
		
		/**
		 * @param $key
		 * @return bool
		 */
		public static function has($key)
		{
			
			$all = self::all(true);
			
			return in_array($key, array_keys($all));
		}
		
		
		
		/**
		 * @param $key
		 * @param $value
		 * @return false|mixed
		 */
		public static function hasValue($key, $value)
		{
			
			$all = self::all();
			
			return $all->$key === $value;
		}
		
		
		
		/**
		 * get the token come with http request
		 * @param bool $isAssoc
		 * @return mixed
		 */
		public static function getAuthorizationToken(bool $isAssoc = false)
		{
			return isset(getallheaders()['Authorization']) ? json_decode(json_encode(getallheaders()['Authorization']), $isAssoc) : '';
		}
		
		
		
		/**
		 * @return mixed|string
		 */
		public static function getCustomHttpHeader($header , $isAssoc = true)
		{
			return isset(getallheaders()[$header]) ? json_decode(json_encode(getallheaders()[$header]), $isAssoc) : '';
		}
		
		
		
		/**
		 * @return array|false|string
		 */
		public static function getAllHeaders($isAssoc =false){
			return json_decode(json_encode(getallheaders()), $isAssoc);
		}
		
	}