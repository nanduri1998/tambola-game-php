<?php
$servername = "tambola-game-heroku.cgzeeefjondj.us-east-1.rds.amazonaws.com";
$username = "root";
$password = "KF6QuSYdsDc70n0tgYjD";
$dbname = "tambola";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
?>