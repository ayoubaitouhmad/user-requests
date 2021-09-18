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


$router->map('GET', '/admin/dashboard', 'App\controllers\admin\dashboard\HomeController@index','home_dashboard');
$router->map('POST', '/admin/logout', 'App\controllers\admin\dashboard\HomeController@logout','logout');





require_once __DIR__ . '/AdminRoutes.php';







require_once __DIR__ . '/UserRoutes.php';





/**
 * helpers page routes
 */
$router->map('GET', '/page/refresh', 'App\Controllers\helpers\RefreshPageController@index','refresh_page');



/**
 * tools page  routes
 */
$router->map('GET', '/test', 'App\controllers\helpers\TestController@index','test_file');
