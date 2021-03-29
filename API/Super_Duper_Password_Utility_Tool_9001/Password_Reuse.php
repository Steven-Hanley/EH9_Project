<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $conn = null;

    /**
     * method for fetching the connection and assigning $conn
     */
    function getConnection() {

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

        // first, check for a valid user id
        $sql = "SELECT * FROM Passwords
        WHERE USER_ID = ?";

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
        $num = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // check if that account exists
        if (is_array($num)) {
            // compare the entered password to that password record
            if (password_verify($userPassword, $num['password'])) {
                // passwords match
              //  echo "Password has been used before."; echo "<br>";
            } else {
                // passwords don't match
               // echo "Password has not been used before."; echo "<br>";

                // insert password data under that user id
                if (insertPasswordData($userID, $userPassword)) {
                    // success
                  //  echo "you can insert the password."; echo "<br>";

                } else {
                    // failure
                  //  echo "you can't insert the password here."; echo "<br>";
                }
            }
        } else {
            // no entries
         //   echo "No entries."; echo "<br>";

        }
    }

    function insertPasswordData($userID, $userPassword) {

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
        checkPasswordExists($userID, $userPassword);
    }
?>