<?php
include('dbconnect.php');
$player_name = $_POST['player_name'];
$game_id = $_POST['game_id'];
$ticket_id = uniqid('TB');
$otp = rand('1111', '9999');

$sql_player = "INSERT INTO player(player_name, game_id, ticket_id, otp) VALUES ('".$player_name."', '".$game_id."', '".$ticket_id."', ".$otp.")";
if(!mysqli_query($con, $sql_player)){
    die("Error".mysqli_error($con));
}


for($max_numbers = 0; $max_numbers < 15; $max_numbers++){
    $row = rand(1, 3);
    $col = rand(1, 9);
    $check_rowcol_exists = check_rowcol_exists($con, $row, $col, $ticket_id);
    if($check_rowcol_exists == false){
        $max_numbers--;
        continue;
    }
    switch($col){
        case 1:
            $number = rand(1,10);
            break;
        case 2:
            $number = rand(11, 20);
            break;
        case 3:
            $number = rand(21,30);
            break;
        case 4:
            $number = rand(31,40);
            break;
        case 5:
            $number = rand(41,50);
            break;
        case 6:
            $number = rand(51,60);
            break;
        case 7:
            $number = rand(61,70);
            break;
        case 8:
            $number = rand(71,80);
            break;
        case 9:
            $number = rand(81,90);
            break;
    }
    $check_num_exists = check_number_exists($con, $row, $col, $number, $ticket_id);
    if($check_num_exists == false){
        $max_numbers--;
        continue;
    }
    $insert = mysqli_query($con, "INSERT INTO ticket(game_id, row, col, number, ticket_id) VALUES ('".$game_id."', '".$row."', '".$col."', '".$number."', '".$ticket_id."')");
    if(!$insert){
        die('Error'.mysqli_error($con));
    }
}
function check_rowcol_exists($con, $row, $col, $ticket_id){
    // echo "exec\n";
    $sqp_rowcol = mysqli_query($con, "SELECT row, col FROM ticket WHERE ticket_id = '".$ticket_id."' AND row = '".$row."' AND col = '".$col."'");
    if(mysqli_num_rows($sqp_rowcol) != 0){
        return false;
        // echo "false\n";
    }
    else{
        return true;
        // echo "true\n";
    }
}

function check_number_exists($con, $row, $col, $number, $ticket_id){
    // echo "exec1\n";
    $sqp_num = mysqli_query($con, "SELECT row, col, number FROM ticket WHERE ticket_id = '".$ticket_id."' AND number = '".$number."'");
    if(mysqli_num_rows($sqp_num) != 0){
        return false;
        // echo "false1\n";
    }
    else{
        return true;
        // echo "true1\n";
    }
}

 echo "<script>alert('OTP is $otp'); window.location.href='game.php?id=$game_id'</script>";

