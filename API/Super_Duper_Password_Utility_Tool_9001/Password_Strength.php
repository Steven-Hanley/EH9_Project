<!DOCTYPE html>

<html>

    <title>Api Prototype</title>
   
    <body>
		<!-- Legacy form for testing purposes-->
		<!--
        <form method="post" action=" echo $_SERVER['PHP_SELF'];">                    
        Input Password: <input type="text" name ="testPassword">
        <input type="submit">
        </form>
		-->
		
        <?php
			//Initialise global variables
			$lengthScore = 0;
			$numericScore = 0;
			$complexScore = 0;
			$capitalScore = 0;
			$lowerScore = 0;    
			$repeatingScore = 0;
			$consecutiveScore = 0;
				
            if ($_SERVER["REQUEST_METHOD"] == "POST") { 
                //This function Scores the length of the user password
                function length($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5) { 
					//Import score
                    GLOBAL $lengthScore;
					if (strlen($userPassword)) {
						//check password ageainst criteria
                        if (strlen($userPassword) <= 7) {

                            $lengthScore += $Score1;  
                        }  
                        else if (strlen($userPassword) >= 8 && strlen($userPassword) <=10) {

                            $lengthScore += $Score2;    
                        }
						else if (strlen($userPassword) >= 11 && strlen($userPassword) <=14) {

                            $lengthScore += $Score3;    
                        }
						else if (strlen($userPassword) >= 15 && strlen($userPassword) <=19) {

                            $lengthScore += $Score4;    
                        }
                        else if (strlen($userPassword) >= 20)  {
                        
                            $lengthScore += $Score5;
                        }                           
                     }  
					//output Score
                    echo "Length Score: $lengthScore,\r\n <br>";
                };
				//This function Scores the number of capitals in the user password
                function capitals($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5) {
                    GLOBAL $capitalScore;
					if (preg_match('/[A-Z]/', $userPassword)) {
                        if (!preg_match_all('/[A-Z]/', $userPassword)) {

                            $capitalScore = $Score1;                            
                        }  
                        else if (preg_match_all('/[A-Z]/', $userPassword) == 1) {

                            $capitalScore += $Score2;
                        }  
                        else if (preg_match_all('/[A-Z]/', $userPassword) >= 2 && preg_match_all('/[A-Z]/', $userPassword) <= 3) {

                            $capitalScore += $Score3;
                        }    
						else if (preg_match_all('/[A-Z]/', $userPassword) >= 4 && preg_match_all('/[A-Z]/', $userPassword) <= 5) {

                            $capitalScore += $Score4;
                        }   
                        else if (preg_match_all('/[A-Z]/', $userPassword) >= 6) {

                            $capitalScore += $Score5;

                        }   
                    }  
                    echo "Capital Score: $capitalScore, <br>";
                };
				//This function Scores the number of lower case letters in the user password
                function lower($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5) {
                    GLOBAL $lowerScore;
					if (preg_match('/[A-Z]/', $userPassword)) {
                        if (preg_match_all('/[a-z]/', $userPassword) <= 3) {

                            $capitalScore = $Score1;                            
                        }  
                        else if (preg_match_all('/[a-z]/', $userPassword) >= 4 && preg_match_all('/[a-z]/', $userPassword) == 6) {

							$capitalScore = $Score2;                            
						}
                        else if (preg_match_all('/[a-z]/', $userPassword) >= 7 && preg_match_all('/[a-z]/', $userPassword) <= 9) {

                            $capitalScore = $Score3;    
                        }   
                        else if (preg_match_all('/[a-z]/', $userPassword) >= 10 && preg_match_all('/[a-z]/', $userPassword) <= 14) {

                            $capitalScore = $Score4;    
                        }   						
                        else if (preg_match_all('/[a-z]/', $userPassword) >= 15) {

                            $capitalScore = $Score5;    
                        }   
                    }  
                    echo "Lower Score: $lowerScore, <br>";
                };
				//This function Scores the number of numbers in the user password
                function numbers($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5) {
                    GLOBAL $numericScore;
					if (preg_match('/[0-9]/', $userPassword)) {
                        if (preg_match_all('/[0-9]/', $userPassword) <= 2) {

                            $numericScore = $Score1;
                        }
						else if (preg_match_all('/[0-9]/', $userPassword) == 3) {

                            $numericScore += $Score2;
                        } 
                        else if (preg_match_all('/[0-9]/', $userPassword) >= 4 && preg_match_all('/[0-9]/', $userPassword) <= 5) {

                            $numericScore += $Score3;
                        } 
						else if (preg_match_all('/[0-9]/', $userPassword) >= 6 && preg_match_all('/[0-9]/', $userPassword) <= 7) {

                            $numericScore += $Score4;
                        } 
                        else if (preg_match_all('/[0-9]/', $userPassword) >= 8) {

                            $numericScore += $Score5;
                        }                             
                    }  
                    echo "Numeric Score: $numericScore, <br>";
                };
				//This function Scores the complexity of the user password
                function complexity($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5) {
                    GLOBAL $complexScore;
					if (preg_match_all('/[\'()^&$%£*!}{#@~?><>,|=_+¬-]/', $userPassword)) {   

                        if (!preg_match_all('/[\'()^&$%£*!}{#@~?><>,|=_+¬-]/', $userPassword)) {    
                            
                            $complexScore = $Score1;
                        }
                        else if (preg_match_all('/[\'()^&$%£*!}{#@~?><>,|=_+¬-]/', $userPassword) == 1) {    
                            
                            $complexScore += $Score2;
                        }
                        else if (preg_match_all('/[\'()^&$%£*!}{#@~?><>,|=_+¬-]/', $userPassword) == 2) {    
                            
                            $complexScore += $Score3;
                        }
                        else if (preg_match_all('/[\'()^&$%£*!}{#@~?><>,|=_+¬-]/', $userPassword) == 3) {    
                            
                            $complexScore += $Score4;
                        }   
						else if (preg_match_all('/[\'()^&$%£*!}{#@~?><>,|=_+¬-]/', $userPassword) >= 4) {    
                            
                            $complexScore += $Score5;
                        }   
                    } 
                    echo "Complex Score: $complexScore, <br>";
                };
              //This function Scores the number of repeating charaters in the user password
				function repeating($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5){
					GLOBAL $repeatingScore;
					$count = 0;
					
					for($i = 0; $i < strlen($userPassword); $i++){
						for ($l = ($i + 1); $l < strlen($userPassword); $l++){
							
							if($userPassword[$i] == $userPassword[$l]){
								$count += 1;
								//echo "1";
								break;
							}
						}
					}
					if($count > 4){
					
						$repeatingScore += $Score1;
					}
					
					else if($count == 4){
					
						$repeatingScore += $Score2;
					}
					else if($count == 3){
					
						$repeatingScore += $Score3;
					}
					else if($count == 2){
					
						$repeatingScore += $Score4;
					}
					else if($count < 2){
					
						$repeatingScore += $Score5;
					}
					
					echo "Repeating Score: $repeatingScore From $count, <br>";
				}
				//This function Scores the number of consecutive charagets in the user password
				function consecutive($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5){
					GLOBAL $consecutiveScore;
					$file = file("Pattern.txt");
					$items = count($file); 
  
					foreach($file as $i ){
						$i = preg_replace("/\r|\n/", "", $i);
						//echo $i . "-<br>";
						
						if(stristr($userPassword, $i) !=false){
							$consecutiveScore += 1;;
						}
					}
					echo "Consecutive Score: $consecutiveScore<br> ";
					echo "-$userPassword-,";
				}
				
				//Main function that calls all functuins above
				function PasswordCheck($userPassword){                              
					//initialise variables
					$Score1 = -1;
					$Score2 = 1;
					$Score3 = 2;
					$Score4 = 4;
					$Score5 = 6;
				

					//call functions
					length($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5);
					capitals($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5);
					lower($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5);
					numbers($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5);
					complexity($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5);     
					repeating($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5);
					consecutive($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5);
				}
            }       
        ?>

    </body>

</html>