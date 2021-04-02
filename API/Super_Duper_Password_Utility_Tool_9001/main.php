
        <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Max-Age: 3600");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

            require 'Password_Strength.php';
			require 'dictionary.php';
			require 'Password_Reuse.php';
			
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if(isset($_POST['password'])){
                    $userpassword = $_POST['password'];

                    if (isset($_POST['user_id'])) {
                        $id = $_POST['user_id'];
                        if($id != 0){
                            $usedPassword = passwordReuse($id, $userpassword);
                        }
                    }
    
                    $scores = PasswordCheck($userpassword);
                    $found = checkDict($userpassword);
    
                   // echo $userpassword;


                    if (isset($usedPassword)){
                        $response = array(
                            'scores' => array(
                                    'lengthScore' => $scores['lengthScore'],
                                    'capitalScore' => $scores['capitalScore'],
                                    'lowerScore' => $scores['lowerScore'],
                                    'numericScore' => $scores['numericScore'],
                                    'complexScore' => $scores['complexScore'],
                                    'repeatingScore' => $scores['repeatingScore'],
                                    'consecutiveScore' => $scores['consecutiveScore'],
                            ),
                            'dict' => array(
                                'exactMatch' => $found['exactMatch'],
                                'wordsInDict' => $found['wordsInDict']
                            ),
                            'usedBefore' => $usedPassword
                        );
                        $post_data = json_encode($response);
                        echo $post_data;
                    }else{
                        $response = array(
                            'scores' => array(
                                    'lengthScore' => $scores['lengthScore'],
                                    'capitalScore' => $scores['capitalScore'],
                                    'lowerScore' => $scores['lowerScore'],
                                    'numericScore' => $scores['numericScore'],
                                    'complexScore' => $scores['complexScore'],
                                    'repeatingScore' => $scores['repeatingScore'],
                                    'consecutiveScore' => $scores['consecutiveScore'],
                            ),
                            'dict' => array(
                                'exactMatch' => $found['exactMatch'],
                                'wordsInDict' => $found['wordsInDict']
                            )
                        );
                        $post_data = json_encode($response);
                        echo $post_data;
                    }

                    
                }else{
                    $response = array(
                        'message' => 'No Password Entered'
                    );
                    echo json_encode($response);
                }
                
            }else{
                $response = array(
                    'message' => 'Inavlid Request'
                );
                echo json_encode($response);
            }
            
            
                      
        ?>



