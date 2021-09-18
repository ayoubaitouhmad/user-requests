<?php
	
	/**
	 * @param $user
	 * @return string
	 */
	function generateId($user): string
	{
		$str = str_replace(' ' , '_',strtolower(trim($user)));
		$id = $str.'_'.date('y-i-s_h-i-s');
		return $id;
	}
	
	
	/**
	 * @return string
	 */
	function generateRequestIds(): string
	{
		$codeAlphabet = "#ABCDEFGHILKMNOPQRSTUVWXYZ";
		$codeAlphabet .= "#abcdefghilkmnopqrstuvwxyz";
		$lack ='';
		for ($i =0 ; $i<rand(1 , strlen($codeAlphabet)-1) ; $i++){
			$lack .= $codeAlphabet[rand(1 , strlen($codeAlphabet) -1)];
		}
		return 'request_' . $lack . '_' .date('y-i-s_h-i-s');
	}
	
	