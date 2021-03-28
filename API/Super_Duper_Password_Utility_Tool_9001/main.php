<html>
    <body>
        <?php
            session_start();



            include 'Password_Strength.php';
			include 'dictionary.php';
			include 'Password_Reuse.php';
			
            $userpassword = $_POST['password'];

            if (isset($_SESSION['user_id'])) {
				$id = $_SESSION['user_id'];
            }

             

			if (isset($_SESSION['valid_user'])) {
				passwordReuse($id, $userpassword);
            }

            PasswordCheck($userpassword);
			
			
            checkDict($userpassword);
			
			
			echo "*$lengthScore*";
			echo "-$userpassword-,<br>";  
                      
        ?>
    </body>
</html> 


