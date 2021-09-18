<?php
	
	namespace App\controllers\user\signup;
	
	use App\classes\AxiosHttpRequest;
	use App\classes\base\Controller;
	use App\classes\Redirect;
	use App\classes\UiMessages;
	use App\classes\CSRF;
	use App\classes\ErrorHandler;
	use App\classes\Mailer;
	use App\classes\Session;
	use App\classes\Validator;
	use App\interfaces\Controller as ControllerFunc;
	use App\models\User;
	use Illuminate\Support\Facades\Mail;
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	/**
	 *
	 */
	class SignupController extends  Controller implements ControllerFunc
	{
		
		

		
		
		public function __construct()
		{
			if(Session::has('user-connected')){
				Redirect::To('/user/dashboard');
			}
			if (Session::has('currentSignUp')) {
				unset($_SESSION['currentSignUp']);
			}
			$this->init(new User());
		}
		
		
		
		/**
		 * @return void
		 * @throws \Exception
		 */
		public function index()
		{
			
			$token = $this->tokenManager->token();
			
			return view('user/sign_up/signup', compact('token'));
		}
		
		
		
		/**
		 *
		 * @throws \Exception
		 */
		public function signup()
		{
			
			if (
				AxiosHttpRequest::has('action')
				&& AxiosHttpRequest::hasValue('action', 'post')
				&& AxiosHttpRequest::getAuthorizationToken() !== ''
			) {
				$token = AxiosHttpRequest::getAuthorizationToken();
				if ($this->tokenManager->verifyToken($token)) {
					$this->validator->add(AxiosHttpRequest::all()->data, [
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
							],
							'phone' => [
								'required' => true,
								'phone' => 'mar',
								'length' => 10
							
							]
						]
					);
					if (!is_array($this->errorHandler->all())) {
						$email = AxiosHttpRequest::get('data', 'email');
						$phone = AxiosHttpRequest::get('data' , 'phone');
						$password = AxiosHttpRequest::get('data' , 'password');
						$name = AxiosHttpRequest::get('data' , 'name');
						$this->model = new User();
						if ($this->model->isDuplicatedData($email , $phone) === 0) {
							// send conformation code to email
							$code = $this->tokenManager->getValidationCode();
							$body = 'hi ' . $name . '<br>';
							$body .= 'your code is ' . $code;
							
							Mailer::init($email, 'confirmation code', $body);
							// send the current signup to session
							$data = [
								'email' => $email,
								'phoneNumber' => $phone,
								'password' => $password,
								'code' => $code,
								'name' => $name,
								'sign_up_status' => 0
							];
							Session::add('currentSignUp', $data);
							$this->tokenManager->destroy(); // REMOVE THE TOKEN FROM SESSION
							echo cleanJSON([
								'header' => UiMessages::VALID,
								'body' => ''
							]);
							
							
							
						} else {
							echo cleanJSON([
								'header' => UiMessages::USED,
								'body' => UiMessages::used('email or phone number')
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
						'body' => UiMessages::error()
					]);
				}
				
			} else {
				echo cleanJSON([
					'header' => UiMessages::ERROR,
					'body' => ''
				]);
			}
			
			
		}
		
		
	}