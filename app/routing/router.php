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

$router->map('GET', '/admin', 'App\controllers\admin\dashboard\DashboardController@index','dashboard_route_one');
$router->map('GET', '/admin/dashboard', 'App\controllers\admin\dashboard\DashboardController@index','dashboard_route_two');
$router->map('POST', '/admin/logout', 'App\controllers\admin\dashboard\DashboardController@logout','logout');



$router->map('GET', '/admin/login', 'App\Controllers\admin\LoginController@index','login_route_one');
$router->map('GET', '/admin/login/', 'App\Controllers\admin\LoginController@index','login_route_two');
$router->map('POST', '/admin/login/authorization', 'App\Controllers\admin\LoginController@valid','authorization');






require_once __DIR__ . '/AdminRoutes.php';













/**
 * helpers page routes
 */
$router->map('GET', '/page/refresh', 'App\Controllers\helpers\RefreshPageController@refreshPage','refresh_page');



/**
 * tools page  routes
 */
$router->map('GET', '/test', 'App\controllers\helpers\TestController@testPage','test_file');
$router->map('POST', '/test', 'App\controllers\helpers\TestController@test','GET_file');
$router->map('GET', '/test/api', 'App\controllers\helpers\TestController@testAPi','testAPi');