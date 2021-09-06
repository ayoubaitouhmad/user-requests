<?php
	
	declare(strict_types=1);
	
	
	namespace App\controllers\admin;
	
	
	
	use App\classes\AxiosHttpRequest;
	use App\classes\CrudErrors;
	use App\classes\CSRF;
	use App\classes\ErrorHandler;
	use App\classes\Redirect;
	use App\classes\Request;
	use App\classes\Session;
	use App\classes\Validator;
	use App\interfaces\Controller;
	use App\interfaces\CrudInterface;
	use App\models\Admin;
	use Exception;
	
	/**
	 *
	 */
	class LoginController implements Controller
	{
		
		protected $model;
		
		protected $tokenManager;
		
		protected $validator;
		
		protected $errorHandler;
		
		
		
		/**
		 * @throws Exception
		 */
		public function __construct()
		{
			
			if (isAuthenticated()) {
				Redirect::To('/admin');
			}
			$this->model = new Admin();
			$this->tokenManager = new CSRF();
			$this->errorHandler = new ErrorHandler();
			$this->validator = new Validator($this->errorHandler);
		}
		
		
		
		/**
		 * @return void
		 * @throws Exception
		 */
		public function index()
		{
			
			$token = $this->tokenManager->token();
			echo view('admin/login', compact('token'));
		}
		
		
		
		/**
		 * check if admin is
		 * @throws Exception
		 */
		public function valid()
		{
			
			if (AxiosHttpRequest::has('action') && AxiosHttpRequest::hasValue('action', 'post') && AxiosHttpRequest::getAuthorizationToken() !== '') {
				if ($this->tokenManager->verifyToken(AxiosHttpRequest::getAuthorizationToken())) {
					
					$request = AxiosHttpRequest::all();
					$this->validator->add($request->data, [
						'username' => [
							'required' => true,
							'text' => true,
							'maxLength' => 20,
							'minLength' => 5
						],
						'password' => [
							'required' => true,
							'maxLength' => 50,
							'minLength' => 8
						]
					]);
					
					if (!is_array($this->errorHandler->all())) {
						$username = AxiosHttpRequest::get('data', 'username');
						$password = AxiosHttpRequest::get('data', 'password');
						if ($this->model->isValid($username, $password) !== null) {
							$array = [
								'username' => $username,
								'pass' => $password
							];
							
							
							
							Session::add('admin-connected', $this->model->isValid($username, $password));
							$this->tokenManager->destroy();
							
							
							echo cleanJSON(
								[
									'header' => CrudErrors::LOGIN_VALID
								]
							);
							
							
							
						} else {
							echo cleanJSON(
								[
									'header' => CrudErrors::LOGIN_NOT_VALID,
									'body' => CrudErrors::loginFailed()
								]
							);
						}
					} else {
						echo cleanJSON(
							[
								'header' => CrudErrors::NOT_VALID,
								'body' => $this->errorHandler->all()
							]
						);
					}
					
				} else {
					echo cleanJSON([
						'header' => CrudErrors::ERROR,
						'body' => CrudErrors::error()
					]);
				}
			}
			
		}
		
		
		
	
		
		
		
		
	}