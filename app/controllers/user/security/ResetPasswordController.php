<?php
	
	namespace App\controllers\user\security;
	
	use App\classes\AxiosHttpRequest;
	use App\classes\base\Controller;
	use App\classes\CSRF;
	use App\classes\ErrorHandler;
	use App\classes\Mailer;
	use App\classes\PushNotification;
	use App\classes\Redirect;
	use App\classes\Session;
	use App\classes\UiMessages;
	use App\interfaces\Controller as ControllerFunc;
	use App\models\AdminNotification;
	use App\models\User;
	use App\models\UserNotification;
	use App\models\UserSetting;
	
	class ResetPasswordController extends Controller implements ControllerFunc
	{
		
		public function __construct()
		{
			
			if (Session::has('user-connected')) {
				Redirect::To('/user/dashboard');
			}
			if (Session::has('currentSignUp')) {
				Redirect::To('/user/signup');
			}
			$this->init(new User());
			
		}
		
		
		public  function __destruct()
		{
		
		}
		
		
		
		public function index()
		{
			
			// TODO : Get page token
			$token = $this->tokenManager->token();
			
			return view('user/security/reset_password', compact([
				'token'
			]));
		}
		
		// option :  change password with question secret
		public function checkQuestionSecret()
		{
			if (AxiosHttpRequest::has('action') && AxiosHttpRequest::hasValue('action', 'edit') && !empty(AxiosHttpRequest::getAuthorizationToken())) {
				$token = AxiosHttpRequest::getAuthorizationToken();
				if ($this->tokenManager->verifyToken($token)) {
					$post = AxiosHttpRequest::all()->data;
					$this->init(new User());
					$this->validator->add($post, [
						'question' => [
							'required' => true,
							'text' => true,
							'maxLength' => 100,
							'minLength' => 1
						]
					]);
					if (!is_array($this->errorHandler->all())) {
						$res = Session::get('user-to-reset')->user_Response;
						if ($post->question === $res) {
							echo cleanJSON([
								'title' => UiMessages::VALID,
								'body' => ''
							]);
						} else {
							echo cleanJSON([
								'title' => UiMessages::CANCEL,
								'body' =>'error !! , invalid response'
							]);
						}
						
						
					} else {
						echo cleanJSON([
							'title' => UiMessages::NOT_VALID,
							'body' => $this->errorHandler->all()
						]);
					}
					
				}
			}
		}
		
		// option : change password with email
		public function checkEmail()
		{
			
			if (AxiosHttpRequest::has('action') && AxiosHttpRequest::hasValue('action', 'check') && !empty(AxiosHttpRequest::getAuthorizationToken())) {
				$token = AxiosHttpRequest::getAuthorizationToken();
				if ($this->tokenManager->verifyToken($token)) {
					$post = AxiosHttpRequest::all()->data;
					$this->validator->add($post, [
						'email' => [
							'required' => true,
							'email' => true,
							'maxLength' => 100,
							'minLength' => 5
						]
					]);
					if (!is_array($this->errorHandler->all())) {
						$this->model = new User();
						if ($this->model->isDuplicatedField('user_email', $post->email) === 1) {
							$user = $this->model->getByEmail($post->email);
							$code = $this->tokenManager->getValidationCode();
							Mailer::resetPassword($post->email ,$user->user_fullname , $code );
							$user->code = $code;
							Session::add('user-to-reset', $user);
							
							echo cleanJSON([
								'title' => UiMessages::VALID,
								'body' => $user->user_secretQuestion
							]);
						} else {
							echo cleanJSON([
								'title' => UiMessages::NOT_FOUND,
								'body' => UiMessages::invalidData()
							]);
						}
						
					} else {
						echo cleanJSON([
							'title' => UiMessages::NOT_VALID,
							'body' => $this->errorHandler->all()
						]);
					}
					
				}
			}
		}
		public function checkCode()
		{
			
			if (AxiosHttpRequest::has('action') && AxiosHttpRequest::hasValue('action', 'check') && !empty(AxiosHttpRequest::getAuthorizationToken())) {
				$token = AxiosHttpRequest::getAuthorizationToken();
				if ($this->tokenManager->verifyToken($token)) {
					$post = AxiosHttpRequest::all()->data;
					$this->init(new User());
					$this->validator->add($post, [
						'code' => [
							'required' => true,
							'number' => true,
							'length' => 6
						]
					]);
					if (!is_array($this->errorHandler->all())) {
						$code = Session::get('user-to-reset')->code;
						if ($post->code === $code) {
							echo cleanJSON([
								'title' => UiMessages::VALID,
								'body' => ''
							]);
						} else {
							echo cleanJSON([
								'title' => UiMessages::CANCEL,
								'body' => UiMessages::notMatch("code")
							]);
						}
						
						
					} else {
						echo cleanJSON([
							'title' => UiMessages::NOT_VALID,
							'body' => $this->errorHandler->all()
						]);
					}
					
				}
			}
		}
		
		
		// change
		public function edit()
		{
			// TODO : Check data and token
			if (AxiosHttpRequest::has('action') && AxiosHttpRequest::hasValue('action', 'edit') && !empty(AxiosHttpRequest::getAuthorizationToken())) {
				$token = AxiosHttpRequest::getAuthorizationToken();
				// TODO : Verify Token
				if ($this->tokenManager->verifyToken($token)) {
					$post = AxiosHttpRequest::all()->data;
					$this->init(new User());
					$this->validator->add($post, [
						'password' => [
							'required' => true,
							'maxLength' => 100,
							'minLength' => 8
						]
					]);
					// TODO : check id data valid
					if (!is_array($this->errorHandler->all())) {
						
						$this->model = new User();
						$user = Session::get('user-to-reset');
						$password = password_hash($post->password, PASSWORD_DEFAULT);
						// TODO : change password
						if ($this->model->updateField(['user_password', $password], $user->user_id)) {
							// TODO : redirect to home
							Session::add('user-connected', $user->user_email);
							Session::add('user-connected-password', $post->password);
							Session::remove('user-to-reset');
							// TODO : notify user
							$description = 'your password has been changed ';
							$title = 'Security Notification';
							$userNotification = new AdminNotification();
							$userNotification->setTitle($title);
							$userNotification->setDescription($description);
							$userNotification->setUserId($user->user_id);
							$userNotification->setAdminId('admin_');
							$userNotification->setNotificationType(4);
							$userNotification->create($userNotification);
							
							$description = 'user ' . $user->user_fullname . ' has been change password.';
							$title = 'Security Notification';
							
							$userNotification = new UserNotification();
							$userNotification->setTitle($title);
							$userNotification->setDescription($description);
							$userNotification->setUserId($user->user_id);
							$userNotification->setNotificationType(4);
							$userNotification->create($userNotification);
							
							PushNotification::send($user->user_email.'_change_email', [
								'header ' => $title,
								'body ' => $description,
								'photo' => ''
							
							]);
							PushNotification::send(PushNotification::SECURITY_NOTIFICATION, [
								'header ' => $title,
								'body ' => $description,
								'photo' => $user->user_photo
							
							]);
							
							
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
					
				}
			}
		}
		
		
	}