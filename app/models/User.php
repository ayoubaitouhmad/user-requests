<?php /** @noinspection PhpOptionalBeforeRequiredParametersInspection */
	
	
	namespace App\models;
	
	use App\classes\base\UploadImage;
	use App\interfaces\CrudInterface;
	use App\models\base\Model;
	use App\models\base\Person;
	use Doctrine\DBAL\Exception;
	use \PDOException;
	use \PDO;
	use App\data\database;
	
	
	/**
	 *
	 */
	class User extends Model implements  CrudInterface
	{
		
		
		private $id;
		
		
		private $name;
		
		
		private $address;
		
		
		private $city;
		
		
		private $gender;
		
		
		private $date;
		
		
		private $phoneNumber;
		
		
		private $email;
		
		
		private $password;
		
		
		private $photo;
		
		
		private $role;
		
		
		private $accountStatus;
		
		
		private $secretQuestion;
		
		
		private $response;
		
		
		private $created_at;
		
		
		private $deleted_at;
		
		
		
	
		
		
		
		/**
		 * @return mixed
		 */
		public function getAccountStatus()
		{
			
			return $this->accountStatus;
		}
		
		
		
		/**
		 * @param mixed $accountStatus
		 * @return User
		 */
		public function setAccountStatus($accountStatus)
		{
			
			$this->accountStatus = $accountStatus;
			
			return $this;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getCreatedAt()
		{
			
			return $this->created_at;
		}
		
		
		
		/**
		 * @param mixed $created_at
		 * @return User
		 */
		public function setCreatedAt($created_at)
		{
			
			$this->created_at = $created_at;
			
			return $this;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getDeletedAt()
		{
			
			return $this->deleted_at;
		}
		
		
		
		/**
		 * @param mixed $deleted_at
		 * @return User
		 */
		public function setDeletedAt($deleted_at)
		{
			
			$this->deleted_at = $deleted_at;
			
			return $this;
		}
		
		
		
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
			$this->init($_ENV['DB_USER']);
		}
		
		
		
		/**
		 * get all users
		 * @return array|false|void
		 */
		public function all()
		{
			
			try {
				$query = "SELECT * FROM ".$this->tableName . "  order by created_at DESC";
				$stmt = $this->PDO->query($query);
				
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} catch (PDOException $exception) {
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
				$query = "SELECT COUNT(*) FROM {$this->tableName}";
				$stmt = $this->PDO->query($query);
				$stmt->execute();
				
				return $stmt->fetchColumn();
				
			} catch (PDOException $exception) {
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
					$query = " UPDATE {$this->tableName} ";
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
				$query = "INSERT INTO {$this->tableName} (user_id,user_fullname,user_email,user_password,user_phoneNumber) ";
				$query .= 'VALUES (:id,:name , :email , :pass , :phone);';
				$stmt = $this->PDO->prepare($query);
				
				$name = $record->getName();
				$id = generateId($name);
				$email = $record->getEmail();
				$pass = $record->getPassword();
				$phone = $record->getPhoneNumber();
				
				$stmt->bindParam(':name', $name, PDO::PARAM_STR);
				$stmt->bindParam(':id', $id, PDO::PARAM_STR);
				$stmt->bindParam(':email', $email, PDO::PARAM_STR);
				$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
				$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
				
				$stmt->execute();
				
				return $stmt->rowCount() > 0;
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return false;
			}
		}
		
		
		
		/**
		 * add record to db
		 * @param $record
		 * @return int
		 */
		
		public function createUserProfile(User $record): int
		{
			
			try {
				$query = "INSERT INTO {$this->tableName} (user_id,user_fullname,user_address,user_ville,user_gender,user_dateOfBirth,user_phoneNumber,user_email,user_password,user_photo,user_role,user_compteEtat,user_secretQuestion,user_Response) ";
				$query .= 'VALUES (:user_id ,:fullname,:address,:ville,:gender,:dateOfBirth,:phoneNumber,:email,:password,:photo,:role,:compteEtat,:secretQuestion,:response)';
				$stmt = $this->PDO->prepare($query);
				
				$id = $record->getId();
				$fullname = $record->getName();
				$address = $record->getAddress();
				$ville = $record->getCity();
				$gender = $record->getGender();
				
				$dateOfBirth = $record->getDate();
				$phoneNumber = $record->getPhoneNumber();
				$email = $record->getEmail();
				$password = $record->getPassword();
				
				$photo = $record->getPhoto();
				$role = $record->getRole();
				$secretQuestion = $record->getSecretQuestion();
				$response = $record->getResponse();
				
				$account = 'inactive';
				
				$stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
				$stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
				$stmt->bindParam(':address', $address, PDO::PARAM_STR);
				$stmt->bindParam(':ville', $ville, PDO::PARAM_STR);
				$stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
				$stmt->bindParam(':dateOfBirth', $dateOfBirth, PDO::PARAM_STR);
				$stmt->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
				$stmt->bindParam(':email', $email, PDO::PARAM_STR);
				$stmt->bindParam(':password', $password, PDO::PARAM_STR);
				$stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
				$stmt->bindParam(':role', $role, PDO::PARAM_STR);
				$stmt->bindParam(':compteEtat', $account, PDO::PARAM_STR);
				$stmt->bindParam(':secretQuestion', $secretQuestion, PDO::PARAM_STR);
				$stmt->bindParam(':response', $response, PDO::PARAM_STR);
				
				$stmt->execute();
				$stmt->rowCount() > 0;
				
				return $stmt->rowCount() > 0;
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return false;
			}
		}
		
		
		
		/**
		 * get user by id
		 * @param $id
		 * @return false|mixed
		 */
		public function get($id)
		{
			
			try {
				$query = "SELECT * FROM {$this->tableName} WHERE user_id = :id;";
				$stmt = $this->PDO->prepare($query);
				$stmt->bindParam(':id', $id, PDO::PARAM_STR);
				$stmt->execute();
				
				return $stmt->rowCount() > 0 ?  $stmt->fetch(PDO::FETCH_OBJ) : false;
			} catch (PDOException $e) {
				echo $e->getMessage();
				
				return false;
			}
		}
		
		
		
		/**
		 * get user by id
		 * @param $email
		 * @return false|mixed
		 */
		public function getByEmail($email)
		{
			
			try {
				$query = "SELECT * FROM {$this->tableName} WHERE user_email = :email";
				$stmt = $this->PDO->prepare($query);
				$stmt->bindParam(':email', $email, PDO::PARAM_STR);
				$stmt->execute();
				
				return $stmt->fetch(PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				echo $e->getMessage();
				
				return false;
			}
		}
		
		
		
		/**
		 * @param User $user
		 * @return bool
		 */
		public function signupProfile(User $user)
		{
			
			try {
				
				$query = ' ';
				$query = "UPDATE {$this->tableName} ";
				$query .= ' SET ';
				$query .= ' user_gender = :gender, ';
				$query .= ' user_address = :addresse, ';
				$query .= ' user_role = :role, ';
				$query .= ' user_secretQuestion = :secretQuestion, ';
				$query .= ' user_Response = :response, ';
				$query .= ' user_dateOfBirth = :date, ';
				$query .= ' user_ville = :city ';
				$query .= ' WHERE user_id = :id; ';
				$stmt = $this->PDO->prepare($query);
				
				$gender = $user->getGender() === 'm' ? 'm' : 'f';
				$addresse = $user->getAddress();
				$role = $user->getRole();
				$secretQuestion = $user->getSecretQuestion();
				$response = $user->getResponse();
				$date = $user->getDate();
				$city = $user->getCity();
				$id = $user->getId();
				
				$stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
				$stmt->bindParam(':addresse', $addresse, PDO::PARAM_STR);
				$stmt->bindParam(':role', $role, PDO::PARAM_STR);
				$stmt->bindParam(':secretQuestion', $secretQuestion, PDO::PARAM_STR);
				$stmt->bindParam(':response', $response, PDO::PARAM_STR);
				$stmt->bindParam(':date', $date, PDO::PARAM_STR);
				$stmt->bindParam(':city', $city, PDO::PARAM_STR);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				
				
				
				$stmt->execute();
				
				return $stmt->rowCount() > 0;
			} catch (Exception $exception) {
				echo $exception->getMessage();
				
				return false;
			}
		}
		
		
		
		/**
		 * check credentials
		 * @param $email
		 * @return false|void
		 */
		public function isUser($email)
		{
			try {
				$query = "SELECT * FROM {$this->tableName} where user_email = :email;";
				$stmt = $this->PDO->prepare($query);
				$stmt->bindParam(':email', $email, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->rowCount()>0 ? $stmt->fetch(PDO::FETCH_OBJ) : null;
				
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return false;
			}
		}
		
		
		
		/**
		 * check if some sign data exists already
		 * @param $email
		 * @param $phone
		 * @return mixed
		 */
		public function isDuplicatedData($email, $phone)
		{
			
			try {
				$stmt = $this->PDO->prepare("SELECT COUNT(*) FROM {$this->tableName} where user_email = :email or user_phoneNumber  = :phone;");
				$stmt->bindParam(':email', $email, PDO::PARAM_STR);
				$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetchColumn();
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return false;
			}
		}
		
		
		
		/**
		 * check if some sign data exists already
		 * @param $feild
		 * @param $data
		 * @param int $type
		 * @return mixed
		 */
		public function isDuplicatedField($feild , $data, int $type = PDO::PARAM_STR)
		{
			
			try {
				$stmt = $this->PDO->prepare("SELECT COUNT(*) FROM {$this->tableName} where $feild = :field;");
				$stmt->bindParam(':field', $data, $type);
				$stmt->execute();
				return $stmt->fetchColumn();
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return false;
			}
		}
		
		
		
		
		public function getUserRequests($id)
		{
			
			$query = 'select * from  request where user_id= :id order by  request_date desc;';
			$fetchType = PDO::FETCH_OBJ;
			$param = [':id' => [$id, PDO::PARAM_INT]];
			
			return $this->read($query, $fetchType, $param);
		}
		
		/**
		 * @param User $user
		 * @return bool
		 */
		public function updateUser(User $user)
		{

			try {
				
				$query = ' ';
				$query .= "UPDATE {$this->tableName} ";
				$query .= ' SET ';
				$query .= ' user_fullname = :name, ';
				$query .= ' user_gender = :gender, ';
				$query .= ' user_address = :address, ';
				$query .= ' user_phoneNumber = :phone, ';
				$query .= ' user_dateOfBirth = :date, ';
				$query .= ' user_ville = :city ';
				$query .= ' WHERE user_id = :id; ';
				$stmt = $this->PDO->prepare($query);
				
				$name = $user->getName();
				$gender = $user->getGender() === 'male' ? 'm' : 'f';
				$addresse = $user->getAddress();
				$phone = $user->getPhoneNumber();
				$date = $user->getDate();
				$city = $user->getCity();
				$id = $user->getId();
				
				$stmt->bindParam(':name', $name, PDO::PARAM_STR);
				$stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
				$stmt->bindParam(':address', $addresse, PDO::PARAM_STR);
				$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
				$stmt->bindParam(':date', $date, PDO::PARAM_STR);
				$stmt->bindParam(':city', $city, PDO::PARAM_STR);
				$stmt->bindParam(':id', $id, PDO::PARAM_STR);
				
				
				
				$stmt->execute();
				
				return $stmt->rowCount() > 0;
			} catch (Exception $exception) {
				echo $exception->getMessage();
				
				return false;
			}
		}
		
		
		
		/**
		 * @param $avatar
		 * @param $id
		 * @return bool
		 */
		public function updateUserAvatar($avatar , $id): bool
		{
			try {
				
				$query = ' ';
				$query .= "UPDATE {$this->tableName} ";
				$query .= ' SET user_photo = :photo';
				$query .= ' WHERE user_id = :id ;';
				$stmt = $this->PDO->prepare($query);
				
				
				$stmt->bindParam(':id', $id, PDO::PARAM_STR);
				$stmt->bindParam(':photo',$avatar, PDO::PARAM_STR);
				
				$stmt->execute();
				
				return $stmt->rowCount() > 0;
			} catch (Exception $exception) {
				echo $exception->getMessage();
				
				return false;
			}
		}
		
		
		
		public function updateUserSecurityData(User $user): bool
		{
			try {
				
				$query = ' ';
				$query .= "UPDATE {$this->tableName} ";
				$query .= ' SET user_email = :email, ';
				$query .= ' user_password = :pass, ';
				$query .= ' user_secretQuestion = :question, ';
				$query .= ' user_Response = :res ';
				$query .= ' WHERE user_id = :id ;';
				$stmt = $this->PDO->prepare($query);
				
				$email = $user->getEmail();
				$password = $user->getPassword();
				$question = $user->getSecretQuestion();
				$response = $user->getResponse();
				$id = $user->getId();
				
				
				$stmt->bindParam(':email', $email , PDO::PARAM_STR);
				$stmt->bindParam(':pass',$password , PDO::PARAM_STR);
				$stmt->bindParam(':question',$question , PDO::PARAM_STR);
				$stmt->bindParam(':res',$response , PDO::PARAM_STR);
				$stmt->bindParam(':id',$id, PDO::PARAM_STR);
				
				$stmt->execute();
				
				return $stmt->rowCount() > 0;
			} catch (Exception $exception) {
				echo $exception->getMessage();
				
				return false;
			}
		}
		
		public function updateField(array $field , $id , $field_type = PDO::PARAM_STR,  $id_type = PDO::PARAM_STR ): bool
		{
			try {
				
				$query = ' ';
				$query .= "UPDATE {$this->tableName} ";
				$query .= " SET $field[0] = :pass  ";
				$query .= ' WHERE user_id = :id ;';
				$stmt = $this->PDO->prepare($query);
				
				$stmt->bindParam(':pass',$field[1] ,$field_type);
				$stmt->bindParam(':id',$id, $id_type);
				
				$stmt->execute();
				
				return $stmt->rowCount() > 0;
			} catch (Exception $exception) {
				echo $exception->getMessage();
				
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
		public static function getUserImage($array)
		{
			
			foreach ($array as $record) {
				$record->user_photo = getFileFromDirByName($record->user_photo, UploadImage::targetFolder);
			}
			
			return $array;
		}
		
		
		
		/**
		 *
		 */
		public function generateUserPhotoName()
		{
			
			$username = $this->getName();
			$username = trim($username);
			$username = str_replace(' ', '_', $username);
			$username = strtolower($username);
			
			return $username . '-' . date('y-m-d-h-i-s');
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
			$param = [':gender' => [$gender, PDO::PARAM_STR]];
			
			return $this->read($query, $fetchType, $param);
		}
		
		
		
		/**
		 *
		 * @param $year
		 * @return array|false
		 */
		public function userCountByMonth($year): array
		{
			
			$query = 'CALL proc_UserCountByMonth(:param);';
			$fetchType = PDO::FETCH_OBJ;
			$param = [':param' => [$year, PDO::PARAM_STR]];
			
			return $this->read($query, $fetchType, $param);
			
		}
		
		
		
		public function proc_PercentageRequestsByRole($id)
		{
			
			$query = 'call proc_PercentageRequestsByRole(:id);';
			$fetchType = PDO::FETCH_OBJ;
			$param = [':id' => [$id, PDO::PARAM_INT]];
			
			return $this->read($query, $fetchType, $param);
		}
		
		
		
		/**
		 * Percentage of   requests per month for specific user
		 * @param $id
		 * @param $year
		 * @return array|false
		 */
		public function userRequestsPercentage($id, $year)
		{
			
			try {
				$query = 'CALL proc_UserRequestsPercentage(:id ,:year);';
				$stmt = $this->PDO->prepare($query);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->bindParam(':year', $year, PDO::PARAM_STR);
				$stmt->execute();
				
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				echo $e->getMessage();
				
				return false;
			}
			
			
			
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
		
		
		
		/**
		 * @return false|mixed
		 */
		public function getLastFourUsers()
		{
			
			$query = 'select * from view_GetLastFourUser';
			
			return $this->read($query, PDO::FETCH_OBJ);
		}
		
		
	}
























