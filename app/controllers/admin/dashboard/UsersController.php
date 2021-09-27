<?php
	
	
	namespace App\controllers\admin\dashboard;
	
	
	use App\classes\base\Controller;
	use App\classes\base\UploadImage;
	use App\classes\PushNotification;
	use App\classes\UiMessages;
	use App\classes\CSRF;
	use App\classes\ErrorHandler;
	use App\classes\AxiosHttpRequest;
	use App\classes\Redirect;
	use App\classes\Request;
	use App\classes\Session;
	use App\classes\Validator;
	use App\models\Admin;
	use App\models\AdminNotification;
	use App\models\AdminSetting;
	use App\models\User;
	use App\models\UserNotification;
	use Exception;
	use Google\Service\ArtifactRegistry\UploadAptArtifactMediaResponse;
	
	/**
	 *
	 */
	class UsersController extends Controller
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
			$this->currentAdmin->admin_photo = getFileFromDirByName($this->currentAdmin->admin_photo);
			
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
			// TODO : get user preferences
			$setting = new AdminSetting();
			$settings = $setting->get($this->currentAdmin->admin_id);
			
			return view('admin/dashboard/users', compact([
				'users',
				'token',
				'usersRoleCountByUser',
				'lastFourUsers',
				'admin',
				'notifications',
				'settings'
			
			]));
			
		}
		
		
		
		/**
		 * add user
		 */
		public function store()
		{
			
			if (
				AxiosHttpRequest::has('action') &&
				AxiosHttpRequest::hasValue('action', 'add') &&
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
						if ($this->model->isDuplicatedData($email, $phone) === 0) {
							$user = new User();
							$user->setName($name);
							$user->setEmail($email);
							$user->setPassword(password_hash($password, PASSWORD_DEFAULT));
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
								'body' => UiMessages::adminAddUser('Email or Phone ')
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
			
			if (Request::has('post')) {
				$request = Request::get('post');
				// TODO : check if this token exists in session
				if ($this->tokenManager->verifyToken(AxiosHttpRequest::getAuthorizationToken())) {
					$this->validator->add($request, [
						'email' => [
							'required' => true,
							'email' => true,
							'maxLength' => 100,
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
							'maxLength' => 100,
							'minLength' => 10
						
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
							'date' => true,
							'date_between' => [date('Y') - 18 - 40 . '-01-01', date('Y') - 18 . '-01-01'] // between 18 and 40 year
						
						],
						'phone' => [
							'required' => true,
							'phone' => 'mar',
							'length' => 10
						
						],
						'role' => [
							'required' => true,
							'like' => ['developer web', 'developer desktop', 'project chef', 'ui analysis', 'designer']
						
						],
						'account' => [
							'required' => true,
							'like' => ['active', 'inactive']
						
						],
						'question' => [
							'required' => true,
							'text' => true,
							'maxLength' => 100,
							'minLength' => 1
						
						],
						'response' => [
							'required' => true,
							'maxLength' => 100,
							'minLength' => 1
						
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
						// TODO : check if user account status changed
						$userToUpdate = $user->get($user->getId());
						$isAccountStatusChanged = isset($userToUpdate) && $userToUpdate->user_compteEtat === $request->account;
						if ($user->isDuplicatedData($user->getEmail(), $user->getPhoneNumber()) == 1) {
							// TODO: check  if user want update photo
							if ($updatePhoto) {
								
								$this->uploader = new UploadImage(Request::all(true)['file']['photo']);
								$this->validator->add(Request::all(true)['file'], [
									'photo' => [
										'format' => UploadImage::imgFormatAccept,
										'size' => UploadImage::FILE_SIZE / 1024 / 1024
									]
								]);
								if (!is_array($this->errorHandler->all())) {
									// TODO: update all infos and photo
									$fileName = $user->getName() . '' . date('y-m-d-h-i-s');
									$this->uploader = new UploadImage(Request::all(true)['file']['photo']);
									$this->uploader->setFileName($fileName);
									$user->setPhoto($fileName);
									$res = $user->get($user->getId());
									$oldPhoto = md5($res->user_photo);
									if ($this->model->update($user)) {
										$this->uploader->save();
										// TODO : notify user when acount status changed
										deleteUserImageByFileName($oldPhoto);
										if (!$isAccountStatusChanged) {
											$title = "Account Notification";
											$body = "";
											if ($request->account === 'active') {
												$body = "Your account has been activated successfuly.";
												PushNotification::send($request->email . '_account_status_changed', [
													'header ' => $title,
													'body ' => $body
												]);
											} else {
												$body = "Your account has been disabled.";
												PushNotification::send($request->email . '_account_status_changed', [
													'header ' => $title,
													'body ' => $body
												]);
											}
											$userNotification = new AdminNotification();
											$userNotification->setTitle($title);
											$userNotification->setDescription($body);
											$userNotification->setUserId($user->getId());
											$userNotification->setAdminId($this->currentAdmin->admin_id);
											$userNotification->setNotificationType(5);
											$userNotification->create($userNotification);
											
										}
										echo cleanJSON([
											'title' => UiMessages::VALID,
											'body' => Request::all(true)['file']
										]);
									} else {
										echo cleanJSON([
											'title' => UiMessages::CANCEL,
											'body' => 'nothing changed !!, please change data before click on save button'
										]);
									}
									
								} else {
									echo cleanJSON([
										'title' => UiMessages::NOT_VALID,
										'body' => $this->errorHandler->all()
									]);
								}
								
							} else {
								// TODO : notify user when acount status changed
								if (!$isAccountStatusChanged) {
									$title = "Account Notification";
									$body = "";
									if ($request->account === 'active') {
										$body = "Your account has been activated successfuly.";
										PushNotification::send($request->email . '_account_status_changed', [
											'header ' => $title,
											'body ' => $body
										]);
									} else {
										$body = "Your account has been disabled.";
										PushNotification::send($request->email . '_account_status_changed', [
											'header ' => $title,
											'body ' => $body
										]);
									}
									$userNotification = new AdminNotification();
									$userNotification->setTitle($title);
									$userNotification->setDescription($body);
									$userNotification->setUserId($user->getId());
									$userNotification->setAdminId($this->currentAdmin->admin_id);
									$userNotification->setNotificationType(5);
									$userNotification->create($userNotification);
									
								}
								// TODO: update all filed without photo
								if ($this->model->update($user)) {
									echo cleanJSON([
										'title' => UiMessages::VALID,
										'body' => $request
									]);
								} else {
									echo cleanJSON([
										'title' => UiMessages::CANCEL,
										'body' => 'nothing changed !!, please change data before click on save button'
									]);
								}
								
							}
						} else {
							echo cleanJSON([
								'title' => UiMessages::USED,
								'body' => UiMessages::used('email or password')
							]);
						}
						
					} else {
						echo cleanJSON([
							'title' => UiMessages::NOT_VALID,
							'body' => $this->errorHandler->all()
						]);
					}
				} else {
					echo cleanJSON([
						'title' => UiMessages::ERROR,
						'body' => UiMessages::error()
					]);
				}
				
			}
			
		}
		
		
		
		/**
		 * controller for delete single record
		 */
		public function destroy()
		{
			
			if (AxiosHttpRequest::has('action') &&
				AxiosHttpRequest::hasValue('action', 'delete') &&
				!empty(AxiosHttpRequest::getAuthorizationToken()) &&
				AxiosHttpRequest::all()->data->id_enc) {
				if ($this->tokenManager->verifyToken(AxiosHttpRequest::getAuthorizationToken())) {
					if (AxiosHttpRequest::has('data')) {
						$post = AxiosHttpRequest::all()->data;
						$id = dec($post->id_enc);
						$user = new User();
						
						
						if ($user->delete($id)) {
							echo cleanJSON([
								'header' => UiMessages::VALID,
								'body' => ''
							]);
						} else {
							echo cleanJSON([
								'header' => UiMessages::CANCEL,
								'body' => UiMessages::crudError('delete')
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


























