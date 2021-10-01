<?php
	
	namespace App\controllers\admin\signup;
	
	use App\classes\AxiosHttpRequest;
	use App\classes\base\Controller;
	use App\classes\Mailer;
	use App\classes\Redirect;
	use App\classes\Session;
	use App\classes\UiMessages;
	use App\models\Admin;
	
	class SignupController extends Controller implements \App\interfaces\Controller
	{
		
		public function __construct()
		{
			
			
			if (Session::has('admin-connected') || Session::has('user-connected')) {
				Redirect::To('/');
			}
			$this->init(new Admin());
		}
		
		
		
		public function index()
		{
			
			return view('admin/sign_up/signup');
		}
		
		
		
		public function check()
		{
			
			if (AxiosHttpRequest::has('action') &&
				AxiosHttpRequest::hasValue('action', 'check') &&
				AxiosHttpRequest::getAuthorizationToken() !== '') {
				$request = AxiosHttpRequest::all()->data;
				// TODO : check if this token exists in session
				
				$this->validator->add($request, [
					'first_name' => [
						'required' => true,
						'text' => true,
						'maxLength' => 50,
						'minLength' => 3
					],
					'last_name' => [
						'required' => true,
						'text' => true,
						'maxLength' => 50,
						'minLength' => 3
					],
					'username' => [
						'required' => true,
						'username' => true,
						'maxLength' => 50,
						'minLength' => 5
					],
					'phone' => [
						'required' => true,
						'phone' => 'mar',
						'length' => 10
					
					],
					'email' => [
						'required' => true,
						'email' => true,
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
					],
				
				
				]);
				if (!is_array($this->errorHandler->all())) {
					
					$this->model = new Admin();
					if (!$this->model->isDupplicated($request->username, $request->email, $request->phone)) {
						$code = $this->tokenManager->getValidationCode();
						Mailer::registrationMail($request->email, $request->first_name . ' ' . $request->last_name, $code);
						
						$data = [
							'fname' => $request->first_name,
							'lname' => $request->last_name,
							'username' => $request->username,
							'email' => $request->email,
							'password' => $request->password,
							'phone' => $request->phone,
							'code' => $code
						];
						Session::add('admin-current-signup', $data);
						
						
						
						echo cleanJSON([
							'title' => UiMessages::VALID,
							'body' => UiMessages::  done("You're one step away from start using our site")
						]);
					} else {
						echo cleanJSON([
							'title' => UiMessages::USED,
							'body' => UiMessages::used('email username or phone number ')
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
		
		
		
		public function checkConfermationCode()
		{
			
			if (Session::has('admin-current-signup')) {
				if (AxiosHttpRequest::has('action') &&
					AxiosHttpRequest::hasValue('action', 'check') &&
					AxiosHttpRequest::getAuthorizationToken() !== '') {
					$request = AxiosHttpRequest::all()->data;
					// TODO : check if this token exists in session
					
					$this->validator->add($request, [
						'code' => [
							'required' => true,
							'length' => 6,
							'number' => true
						]
					]);
					if (!is_array($this->errorHandler->all())) {
						$data = Session::get('admin-current-signup');
						if ($request->code === $data['code']) {
							$this->model = new Admin();
							$admin = new Admin();
							$admin->setFullName($data['fname'] . ' ' . $data['lname']);
							$admin->setUsername($data['username']);
							$admin->setEmail($data['email']);
							$admin->setPassword($data['password']);
							$admin->setPhoneNumber($data['phone']);
							if ($this->model->create($admin)) {
								Session::remove('admin-current-signup');
								Session::add('admin-connected', $data['username']);
								echo cleanJSON([
									'title' => UiMessages::VALID,
									'body' => ''
								]);
							} else {
								echo cleanJSON([
									'title' => UiMessages::CANCEL,
									'body' => UiMessages::notMatch('code')
								]);
							}
							
							
						} else {
							echo cleanJSON([
								'title' => UiMessages::CANCEL,
								'body' => UiMessages::notMatch('code')
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
			else {
			        Redirect::back();
			}
			
			
		}
		
		
	}