<?php
include('../dbconnect.php');
$ticket_id = $_REQUEST['ticket_id'];
$game_id = $_REQUEST['game_id'];

$player = mysqli_query($con, "DELETE FROM player WHERE ticket_id = '".$ticket_id."'");
$ticket = mysqli_query($con, "DELETE FROM ticket WHERE ticket_id = '".$ticket_id."'");

if(!$player || !$ticket){
    die("Error");
}
echo "<script>alert('Player Deleted'); window.location.href='../game.php?id=".$game_id."';</script>";
?>