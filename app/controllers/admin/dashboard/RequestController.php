<?php
	
	namespace App\controllers\admin\dashboard;
	
	
	
	use App\classes\AxiosHttpRequest;
	use App\classes\CrudErrors;
	use App\classes\CSRF;
	use App\classes\ErrorHandler;
	use App\classes\Redirect;
	use App\classes\Session;
	use App\classes\Validator;
	use App\models\Request;
	use App\models\User;
	use Exception;
	
	
	/**
	 *  request controller for controller data come from request table in db
	 */
	class RequestController
	{
		protected  $model;
		protected  $tokenManager;
		protected  $validator;
		protected  $errorHandler;
		protected  $currentAdmin;
		protected $uploader;
		
		
		
		/**
		 * @throws Exception
		 */
		public function __construct()
		{
			$this->currentAdmin = Session::get('admin-connected');
		}
		
		
		
		
		/**
		 * controller for
		 *                 get the view
		 *                 send the data
		 */
		public function index()
		{
			if (!isAuthenticated()) {
				Redirect::To('/admin/login');
			}
			$CSRF = new CSRF();
			$request = new Request();
			$requests = $request->all(); // get all requests
			$requestsPercentageByType = $request->getCountRequestsByType(); // get data for charts
			/**
			 *  get last for request and send it to get user photo
			 *  because user photo encrypted ,  we need to decrypted to get photo
			 *  see getUserImage docblock
			 */
			$lastFourRequests = User::getUserImage($request->lastFourRequests());
			$token = $CSRF->token(); // get the token
			$admin = [
				'name' => $this->currentAdmin->admin_name,
				'photo' => getFileFromDirByName($this->currentAdmin->admin_photo)
			];
			return view('admin/dashboard/requests', compact([
				'requests',
				'requestsPercentageByType',
				'lastFourRequests',
				'token',
				'admin'
			]));
		}
		
		
		
		/**
		 *  controller for
		 * send data come from stored procedure to making chart work
		 * receive by : axios
		 */
		public function getChartsData()
		{
			
			$request = new Request();
			// function to get charts data from views , proc
			$menRequestsPerMonth = $request->getRequestsByGender('m');
			$womenRequestsPerMonth = $request->getRequestsByGender('f');
			$requestByMonthCurrentYear = $request->getRequestByMonth(date('Y'));
			$requestByMonthLastYear = $request->getRequestByMonth((date('Y') - 1));
			
			
			echo cleanJSON([
				'header' => 'done',
				'body' => [
					'menRequestsPerMonth' => $menRequestsPerMonth,
					'womenRequestsPerMonth' => $womenRequestsPerMonth,
					'requestByMonthCurrentYear' => $requestByMonthCurrentYear,
					'requestByMonthLastYear' => $requestByMonthLastYear
				]
			]);
			
			
		}
		
		
		
		/**
		 *  controller for
		 *  update request data
		 */
		public function edit()
		{
			
			
			$CSRF = new CSRF(); // token
			$errorHandler = new ErrorHandler(); // place where validation error stored
			$validator = new Validator($errorHandler); // input validation
			$requestModel = new Request(); // request crud
			$request = json_decode(file_get_contents('php://input'), false);
			if (AxiosHttpRequest::has('action') && AxiosHttpRequest::hasValue('action', 'post') && !empty(AxiosHttpRequest::getAuthorizationToken())) {
				$token = AxiosHttpRequest::getAuthorizationToken();
				if ($CSRF->verifyToken($token)) {
					$validator->add($request->data, [
						'status' => [
							'required' => true,
							'maxLength' => 40,
							'minLength' => 5
						],
						'response' => [
							'required' => true,
							'minLength' => 5
						]
					]);
					if (!is_array($errorHandler->all())) {
						$requestModel->setId(dec($request->data->req_id));
						$requestModel->setStatus($request->data->status);
						$requestModel->setResponse($request->data->response);
						if ($requestModel->update($requestModel)) {
							echo cleanJSON([
								'header' => CrudErrors::VALID,
								'body' => ' '
							]);
						} else {
							echo cleanJSON([
								'header' => CrudErrors::CANCEL,
								'body' => CrudErrors::crudError('update')
							]);
						}
					} else {
						echo cleanJSON([
							'header' => CrudErrors::NOT_VALID,
							'body' => $errorHandler->all()
						]);
					}
				} else {
					echo cleanJSON([
						'header' => CrudErrors::ERROR,
						'body' => CrudErrors::error()
					]);
				}
				
			}
			else {
				echo cleanJSON([
					'header' => CrudErrors::ERROR,
					'body' => CrudErrors::error()
				]);
			}
		}
	
	}