<!DOCTYPE html>

<html>

    <title>Api Prototype</title>
   
    <body>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">                    <!--User inputs password into the form-->
        Input Password: <input type="text" name ="testPassword">
        <input type="submit">
        </form>

        <?php
                $userPassword = $_POST['testPassword'];                                    

                $Score1 = -1;
                $Score2 = 1;
                $Score3 = 2;
                $Score4 = 4;
				$Score5 = 6;
				
                $lengthScore = 0;
                $numericScore = 0;
                $complexScore = 0;
                $capitalScore = 0;
                $lowerScore = 0;              
				
            if ($_SERVER["REQUEST_METHOD"] == "POST") { 
                
                function length($userPassword, $lengthScore, $Score1, $Score2, $Score3, $Score4, $Score5) { 
                    if (strlen($userPassword)) {
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
                    echo "Length Score: $lengthScore,\r\n ";
                };
    
                function capitals($userPassword, $capitalScore, $Score1, $Score2, $Score3, $Score4, $Score5) {
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
                    echo "Capital Score: $capitalScore, ";
                };
				
                function lower($userPassword, $lowerScore, $Score1, $Score2, $Score3, $Score4, $Score5) {
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
                    echo "Lower Score: $lowerScore, ";
                };
				
                function numbers($userPassword, $numericScore, $Score1, $Score2, $Score3, $Score4, $Score5) {
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
                    echo "Numeric Score: $numericScore, ";
                };

                function complexity($userPassword, $complexScore, $Score1, $Score2, $Score3, $Score4, $Score5) {
                    if (preg_match_all('/[\'()^&$%£*!}{#@~?><>,|=_+¬-]/', $userPassword)) {   

                        if (!preg_match_all('/[\'()^&$%£*!}{#@~?><>,|=_+¬-]/', $userPassword)) {    
                            
                            $complexScore = Score1;
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
                    echo "Complex Score: $complexScore, ";
                };
              
                length($userPassword, $lengthScore, $Score1, $Score2, $Score3, $Score4, $Score5);
                capitals($userPassword, $capitalScore, $Score1, $Score2, $Score3, $Score4, $Score5);
				lower($userPassword, $lowerScore, $Score1, $Score2, $Score3, $Score4, $Score5);
                numbers($userPassword, $numericScore, $Score1, $Score2, $Score3, $Score4, $Score5);
                complexity($userPassword, $complexScore, $Score1, $Score2, $Score3, $Score4, $Score5);     
			
            }       
        ?>

    </body>

</html>
