<?php
include('dbconnect.php');
$game_name = $_POST['game_name'];
$tickets = $_POST['tickets'];

$sql = "INSERT INTO game(game_name, number_of_tickets, status) VALUES ('".$game_name."', ".$tickets.", 'Active')";
if(!mysqli_query($con, $sql)){
    die('Error'.mysqli_error($con));
}
else{
    $id = mysqli_insert_id($con);
    echo "<script>alert('Game Created'); window.location.href='game.php?id=".$id."';</script>";
}