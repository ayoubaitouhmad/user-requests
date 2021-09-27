<?php
	
	// index
	$router->map('get', '/', 'App\controllers\user\IndexController@index', 'user_index');
	// end index
	
	
	// sign up
	// form
	$router->map('get', '/user/signup', 'App\controllers\user\signup\SignupController@index', 'user_signup_ui');
	$router->map('post', '/user/signup', 'App\controllers\user\signup\SignupController@signup', 'user_signup_create');
	
	
	// email confermation
	$router->map('GET', '/user/signup/email', 'App\controllers\user\signup\EmailConfermationController@index', 'user_signup_confirm_email_ui');
	$router->map('POST', '/user/signup/email/confirm', 'App\controllers\user\signup\EmailConfermationController@confirmEmail', 'user_signup_confirm_email_check');
	
	
	
	// profile
	$router->map('GET', '/user/signup/profile', 'App\controllers\user\signup\ProfileController@index', 'user_signup_profile');
	$router->map('POST', '/user/signup/profile/save', 'App\controllers\user\signup\ProfileController@save', 'user_signup_profile_save');
	// end  sign up
	
	
	
	// dashboard
	//home
	$router->map('GET', '/user/dashboard', 'App\controllers\user\dashboard\homeController@index', 'user_dashboard');
	
	
	
	// request
	$router->map('GET', '/user/dashboard/requests', 'App\controllers\user\dashboard\RequestsController@index', 'user_dashboard_requests');
	$router->map('GET', '/user/dashboard/requests/chart/data', 'App\controllers\user\dashboard\RequestsController@getchartsData', 'user_dashboard_requests_chart');
	$router->map('POST', '/user/dashboard/requests/add', 'App\controllers\user\dashboard\RequestsController@store', 'user_dashboard_add_requests');
	
	// settings
	$router->map('GET', '/user/dashboard/setting', 'App\controllers\user\dashboard\SettingsController@index', 'user_dashboard_settings');
	$router->map('POST', '/user/dashboard/settings/edit/profile', 'App\controllers\user\dashboard\SettingsController@editProfile', 'user_dashboard_edit_profile');
	$router->map('POST', '/user/dashboard/settings/edit/profile/avatar', 'App\controllers\user\dashboard\SettingsController@editProfileAvatar', 'user_dashboard_edit_profile_avatar');
	$router->map('POST', '/user/dashboard/settings/edit/profile/security', 'App\controllers\user\dashboard\SettingsController@editPorfilePasswordAndSecurtity', 'user_dashboard_edit_profile_security');
	$router->map('POST', '/user/dashboard/settings/edit/notifications', 'App\controllers\user\dashboard\SettingsController@editNotifications', 'user_dashboard_edit_profile_notifications');
	
	
	// end dashboard
	
	
	
	
	
	
	
	
	// security
	$router->map('GET', '/user/login/reset/password', 'App\controllers\user\security\ResetPasswordController@index', 'user_reset_password');
	// chnage with email
	$router->map('POST', '/user/login/reset/password/check/email', 'App\controllers\user\security\ResetPasswordController@checkEmail', 'user_reset_password_check');
	$router->map('POST', '/user/login/reset/password/check/email/validation', 'App\controllers\user\security\ResetPasswordController@checkCode', 'user_reset_password_check_validation');
	$router->map('POST', '/user/login/reset/password/check/question', 'App\controllers\user\security\ResetPasswordController@checkQuestionSecret', 'user_reset_password_check_question_edit');
	$router->map('POST', '/user/login/reset/password/check/email/edit', 'App\controllers\user\security\ResetPasswordController@edit', 'user_reset_password_check_edit');
	

	
	
	
	
	// sign in
	// ui
	$router->map('GET', '/user/login', 'App\controllers\user\login\LoginController@index', 'user_login');
	$router->map('POST', '/user/login/validate', 'App\controllers\user\login\LoginController@login', 'user_login_check');
	
	// log out
	$router->map('POST', '/user/logout', 'App\controllers\user\dashboard\homeController@logout', 'user_logout');
	
	
	
	// log out
	$router->map('POST', '/user/reset/notifications/count', 'App\controllers\user\dashboard\homeController@resetNotification', 'reset_user_count');
	
	
	
	
