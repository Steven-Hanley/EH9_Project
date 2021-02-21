<?php
    echo "Hello";
    // fetches all records

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // set necessary HTTP header info
    header("Access-Control-Allow_Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

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

    // query the db
    $stmt = $data->queryData();

    // count the rows returned from stmt
    $num = $stmt->rowCount();

    echo $num;

    // check if a record has been returned
    if ($num > 0) {
        
        // data array
        $data_arr = array();
        $data_arr["records"] = array();

        // fetches the records
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $items = array (
                // CHANGE ME: (depending on columns)
                "id" => $id,
                "password" => $password
                // "id" => $id,
                // "firstname" => $firstname,
                // "surname" => $surname,
                // "age" => $age
            );

            // put the items in container
            array_push($data_arr["records"], $items);
        }

        // everything is ok - 200 response code
        http_response_code(200);

        // encode in JSON format
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