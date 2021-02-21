<?php
    
    // accepts an a record id to search the db

    ini_set('error_reporting', E_ALL);

    // set necessary HTTP header info
    header("Access-Control-Allow-Origin: *");
    header("Acess-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    // files for connecting to db and data return
    // linux system on Mayar so use '/' not '\'
    // CHANGE ME:
    include_once '../config/db.php';
    include_once '../objects/example.php';

    // configuration will handle db connection
    $database = new Configuration();
    $db = $database->getConnection();

    // pass in db and create new data object
    $data = new Data($db);

    // get parameter
    $data->id = isset($_GET['id']) ? $_GET['id'] : die();

    // query the db for one specific info ['id']
    $data->queryOneData();

    // check if the password is null for that record
    if ($data->password != null) {

        // create a container to output in JSON
        $data_arr = array (
            // CHANGE ME: (depending on columns)
            "id" => $data->id,
            "password" => $data->password
            // "id" => $data->id,
            // "firstname" => $data->firstname,
            // "surname" => $data->surname,
            // "age" => $data->age
        );

        // everything is ok - 200
        http_response_code(200);

        // encode output 
        echo json_encode($data_arr);

    } else {

        // not found - 404 response code
        http_response_code(404);
        
        // error message
        echo json_encode (
            array("message" => "No items found.")
        );
    }
?>