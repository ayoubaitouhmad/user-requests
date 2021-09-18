<?php
// admin route
// page : page users
$router->map('GET', '/admin/dashboard/users', 'App\Controllers\admin\dashboard\UsersController@index','show_users_link_one');
$router->map('GET', '/admin/dashboard/users/', 'App\Controllers\admin\dashboard\UsersController@index','show_users_link_two');
$router->map('POST', '/admin/dashboard/users/add', 'App\Controllers\admin\dashboard\UsersController@store','store_user');
$router->map('GET', '/admin/dashboard/users/get', 'App\Controllers\admin\dashboard\UsersController@get','get_user');
$router->map('POST', '/admin/dashboard/users/edit', 'App\Controllers\admin\dashboard\UsersController@edit','edit_user');
$router->map('POST', '/admin/dashboard/users/delete', 'App\Controllers\admin\dashboard\UsersController@destroy','delete_user');
$router->map('GET', '/admin/dashboard/users/chart/data', 'App\Controllers\admin\dashboard\UsersController@charts','page_charts');



// page : page requests
$router->map('GET', '/admin/dashboard/requests', 'App\Controllers\admin\dashboard\RequestController@index','index_route_one');
$router->map('GET', '/admin/dashboard/requests/chart/data', 'App\Controllers\admin\dashboard\RequestController@getChartsData','get_charts_data');
$router->map('POST', '/admin/dashboard/requests/edit', 'App\Controllers\admin\dashboard\RequestController@edit','update_requests');



// page : log out
$router->map('POST', '/admin/logout', 'App\controllers\admin\dashboard\homeController@logout','admin_logout');





// page : login
$router->map('GET', '/admin/login', 'App\Controllers\admin\login\LoginController@index','login_route_one');
$router->map('POST', '/admin/login/authorization', 'App\Controllers\admin\login\LoginController@valid','authorization');

// all pages
$router->map('POST', '/admin/reset/notifications/count', 'App\controllers\admin\dashboard\homeController@resetNotification','admin_reset_notification');





