
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$userusername = $_POST['username'];
$userpassword = $_POST['password'];
//print_r($_POST);

$servername="***REMOVED***";
$username="***REMOVED***";
$dbpassword="***REMOVED***";
$dbname="***REMOVED***";


//create connection to database.
$conn = mysqli_connect($servername,$username,$dbpassword,$dbname);


//check connection
if(!$conn)
{
die("connection failed: " . mysqli_connect_error());
}
else
{
//echo "Connection complete";
}
session_start();

//echo "username= $userusername";
//echo "password= $userpassword";

 if (!isset($_POST['username'], $_POST['password'])) 
        {
           exit("You know the rules and so do I!");
        } 
        else 
        {
            if($stmt = $conn->prepare('SELECT username, password FROM Accounts where username = ?'))
            {
              
                $stmt->bind_param('s',$userusername);
                $stmt->execute();
                $stmt->store_result();
                    if($stmt->num_rows > 0 )
                    {
                        
                        $stmt -> bind_result($id,$password);
                        $stmt ->fetch();

                        if(password_verify($userpassword,$password)){
                           $result= json_encode(array("status" => "login"));
                            echo $result;

                        }
                        else{
                           //echo "ERROR";
                           //$response =['status' => "fail"];
                             echo json_encode(array("status" => "fail"));
                        }
                    }else{

                        //$data="ERROR";
                        //echo $data;
                         echo json_encode(array("status" => 'fail'));
                    }

                $stmt->close();
            }
            

        }


    


?>