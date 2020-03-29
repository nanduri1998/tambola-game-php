<?php
include('header.php');
?>
<br>
<h3 class="text-center">Welcome to the Tambola Game</h3>
<?php
$req = 'no';
$otp = $_POST['otp'];
$req = $_POST['req'];
$get_player = mysqli_query($con, "SELECT * FROM player WHERE otp = $otp");
$player = mysqli_fetch_array($get_player);
if(mysqli_num_rows($get_player) < 1){
    die("<p class='text-center'>No Player Found</p>");
}
$ticket_id = $player['ticket_id'];
$player_name = $player['player_name'];
$game_id = $player['game_id'];
?>
<p class="text-center">You are Logged in as <?php echo $player_name; ?></p>
<p class="text-center">Ticket ID: <?php echo $ticket_id; ?></p>
<?php

    $arrange = array();
    for($i = 1; $i<=3; $i++){
        $arrange[$i] = array();
        for($j = 1; $j<=9; $j++){
            $arrange[$i][$j] = getNumber($i, $j, $con, $ticket_id);
        }
    }

    echo '<pre class=text-center>';
    $max = 0;
    foreach($arrange as $key=>$hor){
        foreach($hor as $k => $ver){
            echo is_null($ver) ? "<button disabled class='btn btn-warning text-white disabled'>*\t</button>\t" : "<button class='btn btn-info text-white' id='".$ver."' onclick='ajaxSelectNum(".$ver.",".$game_id.")'>".$ver."\t</button>\t";
            if($ver > $max){
                $max = $ver;
            }
        }
        echo "\n<br>";
    }
    echo '</pre>';
?>

<?php

function getNumber($i, $j, $con, $ticket_id){
    $get_num_sql = mysqli_query($con, "SELECT number FROM ticket WHERE ticket_id = '".$ticket_id."' AND row = '".$i."' AND col = '".$j."'");
    $num = mysqli_fetch_array($get_num_sql);
    if($num['number'] == null){
        return null;
    }
    else{
        return $num['number'];
    }
}
?>
<?php
if($req == 'yes'){
?>
<style>
.number{
    font-size: 10em;
    color: red;
}
</style>
<h3 class="text-center">Number Called Is</h3>
<h1 class="text-center number" id="numbercalledhere"></h1>

<?php
}
?>
<p id="pausednotice" class="text-center lead"></p>
<div class="container">
<button class="btn btn-info btn-block" id="jaldifive" onclick="jaldiFive(<?php echo $game_id; ?>, '<?php echo $ticket_id; ?>');">Jaldi 5</button>
<button class="btn btn-info btn-block" id="firstrow" onclick="firstRow(<?php echo $game_id; ?>, '<?php echo $ticket_id; ?>');">First Row</button>
<button class="btn btn-info btn-block" id="secondrow" onclick="secondRow(<?php echo $game_id; ?>, '<?php echo $ticket_id; ?>');">Second Row</button>
<button class="btn btn-info btn-block" id="thirdrow" onclick="thirdRow(<?php echo $game_id; ?>, '<?php echo $ticket_id; ?>');">Third Row</button>
<button class="btn btn-info btn-block" id="fullhouse" onclick="fullHouse(<?php echo $game_id; ?>, '<?php echo $ticket_id; ?>');">Full House</button>
</div>
<?php
include('footer.php');
?>

<script>
function ajaxSelectNum(num, game_id){
    $.ajax({
        url: "check_click.php?game_id="+game_id+"&number="+num,
        type: "GET",
        success: function(res){
            if(res == 'success'){
                $("#"+num).removeClass("btn-info");
                $("#"+num).addClass("btn-success disabled");
            }
            else{
                $("#"+num).removeClass("btn-info");
                $("#"+num).addClass("btn-danger").fadeOut("slow").removeClass("btn-danger").fadeIn("slow").addClass("btn-info");
            }
        }
    });
}
</script>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/5.11.1/firebase.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyDFjxUananMWf_pYEPMX7BJ7Rbkbgm9_pc",
    authDomain: "tambola-count.firebaseapp.com",
    databaseURL: "https://tambola-count.firebaseio.com",
    projectId: "tambola-count",
    storageBucket: "tambola-count.appspot.com",
    messagingSenderId: "85000612921",
    appId: "1:85000612921:web:74dd5523ee2a19c1"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
</script>
<?php
if($req == 'yes'){
?>
<script>
var numbers = firebase.database().ref('games/'+<?php echo $game_id; ?>);
numbers.on('value', function(snapshot){
    numbercalled = snapshot.val().number;
    $("#numbercalledhere").fadeOut().html(numbercalled).fadeIn();
    if(snapshot.val().gamePaused == true){
        $("#pausednotice").html("The Game has been Paused");
    }
    else{
        $("#pausednotice").html("");
    }
});
</script>
<?php
}
?>
<script>
function jaldiFive(game_id, ticket_id){
    firebase.database().ref('games/'+game_id).update({
        jaldifive: ticket_id,
        isjaldifiveseen: false,
        gamePaused: true
    });
    $("#jaldifive").addClass('disabled');
}
function firstRow(game_id, ticket_id){
    firebase.database().ref('games/'+game_id).update({
        firstrow: ticket_id,
        isfirstrowseen: false,
        gamePaused: true
    });
    $("#firstrow").addClass('disabled');
}
function secondRow(game_id, ticket_id){
    firebase.database().ref('games/'+game_id).update({
        secondrow: ticket_id,
        issecondrowseen: false,
        gamePaused: true
    });
    $("#secondrow").addClass('disabled');
}
function thirdRow(game_id, ticket_id){
    firebase.database().ref('games/'+game_id).update({
        thirdrow: ticket_id,
        isthirdrowseen: false,
        gamePaused: true
    });
    $("#thirdrow").addClass('disabled');
}
function fullHouse(game_id, ticket_id){
    firebase.database().ref('games/'+game_id).update({
        fullhouse: ticket_id,
        isfullhouseseen: false,
        gamePaused: true
    });
    $("#fullhouse").addClass('disabled');
}
firebase.database().ref('games/'+<?php echo $game_id; ?>).on('value', function(snap){
    jaldifive = snap.val().jaldifive;
    firstrow = snap.val().firstrow;
    secondrow = snap.val().secondrow;
    thirdrow = snap.val().thirdrow;
    fullhouse = snap.val().fullhouse;
    
    if(jaldifive != null){
        $("#jaldifive").addClass('disabled').html('Jaldi 5 - '+ jaldifive).attr('disabled', true);
    }
    else{
        $("#jaldifive").removeClass('disabled').html('Jaldi 5').attr('disabled', false);
    }
    if(firstrow != null){
        $("#firstrow").addClass('disabled').html('First Row - '+ firstrow).attr('disabled', true);
    }
    else{
        $("#firstrow").removeClass('disabled').html('First Row').attr('disabled', false);
    }
    if(secondrow != null){
        $("#secondrow").addClass('disabled').html('Second Row - '+ secondrow).attr('disabled', true);
    }
    else{
        $("#secondrow").removeClass('disabled').html('Second Row').attr('disabled', false);
    }
    if(thirdrow != null){
        $("#thirdrow").addClass('disabled').html('Third Row - '+ thirdrow).attr('disabled', true);
    }
    else{
        $("#thirdrow").removeClass('disabled').html('Third Row').attr('disabled', false);
    }
    if(fullhouse != null){
        $("#fullhouse").addClass('disabled').html('Full House - '+ fullhouse).attr('disabled', true);
    }
    else{
        $("#fullhouse").removeClass('disabled').html('Full House').attr('disabled', false);
    }
})
</script>
