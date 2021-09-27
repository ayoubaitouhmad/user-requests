<?php
	
	namespace App\controllers\user\signup;
	
	use App\classes\AxiosHttpRequest;
	use App\classes\base\Controller;
	use App\classes\CSRF;
	use App\classes\ErrorHandler;
	use App\classes\Mailer;
	use App\classes\Redirect;
	use App\classes\Session;
	use App\classes\UiMessages;
	use App\classes\Validator;
	use App\interfaces\Controller as ControllerFunc;
	use App\models\User;
	use Exception;
	
	/**
	 *
	 */
	class EmailConfermationController extends Controller implements ControllerFunc
	{
		
		
		/**
		 * @throws Exception
		 */
		public function __construct()
		{
//			Session::remove('currentSignUp');
			
			if(Session::has('user-connected')){
				Redirect::To('/user/dashboard');
			}
			if(Session::get('currentSignUp') !== null && isset(Session::get('currentSignUp')['sign_up_status'])){
				if (Session::get('currentSignUp')['sign_up_status'] !== 0) {
					Redirect::To('/user/signup');
				}
			}
			else{
				isset($_SERVER['HTTP_REFERER']) ? Redirect::back() : Redirect::To('/user/signup');
			}
		
			
			$this->init(new User());
		}
		
		
		
		/**
		 * @return mixed
		 * @throws Exception
		 */
		public function index()
		{
			Mailer::init('eatentool@spamfellas.com', 'confirmation code', '48874');
			
			$currentSignUp  = Session::get('currentSignUp');
			$email = $currentSignUp['email'];
			$emailV = $email[0]. '****' .$email[strpos($email , '@') -1].substr($email ,strpos($email , '@') , strlen($email));
			$token  = $this->tokenManager->token();
			return view('user/sign_up/email' , compact(['emailV' , 'token']));
		}
		
		
		
		/**
		 * @throws Exception
		 */
		public function confirmEmail(){
			
			if(AxiosHttpRequest::has('data') && AxiosHttpRequest::getAuthorizationToken() !== '' &&  $this->tokenManager->verifyToken(AxiosHttpRequest::getAuthorizationToken())){
				$token = AxiosHttpRequest::getAuthorizationToken();
				$this->validator->add(AxiosHttpRequest::all(true)['data'] , [
					'code' => [
						'required' => true,
						'length' => 6,
						'number' => true
					]
				]);
				if(!is_array($this->errorHandler->all())){
						$code  = AxiosHttpRequest::get('data' , 'code');
						$orgcode = Session::get('currentSignUp') ?? '';
						
						if($code === $orgcode['code']){
							$_SESSION['currentSignUp']['sign_up_status'] = 1;
							$this->tokenManager->destroy(); // REMOVE THE TOKEN FROM SESSION
							echo cleanJSON([
								'header' => UiMessages::VALID,
								'body' => ''
							]);
						}else{
							echo cleanJSON([
								'header' => UiMessages::CANCEL,
								'body' => UiMessages::notMatch('code')
							]);
						}
				}else{
					echo cleanJSON([
						'header' => UiMessages::NOT_VALID,
						'body' =>  $this->errorHandler->all(),
						'data' => AxiosHttpRequest::all()
					]);
				}
			}
			else{
				echo cleanJSON([
					'header' => UiMessages::ERROR,
					'body' => UiMessages::error()
				]);
			}
		
			
		}
		
		public function test(){
			echo 'here';
		}
	}