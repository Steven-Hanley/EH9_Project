<?php 
    $host = "***REMOVED***";
    $dbase = "***REMOVED***";
    $username = "***REMOVED***";
    $passwd = "***REMOVED***";
    
    $conn = mysql_connect($host, $username, $passwd, $dbase);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        echo "Connected.";
    } 
?>