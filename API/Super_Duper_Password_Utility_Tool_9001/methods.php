<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // defines properties for the data we will be delivering
    // and function/s used to fetch data
    class Data {

        // db connection constructor variable and table name
        // CHANGE ME:
        private $conn;
        private $table = "***REMOVED***";

        // CHANGE ME: attributes we will be returning correspond
        // to db columns
        public $userID;
        public $id;
        public $password;
        
        // constructor which takes a db connection value needed for query
        public function __construct($db_ini) { $this->conn = $db_ini; }
        
        // fetch all data with no conditions
        public function queryData() {

            // sql query which grabs everything
            $sql = "SELECT * FROM " . $this->table . "";

            // prepare the query and execute
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt;
        }

        // insert password data 
        public function insertPasswordData() {
            // $sql = "INSERT INTO Passwords 
            //     SET 
            //         USER_ID = ?,
            //         password = ?";

            $sql = "INSERT INTO Passwords (USER_ID, password) 
                VALUES (?, ?)";

            $stmt = $this->conn->prepare($sql);

            $this->userID = htmlspecialchars(strip_tags($this->userID));
            $this->password = htmlspecialchars(strip_tags($this->password));

            $hash = password_hash($this->password, PASSWORD_DEFAULT);

            $stmt->bindParam(1, $this->userID);
            $stmt->bindParam(2, $hash);

            if ($stmt->execute()) {
                return true;
            } else {
                print_r($stmt->errorInfo());
                return false;
            }
        }

        // grab password data
        public function checkPasswordData() {

            // $sql = "SELECT password FROM Passwords
            // WHERE USER_ID = ? AND password = ?";

            $sql = "SELECT * FROM Passwords
            WHERE USER_ID = ?";
            
            if(!($stmt = $this->conn->prepare($sql))) {
                echo "Prepare failed ";
            }

            $userID = htmlspecialchars(strip_tags($this->userID));
            //$userPassword = htmlspecialchars(strip_tags($userPassword));

            if (!($stmt->bindParam(1, $this->userID))) {
                echo "Binding parameters 1 failed "; echo "<br>";
            } 

            // if (!($stmt->bindParam(2, $userPassword))) {
            //     echo "Binding parameters 2 failed "; echo "<br>";
            // }
            
            if (!($stmt->execute())) {
                echo "Execute failed "; echo "<br>";
                print_r($stmt->errorInfo());
            }

            return $stmt;
        }
    }
?>