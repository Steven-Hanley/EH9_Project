<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    function retrieveUser($username){

        $connection = mysqli_connect("***REMOVED***","***REMOVED***","***REMOVED***", "***REMOVED***");
        $stmt = $connection->prepare("SELECT * FROM Accounts WHERE username = ?");
		$stmt->bind_param("s", $username);
		$stmt->execute();
        $result = $stmt->get_result();
        
        if ($stmt->affected_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $user = array(
                    'user_id' => $row["USER_ID"],
                    'username' => $row["username"],
                    'password' => $row["password"]
                );
                return $user;
            }
        } else {
            $user = array(
                'user_id' => null,
                'username'=> null,
                'password' => null
            );
            return $user;
        }          
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['username'])){
            $username = $_POST['username'];
            $response = retrieveUser($username);
            echo json_encode($response);
        } else {
            $response = array(
                'message' => 'Inavlid Request'
            );
            echo json_encode($response);
        } 
    }else{
        $response = array(
            'message' => 'Inavlid Request'
        );
        echo json_encode($response);
    }