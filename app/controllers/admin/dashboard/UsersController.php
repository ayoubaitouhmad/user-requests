<?php
	
	
	namespace App\controllers\admin\dashboard;
	
	
	use App\classes\base\Controller;
	use App\classes\base\UploadImage;
	use App\classes\UiMessages;
	use App\classes\CSRF;
	use App\classes\ErrorHandler;
	use App\classes\AxiosHttpRequest;
	use App\classes\Redirect;
	use App\classes\Request;
	use App\classes\Session;
	use App\classes\Validator;
	use App\models\Admin;
	use App\models\User;
	use App\models\UserNotification;
	use Exception;
	
	/**
	 *
	 */
	class UsersController extends  Controller
	{
		
		
		
		
		
		/**
		 * @throws Exception
		 */
		public function __construct()
		{

			if (!isAuthenticated()) {
				Redirect::To('/admin/login');
			}
			$this->init(new User());
			
			// TODO :  get the current Admin infos
			$admin = new Admin();
			$username = Session::get('admin-connected');
			$this->currentAdmin = $admin->get($username);
			$this->currentAdmin->admin_photo  = getFileFromDirByName($this->currentAdmin->admin_photo);
			
		}
		
		
		
		/**
		 * controller for
		 *                 get the view
		 *                 send the data
		 * @throws Exception
		 */
		public function index()
		{
			// TODO / get users list
			$usersRoleCountByUser = $this->model->usersRoleCountByUser();
			$lastFourUsers = User::getUserImage($this->model->getLastFourUsers());
			$users = $this->model->all();
			// TODO / get page token
			$tokenCreator = new CSRF();
			$token = $tokenCreator->token();
			// TODO / get current admin infos
			$admin = $this->currentAdmin;
			// TODO / get  notifications list
		
			$notifications = HomeController::AdminNotification();
			// TODO / send all to view
			return view('admin/dashboard/users', compact([
				'users',
				'token',
				'usersRoleCountByUser',
				'lastFourUsers' ,
				'admin',
				'notifications'
				
			]));
			
		}
		
		
		
		
		/**
		 * add user
		 */
		public function store()
		{
			
			if (
					AxiosHttpRequest::has('action') &&
					AxiosHttpRequest::hasValue('action' , 'add') &&
					AxiosHttpRequest::has('data') &&
					!empty(AxiosHttpRequest::getAuthorizationToken())
			) {
				if ($this->tokenManager->verifyToken(AxiosHttpRequest::getAuthorizationToken())) {
					$postRequest = AxiosHttpRequest::all()->data;
					$this->validator->add($postRequest, [
						'name' => [
							'required' => true,
							'text' => true,
							'maxLength' => 50,
							'minLength' => 6
						],
						'email' => [
							'required' => true,
							'email' => true,
							'maxLength' => 100,
							'minLength' => 5
						],
						'password' => [
							'required' => true,
							'maxLength' => 50,
							'minLength' => 8
						]]);
					if (!is_array($this->errorHandler->all())) {
						$name = $postRequest->name;
						$email = $postRequest->email;
						$password = $postRequest->password;
						$phone = $postRequest->phone;
						if ($this->model->isDuplicatedData($email , $phone) === 0 ) {
							$user = new User();
							$user->setName($name);
							$user->setEmail($email);
							$user->setPassword(password_hash($password , PASSWORD_DEFAULT));
							$user->setPhoneNumber($phone);
							if ($user->create($user)) {
								echo cleanJSON([
									'header' => UiMessages::VALID,
									'body' => ''
								]);
							} else {
								echo cleanJSON([
									'header' => UiMessages::ERROR,
									'body' => UiMessages::crudError('add')
								]);
							}
						} else {
							echo cleanJSON([
								'header' => UiMessages::USED,
								'body' => UiMessages::adminAddUser('email or password ')
							]);
						}
					} else {
						echo cleanJSON([
							'header' => 'validator',
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
		
		
		
		/**
		 * controller for get single record
		 */
		public function get()
		{
			
			$CSRF = new CSRF();
			if (AxiosHttpRequest::getAuthorizationToken() !== null && $CSRF->verifyToken(AxiosHttpRequest::getAuthorizationToken())) {
				$user = new User();
				$id = AxiosHttpRequest::getCustomHttpHeader('x-user') ?? '';
				if (!empty($id)) {
					$id = dec($id);
					$userFounded = $user->get($id);
					$userFounded->user_photo = getFileFromDirByName($userFounded->user_photo);
					echo cleanJSON(
						[
							'title' => 'founded',
							'body' => $userFounded
						]
					);
				}
			}
			
			
		}
		
		
		
		/**
		 * controller for update single record
		 * @throws Exception
		 */
		public function edit()
		{
			
		
			
			if (Request::has('post') ) {
				$request = Request::get('post');
				// TODO : check if this token exists in session
				if ($this->tokenManager->verifyToken(AxiosHttpRequest::getAuthorizationToken())) {
					$this->validator->add($request, [
						
						'email' => [
							'required' => true,
							'email' => true,
							'maxLength' => 50,
							'minLength' => 5
						
						],
						'name' => [
							'required' => true,
							'text' => true,
							'maxLength' => 50,
							'minLength' => 6
						
						],
						'address' => [
							'required' => true,
							'address' => true,
							'maxLength' => 50,
							'minLength' => 6
						
						],
						'city' => [
							'required' => true,
						],
						'gender' => [
							'required' => true,
							'gender' => true
						
						],
						'date' => [
							'required' => true,
							'date' => true
						
						],
						'phone' => [
							'required' => true,
							'phone' => 'mar',
							'length' => 10
						
						],
						'role' => [
							'required' => true,
						
						
						],
						'account' => [
							'required' => true,
						
						
						],
						'question' => [
							'required' => true,
							'text' => true,
							'maxLength' => 100,
							'minLength' => 6
						
						],
						'response' => [
							'required' => true,
							'maxLength' => 100,
							'minLength' => 6
						
						],
					
					]);
					// TODO: validate data
					if (!is_array($this->errorHandler->all())) {
						$updatePhoto = Request::hasValue('file', 'photo');
						$user = new User();
						$user->setId(dec($request->id));
						$user->setName($request->name);
						$user->setAddress($request->address);
						$user->setCity($request->city);
						$user->setGender($request->gender);
						$user->setDate($request->date);
						$user->setPhoneNumber($request->phone);
						$user->setEmail($request->email);
						$user->setRole($request->role);
						$user->setCompteEtat($request->account);
						$user->setSecretQuestion($request->question);
						$user->setResponse($request->response);
						if($user->isDuplicatedData($user->getEmail() ,$user->getPhoneNumber()) == 1){
							// TODO: check  if user want update photo
							if ($updatePhoto) {
								// TODO: update all filed and photo
								$fileName = $user->getName() . '' . date('y-m-d-h-i-s');
								$this->uploader = new UploadImage(Request::all(true)['file']['photo']);
								$this->uploader->setFileName($fileName);
								$user->setPhoto($fileName);
								$res = $user->get($user->getId());
								$oldPhoto = md5($res->user_photo);
								if ($this->model->update($user)) {
									$this->uploader->save();
									deleteFile($oldPhoto);
									echo cleanJSON([
										'title' => UiMessages::VALID,
										'body' => ''
									]);
								} else {
									echo cleanJSON([
										'title' => UiMessages::ERROR,
										'body' => UiMessages::crudError('update')
									]);
								}
								
							}
							else {
								// TODO: update all filed without photo
								$user->update($user);
								echo cleanJSON([
									'title' => UiMessages::VALID,
									'body' => ' '
								]);
							}
						}else{
							echo cleanJSON([
								'title' => UiMessages::USED,
								'body' => UiMessages::used('email or password')
							]);
						}
						
					} else {
						echo cleanJSON([
							'title' => 'validator',
							'body' => $this->errorHandler->all()
						]);
					}
				} else {
					echo cleanJSON([
						'title' => 'Error',
						'body' => UiMessages::error()
					]);
				}
				
			} else {
				echo cleanJSON([
					'title' => 'Errofr',
					'body' => Request::all()
				]);
			}
		}
		
		
		
		/**
		 * controller for delete single record
		 */
		public function destroy()
		{
			
			if (AxiosHttpRequest::has('type') && AxiosHttpRequest::hasValue('type', 'post') && !empty(AxiosHttpRequest::getAuthorizationToken())) {
				if ($this->tokenManager->verifyToken(AxiosHttpRequest::getAuthorizationToken())) {
					if (AxiosHttpRequest::has('data')) {
						$id = dec(AxiosHttpRequest::get('data', 'id_enc'));
						$user = new User();
						if ($user->delete($id)) {
							echo cleanJSON([
								'header' => UiMessages::VALID,
								'body' => $id
							]);
						} else {
							echo cleanJSON([
								'header' => UiMessages::CANCEL,
								'body' => $id
							]);
						}
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
		
		
		
		/**
		 * get charts data
		 */
		public function charts()
		{
			echo cleanJSON([
				'body' =>
					[
						
						'userCountWomen' => $this->model->userCountByGender('f'),
						'userCountMen' => $this->model->userCountByGender('m'),
						'userCountByMonthCurYear' => $this->model->userCountByMonth(date('Y')),
						'userCountByMonthLastYear' => $this->model->userCountByMonth((date('Y') - 1))
					]
			]);
		}
		
		
		
	}


























