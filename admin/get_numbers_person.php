<?php
include('dbconnect.php');
$ticket_id = $_REQUEST['ticket_id'];
$row = $_REQUEST['row'];
$numbers = array();
switch($row){
    case 0:
        $query = "SELECT * FROM ticket WHERE ticket_id = '".$ticket_id."'";
        break;
    case 1:
        $query = "SELECT * FROM ticket WHERE ticket_id = '".$ticket_id."' AND row = '1'";
        break;
    case 2:
        $query = "SELECT * FROM ticket WHERE ticket_id = '".$ticket_id."' AND row = '2'";
        break;
    case 3:
        $query = "SELECT * FROM ticket WHERE ticket_id = '".$ticket_id."' AND row = '3'";
        break;
    case 4:
        $query = "SELECT * FROM ticket WHERE ticket_id = '".$ticket_id."'";
        break;
}
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result)){
    $numbers[] = array("number" => $row['number']);
}
echo json_encode($numbers);