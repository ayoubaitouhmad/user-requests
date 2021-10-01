<?php
	
	namespace App\models\base;
	
	class Person
	{
		
		private $id;
		
		private $firstName;
		
		private $lastNname;
		
		private $username;
		private $fullName;
		
		
		
		
		
	
		private $address;
		
		private $city;
		
		private $gender;
		
		private $date;
		
		private $phoneNumber;
		
		private $email;
		
		private $password;
		
		private $photo;
		
		
		
		/**
		 * @return mixed
		 */
		public function getId()
		{
			
			return $this->id;
		}
		
		
		
		/**
		 * @param mixed $id
		 */
		public function setId($id): void
		{
			
			$this->id = $id;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getFirstName()
		{
			
			return $this->firstName;
		}
		
		
		
		/**
		 * @param mixed $firstName
		 */
		public function setFirstName($firstName): void
		{
			
			$this->firstName = $firstName;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getLastNname()
		{
			
			return $this->lastNname;
		}
		
		
		
		/**
		 * @param mixed $lastNname
		 */
		public function setLastNname($lastNname): void
		{
			
			$this->lastNname = $lastNname;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getAddress()
		{
			
			return $this->address;
		}
		
		
		
		/**
		 * @param mixed $address
		 */
		public function setAddress($address): void
		{
			
			$this->address = $address;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getCity()
		{
			
			return $this->city;
		}
		
		
		
		/**
		 * @param mixed $city
		 */
		public function setCity($city): void
		{
			
			$this->city = $city;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getGender()
		{
			
			return $this->gender;
		}
		
		
		
		/**
		 * @param mixed $gender
		 */
		public function setGender($gender): void
		{
			
			$this->gender = $gender;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getDate()
		{
			
			return $this->date;
		}
		
		
		
		/**
		 * @param mixed $date
		 */
		public function setDate($date): void
		{
			
			$this->date = $date;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getPhoneNumber()
		{
			
			return $this->phoneNumber;
		}
		
		
		
		/**
		 * @param mixed $phoneNumber
		 */
		public function setPhoneNumber($phoneNumber): void
		{
			
			$this->phoneNumber = $phoneNumber;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getEmail()
		{
			
			return $this->email;
		}
		
		
		
		/**
		 * @param mixed $email
		 */
		public function setEmail($email): void
		{
			
			$this->email = $email;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getPassword()
		{
			
			return $this->password;
		}
		
		
		
		/**
		 * @param mixed $password
		 */
		public function setPassword($password): void
		{
			
			$this->password = $password;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getPhoto()
		{
			
			return $this->photo;
		}
		
		
		
		/**
		 * @param mixed $photo
		 */
		public function setPhoto($photo): void
		{
			
			$this->photo = $photo;
		}
		
		
		/**
		 * @return mixed
		 */
		public function getUsername()
		{
			
			return $this->username;
		}
		
		
		
		/**
		 * @param mixed $username
		 */
		public function setUsername($username): void
		{
			
			$this->username = $username;
		}
		/**
		 * @return mixed
		 */
		public function getFullName()
		{
			
			return $this->fullName;
		}
		
		
		
		/**
		 * @param mixed $fullName
		 */
		public function setFullName($fullName): void
		{
			
			$this->fullName = $fullName;
		}
		
		
		
	}