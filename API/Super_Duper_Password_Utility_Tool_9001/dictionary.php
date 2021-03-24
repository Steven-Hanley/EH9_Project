<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>API Dictionary Prototype</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="cover.css" rel="stylesheet">
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="">
</head>
<!--
<body>
    <div>
        <form id='dictionary' method='post'>
            <label for="password">Enter Password:</label>
            <input type='text' name='password' id='password'>
            <button type='submit' class="btn btn-outline-secondary" value='Submit' name='dictionaryCheck'>Submit</button>
        </form>
        <?php// checkDict()?>
    </div>
</body>
-->
<?php

    function checkDict(){
		//echo "yes";
	    //if(isset($_POST['dictionaryCheck'])){
            $start = microtime(true);
		    $password = ($_POST['password']);
            $found = searchDict($password);

            $timeTaken = microtime(true) - $start;
            if($found != -1){
                echo "Password found in wordlist in $timeTaken secs <br>";
            }else{
                echo "Password not found in wordlist in $timeTaken secs <br>";
            }
	    //}	
    }

    function searchDict($password){
        $file = file_get_contents("100k-most-used-passwords-NCSC.txt");
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
            if(array_key_exists($text[$i], $table))  {

                $i = $i + max($table[$text[$i]], 1);
            }
            else{
                $i += $patlen;
            }
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        function dictionaryCheck() {

            $file = file_get_contents("100k-most-used-passwords-NCSC.txt");
            
            if(isset($_POST['dictionaryCheck'])){
                $password = ($_POST['password']);
                $password2 = preg_replace("/[^a-zA-Z]/", "", $password);
                $pos = stristr($file, $password2);

                if ($pos === false) {
                    echo "The dictionary word '$password2' was not found";
                } else {
                    echo "The dictionary word '$password2' was found ";
                    
                }                
                   
            }	                                         
        }
    }

    

    dictionaryCheck();




?>

</html>