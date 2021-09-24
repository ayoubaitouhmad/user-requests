<?php
	
	
	namespace App\controllers\admin\dashboard;
	
	
	use App\classes\AxiosHttpRequest;
	use App\classes\base\Controller;
	
	
	use App\classes\Redirect;
	use App\classes\Session;
	
	use App\models\Admin;
	
	use App\interfaces\Controller as ControllerFunc;
	
	use App\models\AdminSetting;
	use App\models\UserNotification;
	use Exception;
	
	
	/**
	 *
	 */
	class HomeController extends Controller implements ControllerFunc
	{
		
		
		/**
		 * @throws Exception
		 */
		public function __construct()
		{
			
			// validate authentication
			if (!isAuthenticated()) {
				Redirect::To('/admin/login');
			}
			
			// setup
			$this->init(new Admin());
			
			// get the current Admin infos
			$email = Session::get('admin-connected');
			$this->currentAdmin = $this->model->get($email);
			$this->currentAdmin->admin_photo = getFileFromDirByName($this->currentAdmin->admin_photo);
			
			
		}
		
		
		
		/**
		 *
		 * @throws Exception
		 */
		public function index()
		{
			
			
			
			// TODO / get  notifications list
			$notifications = self::AdminNotification();
			// TODO / get page token
			$token = $this->tokenManager->token();
			// TODO : get current admin
			$admin = $this->currentAdmin;
			
			// TODO : get user preferences
			$setting =new AdminSetting();
			$settings = $setting->get($this->currentAdmin->admin_id);
			
			return view('admin/dashboard/home', compact([
					'admin',
					'notifications',
					'token',
					'settings'
				]
			));
		}
		
		
		
		/**
		 * clear session when admin logout
		 * @throws Exception
		 */
		public function logout()
		{
			
			if (AxiosHttpRequest::has('token') && $this->tokenManager->verifyToken(AxiosHttpRequest::has('token'))) {
				Session::remove('admin-connected');
			}
		}
		
		
		
		/**
		 * make notification status = read
		 */
		public function resetNotification()
		{
			
			if (AxiosHttpRequest::getAuthorizationToken() !== '' && $this->tokenManager->verifyToken(AxiosHttpRequest::getAuthorizationToken())) {
				$notification = new UserNotification();
				$notification->resetNotificationStatus();
				echo cleanJSON(['fdfdsf']);
			}
			
		}
		
		
		
		/**
		 * get all admin notifications
		 * @return mixed|null
		 */
		public static function AdminNotification()
		{
			
			$notification = new UserNotification();
			
			return $notification->all();
		}
		
		
	}