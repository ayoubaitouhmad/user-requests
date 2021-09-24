<?php
	
	declare(strict_types=1);
	
	namespace App\models\base;
	
	use App\data\database;
	use App\interfaces\CrudInterface;
	use PDO;
	use PDOException;
	
	class Notification
	{
		
		
		protected $notification_id;
		
		protected $title;
		
		protected $description;
		
		protected $created_at;
		
		protected $deleted_at;
		protected $status;
		
		
		
	
		
		
		protected $user_id;
		
		protected $admin_id;
		
		
		protected $notification_type;
		
		protected $tableName;
		
		protected $PDO;
		
		
		/**
		 * @return mixed
		 */
		public function getStatus()
		{
			
			return $this->status;
		}
		
		
		
		/**
		 * @param mixed $status
		 */
		public function setStatus($status): void
		{
			
			$this->status = $status;
		}
		/**
		 * @return mixed
		 */
		public function getNotificationId()
		{
			
			return $this->notification_id;
		}
		
		
		
		/**
		 * @param mixed $notification_id
		 */
		public function setNotificationId($notification_id): void
		{
			
			$this->notification_id = $notification_id;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getTitle()
		{
			
			return $this->title;
		}
		
		
		
		/**
		 * @param mixed $title
		 */
		public function setTitle($title): void
		{
			
			$this->title = $title;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getDescription()
		{
			
			return $this->description;
		}
		
		
		
		/**
		 * @param mixed $description
		 */
		public function setDescription($description): void
		{
			
			$this->description = $description;
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
		 */
		public function setCreatedAt($created_at): void
		{
			
			$this->created_at = $created_at;
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
		 */
		public function setDeletedAt($deleted_at): void
		{
			
			$this->deleted_at = $deleted_at;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getUserId()
		{
			
			return $this->user_id;
		}
		
		
		
		/**
		 * @param mixed $user_id
		 */
		public function setUserId($user_id): void
		{
			
			$this->user_id = $user_id;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getNotificationType()
		{
			
			return $this->notification_type;
		}
		
		
		
		/**
		 * @param mixed $notification_type
		 */
		public function setNotificationType($notification_type): void
		{
			
			$this->notification_type = $notification_type;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getTableName()
		{
			
			return $this->tableName;
		}
		
		
		
		/**
		 * @param mixed $tableName
		 */
		public function setTableName($tableName): void
		{
			
			$this->tableName = $tableName;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getAdminId()
		{
			
			return $this->admin_id;
		}
		
		
		
		/**
		 * @param mixed $admin_id
		 */
		public function setAdminId($admin_id): void
		{
			
			$this->admin_id = $admin_id;
		}
		
		
		
		/**
		 * @return mixed
		 */
		public function getPDO()
		{
			
			return $this->PDO;
		}
		
		
		
		/**
		 * @param mixed $PDO
		 */
		public function setPDO($PDO): void
		{
			
			$this->PDO = $PDO;
		}
		
		
	}