<?php
include('../dbconnect.php');
$game_id = $_REQUEST['game_id'];
$game = mysqli_query($con, "DELETE FROM game WHERE id = $game_id");
$player = mysqli_query($con, "DELETE FROM player WHERE game_id = '".$game_id."'");
$ticket = mysqli_query($con, "DELETE FROM ticket WHERE game_id = '".$game_id."'");
$caller = mysqli_query($con, "DELETE FROM caller WHERE game_id = '".$game_id."'");

if(!$game || !$player || !$ticket || !$caller){
    die("Error");
}
echo "<script>alert('Game Deleted'); window.location.href='../index.php';</script>";
?>