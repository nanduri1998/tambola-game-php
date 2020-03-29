<?php
$servername = "192.168.64.145";
$username = "innovationcenter";
$password = "innovation123$$";
$dbname = "innovationcenter_tambola";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
?>