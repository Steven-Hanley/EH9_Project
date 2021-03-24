<?php

    session_start();
    require_once 'connection.php';
    $response = array();
    
    if(isset($_GET['apicall'])) {

        switch($_GET['apicall']) {
           
            case 'login';           
            $username = $POST['username'];
            $password = password_hash($POST['password']);
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
            case 'signup':
                break;
        default:
                $response['error'] = true;
                $response['message'] = 'Invalid Operation';
        }
    } else {
        $response['error'] = true;
        $response['message'] = 'Invalid API Call';
    }


?>