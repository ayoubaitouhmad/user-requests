<?php
	
	namespace App\controllers\admin\dashboard;
	
	use App\classes\AxiosHttpRequest;
	use App\classes\base\Controller as Func;
	use App\classes\base\UploadImage;
	use App\classes\Redirect;
	use App\classes\Session;
	use App\classes\Request;
	use App\classes\UiMessages;
	use App\models\Admin;
	use App\models\AdminSetting;
	use App\models\User;
	
	use App\models\UserSetting;
	use Google\Service\AndroidPublisher\Resource\EditsListings;
	use PDO;
	
	class SettingsController extends Func implements \App\interfaces\Controller
	{
		
		
		public function __construct()
		{
			
			if (!isAuthenticated()) {
				Redirect::To('/admin/login');
			}
			$this->init(new Admin());
			
			
			// TODO :  get the current Admin infos
			$admin = new Admin();
			$username = Session::get('admin-connected');
			$this->currentAdmin = $admin->get($username);
			$this->currentAdmin->admin_photo = getFileFromDirByName($this->currentAdmin->admin_photo);
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
			
			return view('admin/dashboard/setting', compact([
				'token',
				'admin',
				'settings',
				'notifications'
			]));
		}
		
		
		
		public function editProfile()
		{
			
			if (AxiosHttpRequest::has('action') &&
				AxiosHttpRequest::hasValue('action', 'edit') &&
				AxiosHttpRequest::getAuthorizationToken() !== '') {
				$request = AxiosHttpRequest::all()->data;
				// TODO : check if this token exists in session
				if ($this->tokenManager->verifyToken(AxiosHttpRequest::getAuthorizationToken())) {
					$this->validator->add($request, [
						'fullname' => [
							'required' => true,
							'text' => true,
							'maxLength' => 50,
							'minLength' => 5
						]
					
					]);
					if (!is_array($this->errorHandler->all())) {
						$user = new User();
						$this->model = new Admin();
						$user->setName($request->fullname);
						if ($this->model->editColumn(['admin_name', $request->fullname, PDO::PARAM_STR], [$this->currentAdmin->admin_id, PDO::PARAM_STR])) {
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
		
		
		
		public function editProfileAvatar()
		{
			
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
						$this->model = new Admin();
						$fileName = str_replace(' ', '_', $this->currentAdmin->admin_id) . '_' . date('y-m-d_h-i-s');
						$this->uploader = new UploadImage(Request::all(true)['file']['photo']);
						$this->uploader->setFileName($fileName);
						$oldPhoto = $this->currentAdmin->admin_photo;
						// TODO  : update user image
						if ($this->model->editColumn(['admin_photo', $fileName, PDO::PARAM_STR], [$this->currentAdmin->admin_id, PDO::PARAM_STR])) {
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
		
		
		
		public function editPorfilePasswordAndSecurtity()
		{
			
			if (AxiosHttpRequest::has('action') && AxiosHttpRequest::hasValue('action', 'edit') && !empty(AxiosHttpRequest::getAuthorizationToken())) {
				$token = AxiosHttpRequest::getAuthorizationToken();
				
				if ($this->tokenManager->verifyToken($token)) {
					$post = AxiosHttpRequest::all()->data;
					$this->validator->add($post, [
						'email' => [
							'required' => true,
							'text' => true,
							'maxLength' => 100,
							'minLength' => 5
						],
						'password' => [
							'required' => true,
							'uppercase' => true,
							'lowercase' => true,
							'specialChars' => true,
							'maxLength' => 50,
							'minLength' => 8
						]
					]);
					
					if (!is_array($this->errorHandler->all())) {
						$admin = new Admin();
						$admin->setPassword($post->password);
						$admin->setUsername($post->username);
						$admin->setId($this->currentAdmin->admin_id);
						
						$this->model = new Admin();
						
						if ($this->model->editSecurityData($admin)) {
							Session::add('admin-connected' , $post->username);
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
		
		
		
		public function editNotifications()
		{
			if (AxiosHttpRequest::has('action') && AxiosHttpRequest::hasValue('action', 'edit') && !empty(AxiosHttpRequest::getAuthorizationToken())) {
				$token = AxiosHttpRequest::getAuthorizationToken();
				if ($this->tokenManager->verifyToken($token)) {
					$post = AxiosHttpRequest::all()->data;
					$setting = new AdminSetting();
					
					if ($setting->edit([$post->prefrences_name ,$post->prefrences_data , PDO::PARAM_BOOL] , [$this->currentAdmin->admin_id , PDO::PARAM_STR])){
						echo cleanJSON([
							'title' => UiMessages::VALID,
							'body' => $post
						]);
					}else{
						echo cleanJSON([
							'title' => UiMessages::CANCEL,
							'body' => $post
						]);
					}
					
					
					
				}
			}else{
				echo cleanJSON([
					'title' => UiMessages::ERROR,
					'body' => UiMessages::error()
				]);
			}
		}
		
		
	}