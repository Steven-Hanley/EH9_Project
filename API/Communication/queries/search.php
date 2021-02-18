<?php       

    // searches the db for the supplied password

    // set necessary http headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // files for connecting to db and data return
    // linux system on Mayar so use '/' not '\'
    // CHANGE ME:
    include_once '../config/db.php';
    include_once '../objects/example.php';

    // create instance of configuration class and set up connection
    $database = new Configuration();
    $db = $database->getConnection();

    // create instance of the data class
    $data = new Data($db);

    // set keyword parameter
    $keywords=isset($_GET['password']) ? $_GET['password'] : die();

    // if condition of GET method 

    // pass in keywords parameter and search for it
    $stmt = $data->searchPassword($keywords);

    // returns an integer for results returned
    $num = $stmt->rowCount();

    if ($num > 0) {

        // container used to hold data
        $data_arr = array();

        // CHANGE ME: (records)
        $data_arr["records"] = array();

        // fetch the records
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

            // put the items into container
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
        echo json_encode(
            array("message" => "No items found.")
        );
    }
?>