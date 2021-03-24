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
        $data->password = $postBody->password;

        if ($data->insertPasswordData()) {
            http_response_code(201);

            echo json_encode(array(
                "message" => "Password was created."
            ));

        } else {
            http_response_code(503);

            echo json_encode(array(
                "message" => "Password was not created."
            ));
        }

    } else {

        http_response_code(400);
    
        echo json_encode(array(
            "message" => "Insufficient information."
        ));
    }




?>