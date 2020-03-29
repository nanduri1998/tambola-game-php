<?php
include('dbconnect.php');
$game_id = $_REQUEST['id'];
$number = rand(1,90);
$check_num_exists = check_number_exists($con, $number, $game_id);
if($check_num_exists == false){
    echo "recall";
}
else{
$insert = mysqli_query($con, "INSERT INTO caller(number, game_id) VALUES ('".$number."', '".$game_id."')");
if($insert){
echo $number;
}
else{
    echo "Error";
}
}
function check_number_exists($con, $number, $game_id){
    // echo "exec1\n";
    $sqp_num = mysqli_query($con, "SELECT number FROM caller WHERE game_id = '".$game_id."' AND number = '".$number."'");
    if(mysqli_num_rows($sqp_num) != 0){
        return false;
        // echo "false1\n";
    }
    else{
        return true;
        // echo "true1\n";
    }
}