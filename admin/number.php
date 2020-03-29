<?php
include('header.php');
include('navbar.php');
$game_id = $_REQUEST['id'];
mysqli_query($con, "UPDATE game SET status = 'On Going' WHERE id = $game_id");
?>
<style>
.number{
    font-size: 15em;
    color: red;
}
</style>
<h1 class="text-center">Number Called is</h3>
<br><br>
<h1 class="text-center number" id="number">00</h1>
<p class="text-center lead">Total Numbers Called: <span id="count"></span></p>
<p class="text-center"><button class="btn btn-warning" onclick="pauseFunc();" id="pause">Pause Game</button><a href="done.php?id=<?php echo $game_id; ?>" class="btn btn-danger">Game Over</a></p>
<div id="audio"></div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Verification for <span id="reason_head"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Called by Ticket ID: <span id="ticket_id"></span> for <span id="reason"></span>
      <div class="row">
      <div class="col">
      <ol id="num"></ol>
      </div>
      <div class="col">
      <ol id="person"></ol>
      </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Correct</button>
        <button type="button" class="btn btn-danger" id="incorrect">Incorrect</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="mypause" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Numbers Verification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Numbers till Now</p>
	  <div class="row">
      <ol id="num1"></ol>
      </div>
      </div>
    </div>
  </div>
</div>

<?php
include('footer.php');
?>

<script src="speakClient.js"></script>
<script>
$(document).ready(function(){
    callNumber();
});
var count=0;
var isPaused = false;
var timerDef = 10000;
function pauseFunc(){
    if(!isPaused){
        isPaused = true;
        timerDef = 1000;
        $("#pause").html("Resume Game");
        getNumbers();
        $('#mypause').modal('show');
        $('#mypause').modal('handleUpdate');
        firebase.database().ref('games/'+<?php echo $game_id; ?>).update({
            gamePaused: true
        })
    }
    else{
        isPaused = false;
        $("#pause").html("Pause Game");
        firebase.database().ref('games/'+<?php echo $game_id; ?>).update({
            gamePaused: null
        })
    }
}
function callNumber(){
    $.ajax({
        url: "number_call.php?id=<?php echo $game_id; ?>",
        type: "GET",
        success: function(res){
            if(res != 'recall'){
            $("#number").fadeOut().html(res).fadeIn();
            var tens = parseInt(res%10).toString();
            var ones = parseInt(res/10).toString();
            // console.log(tens);
            // console.log(ones);
            // speak(ones);
            // speak(tens);
            // speak(res);
            var string = ones + ",    "+tens+",   "+res;
            speak(string, {
                pitch: 60,
                wordgap: 2
            }); 
            writeNumbers(<?php echo $game_id; ?>, res)
            count++;
            $("#count").html(count);
            }
            else{
                callNumber();
            }
        }
    });
    timerDef = 5000;
}
window.setInterval(function(){
    if(count<90 && !isPaused){
        callNumber();
    }
}, timerDef);
if(count>=90){
    $("#number").fadeOut().html('OVER').fadeIn();
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
<script>
function getNumbers(){
    $.ajax({
        url: "get_numbers.php?game_id=<?php echo $game_id; ?>",
        type: "GET",
        dataType: 'JSON',
        success: function(numbers){
            var len = numbers.length;
            for(var i=0; i<len; i++){
                var number = numbers[i].number;
                var li_str = "<li>" + number + "</li>";
                $("#num").append(li_str);
                $("#num1").append(li_str);
            }
        }
    });
}
</script>
<script>
function getNumbersPerson(ticket_id, type){
    $.ajax({
        url: "get_numbers_person.php?ticket_id="+ticket_id+"&row="+type,
        type: "GET",
        dataType: 'JSON',
        success: function(person){
            var len = person.length;
            for(var i=0; i<len; i++){
                var number = person[i].number;
                var li_str = "<li>" + number + "</li>";
                $("#person").append(li_str);
            }
        }
    });
}
</script>
<script>
function writeNumbers(gameId, number) {
  firebase.database().ref('games/' + gameId).update({
    number: number
  });
}
firebase.database().ref('games/'+<?php echo $game_id; ?>).on('value', function(snapshot){
    isjaldifiveseen = isfirstrowseen = issecondrowseen = isthirdrowseen = isfullhouseseen = true;
    jaldifive = snapshot.val().jaldifive;
    firstrow = snapshot.val().firstrow;
    secondrow = snapshot.val().secondrow;
    thirdrow = snapshot.val().thirdrow;
    fullhouse = snapshot.val().fullhouse;
    isjaldifiveseen = snapshot.val().isjaldifiveseen;
    isfirstrowseen = snapshot.val().isfirstrowseen;
    issecondrowseen = snapshot.val().issecondrowseen;
    isthirdrowseen = snapshot.val().isthirdrowseen;
    isfullhouseseen = snapshot.val().isfullhouseseen;
    
    if(jaldifive != null && isjaldifiveseen == false){
        isPaused = true;
        getNumbers();
        getNumbersPerson(jaldifive, 0)
        $('#incorrect').data('ticket', 'jaldifive');
        $('#myModal').modal('show');
        $('#myModal').modal('handleUpdate');
        $("#ticket_id").html(jaldifive);
        $("#reason").html("Jaldi 5");
        $("#reason_head").html("Jaldi 5");
        firebase.database().ref('games/'+<?php echo $game_id; ?>).update({
            isjaldifiveseen: true
        })
    }
    if(firstrow != null && isfirstrowseen == false){
        isPaused = true;
        getNumbers();
        getNumbersPerson(firstrow, 1);
        $('#incorrect').data('ticket', 'firstrow');
        $('#myModal').modal('show');
        $('#myModal').modal('handleUpdate');
        $("#ticket_id").html(firstrow);
        $("#reason").html("First Row");
        $("#reason_head").html("First Row");
        firebase.database().ref('games/'+<?php echo $game_id; ?>).update({
            isfirstrowseen: true
        })
    }
    if(secondrow != null && issecondrowseen == false){
        isPaused = true;
        getNumbers();
        getNumbersPerson(secondrow, 2);
        $('#incorrect').data('ticket', 'secondrow');
        $('#myModal').modal('show');
        $('#myModal').modal('handleUpdate');
        $("#ticket_id").html(secondrow);
        $("#reason").html("Second Row");
        $("#reason_head").html("Second Row");
        firebase.database().ref('games/'+<?php echo $game_id; ?>).update({
            issecondrowseen: true
        })
    }
    if(thirdrow != null && isthirdrowseen == false){
        isPaused = true;
        getNumbers();
        getNumbersPerson(thirdrow, 3);
        $('#incorrect').data('ticket', 'thirdrow');
        $('#myModal').modal('show');
        $('#myModal').modal('handleUpdate');
        $("#ticket_id").html(thirdrow);
        $("#reason").html("Third Row");
        $("#reason_head").html("Third Row");
        firebase.database().ref('games/'+<?php echo $game_id; ?>).update({
            isthirdrowseen: true
        })
    }
    if(fullhouse != null && isfullhouseseen == false){
        isPaused = true;
        getNumbers();
        getNumbersPerson(fullhouse, 4);
        $('#incorrect').data('ticket', 'fullhouse');
        $('#myModal').modal('show');
        $('#myModal').modal('handleUpdate');
        $("#ticket_id").html(fullhouse);
        $("#reason").html("Full House");
        $("#reason_head").html("Full House");
        firebase.database().ref('games/'+<?php echo $game_id; ?>).update({
            isfullhouseseen: true
        })
    }
});

$("#incorrect").on('click', function(){
    var type = $(this).data("ticket");
    if(type == 'jaldifive'){
        firebase.database().ref('games/'+<?php echo $game_id; ?>).update({
            jaldifive: null,
            isjaldifiveseen: null
        })
        $('#myModal').modal('hide');
    }
    if(type == 'firstrow'){
        firebase.database().ref('games/'+<?php echo $game_id; ?>).update({
            firstrow: null,
            isfirstrowseen: null
        })
        $('#myModal').modal('hide');
    }
    if(type == 'secondrow'){
        firebase.database().ref('games/'+<?php echo $game_id; ?>).update({
            secondrow: null,
            issecondrowseen: null
        })
        $('#myModal').modal('hide');
    }
    if(type == 'thirdrow'){
        firebase.database().ref('games/'+<?php echo $game_id; ?>).update({
            thirdrow: null,
            isthirdrowseen: null
        })
        $('#myModal').modal('hide');
    }
    if(type == 'fullhouse'){
        firebase.database().ref('games/'+<?php echo $game_id; ?>).update({
            fullhouse: null,
            isfullhouseseen: null
        })
        $('#myModal').modal('hide');
    }
})

$('#myModal').on('hidden.bs.modal', function (e) {
  isPaused = false;
  $("#num").children('li').remove();
  $("#person").children('li').remove();
  firebase.database().ref('games/'+<?php echo $game_id; ?>).update({
      gamePaused: null
  })
})
</script>