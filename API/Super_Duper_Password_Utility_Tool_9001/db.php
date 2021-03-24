<?php
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    class Configuration {

        // declare database configuration details
        // CHANGE ME:
        private $host = "***REMOVED***";
        private $dbase = "***REMOVED***";
        private $username = "***REMOVED***";
        private $passwd = "***REMOVED***";
        public $conn;
        // CHANGE ME:
        public $file_path = 'C:\\xampp\\htdocs\\work\\';

        // initialise connection to db
        public function getConnection() {

            $this->conn = null;

            // error handling for db connection
            try {
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