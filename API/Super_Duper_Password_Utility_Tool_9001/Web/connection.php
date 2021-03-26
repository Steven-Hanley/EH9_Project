<?php 
    $host = "***REMOVED***";
    $dbase = "***REMOVED***";
    $username = "***REMOVED***";
    $passwd = "***REMOVED***";
    
    // Create connection
    $conn = mysql_connect($host, $username, $passwd, $dbase);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        echo "Connected.";
    } 
?>