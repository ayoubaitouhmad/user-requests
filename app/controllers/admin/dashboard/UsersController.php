<?php
	
	
	namespace App\controllers\admin\dashboard;
	
	
	use App\classes\base\UploadImage;
	use App\classes\CrudErrors;
	use App\classes\CSRF;
	use App\classes\ErrorHandler;
	use App\classes\AxiosHttpRequest;
	use App\classes\Redirect;
	use App\classes\Request;
	use App\classes\Session;
	use App\classes\Validator;
	use App\data\database;
	use App\models\Admin;
	use App\models\User;
	use Exception;
	
	/**
	 *
	 */
	class UsersController
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
//		Session::remove('admin-connected');
			if (!isAuthenticated()) {
				Redirect::To('/admin/login');
			}
			$this->model = new Admin();
			$this->tokenManager = new CSRF();
			$this->errorHandler = new ErrorHandler();
			$this->validator = new Validator($this->errorHandler);
			$this->currentAdmin = Session::get('admin-connected');
		
			
		}
		
		
		
		/**
		 * controller for
		 *                 get the view
		 *                 send the data
		 * @throws Exception
		 */
		public function index()
		{
			
			$user = new User();
			$usersRoleCountByUser = $user->usersRoleCountByUser();
			$lastFourUsers = User::getUserImage($user->getLastFourUsers());
			$users = $user->all();
			getPhoto($users , 'user_photo'); // get users image from upload dir
			encyptIdentifiers($users , 'user_id'); // crypt the users ids befor sended to view
			$tokenCreator = new CSRF();
			$token = $tokenCreator->token();
			$admin = [
				'name' => $this->currentAdmin->admin_name,
				'photo' => getFileFromDirByName($this->currentAdmin->admin_photo)
			];
			return view('admin/dashboard/users', compact(['users', 'token', 'usersRoleCountByUser', 'lastFourUsers' , 'admin']));
			
		}
		
		
		
		/**
		 * add user
		 */
		public function store()
		{
			
			$user = new User();
			$csrfCreator = new CSRF();
			$errorHandler = new ErrorHandler();
			$validator = new Validator($errorHandler);
			if (Request::has('post') && Request::hasValue('post', 'token')) {
				if ($csrfCreator->verifyToken(Request::get('post')->token)) {
					$validator->add(Request::get('post'), [
						'name' => [
							'required' => true,
							'text' => true,
							'maxLength' => 50,
							'minLength' => 6
						],
						'email' => [
							'required' => true,
							'email' => true,
							'maxLength' => 20,
							'minLength' => 5
						],
						'password' => [
							'required' => true,
							'maxLength' => 50,
							'minLength' => 8
						]]);
					if (!is_array($errorHandler->all())) {
						$name = Request::get('post')->name;
						$email = Request::get('post')->email;
						$password = Request::get('post')->password;
						$token = Request::get('post')->token;
						
						if ($user->count($email) == 0) {
							$user->setName($name);
							$user->setEmail($email);
							$user->setPassword($password);
							if ($user->create($user)) {
								echo cleanJSON([
									'title' => CrudErrors::VALID,
									'body' => ''
								]);
							} else {
								echo cleanJSON([
									'title' => CrudErrors::ERROR,
									'body' => CrudErrors::crudError('add')
								]);
							}
						} else {
							echo cleanJSON([
								'title' => CrudErrors::USED,
								'body' => CrudErrors::used('email')
							]);
						}
					} else {
						echo cleanJSON([
							'title' => 'validator',
							'body' => $errorHandler->all()
						]);
					}
				} else {
					echo cleanJSON([
						'title' => CrudErrors::ERROR,
						'body' => CrudErrors::error()
					]);
				}
				
			} else {
				echo cleanJSON([
					'title' => CrudErrors::ERROR,
					'body' => CrudErrors::error()
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
		 */
		public function edit()
		{
			
			$user = new User();
			$csrfCreator = new CSRF();
			$errorHandler = new ErrorHandler();
			$validator = new Validator($errorHandler);
			// TODO : check post and token
			if (Request::get('post') && Request::hasValue('post', 'token')) {
				$request = Request::get('post');
				// TODO : check if this token exists in session
				if ($csrfCreator->verifyToken($request->token)) {
					
					$validator->add($request, [
						
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
						'password' => [
							'required' => true,
							'maxLength' => 50,
							'minLength' => 8
						
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
					if (!is_array($errorHandler->all())) {
						$updatePhoto = Request::hasValue('file', 'photo');
						$user->setId(dec($request->id));
						$user->setName($request->name);
						$user->setAddress($request->address);
						$user->setCity($request->city);
						$user->setGender($request->gender);
						$user->setDate($request->date);
						$user->setPhoneNumber($request->phone);
						$user->setEmail($request->email);
						$user->setPassword($request->password);
						$user->setRole($request->role);
						$user->setCompteEtat($request->account);
						$user->setSecretQuestion($request->question);
						$user->setResponse($request->response);
						
						// TODO: check  if user want update photo
						if ($updatePhoto) {
							// TODO: update all filed and photo
							$fileName = $user->getName() . '' . date('y-m-d-h-i-s');
							$this->uploader = new UploadImage(Request::all(true)['file']['photo']);
							$this->uploader->setFileName($fileName);
							$user->setPhoto($fileName);
							$res = $user->get($user->getId());
							$oldPhoto = md5($res->user_photo);
							if ($user->update($user)) {
								$this->uploader->save();
								deleteFile($oldPhoto);
								echo cleanJSON([
									'title' => CrudErrors::VALID,
									'body' => ''
								]);
							} else {
								echo cleanJSON([
									'title' => CrudErrors::ERROR,
									'body' => CrudErrors::crudError('update')
								]);
							}
							
						} else {
							// TODO: update all filed without photo
							$user->update($user);
							echo cleanJSON([
								'title' => CrudErrors::VALID,
								'body' => ' '
							]);
						}
					} else {
						echo cleanJSON([
							'title' => 'validator',
							'body' => $errorHandler->all()
						]);
					}
				} else {
					echo cleanJSON([
						'title' => 'Error',
						'body' => CrudErrors::error()
					]);
				}
				
			} else {
				echo cleanJSON([
					'title' => 'Error',
					'body' => CrudErrors::error()
				]);
			}
		}
		
		
		
		/**
		 * controller for delete single record
		 */
		public function destroy()
		{
			
			$CSRF = new CSRF();
			if (AxiosHttpRequest::has('type') && AxiosHttpRequest::hasValue('type', 'post') && !empty(AxiosHttpRequest::getAuthorizationToken())) {
				if ($CSRF->verifyToken(AxiosHttpRequest::getAuthorizationToken())) {
					if (AxiosHttpRequest::has('data')) {
						$id = dec(AxiosHttpRequest::get('data', 'id_enc'));
						$user = new User();
						if ($user->delete($id)) {
							echo cleanJSON([
								'header' => CrudErrors::VALID,
								'body' => $id
							]);
						} else {
							echo cleanJSON([
								'header' => CrudErrors::CANCEL,
								'body' => $id
							]);
						}
					}
					
					
				} else {
					echo cleanJSON([
						'header' => CrudErrors::ERROR,
						'body' => CrudErrors::error()
					]);
				}
				
			} else {
				echo cleanJSON([
					'header' => CrudErrors::ERROR,
					'body' => CrudErrors::error()
				]);
			}
			
		}
		
		
		
		/**
		 * get charts data
		 */
		public function charts()
		{
			
			$user = new User();
			
			echo cleanJSON([
				'body' =>
					[
						
						'userCountWomen' => $user->userCountByGender('f'),
						'userCountMen' => $user->userCountByGender('m'),
						'userCountByMonthCurYear' => $user->userCountByMonth(date('Y')),
						'userCountByMonthLastYear' => $user->userCountByMonth((date('Y') - 1))
					]
			]);
		}
		
		
	}


























