<?php
	
	
	namespace App\controllers\admin\dashboard;
	
	
	use App\classes\AxiosHttpRequest;
	use App\classes\base\Controller;
	
	
	use App\classes\Redirect;
	use App\classes\Session;
	
	use App\models\Admin;
	
	use App\interfaces\Controller as ControllerFunc;
	
	use App\models\AdminSetting;
	use App\models\Request;
	use App\models\User;
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
			$setting = new AdminSetting();
			$settings = $setting->get($this->currentAdmin->admin_id);
			
			// TODO : cards data (ui statistique)
			// TODO : get visiteur
			$visiteurCount = [
				$this->model->visiteurQueries(),
				$this->model->visiteurQueries(true)
			];
			
			// TODO : get notification
			$countNotificationToday = $this->model->count("select * from view_getNotificationCountToday");
		
			
			// TODO : get requests
			$countRequestsToday = $this->model->count("select * from view_getRequestCountToday");
			$countRequests = $this->model->count("select count(*) from request;");
			$request = new Request();
			$requests = $request->query('select  * from request WHERE  cast(request_date as date ) = curdate() order by  request_date DESC  limit 5;' , \PDO::FETCH_OBJ);
			$requests = $request->gelAllRequestFullData($requests);
			
			
			
			// TODO : get users
			$countUsersToday = $this->model->count("select * from view_getUsersCountToday");
			$countUsers = $this->model->count("select count(*) from user;");
			$user  = new User();
			$users = $user->read('select * from user where cast(created_at as date) = curdate() order by created_at DESC LIMIT 5' , \PDO::FETCH_OBJ);
			
			
			
			return view('admin/dashboard/home', compact([
					'admin',
					'notifications',
					'token',
					'settings',
					'visiteurCount',
					'countNotificationToday',
					'countRequestsToday',
					'countRequests',
					'countUsersToday',
					'countUsers',
					'users',
					'requests',
					
				
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