<?php /** @noinspection PhpOptionalBeforeRequiredParametersInspection */
	
	
	namespace App\models;
	
	use App\classes\base\UploadImage;
	use App\interfaces\CrudInterface;
	use App\models\base\Person;
	use \PDOException;
	use \PDO;
	use App\data\database;
	
	
	/**
	 *
	 */
	class User  implements CrudInterface
	{
		
		/**
		 * @var
		 */
		private $id;
		
		/**
		 * @var
		 */
		private $name;
		
		/**
		 * @var
		 */
		private $address;
		
		/**
		 * @var
		 */
		private $city;
		
		/**
		 * @var
		 */
		private $gender;
		
		/**
		 * @var
		 */
		private $date;
		
		/**
		 * @var
		 */
		private $phoneNumber;
		
		/**
		 * @var
		 */
		private $email;
		
		/**
		 * @var
		 */
		private $password;
		
		/**
		 * @var
		 */
		private $photo;
		
		/**
		 * @var
		 */
		private $role;
		
		/**
		 * @var
		 */
		private $accountStatus;
		
		/**
		 * @var
		 */
		private $secretQuestion;
		
		/**
		 * @var
		 */
		private $response;
		
		/**
		 * @var PDO
		 */
		private $PDO;
		
		
		
		/**
		 * @return mixed
		 */
		public function getId()
		{
			
			return $this->id;
		}
		
		
		
		/**
		 * @param $id
		 */
		public function setId($id)
		{
			
			$this->id = $id;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getName()
		{
			
			return $this->name;
		}
		
		
		
		/**
		 * @param $name
		 */
		public function setName($name)
		{
			
			$this->name = $name;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getAddress()
		{
			
			return $this->address;
		}
		
		
		
		/**
		 * @param $address
		 */
		public function setAddress($address)
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
		 * @param $city
		 */
		public function setCity($city)
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
		 * @param $gender
		 */
		public function setGender($gender)
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
		 * @param $date
		 */
		public function setDate($date)
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
		 * @param $phoneNumber
		 */
		public function setPhoneNumber($phoneNumber)
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
		 * @param $email
		 */
		public function setEmail($email)
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
		 * @param $password
		 */
		public function setPassword($password)
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
		 * @param $photo
		 */
		public function setPhoto($photo)
		{
			
			$this->photo = $photo;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getRole()
		{
			
			return $this->role;
		}
		
		
		
		/**
		 * @param $role
		 */
		public function setRole($role)
		{
			
			$this->role = $role;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getCompteEtat()
		{
			
			return $this->compteEtat;
		}
		
		
		
		/**
		 * @param $compteEtat
		 */
		public function setCompteEtat($compteEtat)
		{
			
			$this->compteEtat = $compteEtat;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getSecretQuestion()
		{
			
			return $this->secretQuestion;
		}
		
		
		
		/**
		 * @param $secretQuestion
		 */
		public function setSecretQuestion($secretQuestion)
		{
			
			$this->secretQuestion = $secretQuestion;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getResponse()
		{
			
			return $this->response;
		}
		
		
		
		/**
		 * @param $response
		 */
		public function setResponse($response)
		{
			
			$this->response = $response;
		}
		
		
		
		/**
		 *
		 */
		public function __construct()
		{
			
			$database = new database();
			$this->PDO = $database->connection;
			
		}
		
		
		
		/**
		 * get all users
		 * @return array|false|void
		 */
		public function all()
		{
			
			try {
				$query = "SELECT * FROM `users`";
				$stmt = $this->PDO->query($query);
				
				return $stmt->fetchAll(\PDO::FETCH_OBJ);
			} catch (\PDOException $exception) {
				echo $exception->getMessage();
			}
		}
		
		
		
		/**
		 * get users count
		 * @param $id
		 * @return false|int
		 */
		public function usersCount()
		{
			try {
				$query = 'SELECT COUNT(*) FROM `users`';
				$stmt = $this->PDO->query($query);
				$stmt->execute();
				return $stmt->fetchColumn();
				
			} catch (\PDOException $exception) {
				echo $exception->getMessage();
				
				return false;
			}
		}
		
		
		
		/**
		 * get one user data
		 * @param $query
		 * @param $fetchType
		 * @param array $data
		 * @return false|mixed
		 */
		public function read($query, $fetchType, array $data = [])
		{
			try {
				$stmt = $this->PDO->prepare($query);
				if (count($data) > 0) {
					foreach ($data as $key => $value) {
						$key_data = $value[0];
						$key_data_type = $value[1];
						$stmt->bindParam($key, $key_data, $key_data_type);
					}
				}
				$stmt->execute();
				
				return $stmt->fetchAll($fetchType);
			} catch (PDOException $e) {
				echo $e->getMessage();
				
				return false;
			}
		}
		
		
		
		/**
		 * update user
		 * @param $user
		 * @return bool|string
		 */
		public function update($user)
		{
			
			if ($this->get($user->getId()) !== null) {
				try {
					$withPhoto = $user->getPhoto() !== null;
					
					$query = '';
					$query = ' UPDATE users ';
					$query .= ' SET ';
					$query .= ' user_fullname = :fullname , ';
					$query .= ' user_address = :address , ';
					$query .= ' user_ville = :ville , ';
					$query .= ' user_gender = :gender , ';
					$query .= ' user_dateOfBirth = :dateOfBirth , ';
					$query .= ' user_phoneNumber = :phoneNumber , ';
					$query .= ' user_email = :email , ';
					$query .= ' user_password = :password , ';
					$withPhoto ? $query .= ' user_photo = :photo , ' : $query .= '';
					$query .= ' user_role = :role , ';
					$query .= ' user_compteEtat = :compteEtat , ';
					$query .= ' user_secretQuestion = :secretQuestion , ';
					$query .= '  user_Response = :response ';
					$query .= ' WHERE user_id = :target; ';
					
					$fullname = $user->getName();
					$address = $user->getAddress();
					$ville = $user->getCity();
					$gender = $user->getGender();
					$dateOfBirth = $user->getDate();
					$phoneNumber = $user->getPhoneNumber();
					$email = $user->getEmail();
					$password = $user->getPassword();
					$role = $user->getRole();
					$compteEtat = $user->getCompteEtat();
					$secretQuestion = $user->getSecretQuestion();
					$Response = $user->getResponse();
					$target = $user->getId();
					
					
					$stmt = $this->PDO->prepare($query);
					
					if ($withPhoto) {
						$photo = $user->getPhoto();
						$stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
					}
					
					$stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
					$stmt->bindParam(':address', $address, PDO::PARAM_STR);
					$stmt->bindParam(':ville', $ville, PDO::PARAM_STR);
					$stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
					$stmt->bindParam(':dateOfBirth', $dateOfBirth, PDO::PARAM_STR);
					$stmt->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
					$stmt->bindParam(':email', $email, PDO::PARAM_STR);
					$stmt->bindParam(':password', $password, PDO::PARAM_STR);
					$stmt->bindParam(':role', $role, PDO::PARAM_STR);
					$stmt->bindParam(':compteEtat', $compteEtat, PDO::PARAM_STR);
					$stmt->bindParam(':secretQuestion', $secretQuestion, PDO::PARAM_STR);
					$stmt->bindParam(':response', $Response, PDO::PARAM_STR);
					$stmt->bindParam(':target', $target, PDO::PARAM_STR);
					$stmt->execute();
					
					return $stmt->rowCount() > 0;
					
				} catch (PDOException $exceptione) {
					return $exceptione->getMessage();
				}
			} else {
				return false;
			}
			
		}
		
		
		
		/**
		 * delete user
		 * @param $id
		 * @return bool|string
		 */
		public function delete($id)
		{
			
			try {
				$query = 'DELETE FROM users where user_id = :id';
				$stmt = $this->PDO->prepare($query);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->execute();
				
				return $stmt->rowCount() > 0;
			} catch (PDOException $exception) {
				return $exception->getMessage();
			}
			
		}
		
		
		
		/**
		 * add record to db
		 * @param $record
		 * @return int
		 */
		public function create($record): int
		{
			
			try {
				$query = 'INSERT INTO users (user_fullname,user_email,user_password,user_compteEtat) ';
				$query .= 'VALUES (:name , :email , :pass , :account)';
				$stmt = $this->PDO->prepare($query);
				$name = $record->getName();
				$email = $record->getEmail();
				$pass = $record->getPassword();
				$status = 'inactive';
				$stmt->bindParam(':name', $name, PDO::PARAM_STR);
				$stmt->bindParam(':email', $email, PDO::PARAM_STR);
				$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
				$stmt->bindParam(':account', $status, PDO::PARAM_STR);
				$stmt->execute();
				
				return $stmt->rowCount();
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return false;
			}
		}
		
		
		
		/**
		 * @param $id
		 * @return false|mixed
		 */
		public function get($id)
		{
			
			try {
				$query = 'SELECT * FROM users WHERE user_id = :id';
				$stmt = $this->PDO->prepare($query);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->execute();
				
				return $stmt->fetch(PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				echo $e->getMessage();
				
				return false;
			}
		}
		
		
		/*
				 *
				*********************       ->  helpers <-   *******************************
				 *
		*/
		
		
		/**
		 * loop into array contain user photo and affect photo path to the object
		 * @param $array
		 * @return mixed
		 */
		public static function getUserImage($array )
		{
			
			foreach ($array as $record) {
				$record->user_photo = getFileFromDirByName($record->user_photo, UploadImage::targetFolder);
			}
			
			return $array;
		}
		
		
		
		
		
		/*
			 *
			*********************       -> charts <-   *******************************
			 *
		*/
		
		
		/**
		 * get each role count of their users
		 */
		public function userCountByGender($gender): array
		{
			
			$query = 'call proc_UserCountByGender(:gender);';
			$fetchType = PDO::FETCH_OBJ;
			$param = [':gender' => [$gender, \PDO::PARAM_STR]];
			
			return $this->read($query, $fetchType, $param);
		}
		
		
		
		/**
		 * @param $yaer
		 * @return array|false
		 */
		public function userCountByMonth($year): array
		{
			
			$query = 'CALL proc_UserCountByMonth(:param);';
			$fetchType = PDO::FETCH_OBJ;
			$param = [':param' => [$year, \PDO::PARAM_STR]];
			
			return $this->read($query, $fetchType, $param);
			
		}
		
		
		
		/**
		 * @return array|false
		 */
		public function usersRoleCountByUser(): array
		{
			
			$query = 'select * from view_GetUsersRoleCountByUser;';
			$fetchType = PDO::FETCH_OBJ;
			
			return $this->read($query, $fetchType);
			
		}
		
		public function getLastFourUsers(){
			$query = 'select * from view_GetLastFourUser';
			return $this->read($query , PDO::FETCH_OBJ);
		}
		
		
	}
























