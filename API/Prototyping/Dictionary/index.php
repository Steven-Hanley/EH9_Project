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

            //take current time for the starting position
            $start = microtime(true);

		    $password = ($_POST['password']);

            $found = searchDict($password);

            //gets time taken by subtracting current time from start time
            $timeTaken = microtime(true) - $start;


            if($found != -1){
                echo "password found in wordlist in $timeTaken secs";
            }else{
                echo "password not found in wordlist in $timeTaken secs";
            }
	    }	
    }

    function searchDict($password){
        //file = gets file contents of the rockyou.txt
        $file = file_get_contents("rockyou.txt");

        //begins boyermoore function
        $found = BoyerMoore($file, $password);

        //returns found variable
        return $found;
    }

    function BoyerMoore($text, $pattern) {
        //gets the length of the pattern you are trying to find
        $patlen = strlen($pattern);
        //gets the total string length of rock you
        $textlen = strlen($text);
        //runs the make character table function
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