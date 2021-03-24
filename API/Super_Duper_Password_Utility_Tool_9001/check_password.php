<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once 'db.php';
    include_once 'methods.php';

    $database = new Configuration();
    $db = $database->getConnection();

    $data = new Data($db);

    $postBody = json_decode(file_get_contents("php://input"));

    if(!empty($postBody->userID) && !empty($postBody->password)){

        $data->userID = $postBody->userID;

        // not necessary
        $data->password = $postBody->password;

        $stmt = $data->checkPasswordData();

        $num = $stmt->fetch(PDO::FETCH_ASSOC);

        if (is_array($num)) {
            if (password_verify($data->password, $num['password'])) {
                http_response_code(200);

                echo json_encode(array(
                    "message" => "Found."
                ));
            } else {
                http_response_code(404);

                echo json_encode(array(
                    "message" =>  "Not found."
                ));
            }

        } else {

            http_response_code(404);

            echo json_encode(array(
                "message" =>  "No entries."
            ));
        }

    } else {

        http_response_code(400);
    
        echo json_encode(array(
            "message" => "Oops"
        ));
    }
?>