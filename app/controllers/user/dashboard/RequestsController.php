<?php
	
	namespace App\controllers\user\dashboard;
	
	use App\classes\AxiosHttpRequest;
	use App\classes\base\Controller;
	use App\classes\CSRF;
	use App\classes\ErrorHandler;
	use App\classes\PushNotification;
	use App\classes\Redirect;
	use App\classes\Session;
	use App\classes\UiMessages;
	use App\classes\Validator;
	use App\interfaces\Controller as ControllerFunc;
	use App\models\AdminNotification;
	use App\models\Notification;
	use App\models\Request;
	use App\models\UserSetting;
	use App\models\User;
	use App\models\UserNotification;
	use Exception;
	
	class RequestsController extends Controller implements ControllerFunc
	{
		
		
		public function __construct()
		{
			
			if (!Session::has('user-connected')) {
				Redirect::To('/');
			}
			
			// TODO : setup
			$this->init(new Request());
			
			// TODO : get current user infos
			$user = new User();
			$this->currentUser = $user->getByEmail(Session::get('user-connected'));
			if ($this->currentUser !== false) {
				$this->currentUser->user_photo = getFileFromDirByName($this->currentUser->user_photo);
				if($this->currentUser->user_compteEtat  !== 'active'){
					Redirect::To('/user/dashboard');
				}
			}else{
				Session::remove('user-connected');
			}
			
			
			
			
			
			
		}
		
		
		
		public function index()
		{
			
			
			// TODO : get page token
			$token = $this->tokenManager->token();
			
			// TODO : get current user requests
			$user = new User;
			$requests = $user->getUserRequests($this->currentUser->user_id);
			$percentageRequestsByRole = $user->proc_PercentageRequestsByRole($this->currentUser->user_id);
			
			// TODO : get user notifications
			$notification = new AdminNotification();
			$notifications = $notification->getUserNotification($this->currentUser->user_id);
			
			// TODO : get current user infos
			$activeUser = $this->currentUser;
			
			// TODO : get user preferences
			$setting = new UserSetting();
			$settings = $setting->get($this->currentUser->user_id);
			
			return view('user/dashboard/requests', compact([
				'token',
				'requests',
				'percentageRequestsByRole',
				'activeUser',
				'notifications',
				'settings'
			]));
			
			
			
		}
		
		
		
		/**
		 *
		 */
		public function getchartsData()
		{
			
			$user = new User();
			$requestPercentageCurrYear = $user->userRequestsPercentage($this->currentUser->user_id, '2021');
			$requestPercentageLastYear = $user->userRequestsPercentage($this->currentUser->user_id, '2020');
			
			echo cleanJSON([
				'body' =>
					[
						
						'requestPercentageCurrYear' => $requestPercentageCurrYear,
						'requestPercentageLastYear' => $requestPercentageLastYear
					]
			]);
		}
		
		
		
		/**
		 * add new request
		 * @throws Exception
		 */
		public function store()
		{
			
			if (AxiosHttpRequest::has('action') && AxiosHttpRequest::hasValue('action', 'add') && !empty(AxiosHttpRequest::getAuthorizationToken())) {
				$token = AxiosHttpRequest::getAuthorizationToken();
				
				if ($this->tokenManager->verifyToken($token)) {
					$post = AxiosHttpRequest::all()->data;
					$this->validator->add($post, [
						'pretext' => [
							'required' => true,
							'paragraph' => true,
							'minLength' => 5
						],
						'type' => [
							'required' => true,
							'text' => true,
							'maxLength' => 20,
							'like' => ['task done', 'change role', 'emergency', 'vacation']
						],
					
					]);
					if (!is_array($this->errorHandler->all())) {
						$request = new Request();
						$request->setPretext($post->pretext);
						$request->setType($post->type);
						$request->setUser($this->currentUser->user_id);
						if ($this->model->create($request)) {
							// TODO : NOTIFY ADMIN
							$title = 'new request';
							$description = 'user ' . $this->currentUser->user_fullname . 'has just send new request';
							$notification = new UserNotification();
							$notification->setTitle($title);
							$notification->setDescription($description);
							$notification->setUserId($this->currentUser->user_id);
							$notification->setNotificationType(2);
							$notification->create($notification);
							// TODO : SEND NOTIFICATION TO ADMIN
							PushNotification::send(PushNotification::NEW_REQUEST, [
								'title ' => $title,
								'description' => $description,
								'photo' => getFileFromDirByName($this->currentUser->user_photo)
							]);
							
							
							
							// TODO : NOTIFY USER
							$title = 'new request';
							$description = "you hav've sent new request";
							$notification = new AdminNotification();
							$notification->setTitle($title);
							$notification->setDescription($description);
							$notification->setUserId($this->currentUser->user_id);
							$notification->setAdminId('admin_');
							$notification->setNotificationType(2);
							$notification->create($notification);
							// TODO : SEND NOTIFICATION
							PushNotification::send($this->currentUser->user_email . '_new_request', [
								'title ' => $title,
								'description' => $description,
								'photo' => ''
							]);
							
							
							
							echo cleanJSON([
								'header' => UiMessages::VALID,
								'body' => ''
							]);
						} else {
							echo cleanJSON([
								'header' => UiMessages::CANCEL,
								'body' => ''
							]);
						}
						
					} else {
						echo cleanJSON([
							'header' => UiMessages::NOT_VALID,
							'body' => $this->errorHandler->all()
						]);
					}
					
				} else {
					echo cleanJSON([
						'header' => UiMessages::ERROR,
						'body' => UiMessages::error()
					]);
				}
				
			} else {
				echo cleanJSON([
					'header' => UiMessages::ERROR,
					'body' => UiMessages::error()
				]);
			}
		}
	}