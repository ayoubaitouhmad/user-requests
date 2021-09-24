<?php
	
	namespace App\controllers\user\signup;
	
	use App\classes\AxiosHttpRequest;
	use App\classes\base\UploadImage;
	use App\classes\CSRF;
	use App\classes\ErrorHandler;
	use App\classes\PushNotification;
	use App\classes\Redirect;
	use App\classes\Request;
	use App\classes\Session;
	use App\classes\UiMessages;
	use App\classes\Validator;
	use App\classes\base\Controller;
	use App\interfaces\Controller as ControllerFunc;
	use App\models\Admin;
	use App\models\Notification;
	use App\models\User;
	use App\models\UserNotification;
	use Exception;
	
	/**
	 *
	 */
	class ProfileController extends Controller implements ControllerFunc
	{
		
		
		public function __construct()
		{
			
			if (Session::has('user-connected')) {
				Redirect::To('/user/dashboard');
			}
			if (Session::get('currentSignUp') !== null && isset(Session::get('currentSignUp')['sign_up_status'])) {
				if (Session::get('currentSignUp')['sign_up_status'] !== 1) {
					Redirect::To('/user/signup');
				}
			} else {
				isset($_SERVER['HTTP_REFERER']) ? Redirect::back() : Redirect::To('/user/signup');
			}
			
			
			
			$this->model = new User();
			$this->tokenManager = new CSRF();
			$this->errorHandler = new ErrorHandler();
			$this->validator = new Validator($this->errorHandler);
			
		}
		
		
		
		/**
		 *
		 * get the view
		 * send the data
		 * @return void
		 * @throws Exception
		 */
		public function index()
		{
			
			$token = $this->tokenManager->token();
			$currentUser = Session::get('currentSignUp') ?? '';
			
			return view('user/sign_up/profile', compact(['currentUser', 'token']));
		}
		
		
		
		/**
		 * save the user profile data
		 *
		 */
		public function save()
		{
			
			// TODO : check post and token
			if (Request::get('post') !== null && AxiosHttpRequest::getAuthorizationToken() !== '') {
				$token = AxiosHttpRequest::getAuthorizationToken();
				$request = Request::get('post');
				
				// TODO : check if this token exists in session
				if ($this->tokenManager->verifyToken($token)) {
					
					// TODO: validate data
					$this->validator->add($request, [
						'gender' => [
							'required' => true,
							'gender' => true
						],
						'address' => [
							'required' => true,
							'address' => true,
							'maxLength' => 100,
							'minLength' => 5
						],
						'role' => [
							'required' => true,
						],
						'secretQuestion' => [
							'required' => true,
							'maxLength' => 100,
							'minLength' => 1
						],
						'date' => [
							'required' => true,
							'date' => true
						],
						'city' => [
							'required' => true,
						],
						'response' => [
							'required' => true,
							'maxLength' => 100,
							'minLength' => 1
						],
					
					]);
					
					
					$this->uploader = new UploadImage(Request::all(true)['file']['photo']);
					if (!$this->uploader->isValidType() || !$this->uploader->isValidSize()) {
						$this->errorHandler->addError('image', 'sorry ,  image must be (jpg,jpeg,webp,png) and size 2mg');
					}
					
					
					if (!is_array($this->errorHandler->all())) {
						$user = new User();
						$currentUserData = Session::get('currentSignUp');
						
						// TODO : Generate id
						$user->setId(generateId($currentUserData['name']));
						// TODO: GET THE PREV DATA FROM SESSION
						$user->setName($currentUserData['name']);
						$user->setEmail($currentUserData['email']);
						$user->setPhoneNumber($currentUserData['phoneNumber']);
						$user->setPassword(password_hash($currentUserData['password'] , PASSWORD_DEFAULT));
						// TODO : GET NEW DATA
						$user->setGender($request->gender);
						$user->setAddress($request->address);
						$user->setRole($request->role);
						$user->setSecretQuestion($request->secretQuestion);
						$user->setDate($request->date);
						$user->setCity($request->city);
						$user->setResponse($request->response);
						$user->setPhoto($user->generateUserPhotoName());
						
						
						
						// TODO // TRY ADD USER
						if ($this->model->createUserProfile($user)) {
							// TODO : UPLOAD IMAGE TO DIR
							$this->uploader->setFileName($user->getPhoto());
							$this->uploader->save();
							
							// TODO : NOTIFY ADMIN
							$title = 'new signup';
							$description = 'user ' . $user->getName() . " ({$user->getEmail()}) " . ' has just registered.' ;
							$notification = new UserNotification();
							$notification->setTitle($title);
							$notification->setDescription($description);
							$notification->setUserId($user->getId());
							$notification->setNotificationType(1);
							
							if ($notification->create($notification)) {
								// TODO : SEND NOTIFICATION
								PushNotification::send(PushNotification::adduser, [
									'header ' => 'new signup',
									'body ' => 'user ' . $user->getName() . " ({$user->getEmail()}) " . ' has just registered',
									'photo' => getFileFromDirByName($user->getPhoto())
								]);
								// TODO : END SIGNUP ANS START SIGNING SESSION
								Session::remove('currentSignUp');
								Session::add('user-connected', $user->getEmail());
								echo cleanJSON([
									'header' => 'done',
									'body' => ''
								]);
							} else {
								echo cleanJSON([
									'header' => UiMessages::CANCEL,
									'body' => UiMessages::error()
								]);
							}
							
						} else {
							echo cleanJSON([
								'header' => UiMessages::CANCEL,
								'body' => UiMessages::crudError('add')
							]);
						}
						
						
						
					} else {
						echo cleanJSON([
							'header' => UiMessages::NOT_VALID,
							'body' => $this->errorHandler->all()
						]);
					}
					
				}
				else {
					echo cleanJSON([
						'header' => UiMessages::ERROR,
						'body' => 'dfd'
					]);
				}
			}else{
				echo cleanJSON([
					'header' => UiMessages::ERROR,
					'body' => UiMessages::error()
				]);
			}
		}
	}