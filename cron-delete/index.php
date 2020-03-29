<?php
include('dbconnect.php');

$caller_delete = mysqli_query($con,"TRUNCATE caller");
$game_delete = mysqli_query($con,"TRUNCATE game");
$player_delete = mysqli_query($con,"TRUNCATE player");
$ticket_delete = mysqli_query($con,"TRUNCATE ticket");

if(!$caller_delete || !$game_delete || !$player_delete || !$ticket_delete){
    die("Error".mysqli_error($con));
}
$myfile = fopen("log.txt", "w");
$txt = date("d-m-Y H:i:s");
fwrite($myfile, $txt);
fclose($myfile);
?>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/5.11.1/firebase.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    //YOUR FIREBASE CONFIG HERE
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
</script>
<script>
var database = firebase.database();
database.ref('games').set(null)
</script>