<?php
    
    ini_set('error_reporting', E_ALL);

    class Configuration {

        // declare database configuration details
        // CHANGE ME:
        private $host = "**************";
        private $dbase = "**************";
        private $username = "**************";
        private $passwd = "**************";
        public $conn;
        // CHANGE ME:
        public $file_path = 'C:\\xampp\\htdocs\\work\\';

        // initialise connection to db
        public function getConnection() {

            $this->conn = null;

            // error handling for db connection
            try {
                echo "YASS";
                // successful
                $this->conn = new PDO
                (
                    "mysql:host=" . $this->host 
                    . ";dbname=" . $this->dbase, 
                    $this->username, $this->passwd
                );
                $this->conn->exec("set names utf8");
            } catch (PDOExecption $exception) {
                //echo $exception;
                // unsuccessful
                echo "Connection error: " . $exception->getMessage();
            }
            
            // should be null if there was an error
            return $this->conn;
        } 
    }

?>