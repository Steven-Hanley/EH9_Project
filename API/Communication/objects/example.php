<?php

    ini_set('error_reporting', E_ALL);

    // defines properties for the data we will be delivering
    // and function/s used to fetch data
    class Data {

        // db connection constructor variable and table name
        // CHANGE ME:
        private $conn;
        private $table = "test";

        // CHANGE ME: attributes we will be returning correspond
        // to db columns
        public $id;
        public $password;

        public $firstname;
        public $surname;
        public $age;

        // constructor which takes a db connection value needed for query
        public function __construct($db_ini) { $this->conn = $db_ini; }
        
        // fetch all data
        public function queryData() {

            // sql query which grabs everything
            $sql = "SELECT * FROM " . $this->table . "";

            // prepare the query and execute
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt;
        }

        // fetch one specific piece of data using id
        public function queryOneData() {
            
            // use placeholder and limit the data to one record only
            $sql = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 0,1";

            // prepare and execute the query
            $stmt = $this->conn->prepare($sql);

            // bind the id value to the placeholder in the sql query
            $stmt->bindParam(1, $this->id);

            $stmt->execute();
            
            // get the row with the data
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // use a for loop to allow usage of break (can't be used within PHP if statements)
            for ($i = 0; $i < 1; $i++) {
                // if the id supplied is valid and can be searched for then its correct
                if ($row && $row['id'] == $this->id) {
                    $this->password = $row['password'];
                    // $this->firstname = $row['firstname'];
                    // $this->surname = $row['surname'];
                    // $this->age = $row['age'];
                } else { break; }
            }
        }

        // search for a password
        public function searchPassword($keywords) {

            $sql = "SELECT * FROM " . $this->table . " WHERE password LIKE ?";

            $stmt = $this->conn->prepare($sql);

            // make sure input is sanitised
            $keywords = htmlspecialchars(strip_tags($keywords));
            $keywords = "%{$keywords}%";
             
            // bind keywords to placeholder
            $stmt->bindParam(1, $keywords);
            // execute
            $stmt->execute();

            return $stmt;
        }
    }
?>