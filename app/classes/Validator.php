<?php
	
	namespace App\classes;
	
	use App\classes\base\UploadImage;
	
	class Validator
	{
		
		protected $errorHandler;
		
		protected $field;
		
		protected $value;
		
		protected $rules;
		
		
		const RULES = array(
			'required',
			'length',
			'email',
			'maxLength',
			'minLength',
			'text',
			'number',
			'phone',
			'address',
			'gender',
			'date',
			'password',
			'like',
			'format',
			'size',
			'uppercase',
			'specialChars',
			'lowercase',
			'date_between'
		);
		
		const REGEX = [
			'phone' => [
				'mar' => '/^(?!\+@$)([0-9]{10})$/',
			],
			'address' => "/^[a-zA-Z0-9'\s.]*$/",
			'date' => "/^\d{4}[\-\/\s]?((((0[13578])|(1[02]))[\-\/\s]?(([0-2][0-9])|(3[01])))|(((0[469])|(11))[\-\/\s]?(([0-2][0-9])|(30)))|(02[\-\/\s]?[0-2][0-9]))$/",
			'password' => "/^(?:(?:(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]))|(?:(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[a-z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))).{8,32}$/",
			'number' => '/^[0-9]$/',
			'text' => '/^[a-zA-Z0-9\s.,:-_()?!]*$/'
		];
		
		
		const MESSAGES = [
			'required' => " sorry ,  field is required",
			'length' => " sorry , field must be  regex characters. ",
			'email' => ' sorry , enter a valid email like(name@domain.com).',
			'maxLength' => ' sorry , field can accept only regex. ',
			'minLength' => ' sorry , field must be at least regex characters. ',
			'text' => ' sorry, field can only contain character and spaces and known symbols (?,!,= ...).',
			'number' => ' sorry , field can only contain real number',
			'phone' => ' sorry , field can only contain 10 number (Ex : 0606060606)',
			'address' => 'sorry, field can only contain character,numbers and spaces.',
			'gender' => 'sorry , field accept men and women only.',
			'date' => 'sorry , field accept men and women only.',
			'password' => 'sorry ,password must be al least 8 characters (numbers,characters,symbol ...).',
			'like' => 'sorry , sorry field must be in (regex) ',
			'format' => 'sorry ,  field must be in list  (regex). ',
			'size' => 'sorry ,  field must be less than regexMB.',
			'uppercase' => 'sorry ,  field must be contain at least one uppercase character .',
			'specialChars' => 'sorry ,  field must be contain one special caractere like (- or _) .',
			'lowercase' => 'sorry ,   field must be contain at least one lowercase character .',
			'date_between' => 'sorry ,   field must be between (regex) .',
			
		];
		
		
		
		
		function __construct(ErrorHandler $errorHandler)
		{
			
			$this->errorHandler = $errorHandler;
		}
		
		
		
		function add($items, $rules)
		{
			
			foreach ($items as $item => $value) {
				
				if (in_array($item, array_keys($rules))) {
					$this->field = $item;
					$this->value = $value;
					$this->rules = $rules[$item];
					$this->validate();
				}
			}
		}
		
		
		
		public function getErrors()
		{
			
			return $this->errorHandler->all();
		}
		
		
		
		function validate()
		{
			
			$field = $this->field;
			foreach ($this->rules as $rule => $regex) {
				if (in_array($rule, self::RULES)) {
					if (method_exists($this, '' . $rule)) {
						if (!call_user_func_array([$this, $rule], [$this->value, $regex]) ) {
							if (in_array($rule, array_keys(self::MESSAGES))) {
								$message = self::MESSAGES[$rule];
							
								if (str_contains($message, 'field')) {
									$message = str_replace('field', $this->field, $message);
								}
								if (str_contains($message, 'regex')) {
									if(is_array($regex)){
										if(count($regex) > 2){
											$regex = implode(",",$regex);
											$message = str_replace('regex', $regex, $message);
										}
										else{
											if(count($regex) === 2){
												$regex = $regex[0] . ' and ' . $regex[1];
												$message = str_replace('regex', $regex, $message);
											}else{
												$message = $regex;
											}
										}
										
										
									}else{
										$message = str_replace('regex', $regex, $message);
										
									}
								}
								if (!$this->errorHandler->field($field)->hasErrors($message)) {
									$this->errorHandler->addError($field, $message);
								}
								
							} else {
								$this->errorHandler->addError($field, 'error');
							}
						}
					}
					
				}
			}
			
		}
		
		
		
		private function required($value, $regex)
		{
			
			if ($regex) {
			
					return !empty(trim($value));
				
			} else
				return true;
		}
		
		
		
		private function length($val, $regex)
		{
			
			return strlen($val) == $regex;
		}
		
		
		
		private function email($val, $regex)
		{
			
			if ($regex) {
				return filter_var($val, FILTER_VALIDATE_EMAIL);
			} else
				return true;
		}
		
		
		
		private function maxLength($val, $regex)
		{
			
			if (!empty($regex)) {
				return strlen($val) <= $regex;
			} else
				return true;
		}
		
		
		
		private function minLength($val, $regex)
		{
			
			if (!empty($regex)) {
				return strlen($val) >= $regex;
			} else
				return true;
		}
		
		
		
		private function number($val, $regex)
		{
			
			if ($regex) {
					return is_numeric($val);
			} else
				return true;
		}
		
		
		
		private function text($val, $regex)
		{
			
			if ($regex) {
				$option = array(
					'options' => array('regexp' => self::REGEX['text'])
				);
				
				return filter_var($val, FILTER_VALIDATE_REGEXP, $option) == $val;
			} else
				return true;
		}
		
		
		
		private function phone($val, $regex)
		{
			
			if (!empty($regex) && in_array($regex, array_keys(self::REGEX))) {
				$valid = false;
				switch (strtolower(trim($regex))) {
					case 'mr' || 'mar':
						$option = array(
							'options' => array('regexp' => self::REGEX['phone']['mar'])
						);
						$valid = filter_var($val, FILTER_VALIDATE_REGEXP, $option) == $val;
				}
				
				return $valid;
			} else
				return true;
		}
		
		
		
		private function address($val, $regex)
		{
			
			if (!empty($regex) and $regex) {
				$option = array(
					'options' => array('regexp' => self::REGEX['address'])
				);
				
				return filter_var($val, FILTER_VALIDATE_REGEXP, $option) == $val;
			} else
				return true;
			
		}
		
		
		
		private function gender($val, $regex)
		{
			$val = strtolower($val);
			$val = trim($val);
			if ($regex) {
				return $val == 'male' || $val == 'female';
			} else
				return true;
		}
		
		
		
		private function date($val, $regex)
		{
			
			if ($regex) {
				$option = array(
					'options' => array('regexp' => self::REGEX['date'])
				);
				
				return filter_var($val, FILTER_VALIDATE_REGEXP, $option) == $val;
			} else
				return true;
		}
		
		public function uppercase($val, $regex){
			if($regex)
				return preg_match('@[A-Z]@', $val);
			else
				return true;
		}
		public function specialChars($val, $regex){
			if($regex)
				return preg_match( "@[_-]@" , $val);
			else
				return true;
			
			
		}
		public function lowercase($val, $regex){
			if($regex)
				return preg_match('@[a-z]@', $val);
			else
				return true;
		}
		
		private function password($val, $regex): bool
		{
		

			if ($regex) {
				$option = array(
					'options' => array('regexp' => self::REGEX['password'])
				);
				
				return filter_var($val, FILTER_VALIDATE_REGEXP, $option) == $val;
			} else
				return true;
		}
		
		private function date_between($val, $regex): bool
		{
			if (is_array($regex) && count($regex)){
				$dateToCompare = $val;
				$startdate = date('Y-m-d', strtotime($regex[0]));
				$enddate = date('Y-m-d', strtotime($regex[1]));
				return $dateToCompare <= $enddate && $dateToCompare >= $startdate;
			}else{
				return true;
			}
		}
		
		
		
		
		
		public  function like($val, $regex){
			return in_array(strtolower($val) , $regex);
		}
		
	
		
		public function size($val, $regex){
			return  ($val['size']/ 1024 / 1024) < $regex;
		}
		public function format($val, $regex){
			return in_array(pathinfo($val['name'])['extension'] , $regex);
		}
		
		
	}