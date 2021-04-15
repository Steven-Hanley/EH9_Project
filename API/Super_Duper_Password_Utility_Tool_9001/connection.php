<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    $conn = null;

    function setupConnection() {

        GLOBAL $conn;

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
            echo "Connection error: " . $exception->getMessage();
        }
    }

    function checkAccount() {

        GLOBAL $conn;

        if (!isset($_POST['username'], $_POST['password'])) {
            exit("You know the rules and so do I!");
        } else {
            if ($stmt = $conn->prepare('SELECT * FROM Accounts WHERE username = ?')) {
                    $stmt->bindParam(1, $_POST['username']);
                    $stmt->execute();
                    //$stmt->store_result();

                    // fetch the record
                    $num = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    // check if that account exists
                    if (is_array($num)) {
                        // compare the entered password to that password record
                        // change to password verify for hashed passwords
                        if (password_verify($_POST['password'], $num['password'])) {
                            // passwords match
                           // echo"working";
                            session_regenerate_id();
                            $_SESSION['valid_user'] = TRUE;
                            $session = $_SESSION['user_id'] = $num['USER_ID'];
                            echo json_encode(array("status" => "login","cookie"=>$session));
                           //echo json_encode(array("cookie"=> $_SESSION['valid_user']));
                          
                           //  header("Location: Index.php");
                            
                        } else {
                            // passwords don't match
                            //echo "Incorrect details..."; echo "<br>"; 
                            echo json_encode(array("status" => "fail"));
                        }
                    } else {
                        // no entries
                        //echo "Incorrect details"; echo "<br>";
                        echo json_encode(array("status" => "fail"));

                    }

                   // $stmt->close();
                    
                }
        }


    }

    session_start();
    setupConnection();
    //echo "yes";
    checkAccount();
    //echo "yes";
?>