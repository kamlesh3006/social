<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "social";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        //echo "Connection Established.";
    }
?>