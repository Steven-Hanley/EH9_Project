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
            <input type='submit' value='submit' name='dictionaryCheck'>
        </form>
        <?php checkDict()?>
    </div>
</body>

<?php

    function checkDict(){
	    if(isset($_POST['dictionaryCheck'])){
            $start = microtime(true);
		    $password = ($_POST['password']);
            $found = searchDict($password);

            $timeTaken = microtime(true) - $start;
            if($found != -1){
                echo "password found in wordlist in $timeTaken secs";
            }else{
                echo "password not found in wordlist in $timeTaken secs";
            }
	    }	
    }

    function searchDict($password){
        $file = file_get_contents("rockyou.txt");
        $found = BoyerMoore($file, $password);
        return $found;
    }

function BoyerMoore($text, $pattern) {
    $patlen = strlen($pattern);
    $textlen = strlen($text);
    $table = makeCharTable($pattern);

    for ($i=$patlen-1; $i < $textlen;) { 
        $t = $i;
        for ($j=$patlen-1; $pattern[$j]==$text[$i]; $j--,$i--) { 
            if($j == 0) return $i;
        }
        $i = $t;
        if(array_key_exists($text[$i], $table))

            $i = $i + max($table[$text[$i]], 1);
            
        else
            $i += $patlen;
    }
    return -1;
}

function makeCharTable($string) {
    $len = strlen($string);
    $table = array();
    for ($i=0; $i < $len; $i++) { 
        $table[$string[$i]] = $len - $i - 1; 
    }
    return $table;
}


?>

</html>