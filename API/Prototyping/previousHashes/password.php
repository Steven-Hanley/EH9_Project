<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>API Dictionary Prototype</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body>
    <div>
        <form id='dictionary' method='post'>
            <label for="password">Enter Password</label>
            <input type='text' name='password' id='password'>
            <input type='submit' value='submit' name='hash'>
        </form>
        <?php checkHash()?>
    </div>
</body>

<?php
        function checkHash(){
            if(isset($_POST['hash'])){
                $password = $_POST['password'];
                $hash = password_hash($password, PASSWORD_BCRYPT);

                echo $hash; 
                
                $hashes = file('hashes.txt');
                $length = count($hashes);

                echo "there are $length lines in file searching now<br>";

                $hashes = preg_replace("/\r|\n/", "", $hashes);

                for ($i=0;$i < $length; $i++){

                    echo "<br>searching line $i of file <br>";
                    echo "hash = |$hashes[$i]| <br>";

                    if(password_verify($password, $hashes[$i])){
                        echo 'password matches';
                    }else{
                        echo 'password doesnt match';
                    }
                }
            }
        }


?>

</html>