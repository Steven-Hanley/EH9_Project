
        <?php
        
                //This function Scores the length of the user password
                function length($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5) { 
					//Import score
					//if (strlen($userPassword)) {
                        $lengthScore = 0;
						//check password ageainst criteria
                        if (strlen($userPassword) <= 7) {

                            $lengthScore = $Score1;  
                        }  
                        else if (strlen($userPassword) >= 8 && strlen($userPassword) <=10) {

                            $lengthScore = $Score2;    
                        }
						else if (strlen($userPassword) >= 11 && strlen($userPassword) <=14) {

                            $lengthScore = $Score3;    
                        }
						else if (strlen($userPassword) >= 15 && strlen($userPassword) <=19) {

                            $lengthScore = $Score4;    
                        }
                        else if (strlen($userPassword) >= 20)  {
                        
                            $lengthScore = $Score5;
                        }                           
                     //}  
					//output Score
                    return $lengthScore;
                };
				//This function Scores the number of capitals in the user password
                function capitals($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5) {
                    $capitalScore = 0;
					//if (preg_match('/[A-Z]/', $userPassword)) {
                        if (!preg_match_all('/[A-Z]/', $userPassword)) {

                            $capitalScore = $Score1;                            
                        }  
                        else if (preg_match_all('/[A-Z]/', $userPassword) == 1) {

                            $capitalScore = $Score2;
                        }  
                        else if (preg_match_all('/[A-Z]/', $userPassword) >= 2 && preg_match_all('/[A-Z]/', $userPassword) <= 3) {

                            $capitalScore = $Score3;
                        }    
						else if (preg_match_all('/[A-Z]/', $userPassword) >= 4 && preg_match_all('/[A-Z]/', $userPassword) <= 5) {

                            $capitalScore = $Score4;
                        }   
                        else if (preg_match_all('/[A-Z]/', $userPassword) >= 6) {

                            $capitalScore = $Score5;

                        }   
                    //}  
                    return $capitalScore;
                };
				//This function Scores the number of lower case letters in the user password
                function lower($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5) {
                    $lowerScore = 0;
					//if (preg_match('/[a-z]/', $userPassword)) {
                        if (preg_match_all('/[a-z]/', $userPassword) <= 3) {

                            $lowerScore = $Score1;                            
                        }  
                        else if (preg_match_all('/[a-z]/', $userPassword) >= 4 && preg_match_all('/[a-z]/', $userPassword) == 6) {

							$lowerScore = $Score2;                            
						}
                        else if (preg_match_all('/[a-z]/', $userPassword) >= 7 && preg_match_all('/[a-z]/', $userPassword) <= 9) {

                            $lowerScore = $Score3;    
                        }   
                        else if (preg_match_all('/[a-z]/', $userPassword) >= 10 && preg_match_all('/[a-z]/', $userPassword) <= 14) {

                            $lowerScore = $Score4;    
                        }   						
                        else if (preg_match_all('/[a-z]/', $userPassword) >= 15) {

                            $lowerScore = $Score5;    
                        }   
                    //}  
                    return $lowerScore;
                };
				//This function Scores the number of numbers in the user password
                function numbers($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5) {
                    $numericScore = 0;
					//if (preg_match('/[0-9]/', $userPassword)) {
                        if (preg_match_all('/[0-9]/', $userPassword) <= 2) {

                            $numericScore = $Score1;
                        }
						else if (preg_match_all('/[0-9]/', $userPassword) == 3) {

                            $numericScore = $Score2;
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
                    //}  
                    return $numericScore;
                };
				//This function Scores the complexity of the user password
                function complexity($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5) {
                    $complexScore = 0;
					/* if (preg_match_all('/[\'()^&$.%£*!}{#@~?><>,|=_+¬-]/', $userPassword)) {    */

                        if (preg_match_all('/[\'()^&$%£*!}{#@~?><>,|=_+¬-]/', $userPassword) == 0) {    
                            
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
                    //} 
                    return $complexScore;
                };
              //This function Scores the number of repeating charaters in the user password
				function repeating($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5){
					$repeatingScore = 0;
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
					
						$repeatingScore = $Score1;
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
					
					return $repeatingScore;
				}
				//This function Scores the number of consecutive charagets in the user password
				function consecutive($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5){
					$consecutiveScore = 0;
					$consecutiveNumber = 0;
					
					$file = file("Pattern.txt");
					$items = count($file); 
  
					foreach($file as $i ){
						$i = preg_replace("/\r|\n/", "", $i);
						//echo $i . "-<br>";
						if(stristr($userPassword, $i) !=false){
							$consecutiveNumber += 1;;
						}
					}
					$percentage = 100 / strlen($userPassword) * $consecutiveNumber;
					
					if($percentage < 40){
						$consecutiveScore = $Score5;
					}elseif($percentage > 40 && $percentage < 49){
						$consecutiveScore = $Score4;
					}elseif($percentage > 50 && $percentage < 59){
						$consecutiveScore = $Score3;
					}elseif($percentage > 60 && $percentage < 69){
						$consecutiveScore = $Score2;
					}elseif($percentage > 69){
						$consecutiveScore = $Score1;
					}
					return $consecutiveScore;
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
					$lengthScore = length($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5);
					$capitalScore = capitals($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5);
					$lowerScore = lower($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5);
					$numericScore = numbers($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5);
					$complexScore = complexity($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5);     
					$repeatingScore = repeating($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5);
					$consecutiveScore = consecutive($userPassword, $Score1, $Score2, $Score3, $Score4, $Score5);

                    $scores = array(
                        'lengthScore' => $lengthScore,
                        'capitalScore' => $capitalScore,
                        'lowerScore' => $lowerScore,
                        'numericScore' => $numericScore,
                        'complexScore' => $complexScore,
                        'repeatingScore' => $repeatingScore,
                        'consecutiveScore' => $consecutiveScore
                    );
                    return $scores;
				}
            
        ?>
