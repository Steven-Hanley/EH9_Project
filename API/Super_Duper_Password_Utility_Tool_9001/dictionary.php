
<?php
    function checkDict($password){
        $exactMatch = searchDict($password);
        if($exactMatch != -1){
            $exactMatch = true;
        }else{
            $exactMatch = false;
        }

        $wordsinDict = dictionaryCheck($password);
        $results = array(
            'exactMatch' => $exactMatch,
            'wordsInDict' => $wordsinDict
        );
        return $results;
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

    function dictionaryCheck($password) {
        $file = file_get_contents("100k-most-used-passwords-NCSC.txt");
        $password2 = preg_replace("/[^a-zA-Z]/", "", $password);
        $pos = stristr($file, $password2);

        if ($pos === false) {
            return false;
        } else {
           return true;
        }                                                    
    }
?>
