<?php
	
	namespace App\controllers\user\login;
	
	use App\classes\AxiosHttpRequest;
	use App\classes\CSRF;
	use App\classes\ErrorHandler;
	use App\classes\Redirect;
	use App\classes\Session;
	use App\classes\UiMessages;
	use App\classes\Validator;
	use App\interfaces\Controller  as ControllerFunc;
	use App\classes\base\Controller;
	use App\models\User;
	use Exception;
	use PDO;
	
	/**
	 *
	 */
	class LoginController extends Controller implements  ControllerFunc
	{
		public function __construct()
		{
			if(Session::has('user-connected') || Session::has('currentSignUp')){
				Redirect::To('/');
			}
			$this->init(new User());
			
		
		}
		
		
		
		/**
		 * @return void
		 * @throws Exception
		 */
		public function index()
		{
			$token  = $this->tokenManager->token();
			return view('user/sign_in/login' , compact('token'));
		}
		
		
		
		/**
		 * check if user valid
		 */
		public  function  login(){
			
			
		
			
			// TODO : check post and token
			if (
				AxiosHttpRequest::has('action') && AxiosHttpRequest::hasValue('action' , 'validation') &&
				 AxiosHttpRequest::getAuthorizationToken() !== ''
			){
				$token = AxiosHttpRequest::getAuthorizationToken();
				$request  =AxiosHttpRequest::all()->data;
				// TODO : check if this token exists in session
				if($this->tokenManager->verifyToken($token)){
					// TODO: validate data
					$this->validator->add($request ,[
						'email' => [
							'required' => true,
							'email' => true,
							'maxLength' => 100,
							'minLength' => 5
						],
						'password' => [
							'required' => true,
							'maxLength' => 100,
							'minLength' => 8
						],
					]);
					if(!is_array($this->errorHandler->all())){
						$this->model = new User;
						if($this->model->isUser($request->email) !== null){
							$user = $this->model->isUser($request->email);
							if(password_verify($request->password , $user->user_password)){
								Session::add('user-connected' , $request->email);
								echo cleanJSON([
									'header' => UiMessages::VALID,
									'body' =>''
								]);
							}else{
								echo cleanJSON([
									'header' => UiMessages::LOGIN_NOT_VALID ,
									'body' => UiMessages::loginFailed()
								]);
							}
						
						}else{
							echo cleanJSON([
								'header' => UiMessages::NOT_FOUND ,
								'body' => UiMessages::invalidData()
							]);
						}
					}
					else{
						echo cleanJSON([
							'header' => UiMessages::NOT_VALID ,
							'body' => $this->errorHandler->all()
						]);
					}
				}else{
					echo cleanJSON([
						'header' => UiMessages::ERROR ,
						'body' => UiMessages::error()
					]);
				}
			
			}else{
				echo cleanJSON([
					'header' => UiMessages::ERROR ,
					'body' => UiMessages::error()
				]);
			}
			
		
		}
		
		
		
		
		
		
		
		
	}