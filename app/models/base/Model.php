<?php
	
	namespace App\models\base;
	
	use App\data\database;
	
	class Model
	{
		protected $PDO;
		protected  $tableName;
		
		
		protected  function init($tableName){
			$database = new database();
			$this->PDO = $database->connection;
			$this->tableName = $tableName;
		}
	}