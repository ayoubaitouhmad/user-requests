<?php
// admin route



// dashboard
	// home
	$router->map('GET', '/admin/dashboard', 'App\controllers\admin\dashboard\HomeController@index', 'home_dashboard');

	
	// users page
	$router->map('GET', '/admin/dashboard/users', 'App\Controllers\admin\dashboard\UsersController@index', 'users');
	$router->map('POST', '/admin/dashboard/users/add', 'App\Controllers\admin\dashboard\UsersController@store', 'store_user');
	$router->map('GET', '/admin/dashboard/users/get', 'App\Controllers\admin\dashboard\UsersController@get', 'get_user');
	$router->map('POST', '/admin/dashboard/users/edit', 'App\Controllers\admin\dashboard\UsersController@edit', 'edit_user');
	$router->map('POST', '/admin/dashboard/users/delete', 'App\Controllers\admin\dashboard\UsersController@destroy', 'delete_user');
	$router->map('GET', '/admin/dashboard/users/chart/data', 'App\Controllers\admin\dashboard\UsersController@charts', 'page_charts');



	//  requests page
	$router->map('GET', '/admin/dashboard/requests', 'App\Controllers\admin\dashboard\RequestController@index', 'requests');
	$router->map('GET', '/admin/dashboard/requests/chart/data', 'App\Controllers\admin\dashboard\RequestController@getChartsData', 'get_charts_data');
	$router->map('POST', '/admin/dashboard/requests/edit', 'App\Controllers\admin\dashboard\RequestController@edit', 'update_requests');
	
	
	
	//  settings page
	$router->map('GET', '/admin/dashboard/setting', 'App\Controllers\admin\dashboard\SettingsController@index', 'settings');
	$router->map('POST', '/admin/dashboard/settings/edit/profile', 'App\controllers\admin\dashboard\SettingsController@editProfile', 'admin_dashboard_edit_profile');
	$router->map('POST', '/admin/dashboard/settings/edit/profile/avatar', 'App\controllers\admin\dashboard\SettingsController@editProfileAvatar', 'admin_dashboard_edit_profile_avatar');
	$router->map('POST', '/admin/dashboard/settings/edit/profile/security', 'App\controllers\admin\dashboard\SettingsController@editPorfilePasswordAndSecurtity', 'admin_dashboard_edit_profile_security');
	$router->map('POST', '/admin/dashboard/settings/edit/notifications', 'App\controllers\admin\dashboard\SettingsController@editNotifications', 'admin_dashboard_edit_profile_notifications');










// end dashboard

	// page : log out
	$router->map('POST', '/admin/logout', 'App\controllers\admin\dashboard\homeController@logout', 'admin_logout');



// page : login
	$router->map('GET', '/admin/login', 'App\Controllers\admin\login\LoginController@index', 'login_route_one');
	$router->map('POST', '/admin/login/authorization', 'App\Controllers\admin\login\LoginController@valid', 'authorization');

// hellpers
	$router->map('POST', '/admin/reset/notifications/count', 'App\controllers\admin\dashboard\HomeController@resetNotification', 'admin_reset_notification');
	
	
	
	
	
	