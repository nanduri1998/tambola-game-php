<?php 
include('dbconnect.php');
$game_id=$_REQUEST['game_id'];
$number = $_REQUEST['number'];
$sql = mysqli_query($con, "SELECT * FROM caller WHERE game_id='".$game_id."' AND number = '".$number."'");
if(mysqli_num_rows($sql) == 0){
    echo "fail";
}
else{
    echo "success";
}