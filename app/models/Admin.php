<?php
	
	namespace App\models;
	
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
	}