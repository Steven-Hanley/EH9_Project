<?php

    session_start();
    require_once 'connection.php';
    $response = array();
    
    if(isset($_GET['callAPI'])) {

        switch($_GET['callAPI']) {
           
            case 'login';           
            $username = $POST['username'];
            $password = password_hash($POST['password'], PASSWORD_DEFAULT);
            //prepared statement
            $stmt = $con->prepare('SELECT id, username FROM Accounts WHERE username = ? AND password = ?');
            $stmt->bindParam(1, $_POST['username']);
            $stmt->execute();
            $stmt->store_result();


            if($stmt->num_rows > 0) {

                $stmt->bind_result($id, $username);
				$stmt->fetch();
                $user = array(
                    'id'=>$id,
                    'username'=>$username,
                );

                $response['error'] = false;
                $response['message'] = 'Login successful';
                $response['user'] = $user;
            } else {
                $response['error'] = false;
                $response['message'] = 'Invalid username or password';
            }
        break;
        default:
                $response['error'] = true;
                $response['message'] = 'Invalid ';
        }
    } else {
        $response['error'] = true;
        $response['message'] = 'Invalid API Call';
    }
?>