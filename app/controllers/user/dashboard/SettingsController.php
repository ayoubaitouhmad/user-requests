<?php
	
	namespace App\controllers\user\dashboard;
	
	use App\classes\AxiosHttpRequest;
	use App\classes\base\UploadImage;
	use App\classes\Redirect;
	use App\classes\Request;
	use App\classes\Session;
	use App\classes\UiMessages;
	use App\interfaces\Controller as ControllerFunc;
	use App\classes\base\Controller;
	use App\models\AdminNotification;
	use App\models\UserSetting;
	use App\models\User;
	use Exception;
	
	
	/**
	 *
	 */
	class SettingsController extends Controller implements ControllerFunc
	{
		
		/**
		 * @throws Exception
		 */
		public function __construct()
		{
			
			if (!Session::has('user-connected')) {
				Redirect::To('/');
			}
			$this->init(new User());
			$this->model = new User();
			// TODO : get current user infos
			$this->currentUser = $this->model->getByEmail(Session::get('user-connected'));
			if (!$this->currentUser === false) {
				$this->currentUser->user_photo = getFileFromDirByName($this->currentUser->user_photo);
			} else {
				Session::remove('user-connected');
			}
		}
		
		
		
		/**
		 *
		 * @throws Exception
		 */
		public function index()
		{
			
			$token = $this->tokenManager->token();
			
			// TODO : get current user infos
			$activeUser = $this->currentUser;
			$activeUser->password = Session::get('user-connected-password');
			
			// TODO : get user notifications
			$notification = new AdminNotification();
			$notifications = $notification->getUserNotification($this->currentUser->user_id);
			
			// TODO : get user preferences
			$setting = new UserSetting();
			$settings = $setting->get($this->currentUser->user_id);
			
			
			return view('user/dashboard/setting', compact([
				'token',
				'activeUser',
				'notifications',
				'settings'
			]));
		}
		
		
		
		/**
		 * edit user profile
		 */
		public function editProfile()
		{
			
			if ($this->currentUser->user_compteEtat === 'active') {
				
				
				
				if (Request::has('post')) {
					$request = Request::get('post');
					
					// TODO : check if this token exists in session
					if ($this->tokenManager->verifyToken(AxiosHttpRequest::getAuthorizationToken())) {
						$this->validator->add($request, [
							'name' => [
								'required' => true,
								'text' => true,
								'maxLength' => 100,
								'minLength' => 5
							
							],
							'email' => [
								'required' => true,
								'email' => true,
								'maxLength' => 100,
								'minLength' => 5
							
							],
							'phone' => [
								'required' => true,
								'phone' => 'mar',
								'length' => 10
							
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
							'birth' => [
								'required' => true,
								'date' => true,
								'date_between' => [date('Y') - 18 - 40 . '-01-01', date('Y') - 18 . '-01-01'] // between 18 and 40 year
							
							],
						
						]);
						if (!is_array($this->errorHandler->all())) {
							$user = new User();
							$this->model = new User();
							$user->setName($request->fullname);
							$user->setPhoneNumber($request->phone);
							$user->setAddress($request->address);
							$user->setCity($request->city);
							$user->setGender($request->gender);
							$user->setDate($request->birth);
							$user->setId($this->currentUser->user_id);
							if ($this->currentUser->user_phoneNumber == $request->phone) {
								if ($this->model->updateUser($user)) {
									echo cleanJSON([
										'title' => UiMessages::VALID,
										'body' => ''
									]);
								} else {
									echo cleanJSON([
										'title' => UiMessages::CANCEL,
										'body' => 'nothing changed !!, please change data before click on save button'
									]);
								}
							} else {
								if ($user->isDuplicatedField('user_phoneNumber', $request->phone) == 0) {
									if ($this->model->updateUser($user)) {
										echo cleanJSON([
											'title' => UiMessages::VALID,
											'body' => ''
										]);
									} else {
										echo cleanJSON([
											'title' => UiMessages::CANCEL,
											'body' => UiMessages::crudError('updat')
										]);
									}
								} else {
									echo cleanJSON([
										'title' => UiMessages::USED,
										'body' => UiMessages::used('phone number')
									]);
								}
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
				} else {
					echo cleanJSON([
						'title' => UiMessages::ERROR,
						'body' => UiMessages::error()
					]);
				}
			}
			
		}
		
		
		
		/**
		 * edit user avatar
		 */
		public function editProfileAvatar()
		{
			
			if ($this->currentUser->user_compteEtat === 'active') {
				// TODO  : check authorization
				if (AxiosHttpRequest::getAuthorizationToken() !== '' && Request::has('file') && Request::hasValue('file', 'photo')) {
					if ($this->tokenManager->verifyToken(AxiosHttpRequest::getAuthorizationToken())) {
						$this->uploader = new UploadImage(Request::all(true)['file']['photo']);
						$this->validator->add(Request::all(true)['file'], [
							'photo' => [
								'format' => UploadImage::imgFormatAccept,
								'size' => UploadImage::FILE_SIZE / 1024 / 1024
							]
						]);
						
						// TODO  : validate image
						if (!is_array($this->errorHandler->all())) {
							$this->model = new User();
							$id = $this->currentUser->user_id;
							$fileName = str_replace(' ', '_', $this->currentUser->user_fullname) . '_' . date('y-m-d_h-i-s');
							$this->uploader = new UploadImage(Request::all(true)['file']['photo']);
							$this->uploader->setFileName($fileName);
							$oldPhoto = $this->currentUser->user_photo;
							// TODO  : update user image
							if ($this->model->updateUserAvatar($fileName, $id)) {
								// TODO  : upload new  image
								$this->uploader->save();
								// TODO  : remove old image
								if (!empty($oldPhoto)) deleteFile($oldPhoto);
								echo cleanJSON([
									'title' => UiMessages::VALID,
									'body' => ''
								]);
							} else {
								echo cleanJSON([
									'title' => UiMessages::CANCEL,
									'body' => UiMessages::crudError('updat')
								
								]);
							}
						} else {
							echo cleanJSON([
								'title' => UiMessages::NOT_VALID,
								'body' => $this->errorHandler->all()
							
							]);
						}
					} else
						echo cleanJSON([
							'title' => UiMessages::ERROR,
							'body' => UiMessages::error()
						
						]);
					
				} else {
					echo cleanJSON([
						'title' => UiMessages::ERROR,
						'body' => UiMessages::error()
					
					]);
				}
			}
			
			
			
		}
		
		
		
		/**
		 * edit user security prefrences
		 * @throws Exception
		 */
		public function editPorfilePasswordAndSecurtity()
		{
			
			if ($this->currentUser->user_compteEtat === 'active') {
				if (AxiosHttpRequest::has('action') && AxiosHttpRequest::hasValue('action', 'edit') && !empty(AxiosHttpRequest::getAuthorizationToken())) {
					$token = AxiosHttpRequest::getAuthorizationToken();
					
					if ($this->tokenManager->verifyToken($token)) {
						$post = AxiosHttpRequest::all()->data;
						$this->validator->add($post, [
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
							],
							'question' => [
								'required' => true,
								'paragraph' => true,
								'maxLength' => 100,
								'minLength' => 1
							],
							'response' => [
								'required' => true,
								'paragraph' => true,
								'maxLength' => 100,
								'minLength' => 1
							],
						
						]);
						
						if (!is_array($this->errorHandler->all())) {
							$user = new User();
							$user->setId($this->currentUser->user_id);
							$user->setEmail($post->email);
							$pass =password_hash($post->password , PASSWORD_DEFAULT);
							$user->setPassword($pass);
							$user->setSecretQuestion($post->question);
							$user->setResponse($post->response);
							if ($post->email === $this->currentUser->user_email) {
								if ($this->model->updateUserSecurityData($user)) {
									Session::add('user-connected-password', $post->password);
									echo cleanJSON([
										'title' => UiMessages::VALID,
										'body' => ''
									]);
								} else {
									echo cleanJSON([
										'title' => UiMessages::CANCEL,
										'body' => 'nothing changed !!, please change data before click on save button'
									]);
								}
								
							} else {
								if ($this->model->isDuplicatedField('user_email', $post->email) == 0) {
									if ($this->model->updateUserSecurityData($user)) {
										Session::add('user-connected', $post->email);
										Session::add('user-connected-password', $post->password);
										echo cleanJSON([
											'title' => UiMessages::VALID,
											'body' => ''
										]);
									} else {
										echo cleanJSON([
											'title' => UiMessages::USED,
											'body' => UiMessages::crudError('updat')
										]);
									}
									
								} else
									echo cleanJSON([
										'title' => UiMessages::USED,
										'body' => UiMessages::used('email')
									]);
								
							}
						} else
							echo cleanJSON([
								'title' => UiMessages::NOT_VALID,
								'body' => $this->errorHandler->all()
							]);
						
					} else
						echo cleanJSON([
							'title' => UiMessages::ERROR,
							'body' => UiMessages::error()
						]);
				} else
					echo cleanJSON([
						'title' => UiMessages::ERROR,
						'body' => UiMessages::error()
					]);
			}
			
			
			
		}
		
		
		
		public function editNotifications()
		{
			
			// TODO : stop users from do this stuff  when  account is inactive
			if (AxiosHttpRequest::has('action') && AxiosHttpRequest::hasValue('action', 'edit') && !empty(AxiosHttpRequest::getAuthorizationToken())) {
				$token = AxiosHttpRequest::getAuthorizationToken();
				// TODO : validate page token
				if ($this->tokenManager->verifyToken($token)) {
					$post = AxiosHttpRequest::all()->data;
					$setting = new UserSetting();
					// TODO : db stuff
					if ($setting->edit([$post->prefrences_name, $post->prefrences_data, \PDO::PARAM_BOOL], [$this->currentUser->user_id, \PDO::PARAM_STR])) {
						echo cleanJSON([
							'title' => UiMessages::VALID,
							'body' => $post
						]);
					} else {
						echo cleanJSON([
							'title' => UiMessages::CANCEL,
							'body' => $post
						]);
					}
					
					
					
				}
			} else {
				echo cleanJSON([
					'title' => UiMessages::ERROR,
					'body' => UiMessages::error()
				]);
			}
			
			
		}
		
		
	}