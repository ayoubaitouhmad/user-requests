<?php
	
	namespace App\models;
	
	use App\data\database;
	use App\interfaces\CrudInterface;
	use App\models\base\Notification;
	use PDO;
	use PDOException;
	
	class AdminNotification extends  Notification implements  CrudInterface
	{
		public function __construct()
		{
			$database = new database();
			$this->PDO = $database->connection;
			$this->tableName = $_ENV['DB_ADMIN_NOTIFICATION'];
		}
		
		
		
		public function create( $record)
		{
			
			try {
				$query = ' INSERT INTO ' .$this->tableName. ' (title, description, admin,user, type) VALUES (:title, :description, :admin, :user, :type);';
				
				$stmt = $this->PDO->prepare($query);
				
				
				$title = $record->title;
				$description = $record->description;
				$user_id = $record->user_id;
				$admin_id = $record->admin_id;
				$notification_type = $record->notification_type;
				
				
				
				$stmt->execute(
					[
						'title' => $title,
						'description' => $description,
						'admin' => $admin_id,
						'user' => $user_id,
						'type' => $notification_type
					]
				);
				
				return $stmt->rowCount()>0;
				
				
				
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return null;
			}
		}
		
		
		
		public function read($query, $fetchType, array $data = [])
		{
			// TODO: Implement read() method.
		}
		
		
		
		public function update($record)
		{
			// TODO: Implement update() method.
		}
		
		
		
		public function delete($id)
		{
			try {
				$query = 'UPDATE '. $this->tableName;
				$query .= ' SET deleted_at = :date ';
				$query .= ' where notification_id = :id';
				
				$stmt = $this->PDO->prepare($query);
				
				$date = date('y-m-d h:i:s');
				$stmt->bindParam(':id' , $id , PDO::PARAM_INT);
				$stmt->bindParam(':date' , $date , PDO::PARAM_STR);
				$stmt->execute();
				return  $stmt->rowCount()>0;
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return null;
			}
		}
		
		
		
		public function all()
		{
			try {
				$query = 'SELECT * FROM '. $this->tableName.' WHERE deleted_at is null order by created_at DESC';
				$stmt = $this->PDO->query($query);
				$stmt->execute();
				return  $stmt->fetchAll(PDO::FETCH_OBJ);
				
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return null;
			}
		}
		
		
		
		public function get($id)
		{
			try {
				$query = 'SELECT * FROM '. $this->tableName.' where notification_id = :id order by created_at DESC';
				$stmt = $this->PDO->prepare($query);
				$stmt->bindParam(':id' , $id , PDO::PARAM_INT);
				$stmt->execute();
				return  $stmt->fetchAll(PDO::FETCH_OBJ);
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return null;
			}
		}
		
		
		public function getUserNotification($id)
		{
			try {
				$query = 'SELECT * FROM '. $this->tableName.' where user = :id order by created_at DESC';
				$stmt = $this->PDO->prepare($query);
				$stmt->bindParam(':id' , $id , PDO::PARAM_INT);
				$stmt->execute();
				return  $stmt->fetchAll(PDO::FETCH_OBJ);
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return null;
			}
		}
		
		
		public function updateStatus()
		{
			try {
				$query = "Update {$this->tableName} set status = :status";
				$stmt = $this->PDO->prepare($query);
				$status = 1;
				$stmt->bindParam(':status' , $status , PDO::PARAM_INT);
				$stmt->execute();
				return  $stmt->fetchAll(PDO::FETCH_OBJ);
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				
				return null;
			}
		}
		
		
	}