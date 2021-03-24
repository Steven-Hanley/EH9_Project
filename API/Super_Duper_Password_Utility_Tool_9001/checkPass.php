<!DOCTYPE html>

<head> Password check</head>
<body>
<form method = "post">

<label for="password"> Password: </label>
<input type="text" name="password" id="password"><br>
<input type = "submit" name="submit">

</form>

</body>
</html>

<?php 
//Error Reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
		
$password = $_POST['password'];//user password
$hash = password_hash($password, PASSWORD_DEFAULT);//hash of user password
$target_password = 'password';
$target_hash = password_hash($target_password, PASSWORD_DEFAULT);

$test = file('test.txt');//contents of test.txt into an array.
$test = preg_replace("/\r|\n/" , "",$test);//Solves an error of adding a space to the end of a line for each hash
$length = count($test);//length of the array. i.e. number of hashes in the text file.

for($i=0;$i < $length;$i++)
{
if(password_verify($password,$test[$i]))//Checking password against hash values in test.txt
{
	echo "Password found";
	echo $test[$i];
	echo nl2br("\n");
}
else
{
	echo "password not found";
	echo $test[$i];
	echo nl2br("\n");
}

}
?>
