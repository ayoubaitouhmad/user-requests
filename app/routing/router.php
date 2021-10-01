<?php
/**
 * dynamic route write like that =>
 * user/[i:id]/add
 * http://altorouter.com/usage/mapping-routes.html
 */

require_once  __DIR__.'/../../bootstrap/init.php';
$router  = new AltoRouter();




/**
    * admin dashboard route (index)
 */




// import  admin route
require_once __DIR__ . '/AdminRoutes.php';
// import  admin route
require_once __DIR__ . '/UserRoutes.php';





/**
 * helpers page routes
 */
$router->map('GET', '/page/refresh', 'App\Controllers\helpers\RefreshPageController@index','refresh_page');



/**
 * tools page  routes
 */
$router->map('GET', '/test', 'App\controllers\helpers\TestController@index','test_ui');
$router->map('GET', '/test/', 'App\controllers\helpers\TestController@index','test_uif');
$router->map('GET', '/test/fb', 'App\controllers\helpers\TestController@login','test_fb');
$router->map('GET', '/test/fb/callback', 'App\controllers\helpers\TestController@callback','testd_fb');
