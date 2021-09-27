<?php

//	declare(strict_types=1);
	
	use App\classes\base\UploadImage;
	use App\classes\Redirect;
	use App\classes\Session;
	
	/**
	 * @param $path
	 * @param array $data
	 */
	function view($path, array $data = [])
	{
		
		$view = __DIR__ . '/../../resources/views';
		$cash = __DIR__ . '/../../bootstrap/cash';
		$blade = new Philo\Blade\Blade($view, $cash);
		echo $blade->view()->make($path, $data)->render();
	}
	
	
	/**
	 * @param array $message
	 * @return false|string
	 */
	function cleanJSON(array $message = [])
	{
		
		return json_encode($message);
	}
	
	
	/**
	 * crypt
	 * @param $data
	 * @return string
	 */
	function enc($data)
	{
		
		$enc_data = $data;
		for ($i = 0; $i < 5; $i++) {
			$enc_data = base64_encode($enc_data);
		}
		
		return $enc_data;
	}
	
	
	/**
	 * decrypt
	 * @param $enc_data
	 * @return false|string
	 */
	function dec($enc_data)
	{
		
		$data = $enc_data;
		for ($i = 0; $i < 5; $i++) {
			$data = base64_decode($data);
		}
		
		return $data;
	}
	
	
	/**
	 * @throws Exception
	 */
	function isAuthenticated()
	{
		return Session::has('admin-connected');
	}
	
	
	
	
	/**
	 * loop into array contain user photo and affect photo path to the object
	 * @param $array
	 * @param $img_key
	 * @return mixed
	 */
	function getPhoto($array , $img_key)
	{
		
		foreach ($array as $record) {
			$record->$img_key =  getFileFromDirByName($record->$img_key, UploadImage::targetFolder);
		}
		
		return $array;
	}
	
	
	/**
	 * @param $record
	 * @param $img_key
	 * @return mixed
	 */
	function getPhotoFromObj($record , $img_key)
	{
		$record->$img_key = getFileFromDirByName($record->$img_key, UploadImage::targetFolder);
		return $record;
	}
	
	
	/**
	 * @param array $records
	 * @param $idKey
	 * @return array
	 */
	function encyptIdentifiers(array $records , $idKey){
		foreach ($records as $record) {
			$record->$idKey = enc($record->$idKey);
		}
		return $records;
	}
	
	
	function calcVisiteur(){
		$ip_all = file("ip.txt");
		$ip_cur = $_SERVER['REMOTE_ADDR']."\n";
		if (!in_array($ip_cur, $ip_all)) {
			$ip_all[] = $ip_cur;
			file_put_contents("ip.txt", implode($ip_all));
		}
		
	}