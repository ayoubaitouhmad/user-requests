<?php


namespace App\classes;


/**
 *
 */
class Redirect
{
	
	/**
	 * @param $path
	 */
	public static function To($path){
        header("Location:$path");
        die();
    }
	
	
	
	/**
	 *
	 */
	public static function back(){
        if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
            header("Location:{$_SERVER['HTTP_REFERER']}");
            exit();
        }
     }




}