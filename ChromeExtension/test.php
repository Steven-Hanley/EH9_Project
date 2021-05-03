<?php

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



$stmt = mysqli_prepare($conn, "INSERT INTO chromeTesting  (password) VALUES (?)");	
mysqli_stmt_bind_param($stmt,"s", $userpassword);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo $userpassword;
echo json_encode(array(
    "message" => "Hi Tom."
));
//echo"Test1";
?>