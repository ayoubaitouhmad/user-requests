<?php

namespace App\controllers\helpers;

use App\classes\CSRF;

class TestController
{
    function testPage()
    {
        $CSRF = new CSRF();
        $data = $CSRF->token();
        return view('test/test');
    }

    function test(){
        echo cleanJSON([
            "title" => 'done!!',
            "body" => json_decode(file_get_contents('php://input'))
        ]);
    }

    function testAPi(){
//        sleep(5);
        echo cleanJSON([
            "title" => 'done!!',
            "body" => $_GET
        ]);

    }


}