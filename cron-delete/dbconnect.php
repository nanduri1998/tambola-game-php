<?php

$servername = "YOUR_HOST";

$username = "DB_USERNAME";

$password = "DB_PASSWORD";

$dbname = "DB_NAME";



// Create connection

$con = new mysqli($servername, $username, $password, $dbname);

// Check connection

if ($con->connect_error) {

    die("Connection failed: " . $con->connect_error);

} 

?>