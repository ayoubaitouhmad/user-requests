<?php

/**
 * users page routes
 */
$router->map('GET', '/admin/dashboard/users', 'App\Controllers\admin\dashboard\UsersController@index','show_users_link_one');
$router->map('GET', '/admin/dashboard/users/', 'App\Controllers\admin\dashboard\UsersController@index','show_users_link_two');
$router->map('POST', '/admin/dashboard/users/add', 'App\Controllers\admin\dashboard\UsersController@store','store_user');
$router->map('GET', '/admin/dashboard/users/get', 'App\Controllers\admin\dashboard\UsersController@get','get_user');
$router->map('POST', '/admin/dashboard/users/edit', 'App\Controllers\admin\dashboard\UsersController@edit','edit_user');
$router->map('POST', '/admin/dashboard/users/delete', 'App\Controllers\admin\dashboard\UsersController@destroy','delete_user');
$router->map('GET', '/admin/dashboard/users/chart/data', 'App\Controllers\admin\dashboard\UsersController@charts','page_charts');




/**
 * Request route
 */




$router->map('GET', '/admin/dashboard/requests', 'App\Controllers\admin\dashboard\RequestController@index','index_route_one');
$router->map('GET', '/admin/dashboard/requests/chart/data', 'App\Controllers\admin\dashboard\RequestController@getChartsData','get_charts_data');
$router->map('POST', '/admin/dashboard/requests/edit', 'App\Controllers\admin\dashboard\RequestController@edit','update_requests');

