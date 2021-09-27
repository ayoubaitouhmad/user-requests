<?php
	
	namespace App\models;
	
	use App\classes\UserInfo;
	use App\data\database;
	use App\interfaces\CrudInterface;
	use App\models\base\Person;
	use PDO;
	use PDOException;
	
	/**
	 *
	 */
	class Admin extends Person implements CrudInterface
	{
		protected  $PDO ;
		protected   $tableName;
		public function  __construct()
		{
			$database = new database();
			$this->PDO = $database->connection;
			$this->tableName = $_ENV['DB_ADMIN'];
		}
		
		
		
		public function create($record)
		{
			// TODO: Implement create() method.
		}
		
		
		
		/**
		 * @param $query
		 * @param $fetchType
		 * @param array $data
		 * @return mixed
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
		
		
		
		public function update($record)
		{
			// TODO: Implement update() method.
		}
		
		
		
		public function delete($id)
		{
			// TODO: Implement delete() method.
		}
		
		
		
		public function all()
		{
			// TODO: Implement all() method.
		}
		
		
		
		public function get($id)
		{
			try {
				$query = 'SELECT * FROM admin where admin_username = :username;';
				$stmt = $this->PDO->prepare($query);
				$stmt->bindParam(':username' , $id , PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch(PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				echo $e->getMessage();
				return false;
			}
		}
		
		public function getByID($id)
		{
			try {
				$query = 'SELECT * FROM admin where admin_id = :id;';
				$stmt = $this->PDO->prepare($query);
				$stmt->bindParam(':id' , $id , PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch(PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				echo $e->getMessage();
				return false;
			}
		}
		
		
		
		/**
		 * @param $username
		 * @param $password
		 * @return false|mixed|null
		 */
		public function isValid($username , $password){
			try {
				$query = 'SELECT * FROM admin where admin_username = :username and admin_password = :pass;';
				$stmt = $this->PDO->prepare($query);
				$stmt->bindParam(':username' , $username , PDO::PARAM_STR);
				$stmt->bindParam(':pass' , $password , PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->rowCount() > 0 ? $stmt->fetch(PDO::FETCH_OBJ) : null;
			} catch (PDOException $e) {
				echo $e->getMessage();
				return false;
			}
			
		}
		
		
		public function editColumn(array $field ,array $id ){
			try {
				
				$query = " UPDATE {$this->tableName} ";
				$query .= " SET $field[0] = :field  ";
				$query .= ' WHERE admin_id = :id ;';
				$stmt = $this->PDO->prepare($query);
				$stmt->bindParam(':field',$field[1] ,$field[2]);
				$stmt->bindParam(':id',$id[0], $id[1]);
				
				$stmt->execute();
				
				return $stmt->rowCount() > 0;
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return false;
			}
			
		}
		
		public function editSecurityData(Admin $admin): bool
		{
			try {
				
				$query = " UPDATE {$this->tableName} ";
				$query .= " SET admin_password = :pass,  ";
				$query .= "  admin_username = :username  ";
				$query .= ' WHERE admin_id = :id ;';
				$stmt = $this->PDO->prepare($query);
				
				$username = $admin->getUsername();
				$pass = $admin->getPassword();
				$id = $admin->getId();
				
				$stmt->bindParam(':pass',  $pass,PDO::PARAM_STR);
				$stmt->bindParam(':username',  $username,PDO::PARAM_STR);
				$stmt->bindParam(':id', $id, PDO::PARAM_STR);
				
				$stmt->execute();
				
				return $stmt->rowCount() > 0;
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return false;
			}
			
		}
		
		
		public function visiteurQueries($today = false)
		{
			try {
				if ($today){
					$query = 'select  count(ip) from visitors where cast(date as date ) = curdate() group by ip' ;
				}else{
					$query = "select  count(ip)  from visitors group by ip;";
				}
				
				$stmt = $this->PDO->query($query);
				return $stmt->fetchColumn(0);
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return false;
			}
			
			
		}
		public function addIp(): bool
		{
			try {
				$userInfo = new UserInfo();
				$ip  =$userInfo->getIp();
				$query = "insert into visitors (ip) values(:ip)";
				$stmt = $this->PDO->prepare($query);
				$stmt->bindParam(':ip' , $ip , PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->rowCount();
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return false;
			}
			
			
		}
		
		
		public function count($query){
			try {
				$stmt = $this->PDO->query($query);
				return $stmt->fetchColumn();
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return false;
			}
			
		}
		
		
		
	}