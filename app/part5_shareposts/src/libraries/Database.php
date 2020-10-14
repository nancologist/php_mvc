<?php

/*
* PDO Database Class
* It connects the Backend to database.
* Create prepared statements
* Bind values
* Return rows and results
*/

class Database {
    private $host = DB_HOST;
    private $port = DB_PORT;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbHandler;
    private $dbQuery;
    private $error;

    public function __construct() {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Elegant way to handle errors
        );

        // Create PDO instance
        try {
            $this->dbHandler = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Prepare Query:
    public function query($sql) {
        $this->dbQuery = $this->dbHandler->prepare($sql);
    }

    // Bind values
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->dbQuery->bindValue($param, $value, $type);
    }

    // Execute the DB Query
    public function execute() {
        return $this->dbQuery->execute();
    }

    // Get result set as array of objects
    public function resultSet() {
        $this->execute();
        return $this->dbQuery->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function single() {
        $this->execute();
        return $this->dbQuery->fetch(PDO::FETCH_OBJ);
    }

    // Get row count:
    public function rowCount() {
        return $this->dbQuery->rowCount();
    }
}
