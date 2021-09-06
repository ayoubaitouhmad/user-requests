<?php

namespace App\classes;

/**
 *
 */
class CrudErrors
{
    public const USED = 'used';
    public const ERROR = 'error';
    public const CANCEL = 'cancel';
    public const NOT_VALID = 'validation';
    public const LOGIN_VALID = 'valid login';
    public const LOGIN_NOT_VALID = 'invalid login';
    public const VALID = 'done';


    /**
     * this methode call when user action successes
     * @param $crudType
     * @return string
     */
    public static function success($crudType): string
    {
        return 'Done !!, Data ' . $crudType . 'ed successfully.';
    }

    /**
     * this methode call when user sign up with exists email , or some unique filed
     * @param $who
     * @return string
     */
    public static function used($who) : string
    {
        return $who . ' Already used!!, if you have problem in your login info please try login or reset your password.';
    }

    /**
     * this methode call when token is not valid
     * @return string
     */
    public static function error():string{
        return  'sorry !!, something went wrong please try again';
    }


    /**
     * this methode call when user sign up with exists email , or some unique filed
     * @param $crudType
     * @return string
     */
    public static function crudError($crudType) : string{
        return 'sorry !!, data cant '.$crudType.'ed'.' please wait some time and try again' ;
    }
	
	
	
	/**
	 * @return string
	 */
	public static function loginFailed(){
    	return 'sorry !!, password or email invalid .' ;
    }

}