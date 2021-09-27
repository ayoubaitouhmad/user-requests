<?php
	
	declare(strict_types=1);
	
	namespace App\models;
	
	
	use App\classes\base\UploadImage;
	use App\data\database;
	use App\interfaces\crud;
	use App\interfaces\CrudInterface;
	use PDO;
	use PDOException;
	use Exception;
	
	
	/**
	 *
	 */
	class Request implements CrudInterface
	{
		
		protected $id;
		
		protected $date;
		
		protected $pretext;
		
		protected $response;
		
		protected $status;
		
		protected $user;
		
		protected  $type;
		
		
		
		
		private $PDO;
		
		private $tableName;
		
		
		/**
		 * @return mixed
		 */
		public function getType()
		{
			
			return $this->type;
		}
		
		
		
		/**
		 * @param mixed $type
		 */
		public function setType($type): void
		{
			
			$this->type = $type;
		}
		
		/**
		 * @return mixed
		 */
		public function getId()
		{
			
			return $this->id;
		}
		
		
		
		/**
		 * @param mixed $id
		 * @return Request
		 */
		public function setId($id)
		{
			
			$this->id = $id;
			
			return $this;
		}
		
		
		
		public static function inst()
		{
			
			return new Request();
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
		 * @return Request
		 */
		public function setDate($date)
		{
			
			$this->date = $date;
			
			return $this;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getPretext()
		{
			
			return $this->pretext;
		}
		
		
		
		/**
		 * @param mixed $pretext
		 * @return Request
		 */
		public function setPretext($pretext)
		{
			
			$this->pretext = $pretext;
			
			return $this;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getResponse()
		{
			
			return $this->response;
		}
		
		
		
		/**
		 * @param mixed $response
		 * @return Request
		 */
		public function setResponse($response)
		{
			
			$this->response = $response;
			
			return $this;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getStatus()
		{
			
			return $this->status;
		}
		
		
		
		/**
		 * @param mixed $status
		 * @return Request
		 */
		public function setStatus($status)
		{
			
			$this->status = $status;
			
			return $this;
		}
		
		
		
		/**
		 *
		 */
		public function getUser()
		{
			return $this->user;
		}
		
		
		
		/**
		 *
		 * @param $user
		 * @return Request
		 */
		public function setUser( $user): Request
		{
			
			$this->user = $user;
			
			return $this;
		}
		
		
		
		// end setters/getters
		
		
		public function __construct()
		{
			
			$database = new database();
			$this->PDO = $database->connection;
			$this->tableName = $_ENV['DB_REQUESTS'];
			
		}
		
		
		
		
		
		
		
		// implemented methods
		
		
		
		/**
		 * @param $query
		 * @param array|null $paramsAndTypes
		 * @param $fetchType
		 * @return array|false
		 */
		public function prepare($query, array $paramsAndTypes = null, $fetchType)
		{
			
			try {
				$statement = $this->PDO->prepare($query);
				if (!is_null($paramsAndTypes)) {
					foreach ($paramsAndTypes as $key => $value) {
						$data = $value[0];
						$paramType = $value[1];
						$statement->bindParam($key, $data, $paramType);
					}
				}
				$statement->execute();
				
				return $statement->fetchAll($fetchType);
			} catch (\PDOException $exception) {
				echo $exception->getMessage();
				
				return false;
			}
		}
		
		
		//  class methods
		
		
		
		/**
		 * @param $query
		 * @param $fetch_type
		 * @return array|false
		 */
		public function query($query, $fetch_type)
		{
			
			try {
				$statement = $this->PDO->query($query);
				
				return $statement->fetchAll($fetch_type);
				
			} catch (Exception $exception) {
				echo $exception->getMessage();
				
				return false;
			}
		}
		
		
		
		public function gelAllRequestFullData(array $requests): array
		{
			$user = new User();
			foreach ($requests as $req) {
				$id = $req->user_id;
				if ($user->get($id) !== null) {
					$currentUser = $user->get($id);
					if (isset($currentUser)) {
						$req->userName = $currentUser->user_fullname;
						$req->userPhoto = getFileFromDirByName($currentUser->user_photo, UploadImage::targetFolder);
						$req->request_id = enc($req->request_id);
					}
					
				}
			}
			
			return $requests;
			
		}
		
		
		
		/**
		 * @param $record
		 * @return bool
		 */
		public function create($record): bool
		{
			try {
				$query = " INSERT INTO {$this->tableName} (request_id , request_pretext ,request_type , user_id) ";
				$query .= " VALUES(:id , :request_pretext ,:request_type ,:user_id)";
				$stmt = $this->PDO->prepare($query);
				
				$request_id = generateRequestIds();
				$request_pretext =$record->getPretext();
				$request_type =$record->getType();
				$user_id =$record->getUser();
				
				$stmt->bindParam(':id' , $request_id , PDO::PARAM_STR);
				$stmt->bindParam(':request_pretext' , $request_pretext , PDO::PARAM_STR);
				$stmt->bindParam(':request_type' , $request_type , PDO::PARAM_STR);
				$stmt->bindParam(':user_id' , $user_id , PDO::PARAM_STR);
				
				
				$stmt->execute();
				
				return  $stmt->rowCount() > 0;
				
			} catch (Exception $exception) {
				echo $exception->getMessage();
				
				return false;
			}
		}
		
		
		
		/**
		 * @param $query
		 * @param $fetchType
		 * @param array $data
		 * @return array|false
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
		 * @return array|false
		 */
		public function all()
		{
			
			try {
				$query = "SELECT * FROM `{$this->tableName}` order by `{$this->tableName}`.request_date DESC";
				$stmt = $this->PDO->query($query);
				$stmt->execute();
				$requests = $stmt->fetchAll(PDO::FETCH_OBJ);
				
				return $this->gelAllRequestFullData($requests);
				
			} catch (Exception $exception) {
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
				$query = 'SELECT * FROM request WHERE request_id = :id';
				$stmt = $this->PDO->prepare($query);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->execute();
				
				return $stmt->fetch(PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				echo $e->getMessage();
				
				return false;
			}
		}
		
		
		
		/**
		 * @param $record
		 * @return bool
		 */
		public function update($record)
		{
			
			try {
				$query = ' UPDATE request ';
				$query .= ' SET ';
				$query .= ' request_response = :response , ';
				$query .= ' request_status = :status  ';
				$query .= ' WHERE request_id = :id; ';
				$stmt = $this->PDO->prepare($query);
				$response = $record->getResponse();
				$status = $record->getStatus();
				$id = $record->getId();
				$stmt->bindParam(':response', $response, PDO::PARAM_STR);
				$stmt->bindParam(':status', $status, PDO::PARAM_STR);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				return $stmt->execute();
				
				
				
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return false;
			}
			
		}
		
		
		
		/**
		 * @param $id
		 * @return false|mixed
		 */
		public function delete($id)
		{
			
			try {
				$query = 'DELETE FROM {$this->table_name} WHERE  {$this->table_name}.request_id = :id';
				$stmt = $this->PDO->prepare($query);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->execute();
				
				return $stmt->rowCount();
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
		
		
		
		/*
				 *
				*********************       -> charts data <-   *******************************
				 *
		*/
		
		
		
		/**
		 * get the number of request for each request type
		 * @return array|false
		 */
		public function getCountRequestsByType()
		{
			
			$query = 'SELECT * FROM view_GetCountRequestsByType';
			
			return $this->read($query, PDO::FETCH_OBJ);
		}
		
		
		
		/**
		 * get last for for requests added
		 * @return array|false
		 */
		public function lastFourRequests()
		{
			
			$query = 'SELECT * from viewGetLastFourRequests;';
			
			return $this->read($query, PDO::FETCH_OBJ);
		}
		
		
		
		/**
		 *
		 */
		public function getRequestsByGender($gender)
		{
			
			$query = 'call getRequestsByGender(:gender);';
			$fetchType = PDO::FETCH_OBJ;
			$param = [':gender' => [$gender, PDO::PARAM_STR]];
			
			return $this->read($query, $fetchType, $param);
		}
		
		
		
		/**
		 * @param $date
		 * @return array|false
		 */
		public function getRequestByMonth($date)
		{
			
			$query = 'call prcoRequestByMonth(:date)';
			$fetchType = PDO::FETCH_OBJ;
			$param = [':date' => [$date, PDO::PARAM_STR]];
			
			return $this->read($query, $fetchType, $param);
		}
		
	}