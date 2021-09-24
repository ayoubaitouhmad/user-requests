<?php


namespace App\routing;



class RouteDispatcher
{
    protected $match;
    protected $controller;
    protected  $methode;
    public function __construct(\AltoRouter  $altoRouter)
    {
        $this->match = $altoRouter->match();
        if($this->match){
            list($ctl,$mtd) = explode('@',$this->match['target']);
            $this->controller = $ctl;
            $this->methode = $mtd;

            if(is_callable(array(new $this->controller,$this->methode))){
                call_user_func(array(new $this->controller,$this->methode),
                array($this->match["params"]));
            }else{
                "{$this->methode} not found in {$this->controller}";
            }

        }else{
            header($_SERVER['SERVER_PROTOCOL'].'404 Not Found');
            view("errors/404");
        }
    }
}