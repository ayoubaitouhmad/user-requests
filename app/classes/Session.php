<?php


namespace App\classes;


use Exception;

class Session
{
    /**
     * create a session
     *
     * @param $name
     * @param $value
     * @return mixed
     * @throws Exception
     */
    public static function add($name, $value)
    {
	    if(session_id() === '')
		    session_start();
	    
        if (!empty($name)  && !empty($value)) {
            return $_SESSION[$name] = $value;
        }
        throw new Exception('Name and value required');
    }

    /**
     * get value from session
     *
     * @param $name
     * @return mixed
     * @throws Exception
     */
    public static function get($name)
    {
        $session = null;
        if (!empty($name) && isset($_SESSION[$name])) {
            $session = $_SESSION[$name];
        }
        return $session;

    }

    /**
     * check is session exists
     *
     * @param $name
     * @return bool
     * @throws Exception
     */
    public static function has($name)
    {
       
        return isset($_SESSION[$name]);
    }

    /**
     * remove session
     *
     * @param $name
     * @throws Exception
     */
    public static function remove($name)
    {
        if (self::has($name)) {
            unset($_SESSION[$name]);
        }
    }


}