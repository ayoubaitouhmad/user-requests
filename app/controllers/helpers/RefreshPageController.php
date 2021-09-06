<?php


namespace App\controllers\helpers;


use App\classes\CSRF;
use App\classes\ErrorHandler;
use App\classes\Request;
use App\classes\Validator;

class RefreshPageController
{
    /**
     *
     */
    function refreshPage()
    {
        return view('helpers/refresh');
    }



}