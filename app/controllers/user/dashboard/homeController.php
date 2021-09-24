<?php
	
	namespace App\controllers\user\dashboard;
	
	use App\classes\AxiosHttpRequest;
	use App\classes\base\Controller;
	use App\classes\CSRF;
	use App\classes\ErrorHandler;
	use App\classes\PushNotification;
	use App\classes\Redirect;
	use App\classes\Session;
	use App\classes\Validator;
	use App\controllers\admin\dashboard\UsersController;
	use App\interfaces\Controller as ControllerFunc;
	use App\models\Admin;
	use App\models\AdminNotification;
	use App\models\Notification;
	use App\models\UserSetting;
	use App\models\User;
	use App\models\UserNotification;
	use Exception;
	
	/**
	 *
	 */
	class homeController extends Controller implements ControllerFunc
	{
		
		protected $currentUser;
		public function __construct()
		{


			if (!Session::has('user-connected')) {
				Redirect::To('/');
			}
			
			
			
			
			// TODO : setup
			$this->init(new User());
			
			
			// TODO : get current user infos
			$this->currentUser = $this->model->getByEmail(Session::get('user-connected'));
			if (!$this->currentUser  === false) {
				$this->currentUser ->user_photo = getFileFromDirByName($this->currentUser ->user_photo);
				$this->currentUser ->user_password = enc($this->currentUser ->user_password);
			} else {
				Session::remove('user-connected');
			}
			
			
			
		
		}
		
		
		
		/**
		 * @return void
		 * @throws Exception
		 */
		public function index()
		{
			
			// TODO / get page token
			$token = $this->tokenManager->token();
			
			// TODO / get current user infos
			$activeUser = $this->currentUser;
			
			// TODO / get current user notifications
			$notification = new AdminNotification();
			$notifications = $notification->getUserNotification($this->currentUser->user_id);
			
			// TODO : get user preferences
			$setting = new UserSetting();
			$settings = $setting->get($this->currentUser->user_id);
		

			// TODO / send all to view
			return view('user/dashboard/home', compact([
				'token',
				'activeUser',
				'notifications',
				'settings'
			]));
		}
		
		
	
		
		
		public function logout(){
			if (AxiosHttpRequest::has('token') && $this->tokenManager->verifyToken(AxiosHttpRequest::has('token'))) {
				Session::remove('user-connected');
				Session::remove('user-connected-password');
			}
		}
		function resetNotification(){
			
			if (AxiosHttpRequest::getAuthorizationToken() !== ''&& $this->tokenManager->verifyToken(AxiosHttpRequest::getAuthorizationToken())) {
				$notification = new AdminNotification();
				$notification->updateStatus();
			}
		}
	}