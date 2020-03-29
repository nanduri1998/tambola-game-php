<?php
include('dbconnect.php');
$game_id = $_REQUEST['game_id'];
$numbers = array();
$query = "SELECT * FROM caller WHERE game_id = '".$game_id."'";
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result)){
    $numbers[] = array("number" => $row['number']);
}
echo json_encode($numbers);