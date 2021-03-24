<!DOCTYPE html>
<html>
<?php
    session_start();

    if (!isset($_SESSION['valid_user'])) {
        //header('Location: login.php');
        //exit;
    }
?>
<head> Password Check</head>
    <body>
        <form action="main.php" id= "form1" method = "post">
            <label for="password"> Password: </label>
            <input type="text" name="password" id="password" required><br>
            <input type = "submit" name="submit">
        </form>
    </body>
</html>


