<?php
	
	namespace App\controllers\admin\dashboard;
	
	
	
	use App\classes\AxiosHttpRequest;
	use App\classes\base\Controller;
	use App\classes\PushNotification;
	use App\classes\UiMessages;
	use App\classes\CSRF;
	use App\classes\ErrorHandler;
	use App\classes\Redirect;
	use App\classes\Session;
	use App\classes\Validator;
	use App\models\Admin;
	use App\models\AdminNotification;
	use App\models\AdminSetting;
	use App\models\Notification;
	use App\models\Request;
	use App\models\User;
	use App\models\UserNotification;
	use App\models\UserSetting;
	use Exception;
	
	
	/**
	 *  request controller for controller data come from request table in db
	 */
	class RequestController extends Controller
	{
		
		
		/**
		 * @throws Exception
		 */
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
			$this->currentAdmin->admin_photo = getFileFromDirByName($this->currentAdmin->admin_photo);
			
		}
		
		
		
		/**
		 * controller for
		 *                 get the view
		 *                 send the data
		 */
		public function index()
		{
			
			flush();
			
			// TODO / get requests list and summary data (view thing)
			$requests = $this->model->all(); // get all requests
			$requestsPercentageByType = $this->model->getCountRequestsByType(); // get data for charts
			/**
			 *  get last for request and send it to get user photo
			 *  because user photo encrypted ,  we need to decrypted to get photo
			 *  see getUserImage docblock
			 */
			$lastFourRequests = User::getUserImage($this->model->lastFourRequests());
			// TODO / get page token
			$token = $this->tokenManager->token(); // get the token
			// TODO / get currentAdmin infos
			$admin = $this->currentAdmin;
			// TODO / notifications list
			$notifications = HomeController::AdminNotification();
			// TODO : get user preferences
			$setting = new AdminSetting();
			$settings = $setting->get($this->currentAdmin->admin_id);
			
			// TODO / send all to view
			return view('admin/dashboard/requests', compact([
				'requests',
				'requestsPercentageByType',
				'lastFourRequests',
				'token',
				'admin',
				'notifications',
				'settings'
			]));
		}
		
		
		
		/**
		 *  controller for
		 * send data come from stored procedure to making chart work
		 * receive by : axios
		 */
		public function getChartsData()
		{
			
			echo cleanJSON([
				'header' => 'done',
				'body' => [
					'menRequestsPerMonth' => $this->model->getRequestsByGender('m'),
					'womenRequestsPerMonth' => $this->model->getRequestsByGender('f'),
					'requestByMonthCurrentYear' => $this->model->getRequestByMonth(date('Y')),
					'requestByMonthLastYear' => $this->model->getRequestByMonth((date('Y') - 1))
				]
			]);
			
		}
		
		
		
		/**
		 *  controller for
		 *  update request data
		 */
		public function edit()
		{
			
			
			if (AxiosHttpRequest::has('action') && AxiosHttpRequest::hasValue('action', 'post') && !empty(AxiosHttpRequest::getAuthorizationToken())) {
				$postRequest = AxiosHttpRequest::all()->data;
				$token = AxiosHttpRequest::getAuthorizationToken();
				if ($this->tokenManager->verifyToken($token)) {
					$this->validator->add($postRequest, [
						'status' => [
							'required' => true,
							'maxLength' => 40,
							'minLength' => 5,
							'like' => ['Change Role' ,' Vacation' ,'Emergency']
						],

						'response' => [
							'required' => true,
							'minLength' => 5
						]
					]);
					if (!is_array($this->errorHandler->all())) {
						$data = AxiosHttpRequest::all()->data;
						$req = new Request();
						$req->setId(dec($data->req_id));
						$req->setStatus($data->status);
						$req->setResponse($data->response);
						
						if ($this->model->update($req)) {
							
							
							$fullRequest = $this->model->get(dec($postRequest->req_id));
							$user = new User();
							$user = $user->get($fullRequest->user_id);
							
							$setting = new UserSetting();
							$settings = $setting->get($user->user_id);
							
							
							
							$description = implode(' ', array_slice(explode(' ', $data->response), 0, 5)) . '...';
							$title = $this->currentAdmin->admin_name . ' update your request';
							$userNotification = new AdminNotification();
							$userNotification->setTitle($title);
							$userNotification->setDescription($description);
							$userNotification->setUserId($user->user_id);
							$userNotification->setAdminId($this->currentAdmin->admin_id);
							$userNotification->setNotificationType(3);
							if ($settings->notifiy_when_admin_send_feedback === 0) {
								$userNotification->setStatus(1);
							}
							$userNotification->create($userNotification);
							
							
							PushNotification::send($user->user_email, [
								'header ' => $title,
								'body ' => $description,
								'photo' => $this->currentAdmin->admin_photo,
							
							]);
							echo cleanJSON([
								
								'header' => UiMessages::VALID,
								'body' => $this->currentAdmin
							]);
						} else {
							
							echo cleanJSON([
								'header' => UiMessages::CANCEL,
								'body' => UiMessages::crudError('updat'),
							
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