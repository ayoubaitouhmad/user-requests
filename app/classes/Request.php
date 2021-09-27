<?php

namespace App\classes;

class Request
{
    private static $current;

    public static function all($assoc = false)
    {
        $res = [];
        if (count($_GET) > 0) $res['get'] = $_GET;
        if (count($_POST) > 0) $res['post'] = $_POST;
        $res['file'] = $_FILES;
        return json_decode(json_encode($res), '' . $assoc);
    }


    public static function get($key)
    {
        $all = self::all();
        return $all->$key ?? null;
    }


    public static function has($key): bool
    {
        $all = self::all(true);
        return in_array($key, array_keys($all));
    }
	
	
	
	/**
	 * @param $key
	 * @param $value
	 * @return mixed
	 */
    public static function hasValue($key , $value)
    {
        $all = self::all();
        return isset($all->$key->$value);
    }


}