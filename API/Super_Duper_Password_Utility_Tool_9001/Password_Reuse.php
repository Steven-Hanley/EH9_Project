<?php

    GLOBAL $conn;

    /**
     * method for fetching the connection and assigning $conn
     */
    function getConnection() {
        global $conn;
        $host = "***REMOVED***";
        $dbase = "***REMOVED***";
        $username = "***REMOVED***";
        $password = "***REMOVED***";

        // error handling for db connection
        try {
            // successful
            $conn = new PDO
            (
                "mysql:host=" . $host 
                . ";dbname=" . $dbase, 
                $username, $password
            );
            $conn->exec("set names utf8");
        } catch (PDOExecption $exception) {
            //echo $exception;
            // unsuccessful
            //echo "Connection error: " . $exception->getMessage();
        }
    }

    /**
     * checking if a valid user id and password exists
     */
    function checkPasswordExists($userID, $userPassword) {
        global $conn;
        $usedBefore = false;
        //echo 'checking passwords';

        // first, check for a valid user id
        $sql = "SELECT * FROM Passwords WHERE USER_ID = ?";
        // error statements
        if (!($stmt = $conn->prepare($sql))) {
            //echo "Prepare failed ";
        }
        if (!($stmt->bindParam(1, $userID))) {
         //   echo "Binding parameters 1 failed "; echo "<br>";
        } 
        if (!($stmt->execute())) {
          //  echo "Execute failed "; echo "<br>";
            print_r($stmt->errorInfo());
        }


        // fetch the record
        $num = $stmt->fetchAll();        
        // check if that account exists
        if (is_array($num)) {
            foreach ($num as $item){
                if (password_verify($userPassword, $item['password'])) {
                    //echo 'match';
                    $usedBefore = true;
                    return $usedBefore;
                }                        
            }
            insertPasswordData($userID, $userPassword);
            return $usedBefore;
        } else {
                insertPasswordData($userID, $userPassword);
               //echo "No entries."; echo "<br>";
               return $usedBefore;
        }
    }
            


    function insertPasswordData($userID, $userPassword) {
        global $conn;
        $sql = "INSERT INTO Passwords (USER_ID, password) 
                VALUES (?, ?)";

        $stmt = $conn->prepare($sql);

        // current hashing is bcrypt
        $hash = password_hash($userPassword, PASSWORD_DEFAULT);

        // bind the values to the placeholders (?)
        $stmt->bindParam(1, $userID);
        $stmt->bindParam(2, $hash);

        // returns true or false which is handled by checkPasswordExists
        if ($stmt->execute()) {
            return true;
        } else {
            print_r($stmt->errorInfo());
            return false;
        }     
    }

    // runs everything
    function passwordReuse($userID, $userPassword) {
        getConnection();
        $history = checkPasswordExists($userID, $userPassword);
        return $history;
    }
?>