<?php
include('dbconnect.php');
$game_id = $_REQUEST['id'];

$done = mysqli_query($con, "UPDATE game SET status = 'Done' WHERE id = $game_id");
echo "<script>alert('Thank You'); alert('Please declare all Winners'); window.location.href='index.php';</script>";