<?php
# Database host address, defined in construction.
 $host = "";
# Username for authentication, defined in construction.
 $username = "";
# Password for authentication, defined in construction.
 $password = "";
# Database name, defined in construction.
 $database = "";

# Connection variable. DO NOT CHANGE!
 $connection = "";


$connected = "" ;

# @bool this controls if the errors are displayed. By default, this is set to true.
$errors = true;


try{
    $this->host = $_ENV['DB_HOST'];
    $this->username = $_ENV['DB_USERNAME'];
    $this->password = $_ENV['DB_PASSWORD'];
    $this->database = $_ENV['DB_NAME'];
    $this->connected = true;
    $this->connection = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $this->connection;
}
catch(PDOException $e){
    $this->connected = false;
    if($this->errors === true){
        return $this->error($e->getMessage());
    }else{
        return false;
    }
}


