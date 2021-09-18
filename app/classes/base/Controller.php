<?php
	
	namespace App\classes\base;
	
	use App\classes\CSRF;
	use App\classes\ErrorHandler;
	use App\classes\Validator;
	use App\models\User;
	use App\models\Admin;
	
	/**
	 *
	 */
	class Controller
	{
		protected  $model;
		protected  $tokenManager;
		protected  $validator;
		protected  $errorHandler;
		protected   $currentAdmin;
		protected   $currentUser;
		protected  $uploader;
		
		
		/**
		 * @return mixed
		 */
		public function getModel()
		{
			
			return $this->model;
		}
		
		
		
		/**
		 * @param mixed $model
		 * @return Controller
		 */
		public function setModel($model)
		{
			
			$this->model = $model;
			
			return $this;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getTokenManager()
		{
			
			return $this->tokenManager;
		}
		
		
		
		/**
		 * @param mixed $tokenManager
		 * @return Controller
		 */
		public function setTokenManager($tokenManager)
		{
			
			$this->tokenManager = $tokenManager;
			
			return $this;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getValidator()
		{
			
			return $this->validator;
		}
		
		
		
		/**
		 * @param mixed $validator
		 * @return Controller
		 */
		public function setValidator($validator)
		{
			
			$this->validator = $validator;
			
			return $this;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getErrorHandler()
		{
			
			return $this->errorHandler;
		}
		
		
		
		/**
		 * @param mixed $errorHandler
		 * @return Controller
		 */
		public function setErrorHandler($errorHandler)
		{
			
			$this->errorHandler = $errorHandler;
			
			return $this;
		}
		
		
		
		
		
		
		
		/**
		 * @return mixed
		 */
		public function getUploader()
		{
			
			return $this->uploader;
		}
		
		
		
		/**
		 * @param mixed $uploader
		 * @return Controller
		 */
		public function setUploader($uploader)
		{
			
			$this->uploader = $uploader;
			
			return $this;
		}
		
		
		
		/**
		 * get each property there equivalent data
		 */
		protected function init($model){
			$this->model = $model;
			$this->tokenManager = new CSRF();
			$this->errorHandler = new ErrorHandler();
			$this->validator = new Validator($this->errorHandler);
		}
		
		
		
		
		
		
		
		
		
		
		
	}