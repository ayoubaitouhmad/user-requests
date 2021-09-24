<?php
	
	namespace App\models;
	
	use App\data\database;
	use App\interfaces\CrudInterface;
	use App\models\base\Model;
	use PDO;
	use PDOException;
	
	class AdminSetting extends Model implements CrudInterface
	{
		protected  $hide_notification;
		protected  $hide_sidebar;
		protected  $notifiy_when_admin_send_feedback;
		protected  $notifiy_when_user_send_request;
		protected  $notifiy_when_securuty_info_changed;
		
		
		
		/**
		 * @return mixed
		 */
		public function getHideNotification()
		{
			
			return $this->hide_notification;
		}
		
		
		
		/**
		 * @param mixed $hide_notification
		 */
		public function setHideNotification($hide_notification): void
		{
			
			$this->hide_notification = $hide_notification;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getHideSidebar()
		{
			
			return $this->hide_sidebar;
		}
		
		
		
		/**
		 * @param mixed $hide_sidebar
		 */
		public function setHideSidebar($hide_sidebar): void
		{
			
			$this->hide_sidebar = $hide_sidebar;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getNotifiyWhenAdminSendFeedback()
		{
			
			return $this->notifiy_when_admin_send_feedback;
		}
		
		
		
		/**
		 * @param mixed $notifiy_when_admin_send_feedback
		 */
		public function setNotifiyWhenAdminSendFeedback($notifiy_when_admin_send_feedback): void
		{
			
			$this->notifiy_when_admin_send_feedback = $notifiy_when_admin_send_feedback;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getNotifiyWhenUserSendRequest()
		{
			
			return $this->notifiy_when_user_send_request;
		}
		
		
		
		/**
		 * @param mixed $notifiy_when_user_send_request
		 */
		public function setNotifiyWhenUserSendRequest($notifiy_when_user_send_request): void
		{
			
			$this->notifiy_when_user_send_request = $notifiy_when_user_send_request;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getNotifiyWhenSecurutyInfoChanged()
		{
			
			return $this->notifiy_when_securuty_info_changed;
		}
		
		
		
		/**
		 * @param mixed $notifiy_when_securuty_info_changed
		 */
		public function setNotifiyWhenSecurutyInfoChanged($notifiy_when_securuty_info_changed): void
		{
			
			$this->notifiy_when_securuty_info_changed = $notifiy_when_securuty_info_changed;
		}
		
		
		
		public function __construct()
		{
			$this->init($_ENV['TB_ADMIN_PREFERENCES']);
			$database = new database();
			$this->PDO = $database->connection;
			
		}
		
		
		
		public function create($record)
		{
			// TODO: Implement create() method.
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
			// TODO: Implement delete() method.
		}
		
		
		
		public function all()
		{
			try {
				$query = "SELECT * FROM ".$this->tableName ;
				$stmt = $this->PDO->query($query);
				
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				return false;
			}
		}
		
		
		
		public function get($id)
		{
			try {
				$query = "select  * from $this->tableName where  admin =:id;";
				$stmt = $this->PDO->prepare($query);
				
				$stmt->bindParam(':id' , $id ,PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch(PDO::FETCH_OBJ);
			} catch (PDOException $exception) {
				echo $exception->getMessage();
				return false;
			}
		}
		
		
		
		public function edit(array $field ,array $id ){
			try {
				
				
				$query = " UPDATE {$this->tableName} ";
				$query .= " SET $field[0] = :field  ";
				$query .= ' WHERE admin = :id ;';
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
		
		
	}