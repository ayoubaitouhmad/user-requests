<?php


namespace App\data;

use App\models\User;
use PDO;
use http\Message;
use http\Params;

class database
{
    # Database host address, defined in construction.
    protected $host;
    # Username for authentication, defined in construction.
    protected $username;
    # Password for authentication, defined in construction.
    protected $password;
    # Database name, defined in construction.
    protected $database;

    # Connection variable. DO NOT CHANGE!
    public $connection;

    # @bool default for this is to be left to FALSE, please. This determines the connection state.
    public $connected = false;

    # @bool this controls if the errors are displayed. By default, this is set to true.
    private $errors = true;



    function __construct(){
        try
        {
            $this->host = $_ENV['DB_HOST'];
            $this->username = $_ENV['DB_USERNAME'];
            $this->password = $_ENV['DB_PASSWORD'];
            $this->database = $_ENV['DB_NAME'];
            $this->connected = true;
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            $this->connected = false;
            if($this->errors === true){
                return $this->error($e->getMessage());
            }else{
                return false;
            }
        }
    }

    function __destruct()
    {
        $this->connected = false;
        $this->connection = null;
    }

    function error($er){
        echo $er;
    }


    function pdostatement($query , $params = array()){
        if($this->connected){
            try {
                $stm =  $this->connection->prepare($query);
                return $stm->execute($params);
            }catch (PDOException $e){
                $this->error($e->getMessage());
            }
            return true;
        }
        else
            return false;
    }
    public function test(){
        if(isset($this->connection) && $this->connected){
            echo 'PDO WORK SUCCESSFULLY';
        }else{
            echo 'SORRY ,SOMETHING WENT WRONG  PLEASE REWRITE DB INFO';
        }
    }
//    function fetch($query , $params = array() ){
//        if($this->connected){
//            try {
//                $stm = $this->connection->prepare($query);
//                return $stm->execute()->fetch();
//            }catch (PDOException $e){
//               $this->error($e->getMessage());
//            }
//            return true;
//        }
//        else
//            return false;
//    }
//
//
//    function fetchAll($query , $params = array() ){
//        if($this->connected){
//            try {
//                $stm = $this->connection->prepare($query);
//                return $stm->execute()->fetchAll();
//            }catch (PDOException $e){
//                $this->error($e->getMessage());
//            }
//            return true;
//        }
//        else
//            return false;
//    }
//
//
//    function count($query , $params = array()){
//        return $this->pdostatement() ? $this->pdostatement()->rowcount() : false;
//    }
//
//    public function insert($query, $parameters = array()){
//        if($this->pdostatement($query, $parameters)){
//            return true;
//        }
//        return false;
//    }
//

//    public function query($sql, array $values = [])
//    {
//       $stmt = $this->_pdo->prepare($sql);
//        $x = 1;
//        if (count($values)) {
//            foreach ($values as $value) {
//                $stmt->bindValue($x, $value);
//                $x++;
//            }
//        }
//
//        if ($this->_query->execute()) {
//            return true;
//        } else {
//            return false;
//        }
//
//
//    }

}