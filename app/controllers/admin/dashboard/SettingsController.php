<?php
	
	namespace App\controllers\admin\dashboard;
	
	use App\classes\base\Controller as Func;
	use App\classes\base\Controller;
	use App\classes\Redirect;
	use App\classes\Session;
	use App\models\Admin;
	use App\models\AdminSetting;
	use App\models\Request;
	use App\models\User;
	
	class SettingsController extends  Func implements  \App\interfaces\Controller
	{
		
		
		public function __construct()
		{
			if (!isAuthenticated()) {
				Redirect::To('/admin/login');
			}
			$this->init(new Request());
			
			
			// TODO :  get the current Admin infos
			$admin = new Admin();
			$username = Session::get('admin-connected');
			$this->currentAdmin = $admin->get($username);
			$this->currentAdmin->admin_photo  = getFileFromDirByName($this->currentAdmin->admin_photo);
		}
		
		
		
		public function index()
		{
			// TODO : get page token
			$token = $this->tokenManager->token();
			
			// TODO / get currentAdmin infos
			$admin = $this->currentAdmin;
			
			// TODO : get user preferences
			$setting = new AdminSetting();
			
			// TODO / notifications list
			$notifications = HomeController::AdminNotification();
			
			
			$settings = $setting->get($this->currentAdmin->admin_id);
			return view('admin/dashboard/setting' , compact([
				'token',
				'admin',
				'settings',
				'notifications'
			]));
		}
		
	
	}